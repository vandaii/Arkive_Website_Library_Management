<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalUser = User::where('role', 'peminjam')->where('isActive', true)->count();
        $peminjamanAktif = Peminjaman::where('status_peminjaman', 'Dipinjam')->count();
        $totalPengembalian = Peminjaman::whereIn('status_peminjaman', ['Dikembalikan', 'Terlambat'])->count();
        $totalPending = Peminjaman::where('status_peminjaman', 'Pending')->count();
        $totalTerlambat = Peminjaman::where('status_peminjaman', 'Terlambat')->count();

        $recentPeminjaman = Peminjaman::with('buku', 'user')
            ->latest()
            ->limit(5)
            ->get();

        $popularBooks = Buku::withCount('peminjaman')
            ->orderByDesc('peminjaman_count')
            ->limit(5)
            ->get();

        return view('admin.index', [
            'title' => 'Dashboard Admin',
            'totalBuku' => $totalBuku,
            'totalUser' => $totalUser,
            'peminjamanAktif' => $peminjamanAktif,
            'totalPengembalian' => $totalPengembalian,
            'totalPending' => $totalPending,
            'totalTerlambat' => $totalTerlambat,
            'recentPeminjaman' => $recentPeminjaman,
            'popularBooks' => $popularBooks,
        ]);
    }
}
