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
        'tanggal_pengembalian_aktual',
        'status_peminjaman',
        'denda',
        'keterangan',
        'approved_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    /**
     * Calculate late fee based on days
     * Rp 10,000 per day
     */
    public function calculateDenda()
    {
        if ($this->status_peminjaman !== 'Terlambat') {
            return 0;
        }

        $deadline = \Carbon\Carbon::parse($this->tanggal_pengembalian);
        $returnDate = \Carbon\Carbon::parse($this->tanggal_pengembalian_aktual);

        if ($returnDate->greaterThan($deadline)) {
            $daysLate = $returnDate->diffInDays($deadline);
            return $daysLate * 10000; // Rp 10,000 per day
        }

        return 0;
    }

    /**
     * Get formatted status with badge color
     */
    public function getStatusBadge()
    {
        $badges = [
            'Pending' => 'warning',
            'Dipinjam' => 'info',
            'Pending Dikembalikan' => 'warning',
            'Dikembalikan' => 'success',
            'Terlambat' => 'danger',
            'Ditolak' => 'danger'
        ];

        return $badges[$this->status_peminjaman] ?? 'secondary';
    }
}
