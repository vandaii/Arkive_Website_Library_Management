<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Show books report
     */
    public function bukuReport(Request $request)
    {
        $bukus = Buku::all();

        return view('reports.buku-report', [
            'bukus' => $bukus,
            'title' => 'Laporan Data Buku'
        ]);
    }

    /**
     * Show loan report (peminjaman)
     */
    public function peminjamanReport(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = Peminjaman::with('buku', 'user', 'approver');

        if ($startDate) {
            $query->whereDate('tanggal_peminjaman', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('tanggal_peminjaman', '<=', $endDate);
        }

        $peminjamans = $query->orderBy('tanggal_peminjaman', 'DESC')->get();

        return view('reports.peminjaman-report', [
            'peminjamans' => $peminjamans,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'title' => 'Laporan Data Peminjaman'
        ]);
    }

    /**
     * Show return report (pengembalian)
     */
    public function pengembalianReport(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = Peminjaman::with('buku', 'user', 'approver')
            ->whereIn('status_peminjaman', ['Dikembalikan', 'Terlambat']);

        if ($startDate) {
            $query->whereDate('tanggal_pengembalian_aktual', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('tanggal_pengembalian_aktual', '<=', $endDate);
        }

        $pengembalians = $query->orderBy('tanggal_pengembalian_aktual', 'DESC')->get();

        // Calculate summary
        $totalDenda = $pengembalians->sum('denda');
        $terlambatCount = $pengembalians->where('status_peminjaman', 'Terlambat')->count();

        return view('reports.pengembalian-report', [
            'pengembalians' => $pengembalians,
            'totalDenda' => $totalDenda,
            'terlambatCount' => $terlambatCount,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'title' => 'Laporan Data Pengembalian'
        ]);
    }

    /**
     * Show summary/dashboard report
     */
    public function dashboardReport()
    {
        // Total statistics
        $totalBuku = Buku::count();
        $totalPeminjaman = Peminjaman::count();
        $peminjamanAktif = Peminjaman::whereIn('status_peminjaman', ['Pending', 'Dipinjam', 'Pending Dikembalikan'])->count();
        $terlambat = Peminjaman::where('status_peminjaman', 'Terlambat')->count();
        $totalDenda = Peminjaman::where('status_peminjaman', 'Terlambat')->sum('denda');

        // Books status
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', '<=', 0)->count();

        // Top 10 most borrowed books
        $bukuPopuler = Peminjaman::select('buku_id')
            ->groupBy('buku_id')
            ->selectRaw('count(*) as total')
            ->orderBy('total', 'DESC')
            ->limit(10)
            ->with('buku')
            ->get();

        return view('reports.dashboard-report', [
            'totalBuku' => $totalBuku,
            'totalPeminjaman' => $totalPeminjaman,
            'peminjamanAktif' => $peminjamanAktif,
            'terlambat' => $terlambat,
            'totalDenda' => $totalDenda,
            'bukuTersedia' => $bukuTersedia,
            'bukuHabis' => $bukuHabis,
            'bukuPopuler' => $bukuPopuler,
            'title' => 'Laporan Dashboard'
        ]);
    }
}
