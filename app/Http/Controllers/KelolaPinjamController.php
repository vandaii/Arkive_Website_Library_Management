<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class KelolaPinjamController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('buku')->paginate(10);
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

    public function setujuPinjam($id)
    {
        $pengajuan = Peminjaman::with('user', 'buku')->find($id);
        $pengajuan->update([
            'status_peminjaman' => 'Dipinjam'
        ]);

        return redirect()->route('kelola-pinjam.index')->with('success');
    }

    public function tolakPinjam($id)
    {
        $pengajuan = Peminjaman::with('user', 'buku')->find($id);
        $pengajuan->update([
            'status_peminjaman' => 'Ditolak'
        ]);

        return redirect()->route('kelola-pinjam.index')->with('success');
    }
}
