<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    protected $fillable = [
        'id',
        'buku_id',
        'user_id'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
