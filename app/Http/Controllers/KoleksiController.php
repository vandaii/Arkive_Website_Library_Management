<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KoleksiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $collections = Koleksi::with('buku.kategoriBukuRelasi.kategori', 'buku.ulasan', 'user')->where('user_id', $user->id)->get();
        return view('koleksi.index', compact('collections'));
    }

    public function store(Request $request)
    {
        $user = $request->user();
        Koleksi::with('buku', 'user')->create([
            'buku_id' => $request->buku_id,
            'user_id' => $user->id
        ]);

        return redirect()->back()->with('success', 'Buku ditambahkan ke koleksi!');
    }

    public function destroy(Request $request)
    {
        $koleksi = Koleksi::with('buku', 'user')->where('buku_id', $request->buku_id)->where('user_id', $request->user()->id);
        $buku = Buku::find($request->buku_id);
        $koleksi->delete();
        return redirect()->back()->with('success', $buku->judul . ' dihapus dari koleksi!');
    }
}
