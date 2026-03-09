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
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'stok' => 'required|integer|min:1|max:10',
            'tanggal_pengembalian' => 'required|date|after:today',
        ]);

        // Check book availability
        $book = Buku::find($validated['buku_id']);
        if ($book->stok <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia');
        }

        if ($book->stok < $validated['stok']) {
            return redirect()->back()->with('error', 'Stok buku tidak mencukupi untuk jumlah yang diminta');
        }

        // Check if user has too many pending loans
        $pendingCount = Peminjaman::where('user_id', $user->id)
            ->whereIn('status_peminjaman', ['Pending', 'Dipinjam', 'Pending Dikembalikan'])
            ->count();

        if ($pendingCount >= 5) {
            return redirect()->back()->with('error', 'Anda sudah memiliki terlalu banyak peminjaman yang aktif');
        }

        // Deduct stock immediately when request is created
        $book->update([
            'stok' => $book->stok - $validated['stok']
        ]);

        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'buku_id' => $validated['buku_id'],
            'stok' => $validated['stok'],
            'tanggal_peminjaman' => date('Y-m-d'),
            'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
            'status_peminjaman' => 'Pending'
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan peminjaman berhasil dibuat');
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
