<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;

class KelolaPinjamController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with('buku', 'user')->where('status_peminjaman', '!=', 'Pending');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('buku', function ($bq) use ($search) {
                    $bq->where('judul', 'like', '%' . $search . '%');
                })->orWhereHas('user', function ($uq) use ($search) {
                    $uq->where('nama_lengkap', 'like', '%' . $search . '%')
                       ->orWhere('username', 'like', '%' . $search . '%');
                });
            });
        }

        $peminjamans = $query->orderBy('id', 'DESC')->paginate(10);
        $counts = Peminjaman::with('buku', 'user')->where('status_peminjaman', 'Pending')->get()->count();
        return view('admin.kelola-pinjam.index', compact('peminjamans', 'counts'), ['title' => 'Data Peminjaman']);
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

    public function setujuPinjam(Request $request, $id)
    {
        $pengajuan = Peminjaman::with('user', 'buku')->find($id);
        $user = $request->user();

        // Validate book stock
        if ($pengajuan->buku->stok < $pengajuan->stok) {
            return redirect()->route('kelola-pinjam.pengajuan-pinjaman')
                ->with('error', 'Stok buku tidak mencukupi');
        }

        $pengajuan->update([
            'status_peminjaman' => 'Dipinjam',
            'approved_by' => $user->id
        ]);

        return redirect()->route('kelola-pinjam.index')->with('success');
    }

    public function tolakPinjam(Request $request, $id)
    {
        $pengajuan = Peminjaman::with('user', 'buku')->find($id);
        $user = $request->user();

        // Restore book stock since request is rejected
        $book = $pengajuan->buku;
        $book->update([
            'stok' => $book->stok + $pengajuan->stok
        ]);

        $pengajuan->update([
            'status_peminjaman' => 'Ditolak',
            'approved_by' => $user->id
        ]);

        return redirect()->route('kelola-pinjam.index')->with('success');
    }
}
