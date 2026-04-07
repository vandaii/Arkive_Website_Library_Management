<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class KelolaPinjamController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('buku')->where('status_peminjaman', '!=', 'Pending')->orderBy('id', 'DESC')->paginate(10);
        $counts = Peminjaman::with('buku', 'user')->where('status_peminjaman', 'Pending')->get()->count();
        return view('admin.kelola-pinjam.index', compact('peminjamans', 'counts'), ['title' => 'Data Peminjaman']);
    }

    public function detail($id)
    {
        $peminjaman = Peminjaman::with('buku', 'user')->findOrFail($id);
        return view('admin.kelola-pinjam._detail', compact('peminjaman'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with('buku', 'user')->find($id);
        return view('admin.kelola-pinjam.show', compact('peminjaman'), ['title' => 'Detail Pinjam']);
    }

    public function pengajuanPeminjaman()
    {
        $pengajuans = Peminjaman::with('buku', 'user')->where('status_peminjaman', 'Pending')->get();
        return view('admin.kelola-pinjam.pengajuan-pinjaman', compact('pengajuans'), ['title' => 'Pengajuan Pinjam']);
    }

    public function setujuPinjam($id)
    {
        $pengajuan = Peminjaman::with('user', 'buku')->find($id);
        $pengajuan->update([
            'status_peminjaman' => 'Dipinjam'
        ]);

        // Notifikasi ke user
        Notifikasi::kirim(
            $pengajuan->user_id,
            'Peminjaman Disetujui',
            "Peminjaman buku \"{$pengajuan->buku->judul}\" telah disetujui. Selamat membaca!",
            'success',
            route('peminjaman.show', $pengajuan->id)
        );

        return redirect()->route('kelola-pinjam.index')->with('success', 'Peminjaman berhasil disetujui');
    }

    public function tolakPinjam($id)
    {
        $pengajuan = Peminjaman::with('user', 'buku')->find($id);
        $pengajuan->update([
            'status_peminjaman' => 'Ditolak'
        ]);

        // Notifikasi ke user
        Notifikasi::kirim(
            $pengajuan->user_id,
            'Peminjaman Ditolak',
            "Peminjaman buku \"{$pengajuan->buku->judul}\" ditolak oleh admin.",
            'error',
            route('peminjaman.riwayat-peminjaman')
        );

        return redirect()->route('kelola-pinjam.index')->with('success', 'Peminjaman berhasil ditolak');
    }
}
