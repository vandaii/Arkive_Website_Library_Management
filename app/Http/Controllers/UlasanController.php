<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'buku_id' => 'required|integer|exists:bukus,id',
            'ulasan' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $data['user_id'] = Auth::id();
        $bukuId = $data['buku_id'];

        Ulasan::create($data);

        return redirect()->route('book.show', $bukuId)->with('success', 'Ulasan berhasil ditambahkan');
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
        return redirect()->back()->with('success', 'Ulasan diperbarui');
    }

    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        if (Auth::id() !== $ulasan->user_id) {
            abort(403);
        }
        $ulasan->delete();
        return redirect()->back()->with('success', 'Ulasan dihapus');
    }
}
