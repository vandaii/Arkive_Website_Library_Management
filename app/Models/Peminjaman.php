<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'buku_id',
        'stok',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'status_peminjaman'
    ];
}
