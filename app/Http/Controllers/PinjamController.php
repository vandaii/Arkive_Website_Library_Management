<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $peminjamans = Peminjaman::with('buku', 'user')->where('status_peminjaman', '!=', 'Dikembalikan')->Where('status_peminjaman', '!=', 'Terlambat')->where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(6);
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            // 'stok' => 'required|integer|min:1|max:10',
            'tanggal_pengembalian' => 'required|date',
        ]);

        // Check book availability
        $book = Buku::find($validated['buku_id']);
        if ($book->stok <= 0) {
            echo ('er buku gaada');
            return redirect()->back()->with('error', 'Buku tidak tersedia');
        }

        // if ($book->stok < $validated['stok']) {
        //     echo ('er stok kurang gaada');
        //     return redirect()->back()->with('error', 'Stok buku tidak mencukupi untuk jumlah yang diminta');
        // }

        $book->update([
            'stok' => $book->stok - 1
        ]);

        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'buku_id' => $validated['buku_id'],
            'stok' => 1,
            'tanggal_peminjaman' => date('Y-m-d'),
            'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
            'status_peminjaman' => 'Pending'
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan peminjaman berhasil dibuat');
    }

    public function show($id)
    {
        $detail = Peminjaman::with('buku', 'user')->find($id);
        return view('peminjaman.show', compact('detail'));
    }

    public function history(Request $request)
    {
        $user = $request->user();
        $historys = Peminjaman::with('buku', 'user')->where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        return view('peminjaman.riwayat-peminjaman', compact('historys'));
    }

    public function kembalikanBuku($id)
    {
        $peminjaman = Peminjaman::with('buku', 'user')->find($id);
        $peminjaman->update([
            'status_peminjaman' => 'Pending Dikembalikan'
        ]);
        return redirect()->route('peminjaman.index')->with('success');
    }

    public function buktiPeminjaman($id)
    {
        $peminjaman = Peminjaman::with('buku', 'user', 'approver')->findOrFail($id);
        $pdf = Pdf::loadView('peminjaman.bukti-peminjaman-pdf', compact('peminjaman'));
        return $pdf->stream('bukti-peminjaman-' . $peminjaman->id . '.pdf');
    }

    public function buktiPengembalian($id)
    {
        $peminjaman = Peminjaman::with('buku', 'user', 'approver')->findOrFail($id);
        $pdf = Pdf::loadView('peminjaman.bukti-pengembalian-pdf', compact('peminjaman'));
        return $pdf->stream('bukti-pengembalian-' . $peminjaman->id . '.pdf');
    }
}
