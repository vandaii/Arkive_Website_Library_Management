<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'pesan',
        'tipe',
        'is_read',
        'link'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function kirim($userId, $judul, $pesan, $tipe = 'info', $link = null)
    {
        return self::create([
            'user_id' => $userId,
            'judul' => $judul,
            'pesan' => $pesan,
            'tipe' => $tipe,
            'link' => $link,
        ]);
    }

    public static function kirimKeRole($role, $judul, $pesan, $tipe = 'info', $link = null)
    {
        $users = User::where('role', $role)->get();
        foreach ($users as $user) {
            self::kirim($user->id, $judul, $pesan, $tipe, $link);
        }
    }

    public static function kirimKeAdminPetugas($judul, $pesan, $tipe = 'info', $link = null)
    {
        $users = User::whereIn('role', ['admin', 'petugas'])->get();
        foreach ($users as $user) {
            self::kirim($user->id, $judul, $pesan, $tipe, $link);
        }
    }
}
