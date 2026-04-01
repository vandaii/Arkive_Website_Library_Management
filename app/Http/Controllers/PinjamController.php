<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $peminjamans = Peminjaman::with('buku', 'user')->where('status_peminjaman', '!=', 'Dikembalikan')->Where('status_peminjaman', '!=', 'Terlambat')->where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(6);
        $returns = Peminjaman::with('buku', 'user')->where('status_peminjaman', 'Dikembalikan')->orWhere('status_peminjaman', 'Terlambat')->where('user_id', $user->id)->get();
        return view('peminjaman.index', compact('peminjamans', 'returns'));
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'estimasi_tanggal_pengembalian' => 'required|date|after:tanggal_peminjaman',
            'tanggal_peminjaman' => 'required|date',
        ]);

        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'buku_id' => $validated['buku_id'],
            'tanggal_peminjaman' => $validated['tanggal_peminjaman'],
            'estimasi_tanggal_pengembalian' => $validated['estimasi_tanggal_pengembalian'],
            'status_peminjaman' => 'Pending'
        ]);

        $book = Buku::with('peminjaman')->find($peminjaman->buku_id);
        $stock = $book->stok;
        $newStock = $stock - 1;
        $book->update([
            'stok' => $newStock
        ]);

        return redirect()->route('peminjaman.index')->with('success');
    }

    public function show($id)
    {
        $detail = Peminjaman::with('buku', 'user')->find($id);
        return view('peminjaman.show', compact('detail'));
    }

    public function history(Request $request)
    {
        $user = $request->user();
        $historys = Peminjaman::with('buku', 'user')->where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        return view('peminjaman.riwayat-peminjaman', compact('historys'));
    }

    public function kembalikanBuku($id)
    {
        $peminjaman = Peminjaman::with('buku', 'user')->find($id);
        $peminjaman->update([
            'status_peminjaman' => 'Pending Dikembalikan'
        ]);
        return redirect()->route('peminjaman.index')->with('success');
    }
}
