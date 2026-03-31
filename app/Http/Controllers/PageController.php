<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Ulasan;

class PageController extends Controller
{
    public function index()
    {
        $books = Buku::with('kategoriBukuRelasi', 'ulasan')->get();
        return view('index', compact('books'));
    }

    public function show($id)
    {
        $book = Buku::select('id', 'cover_buku', 'judul', 'penulis', 'penerbit', 'tahun_terbit', 'isbn_number', 'deskripsi', 'stok')
            ->with(['kategoriBukuRelasi' => function ($q) {
                $q->select('id', 'buku_id', 'kategori_id')->with('kategori:id,nama_kategori');
            }])->find($id);
        $countRating = Ulasan::with('buku')->where('buku_id', $id)->get();
        return view('book.show', compact('book', 'countRating'));
    }

    public function userDashboard()
    {
        $books = Buku::with('kategoriBukuRelasi', 'ulasan')->get();
        $categories = Kategori::with('kategoriBukuRelasi')->get();
        return view('user.index', compact('books', 'categories'));
    }
}
