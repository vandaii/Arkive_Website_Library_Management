<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Koleksi;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $koleksi = Koleksi::with('buku', 'user')->where('buku_id', $id)->where('user_id', $user->id)->get();
        $countRating = Ulasan::with('buku')->where('buku_id', $id)->get();
        $ulasans = Ulasan::with('user')->where('buku_id', $id)->latest()->get();
        return view('book.show', compact('book', 'countRating', 'koleksi', 'ulasans'));
    }

    public function userDashboard(Request $request)
    {
        $query = Buku::with('kategoriBukuRelasi.kategori', 'ulasan');
        $categories = Kategori::with('kategoriBukuRelasi')->get();

        // Filter by kategori
        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $kategoriId = $request->kategori;
            $query->whereHas('kategoriBukuRelasi', function ($q) use ($kategoriId) {
                $q->where('kategori_id', $kategoriId);
            });
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'judul_asc':
                    $query->orderBy('judul', 'ASC');
                    break;
                case 'judul_desc':
                    $query->orderBy('judul', 'DESC');
                    break;
                case 'tahun_desc':
                    $query->orderBy('tahun_terbit', 'DESC');
                    break;
                case 'tahun_asc':
                    $query->orderBy('tahun_terbit', 'ASC');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $books = $query->get();
        return view('user.index', compact('books', 'categories'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search', '');

        $query = Buku::with('kategoriBukuRelasi.kategori', 'ulasan');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%");
            });
        }

        $books = $query->get();
        $categories = Kategori::with('kategoriBukuRelasi')->get();

        return view('user.index', compact('books', 'categories', 'search'));
    }
}
