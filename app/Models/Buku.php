<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
        'cover_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit'
    ];

    public function kategoriBukuRelasi()
    {
        return $this->hasMany(KategoriBukuRelasi::class, 'buku_id', 'id');
    }
}
