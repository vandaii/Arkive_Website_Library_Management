<?php

namespace App\View;

use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotifikasiComposer
{
    public function compose(View $view)
    {
        if (Auth::check()) {
            $userId = Auth::id();

            $unreadCount = Notifikasi::where('user_id', $userId)
                ->where('is_read', false)
                ->count();

            $latestNotifikasi = Notifikasi::where('user_id', $userId)
                ->orderBy('created_at', 'DESC')
                ->take(5)
                ->get();

            $view->with('unreadNotifCount', $unreadCount);
            $view->with('latestNotifikasi', $latestNotifikasi);
        } else {
            $view->with('unreadNotifCount', 0);
            $view->with('latestNotifikasi', collect());
        }
    }
}
