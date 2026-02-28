<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;


class KelolaKembaliController extends Controller
{
    public function index()
    {
        $pengembalians = Peminjaman::with('buku', 'user')->where('status_peminjaman', 'Dikembalikan')->orWhere('status_peminjaman', 'Terlambat')->orWhere('status_peminjaman', 'Ditolak')->orderBy('id', 'DESC')->paginate(5);
        $counts = Peminjaman::with('buku', 'user')->where('status_peminjaman', 'Pending Dikembalikan')->get()->count();
        return view('admin.kelola-kembali.index', compact('pengembalians', 'counts'), ['title' => 'Data Kembali']);
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
        $deadline = Carbon::parse($pengajuan->tanggal_pengembalian);
        if ($deadline->isPast()) {
            $pengajuan->update([
                'status_peminjaman' => 'Terlambat',
                'tanggal_pengembalian' => date('Y-m-d')
            ]);
        } else {
            $pengajuan->update([
                'status_peminjaman' => 'Dikembalikan',
                'tanggal_pengembalian' => date('Y-m-d')
            ]);
        }

        return redirect()->route('kelola-kembali.index')->with('success');
    }

    public function tolakKembali($id)
    {
        $pengajuan = Peminjaman::with('user', 'buku')->find($id);
        $pengajuan->update([
            'status_peminjaman' => 'Ditolak'
        ]);

        return redirect()->route('kelola-kembali.index')->with('success');
    }
}
