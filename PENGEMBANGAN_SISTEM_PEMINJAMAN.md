# Dokumentasi Pengembangan Sistem Peminjaman dan Pengembalian

## Ringkasan Perubahan

Sistem peminjaman dan pengembalian buku telah dikembangkan dengan fitur-fitur lengkap termasuk sistem laporan yang dapat dicetak.

---

## 1. Peningkatan Model dan Database

### Kolom Baru pada Tabel `peminjamen`:
- **tanggal_pengembalian_aktual** : Menyimpan tanggal pengembalian aktual (tidak diperkirakan)
- **denda** : Menyimpan jumlah denda untuk pengembalian terlambat (Rp 10,000/hari)
- **keterangan** : Catatan tambahan untuk peminjaman/pengembalian
- **approved_by** : ID admin yang menyetujui peminjaman/pengembalian

### Method Baru pada Model `Peminjaman`:
```php
calculateDenda()       // Menghitung denda otomatis
getStatusBadge()       // Menampilkan warna badge untuk setiap status
```

---

## 2. Alur Peminjaman Lengkap

### Status Peminjaman:
1. **Pending** - Pengajuan baru dari peminjam, menunggu persetujuan admin
2. **Dipinjam** - Pengajuan disetujui, peminjam bisa mengambil buku
3. **Pending Dikembalikan** - Peminjam mengajukan pengembalian
4. **Dikembalikan** - Admin menerima pengembalian (on-time)
5. **Terlambat** - Admin menerima pengembalian (melebihi deadline)
6. **Ditolak** - Pengajuan ditolak atau pembatalan

### Proses Otomatis:
✅ Validasi stok buku saat approval peminjaman
✅ Perhitungan denda otomatis saat pengembalian terlambat
✅ Restore stok buku saat pengembalian/penolakan
✅ Pencatatan admin yang approve/tolak

---

## 3. Sistem Laporan (Reports)

Empat jenis laporan dapat diakses melalui menu **Laporan** di sidebar admin:

### A. Laporan Dashboard
- **Route**: `/reports/dashboard`
- **Isi**: Ringkasan statistik keseluruhan
  - Total buku dan stok
  - Statistik peminjaman (aktif, terlambat)
  - Total denda yang terkumpul
  - Buku paling banyak dipinjam (Top 10)
- **Fitur**: Cetak langsung dari browser

### B. Laporan Data Buku
- **Route**: `/reports/buku`
- **Isi**: Daftar semua buku dengan detail
  - Judul, Penulis, Penerbit, Tahun Terbit
  - Status stok (Tersedia/Habis)
  - Total stok keseluruhan
- **Fitur**: Cetak dengan format formal dengan tempat tanda tangan

### C. Laporan Data Peminjaman
- **Route**: `/reports/peminjaman?start_date=YYYY-MM-DD&end_date=YYYY-MM-DD`
- **Isi**: Daftar peminjaman dalam periode tertentu
  - Nama peminjam dan judul buku
  - Tanggal peminjaman dan estimasi pengembalian
  - Status peminjaman
  - Filter berdasarkan tanggal
- **Fitur**: Filter tanggal custom, cetak dengan tanda tangan

### D. Laporan Data Pengembalian
- **Route**: `/reports/pengembalian?start_date=YYYY-MM-DD&end_date=YYYY-MM-DD`
- **Isi**: Daftar pengembalian dengan detail denda
  - Peminjam, buku, dan tanggal transaksi
  - Status (Dikembalikan/Terlambat)
  - Jumlah denda untuk setiap pengembalian
  - Total denda keseluruhan
  - Filter berdasarkan tanggal
- **Fitur**: Ringkasan denda, cetak dengan tanda tangan formal

---

## 4. Perbaikan Controller

### PinjamController
```php
store()  // Validasi lebih ketat:
         // - Cek stok ketersediaan
         // - Validasi tanggal pengembalian (harus setelah hari ini)
         // - Limit peminjaman aktif per user (max 5)
         // - Kurangi stok saat pengajuan dibuat
```

### KelolaPinjamController
```php
setujuPinjam()   // Update dengan approved_by dan validasi stok
tolakPinjam()    // Update dengan approved_by dan restore stok
```

### KelolaKembaliController
```php
setujuKembali()  // Perhitungan denda otomatis:
                 // - Jika terlambat: denda = hari_terlambat × Rp 10,000
                 // - Simpan tanggal_pengembalian_aktual
                 // - Restore stok buku
                 // - Catat admin yang approve
```

---

## 5. Fitur Cetak Laporan

Semua laporan dilengkapi dengan:
- ✅ Tombol cetak "🖨️ Cetak Laporan" 
- ✅ Styling khusus untuk print (CSS media print)
- ✅ Format profesional dengan tempat tanda tangan
- ✅ Tanggal dan jam pencetakan otomatis
- ✅ Responsive untuk A4 paper size

**Cara Menggunakan:**
1. Buka laporan yang diinginkan
2. Klik tombol "🖨️ Cetak Laporan"
3. Pilih "Save as PDF" atau printer fisik
4. Laporan siap didistribusikan

---

## 6. Struktur Routes Baru

```php
// Reports
Route::get('/reports/dashboard', [ReportController::class, 'dashboardReport'])->name('reports.dashboard');
Route::get('/reports/buku', [ReportController::class, 'bukuReport'])->name('reports.buku');
Route::get('/reports/peminjaman', [ReportController::class, 'peminjamanReport'])->name('reports.peminjaman');
Route::get('/reports/pengembalian', [ReportController::class, 'pengembalianReport'])->name('reports.pengembalian');
```

---

## 7. Migrasi Database

File migration baru: `2026_03_08_000000_update_peminjamen_table.php`

Jalankan migration dengan:
```bash
php artisan migrate
```

---

## 8. Menu Navigasi

Menu "Laporan" telah ditambahkan ke sidebar admin dengan sub-menu:
- Dashboard
- Data Buku
- Data Peminjaman
- Data Pengembalian

---

## 9. Contoh Penggunaan Laporan

### Laporan Tahunan:
1. Buka `/reports/dashboard`
2. Lihat statistik keseluruhan
3. Cetak untuk laporan tahunan

### Laporan Per Bulan:
1. Buka `/reports/pengembalian`
2. Pilih tanggal awal bulan sampai akhir bulan
3. Lihat total denda yang terkumpul
4. Cetak untuk laporan denda bulanan

### Laporan Inventori:
1. Buka `/reports/buku`
2. Cetak daftar semua buku
3. Gunakan untuk audit stok fisik

---

## 10. Fitur Keamanan

- ✅ Semua route laporan memerlukan autentikasi (`middleware('auth')`)
- ✅ Pencatatan admin yang approve/tolak untuk audit trail
- ✅ Validasi input untuk filter tanggal
- ✅ Proteksi dari over-booking melalui validasi stok

---

## Ringkasan Fitur

| Fitur | Status | Keterangan |
|-------|--------|-----------|
| Validasi Peminjaman | ✅ | Stok, tanggal, limit aktif |
| Perhitungan Denda | ✅ | Otomatis Rp 10,000/hari |
| Restore Stok | ✅ | Saat penolakan/pengembalian |
| Laporan Dashboard | ✅ | Statistik lengkap |
| Laporan Buku | ✅ | Daftar + stok |
| Laporan Peminjaman | ✅ | Filter tanggal |
| Laporan Pengembalian | ✅ | Dengan denda |
| Cetak PDF | ✅ | Via browser print |
| Audit Trail | ✅ | Pencatatan admin |

---

**Dibuat**: 08 Maret 2026
**Version**: 1.0
