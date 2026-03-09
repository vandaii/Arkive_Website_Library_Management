# 💻 CODE CHANGES - Technical Reference

Dokumentasi ini untuk developer yang ingin memahami perubahan code secara detail.

---

## 1️⃣ Model Changes

### `app/Models/Peminjaman.php`

**Perubahan fillable:**
```php
// BEFORE
protected $fillable = [
    'id',
    'user_id',
    'buku_id',
    'stok',
    'tanggal_peminjaman',
    'tanggal_pengembalian',
    'status_peminjaman'
];

// AFTER
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
```

**Method Baru:**
```php
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
 * Get badge color class for status
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
```

**Relasi Baru:**
```php
public function approver()
{
    return $this->belongsTo(User::class, 'approved_by', 'id');
}
```

---

## 2️⃣ Controller Changes

### `app/Http/Controllers/PinjamController.php`

**Validasi di store():**
```php
public function store(Request $request)
{
    $user = $request->user();
    $validated = $request->validate([
        'buku_id' => 'required|exists:bukus,id',
        'stok' => 'required|integer|min:1|max:10',  // min:1 added
        'tanggal_pengembalian' => 'required|date|after:today', // after:today added
    ]);

    // Check book availability
    $book = Buku::find($validated['buku_id']);
    if ($book->stok <= 0) {
        return redirect()->back()->with('error', 'Buku tidak tersedia');
    }

    if ($book->stok < $validated['stok']) {
        return redirect()->back()->with('error', 'Stok tidak mencukupi');
    }

    // Check if user has too many pending loans (NEW)
    $pendingCount = Peminjaman::where('user_id', $user->id)
        ->whereIn('status_peminjaman', ['Pending', 'Dipinjam', 'Pending Dikembalikan'])
        ->count();

    if ($pendingCount >= 5) {
        return redirect()->back()->with('error', 'Terlalu banyak peminjaman aktif');
    }

    // Deduct stock immediately (CHANGED)
    $book->update([
        'stok' => $book->stok - $validated['stok']
    ]);

    $peminjaman = Peminjaman::create([
        'user_id' => $user->id,
        'buku_id' => $validated['buku_id'],
        'stok' => $validated['stok'],
        'tanggal_peminjaman' => date('Y-m-d'),
        'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
        'status_peminjaman' => 'Pending'
    ]);

    return redirect()->route('peminjaman.index')->with('success');
}
```

### `app/Http/Controllers/KelolaPinjamController.php`

**Fitur validasi & audit:**
```php
public function setujuPinjam($id)
{
    $pengajuan = Peminjaman::with('user', 'buku')->find($id);
    
    // Validate book stock (NEW)
    if ($pengajuan->buku->stok < $pengajuan->stok) {
        return redirect()->route('kelola-pinjam.pengajuan-pinjaman')
            ->with('error', 'Stok buku tidak mencukupi');
    }

    $pengajuan->update([
        'status_peminjaman' => 'Dipinjam',
        'approved_by' => auth()->id()  // NEW: Track approver
    ]);

    return redirect()->route('kelola-pinjam.index')->with('success');
}

public function tolakPinjam($id)
{
    $pengajuan = Peminjaman::with('user', 'buku')->find($id);
    
    // Restore book stock (NEW)
    $book = $pengajuan->buku;
    $book->update([
        'stok' => $book->stok + $pengajuan->stok
    ]);

    $pengajuan->update([
        'status_peminjaman' => 'Ditolak',
        'approved_by' => auth()->id()  // NEW: Track approver
    ]);

    return redirect()->route('kelola-pinjam.index')->with('success');
}
```

### `app/Http/Controllers/KelolaKembaliController.php`

**Fitur denda otomatis:**
```php
public function setujuKembali($id)
{
    $pengajuan = Peminjaman::with('user', 'buku')->find($id);
    $deadline = Carbon::parse($pengajuan->tanggal_pengembalian);
    $tanggalKembali = date('Y-m-d');
    $returnDate = Carbon::parse($tanggalKembali);

    // Calculate denda if late (NEW)
    $denda = 0;
    if ($returnDate->greaterThan($deadline)) {
        $daysLate = $returnDate->diffInDays($deadline);
        $denda = $daysLate * 10000; // Rp 10,000 per day

        $pengajuan->update([
            'status_peminjaman' => 'Terlambat',
            'tanggal_pengembalian_aktual' => $tanggalKembali,  // NEW
            'denda' => $denda,  // NEW
            'approved_by' => auth()->id()  // NEW
        ]);
    } else {
        $pengajuan->update([
            'status_peminjaman' => 'Dikembalikan',
            'tanggal_pengembalian_aktual' => $tanggalKembali,  // NEW
            'denda' => 0,  // NEW
            'approved_by' => auth()->id()  // NEW
        ]);
    }

    // Restore book stock (NEW)
    $book = Buku::find($pengajuan->buku_id);
    $book->update([
        'stok' => $book->stok + $pengajuan->stok
    ]);

    return redirect()->route('kelola-kembali.index')->with('success');
}
```

### `app/Http/Controllers/ReportController.php` (NEW FILE)

**Complete controller untuk laporan:**
```php
<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;

class ReportController extends Controller
{
    public function dashboardReport()
    {
        // Statistics
        $totalBuku = Buku::count();
        $totalPeminjaman = Peminjaman::count();
        $peminjamanAktif = Peminjaman::whereIn('status_peminjaman', 
            ['Pending', 'Dipinjam', 'Pending Dikembalikan'])->count();
        $terlambat = Peminjaman::where('status_peminjaman', 'Terlambat')->count();
        $totalDenda = Peminjaman::where('status_peminjaman', 'Terlambat')
            ->sum('denda');

        // Book status
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', '<=', 0)->count();

        // Top 10 borrowed books
        $bukuPopuler = Peminjaman::select('buku_id')
            ->groupBy('buku_id')
            ->selectRaw('count(*) as total')
            ->orderBy('total', 'DESC')
            ->limit(10)
            ->with('buku')
            ->get();

        return view('reports.dashboard-report', [
            'totalBuku' => $totalBuku,
            'totalPeminjaman' => $totalPeminjaman,
            'peminjamanAktif' => $peminjamanAktif,
            'terlambat' => $terlambat,
            'totalDenda' => $totalDenda,
            'bukuTersedia' => $bukuTersedia,
            'bukuHabis' => $bukuHabis,
            'bukuPopuler' => $bukuPopuler,
            'title' => 'Laporan Dashboard'
        ]);
    }

    public function peminjamanReport(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = Peminjaman::with('buku', 'user', 'approver');

        if ($startDate) {
            $query->whereDate('tanggal_peminjaman', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('tanggal_peminjaman', '<=', $endDate);
        }

        $peminjamans = $query->orderBy('tanggal_peminjaman', 'DESC')->get();

        return view('reports.peminjaman-report', [
            'peminjamans' => $peminjamans,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'title' => 'Laporan Data Peminjaman'
        ]);
    }

    public function pengembalianReport(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = Peminjaman::with('buku', 'user', 'approver')
            ->whereIn('status_peminjaman', ['Dikembalikan', 'Terlambat']);

        if ($startDate) {
            $query->whereDate('tanggal_pengembalian_aktual', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('tanggal_pengembalian_aktual', '<=', $endDate);
        }

        $pengembalians = $query->orderBy('tanggal_pengembalian_aktual', 'DESC')
            ->get();

        $totalDenda = $pengembalians->sum('denda');
        $terlambatCount = $pengembalians
            ->where('status_peminjaman', 'Terlambat')->count();

        return view('reports.pengembalian-report', [
            'pengembalians' => $pengembalians,
            'totalDenda' => $totalDenda,
            'terlambatCount' => $terlambatCount,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'title' => 'Laporan Data Pengembalian'
        ]);
    }
}
```

---

## 3️⃣ Database Migration

### `database/migrations/2026_03_08_000000_update_peminjamen_table.php`

```php
Schema::table('peminjamen', function (Blueprint $table) {
    // Date when book was actually returned
    $table->date('tanggal_pengembalian_aktual')->nullable()->after('tanggal_pengembalian');
    
    // Late fee in rupiah
    $table->decimal('denda', 10, 2)->default(0)->after('tanggal_pengembalian_aktual');
    
    // Additional notes
    $table->text('keterangan')->nullable()->after('denda');
    
    // Admin who approved this transaction
    $table->unsignedBigInteger('approved_by')->nullable()->after('keterangan');
    $table->foreign('approved_by')->references('id')->on('users');
});
```

---

## 4️⃣ Routes

### `routes/web.php`

```php
// NEW: Report routes with auth middleware
Route::prefix('/reports')->middleware('auth')->group(function () {
    Route::get('/dashboard', [ReportController::class, 'dashboardReport'])
        ->name('reports.dashboard');
    Route::get('/buku', [ReportController::class, 'bukuReport'])
        ->name('reports.buku');
    Route::get('/peminjaman', [ReportController::class, 'peminjamanReport'])
        ->name('reports.peminjaman');
    Route::get('/pengembalian', [ReportController::class, 'pengembalianReport'])
        ->name('reports.pengembalian');
});
```

---

## 5️⃣ Query Examples

### Get late returns with fine:
```php
$lateReturns = Peminjaman::where('status_peminjaman', 'Terlambat')
    ->with('buku', 'user', 'approver')
    ->get();

foreach ($lateReturns as $return) {
    echo "Fine: " . $return->denda . " IDR\n";
}
```

### Get approver info:
```php
$peminjaman = Peminjaman::with('approver')->find($id);
echo "Approved by: " . $peminjaman->approver->name;
```

### Calculate total fine for period:
```php
$totalFine = Peminjaman::where('status_peminjaman', 'Terlambat')
    ->whereDate('tanggal_pengembalian_aktual', '>=', '2026-03-01')
    ->whereDate('tanggal_pengembalian_aktual', '<=', '2026-03-31')
    ->sum('denda');
```

---

## 6️⃣ Status Flow

```
User Request
    ↓
[Pending] → Admin Review
    ↓                  ↓
[Dipinjam]         [Ditolak]
    ↓
User Returns
    ↓
[Pending Dikembalikan] → Admin Review
    ↓                         ↓
On-Time?                 [Ditolak]
   ↓ ↓
[Dikembalikan] [Terlambat]
(Denda: 0)    (Denda: calculated)
```

---

## 📋 Database Schema Changes

```sql
ALTER TABLE peminjamen ADD COLUMN tanggal_pengembalian_aktual DATE NULL AFTER tanggal_pengembalian;
ALTER TABLE peminjamen ADD COLUMN denda DECIMAL(10,2) DEFAULT 0 AFTER tanggal_pengembalian_aktual;
ALTER TABLE peminjamen ADD COLUMN keterangan TEXT NULL AFTER denda;
ALTER TABLE peminjamen ADD COLUMN approved_by BIGINT UNSIGNED NULL AFTER keterangan;
ALTER TABLE peminjamen ADD FOREIGN KEY (approved_by) REFERENCES users(id);
```

---

**Documentation Version:** 1.0
**Date:** 08 Mar 2026
