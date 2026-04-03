<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Notifikasi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $peminjamans = Peminjaman::with('buku', 'user')
            ->where('status_peminjaman', '!=', 'Dikembalikan')
            ->where('status_peminjaman', '!=', 'Terlambat')
            ->where('user_id', $user->id)
            ->orderBy('id', 'DESC')
            ->paginate(6);
        return view('peminjaman.index', compact('peminjamans'));
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

        // Notifikasi ke admin/petugas
        Notifikasi::kirimKeAdminPetugas(
            'Pengajuan Peminjaman Baru',
            "User {$user->nama_lengkap} mengajukan peminjaman buku \"{$book->judul}\"",
            'info',
            route('kelola-pinjam.pengajuan-pinjaman')
        );

        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan peminjaman berhasil dikirim!');
    }

    public function show($id)
    {
        $detail = Peminjaman::with('buku', 'user')->find($id);
        return view('peminjaman.show', compact('detail'));
    }

    public function history(Request $request)
    {
        $user = $request->user();
        $query = Peminjaman::with('buku.ulasan', 'user')->where('user_id', $user->id);

        // Search by judul buku
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('buku', function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status_peminjaman') && $request->status_peminjaman !== 'All') {
            $query->where('status_peminjaman', $request->status_peminjaman);
        }

        $historys = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();
        return view('peminjaman.riwayat-peminjaman', compact('historys'));
    }

    public function detailRiwayat($id)
    {
        $detail = Peminjaman::with('buku', 'user')->find($id);
        return view('peminjaman.riwayat-detail', compact('detail'));
    }

    public function kembalikanBuku(Request $request, $id)
    {
        $validated = $request->validate([
            'notes' => 'string|nullable'
        ]);
        $peminjaman = Peminjaman::with('buku', 'user')->find($id);
        $peminjaman->update([
            'notes' => $validated['notes'],
            'status_peminjaman' => 'Pending Dikembalikan'
        ]);

        // Notifikasi ke admin/petugas
        $user = $request->user();
        Notifikasi::kirimKeAdminPetugas(
            'Pengajuan Pengembalian Buku',
            "User {$user->nama_lengkap} mengajukan pengembalian buku \"{$peminjaman->buku->judul}\"",
            'info',
            route('kelola-kembali.pengajuan-kembali')
        );

        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan pengembalian berhasil dikirim!');
    }
}
