<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class KelolaKembaliController extends Controller
{
    public function index()
    {
        $pengembalians = Peminjaman::with('buku', 'user')->where('status_peminjaman', 'Dikembalikan')->get();
        $counts = Peminjaman::with('buku', 'user')->where('status_peminjaman', 'Pending Dikembalikan')->get()->count();
        return view('admin.kelola-kembali.index', compact('pengembalians', 'counts'), ['title' => 'Data Kembali']);
    }

    public function show()
    {
        return view('admin.kelola-kembali.show');
    }

    public function pengajuanPengembalian()
    {
        $pengajuans = Peminjaman::with('buku', 'user')->where('status_peminjaman', 'Pending Dikembalikan')->get();
        return view('admin.kelola-kembali.pengajuan-kembali', compact('pengajuans'));
    }
}
