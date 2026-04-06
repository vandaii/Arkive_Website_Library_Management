<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function index(Request $request)
    {
        $query = Ulasan::with(['user', 'buku'])->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%");
            })->orWhereHas('buku', function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%");
            });
        }

        $ulasans = $query->paginate(10)->withQueryString();
        return view('admin.ulasan.index', compact('ulasans'), ['title' => 'Kelola Ulasan']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'buku_id' => 'required|integer|exists:bukus,id',
            'ulasan' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Cek apakah user punya peminjaman yang sudah dikembalikan/terlambat untuk buku ini
        $hasPeminjaman = Peminjaman::where('user_id', Auth::id())
            ->where('buku_id', $data['buku_id'])
            ->whereIn('status_peminjaman', ['Dikembalikan', 'Terlambat'])
            ->exists();

        if (!$hasPeminjaman) {
            return redirect()->back()->with('error', 'Anda hanya dapat menulis ulasan untuk buku yang sudah dikembalikan.');
        }

        // Cek apakah user sudah pernah review buku ini
        $existingReview = Ulasan::where('user_id', Auth::id())
            ->where('buku_id', $data['buku_id'])
            ->exists();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Anda sudah pernah menulis ulasan untuk buku ini.');
        }

        $data['user_id'] = Auth::id();

        Ulasan::create($data);

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $ulasan = Ulasan::findOrFail($id);
        if (Auth::id() !== $ulasan->user_id) {
            abort(403);
        }

        $data = $request->validate([
            'ulasan' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $ulasan->update($data);
        return redirect()->back()->with('success', 'Ulasan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        if (Auth::id() !== $ulasan->user_id) {
            abort(403);
        }
        $ulasan->delete();
        return redirect()->back()->with('success', 'Ulasan berhasil dihapus!');
    }
}
