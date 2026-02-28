<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class PageController extends Controller
{
    public function index()
    {
        $books = Buku::with('kategoriBukuRelasi', 'ulasan')->get();
        return view('index', compact('books'));
    }

    public function show($id)
    {
        $book = Buku::select('id', 'cover_buku', 'judul', 'penulis', 'penerbit', 'tahun_terbit', 'stok')
            ->with(['kategoriBukuRelasi' => function ($q) {
                $q->select('id', 'buku_id', 'kategori_id')->with('kategori:id,nama_kategori');
            }])->find($id);
        return view('book.show', compact('book'));
    }
}
