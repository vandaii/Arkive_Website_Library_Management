<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\KategoriBukuRelasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BukuController extends Controller
{
    public function index()
    {
        $books = Buku::with('kategoriBukuRelasi.kategori')->get();
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
            'stok' => 'required|integer',
            'kategori' => 'required'
        ]);

        $coverPath = $request->file('cover_buku')->store('cover', 'public');

        $book = Buku::create([
            'cover_buku' => $coverPath,
            'judul' => $validated['judul'],
            'penulis' => $validated['penulis'],
            'penerbit' => $validated['penerbit'],
            'tahun_terbit' => $validated['tahun_terbit'],
            'stok' => $validated['stok'],
        ]);

        KategoriBukuRelasi::create([
            'buku_id' => $book->id,
            'kategori_id' => $validated['kategori']
        ]);

        return redirect()->route('data-buku.index')->with('success');
    }

    public function show($id)
    {
        $book = Buku::with('kategoriBukuRelasi')->find($id);
        $categories = Kategori::with('kategoriBukuRelasi.buku')->get();
        return view('admin.data-buku.edit', compact('book', 'categories'), ['title' => 'Edit Buku']);
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
            'kategori' => 'required'
        ]);

        $book = Buku::with('kategoriBukuRelasi.kategori')->find($id);

        if ($request->has('kategori')) {
            KategoriBukuRelasi::with('buku')->where('buku_id', $book->id)->delete();
            KategoriBukuRelasi::create([
                'buku_id' => $book->id,
                'kategori_id' => $validated['kategori']
            ]);
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

        return redirect()->route('data-buku.index')->with('success');
    }

    public function destroy($id)
    {
        $book = Buku::with('kategoriBukuRelasi.kategori')->find($id);

        $oldCoverPath = '/storage/' . $book->cover_buku;
        if (File::exists(public_path($oldCoverPath))) {
            File::delete(public_path($oldCoverPath));
        }

        $relation = KategoriBukuRelasi::with('buku')->where('buku_id', $book->id)->delete();
        $book->delete();

        return redirect()->route('data-buku.index')->with('success');
    }
}
