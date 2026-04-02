<?php

namespace App\Http\Controllers;

use App\Models\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KoleksiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $collections = Koleksi::with('buku', 'user')->where('user_id', $user->id)->get();
        return view('koleksi.index', compact('collections'));
    }

    public function store(Request $request)
    {
        $user = $request->user();
        Koleksi::with('buku', 'user')->create([
            'buku_id' => $request->buku_id,
            'user_id' => $user->id
        ]);

        return redirect()->back()->with('success');
    }

    public function destroy(Request $request)
    {
        $koleksi = Koleksi::with('buku', 'user')->where('buku_id', $request->buku_id)->where('user_id', $request->user()->id);
        $koleksi->delete();
        return redirect()->back()->with('success');
    }
}
