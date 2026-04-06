<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\KategoriBukuRelasi;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BukuController extends Controller
{
    public function index()
    {
        $books = Buku::with(['kategoriBukuRelasi.kategori'])->get();
        return view('admin.data-buku.index', compact('books'), ['title' => 'Data Buku']);
    }

    public function create()
    {
        $categories = Kategori::all();
        return view('admin.data-buku.create', compact('categories'), ['title' => 'tambah buku']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cover_buku' => 'required|image|mimes:png,jpg|max:2048',
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'required|integer',
            'isbn_number' => 'required|string',
            'jumlah_halaman' => 'required|integer',
            'stok' => 'required|integer',
            'deskripsi' => 'string|nullable',
            'kategori' => 'required|array',
            'kategori.*' => 'required|exists:kategoris,id'
        ]);

        $coverPath = $request->file('cover_buku')->store('cover', 'public');

        $book = Buku::create([
            'cover_buku' => $coverPath,
            'judul' => $validated['judul'],
            'penulis' => $validated['penulis'],
            'penerbit' => $validated['penerbit'],
            'tahun_terbit' => $validated['tahun_terbit'],
            'isbn_number' => $validated['isbn_number'],
            'jumlah_halaman' => $validated['jumlah_halaman'],
            'stok' => $validated['stok'],
            'deskripsi' => $validated['deskripsi'],
        ]);

        foreach ($request->kategori as $kategori) {
            KategoriBukuRelasi::create([
                'buku_id' => $book->id,
                'kategori_id' => $kategori
            ]);
        }

        // Notifikasi ke admin/petugas
        Notifikasi::kirimKeAdminPetugas(
            'Koleksi Buku Baru',
            "Buku baru \"{$book->judul}\" telah ditambahkan ke koleksi perpustakaan.",
            'success'
        );

        return redirect()->route('data-buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function detail($id)
    {
        $book = Buku::with(['kategoriBukuRelasi.kategori', 'ulasan'])->findOrFail($id);
        $categories = $book->kategoriBukuRelasi->pluck('kategori.nama_kategori')->filter()->implode(', ') ?: '-';
        $avgRating = $book->ulasan->count() > 0 ? number_format($book->ulasan->avg('rating'), 1) : '0';
        $reviewCount = $book->ulasan->count();
        return view('admin.data-buku._detail', compact('book', 'categories', 'avgRating', 'reviewCount'));
    }

    public function show($id)
    {
        $book = Buku::select('id', 'cover_buku', 'judul', 'penulis', 'penerbit', 'tahun_terbit', 'stok')
            ->with(['kategoriBukuRelasi' => function ($q) {
                $q->select('id', 'buku_id', 'kategori_id')->with('kategori:id,nama_kategori');
            }])->find($id);
        $categories = Kategori::select('id', 'nama_kategori')->with('kategoriBukuRelasi.buku')->get();
        $relations = KategoriBukuRelasi::where('buku_id', $book->id)->get();
        return view('admin.data-buku.edit', compact('book', 'categories', 'relations'), ['title' => 'Edit Buku']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'cover_buku' => 'image|mimes:png,jpg|max:2048',
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer',
            'kategori' => 'required|array',
            'kategori.*' => 'required|exists:kategoris,id'
        ]);

        $book = Buku::with('kategoriBukuRelasi.kategori')->find($id);

        if ($request->has('kategori')) {
            KategoriBukuRelasi::with('buku')->where('buku_id', $book->id)->delete();
            foreach ($request->kategori as $kategori) {
                KategoriBukuRelasi::create([
                    'buku_id' => $book->id,
                    'kategori_id' => $kategori
                ]);
            }
        }

        $book->update([
            'judul' => $validated['judul'],
            'penulis' => $validated['penulis'],
            'penerbit' => $validated['penerbit'],
            'tahun_terbit' => $validated['tahun_terbit'],
            'stok' => $validated['stok'],
        ]);

        if ($request->has('cover_buku')) {
            $oldCoverPath = '/storage/' . $book->cover_buku;
            if (File::exists(public_path($oldCoverPath))) {
                File::delete(public_path($oldCoverPath));
            }
            $coverPath = $request->file('cover_buku')->store('cover', 'public');
            $book->update([
                'cover_buku' => $coverPath
            ]);
        }

        return redirect()->route('data-buku.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $book = Buku::with('kategoriBukuRelasi.kategori')->find($id);
        $judul = $book->judul;

        $oldCoverPath = '/storage/' . $book->cover_buku;
        if (File::exists(public_path($oldCoverPath))) {
            File::delete(public_path($oldCoverPath));
        }

        KategoriBukuRelasi::with('buku')->where('buku_id', $book->id)->delete();
        $book->delete();

        // Notifikasi ke admin/petugas
        Notifikasi::kirimKeAdminPetugas(
            'Buku Dihapus',
            "Buku \"{$judul}\" telah dihapus dari koleksi perpustakaan.",
            'warning'
        );

        return redirect()->route('data-buku.index')->with('success', 'Buku berhasil dihapus!');
    }
}
