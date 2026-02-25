<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class PinjamController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('buku', 'user')->where('status_peminjaman', '!=', 'Dikembalikan')->paginate(6);
        $returns = Peminjaman::with('buku')->where('status_peminjaman', '==', 'Dikembalikan')->paginate(6);
        return view('peminjaman.index', compact('peminjamans', 'returns'));
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'stok' => 'required|integer|max:10',
            'tanggal_pengembalian' => 'required|date',
        ]);

        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'buku_id' => $validated['buku_id'],
            'stok' => $validated['stok'],
            'tanggal_peminjaman' => date('Y-m-d'),
            'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
            'status_peminjaman' => 'Pending'
        ]);

        $book = Buku::with('peminjaman')->find($peminjaman->buku_id);
        $stock = $book->stok;
        $newStock = $stock - $peminjaman->stok;
        $book->update([
            'stok' => $newStock
        ]);

        return redirect()->route('peminjaman.index')->with('success');
    }
}
