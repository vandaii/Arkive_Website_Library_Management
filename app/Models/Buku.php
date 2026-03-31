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
        'tahun_terbit',
        'isbn_number',
        'jumlah_halaman',
        'deskripsi',
        'stok'
    ];

    public function kategoriBukuRelasi()
    {
        return $this->hasMany(KategoriBukuRelasi::class, 'buku_id', 'id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id', 'id');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'buku_id', 'id');
    }

    /**
     * Get average rating for the book (float, two decimals)
     */
    public function averageRating()
    {
        $avg = $this->ulasan()->avg('rating');
        return $avg ? round($avg, 2) : 0;
    }
}
