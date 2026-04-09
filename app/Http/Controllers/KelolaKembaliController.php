<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;


class KelolaKembaliController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with('buku', 'user')->whereIn('status_peminjaman', ['Dikembalikan', 'Terlambat', 'Ditolak']);
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('buku', function ($b) use ($search) {
                    $b->where('judul', 'like', "%{$search}%")->orWhere('penulis', 'like', "%{$search}%");
                })->orWhereHas('user', function ($u) use ($search) {
                    $u->where('nama_lengkap', 'like', "%{$search}%");
                });
            });
        }
        $pengembalians = $query->orderBy('id', 'DESC')->paginate(10)->withQueryString();
        $counts = Peminjaman::with('buku', 'user')->where('status_peminjaman', 'Pending Dikembalikan')->get()->count();
        return view('admin.kelola-kembali.index', compact('pengembalians', 'counts'), ['title' => 'Data Kembali']);
    }

    public function detail($id)
    {
        $pengembalian = Peminjaman::with('buku', 'user')->findOrFail($id);
        return view('admin.kelola-kembali._detail', compact('pengembalian'));
    }

    public function show($id)
    {
        $pengembalian = Peminjaman::with('buku', 'user')->find($id);
        return view('admin.kelola-kembali.show', compact('pengembalian'), ['title' => 'Detail']);
    }

    public function pengajuanPengembalian()
    {
        $pengajuans = Peminjaman::with('buku', 'user')->where('status_peminjaman', 'Pending Dikembalikan')->get();
        return view('admin.kelola-kembali.pengajuan-kembali', compact('pengajuans'));
    }

    public function setujuKembali($id)
    {
        $pengajuan = Peminjaman::with('user', 'buku')->find($id);
        $deadline = Carbon::parse($pengajuan->estimasi_tanggal_pengembalian);

        if ($deadline->isPast()) {
            $pengajuan->update([
                'status_peminjaman' => 'Terlambat',
                'tanggal_pengembalian' => date('Y-m-d')
            ]);

            // Notifikasi ke user - terlambat tapi bisa tulis ulasan
            Notifikasi::kirim(
                $pengajuan->user_id,
                'Pengembalian Disetujui (Terlambat)',
                "Pengembalian buku \"{$pengajuan->buku->judul}\" disetujui (tercatat terlambat). Anda dapat menulis ulasan!",
                'warning',
                route('peminjaman.riwayat-peminjaman')
            );
        } else {
            $pengajuan->update([
                'status_peminjaman' => 'Dikembalikan',
                'tanggal_pengembalian' => date('Y-m-d')
            ]);

            // Notifikasi ke user - berhasil dikembalikan, bisa tulis ulasan
            Notifikasi::kirim(
                $pengajuan->user_id,
                'Pengembalian Disetujui',
                "Pengembalian buku \"{$pengajuan->buku->judul}\" disetujui. Anda dapat menulis ulasan di halaman riwayat!",
                'success',
                route('peminjaman.riwayat-peminjaman')
            );
        }

        return redirect()->route('kelola-kembali.index')->with('success', 'Pengembalian berhasil disetujui');
    }

    public function tolakKembali($id)
    {
        $pengajuan = Peminjaman::with('user', 'buku')->find($id);
        $pengajuan->update([
            'status_peminjaman' => 'Ditolak'
        ]);

        // Notifikasi ke user
        Notifikasi::kirim(
            $pengajuan->user_id,
            'Pengembalian Ditolak',
            "Pengembalian buku \"{$pengajuan->buku->judul}\" ditolak oleh admin.",
            'error',
            route('peminjaman.riwayat-peminjaman')
        );

        return redirect()->route('kelola-kembali.index')->with('success', 'Pengembalian berhasil ditolak');
    }
}
