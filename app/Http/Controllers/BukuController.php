<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\KategoriBukuRelasi;
use Illuminate\Http\Request;

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
}
