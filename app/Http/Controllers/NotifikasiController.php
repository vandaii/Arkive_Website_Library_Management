<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasis = Notifikasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('notifikasi.index', compact('notifikasis'));
    }

    public function markAsRead($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);

        if ($notifikasi->user_id !== Auth::id()) {
            abort(403);
        }

        $notifikasi->update(['is_read' => true]);

        if ($notifikasi->link) {
            return redirect($notifikasi->link);
        }

        return redirect()->back();
    }

    public function markAllRead()
    {
        Notifikasi::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Semua notifikasi ditandai sudah dibaca');
    }

    public function destroy($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);

        if ($notifikasi->user_id !== Auth::id()) {
            abort(403);
        }

        if (!$notifikasi->is_read) {
            return redirect()->back()->with('error', 'Notifikasi belum dibaca, tidak bisa dihapus.');
        }

        $notifikasi->delete();

        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus');
    }

    public function destroyAll()
    {
        $deleted = Notifikasi::where('user_id', Auth::id())
            ->where('is_read', true)
            ->delete();

        if ($deleted === 0) {
            return redirect()->back()->with('info', 'Tidak ada notifikasi yang bisa dihapus');
        }

        return redirect()->back()->with('success', "Berhasil menghapus {$deleted} notifikasi");
    }
}
