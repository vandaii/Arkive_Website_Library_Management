<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategoriBukuRelasi', 'ulasan');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('penulis', 'like', '%' . $search . '%')
                    ->orWhere('penerbit', 'like', '%' . $search . '%');
            });
        }

        $books = $query->get();
        return view('index', compact('books'));
    }

    public function show($id)
    {
        $book = Buku::select('id', 'cover_buku', 'judul', 'penulis', 'penerbit', 'tahun_terbit', 'stok')
            ->with(['kategoriBukuRelasi' => function ($q) {
                $q->select('id', 'buku_id', 'kategori_id')->with('kategori:id,nama_kategori');
            }])->find($id);

        $canReview = false;
        if (Auth::check()) {
            $canReview = Peminjaman::where('user_id', Auth::id())
                ->where('buku_id', $id)
                ->whereIn('status_peminjaman', ['Dikembalikan', 'Terlambat'])
                ->exists();
        }

        return view('book.show', compact('book', 'canReview'));
    }
}
