<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function laporanBuku()
    {
        $books = Buku::with('kategoriBukuRelasi.kategori')->get();
        $tanggal = now()->format('d F Y');

        $pdf = Pdf::loadView('pdf.laporan-buku', compact('books', 'tanggal'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-data-buku.pdf');
    }

    public function laporanEmployee()
    {
        $users = User::where('isActive', true)->where('role', '!=', 'peminjam')->get();
        $tanggal = now()->format('d F Y');

        $pdf = Pdf::loadView('pdf.laporan-employee', compact('users', 'tanggal'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-data-petugas.pdf');
    }

    public function laporanUser()
    {
        $users = User::where('isActive', true)->where('role', 'peminjam')->get();
        $tanggal = now()->format('d F Y');

        $pdf = Pdf::loadView('pdf.laporan-user', compact('users', 'tanggal'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-data-peminjam.pdf');
    }

    public function laporanPeminjaman()
    {
        $peminjamans = Peminjaman::with('buku', 'user')
            ->where('status_peminjaman', '!=', 'Pending')
            ->latest()
            ->get();
        $tanggal = now()->format('d F Y');

        $pdf = Pdf::loadView('pdf.laporan-peminjaman', compact('peminjamans', 'tanggal'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-data-peminjaman.pdf');
    }

    public function laporanPengembalian()
    {
        $pengembalians = Peminjaman::with('buku', 'user')
            ->whereIn('status_peminjaman', ['Dikembalikan', 'Terlambat'])
            ->latest()
            ->get();
        $tanggal = now()->format('d F Y');

        $pdf = Pdf::loadView('pdf.laporan-pengembalian', compact('pengembalians', 'tanggal'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('laporan-data-pengembalian.pdf');
    }
}
