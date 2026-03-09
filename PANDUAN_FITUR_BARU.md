# Panduan Implementasi New Features

## ⚙️ Setup Awal

### 1. Jalankan Migration

Sebelum menggunakan fitur laporan dan fitur baru lainnya, jalankan migration untuk menambah kolom ke tabel `peminjamen`:

```bash
php artisan migrate
```

**Kolom yang ditambahkan:**

- `tanggal_pengembalian_aktual` (date, nullable)
- `denda` (decimal, default 0)
- `keterangan` (text, nullable)
- `approved_by` (bigint, nullable, foreign key ke users)

### 2. Bersihkan Cache (Opsional)

```bash
php artisan cache:clear
php artisan config:clear
```

---

## 📋 Panduan Penggunaan Fitur

### A. Proses Peminjaman (User)

1. **Buka katalog buku** → Pilih buku yang ingin dipinjam
2. **Isi form peminjaman:**
    - Jumlah buku (1-10 eksemplar)
    - Tanggal estimasi pengembalian (minimum 1 hari ke depan)
3. **Klik "Ajukan Peminjaman"**
    - Status berubah menjadi **Pending**
    - Stok buku otomatis berkurang

### B. Approval Peminjaman (Admin)

1. **Buka Admin Dashboard** → Kelola Peminjaman
2. **Klik "Pengajuan Peminjaman"** untuk melihat daftar pending
3. **Pilih pengajuan:**
    - 💚 **Setujui** → Status: Dipinjam
    - ❌ **Tolak** → Status: Ditolak (stok dikembalikan)
4. **Catatan:** Hanya admin yang setuju/tolak yang nama-nya tercatat

### C. Pengembalian Buku (User)

1. **User buka Riwayat Peminjaman** → Status "Dipinjam"
2. **Klik detail peminjaman**
3. **Klik tombol "Ajukan Pengembalian"**
    - Status berubah menjadi **Pending Dikembalikan**

### D. Approval Pengembalian (Admin)

1. **Admin Dashboard** → Kelola Kembali
2. **Klik "Pengajuan Pengembalian"**
3. **Pilih pengajuan:**
    - Sistem otomatis cek apakah terlambat
    - 💚 **Setujui** →
        - Jika on-time: Status **Dikembalikan** (Denda: Rp 0)
        - Jika terlambat: Status **Terlambat** (Denda: Rp 10,000/hari)
    - ❌ **Tolak** → Status **Ditolak**
4. **Stok buku otomatis dikembalikan**

---

## 📊 Menggunakan Laporan

### 📈 Laporan Dashboard

**Akses:** Admin Dashboard → Laporan → Dashboard

**Informasi yang ditampilkan:**

- Total buku & stok
- Status buku (Tersedia/Habis)
- Statistik peminjaman aktif
- Jumlah pengembalian terlambat
- Total denda terkumpul
- Top 10 buku paling banyak dipinjam

**Contoh penggunaan:**

- Laporan tahunan kepada kepala sekolah
- Monitoring kesehatan perpustakaan
- Analisis buku populer

---

### 📚 Laporan Data Buku

**Akses:** Admin Dashboard → Laporan → Data Buku

**Informasi yang ditampilkan:**

- Daftar semua buku dengan detail
- Stok masing-masing buku
- Status ketersediaan
- Total stok keseluruhan

**Format cetak:** Formal dengan tempat tanda tangan (Ketua Perpustakaan & Admin)

**Contoh penggunaan:**

- Audit stok fisik
- Laporan inventori
- Distribusi ke dinas

---

### 📋 Laporan Data Peminjaman

**Akses:** Admin Dashboard → Laporan → Data Peminjaman

**Filter:**

- Tanggal mulai peminjaman
- Tanggal akhir peminjaman
- Reset untuk melihat semua data

**Informasi yang ditampilkan:**

- Nama peminjam
- Judul buku yang dipinjam
- Tanggal peminjaman & estimasi kembali
- Status peminjaman (Pending/Dipinjam/Ditolak/dll)
- Ringkasan: Total peminjaman, Disetujui, Ditolak

**Contoh penggunaan:**

- Laporan bulanan peminjaman
- Tracking pengajuan yang tertunda
- Analisis trend peminjaman

---

### 💰 Laporan Data Pengembalian

**Akses:** Admin Dashboard → Laporan → Data Pengembalian

**Filter:**

- Tanggal mulai pengembalian
- Tanggal akhir pengembalian
- Reset untuk melihat semua data

**Informasi yang ditampilkan:**

- Nama peminjam
- Judul buku yang dikembalikan
- Tanggal peminjaman, estimasi kembali & kembali aktual
- Status: Dikembalikan (on-time) atau Terlambat
- **Jumlah denda per item & total denda**
- Ringkasan: Total pengembalian, Terlambat, Total Denda

**Contoh penggunaan:**

- Laporan denda bulanan/tahunan
- Billing pengguna yang terlambat
- Monitoring compliance deadline

---

## 🖨️ Cara Cetak Laporan

**Semua laporan mendukung print/PDF:**

1. Buka laporan yang diinginkan
2. Klik tombol **"🖨️ Cetak Laporan"** (warna biru)
3. Pilih opsi cetak:
    - **Cetak ke printer fisik:** Pilih printer dan print
    - **Simpan sebagai PDF:** Pilih "Save as PDF" sebagai printer
4. Laporan siap dalam format profesional

**Tips:**

- Gunakan **Print Preview** untuk preview sebelum cetak
- Untuk PDF lebih rapi, gunakan **Save as PDF** bukan browser's PDF print
- Laporan sudah ter-format untuk kertas A4

---

## 🔍 Contoh Skenario Penggunaan

### Skenario 1: Laporan Bulanan

```
1. Buka Laporan Data Pengembalian
2. Filter: 01-Maret hingga 31-Maret 2026
3. Lihat Total Denda yang terkumpul
4. Cetak laporan
5. Serahkan ke bendahara
```

### Skenario 2: Audit Stok

```
1. Buka Laporan Data Buku
2. Lihat daftar semua buku + stok saat ini
3. Cetak laporan
4. Cocokkan dengan stok fisik di perpustakaan
5. Laporkan diskrepansi jika ada
```

### Skenario 3: Laporan Tahunan

```
1. Buka Laporan Dashboard
2. Lihat statistik keseluruhan
3. Lihat Top 10 buku populer
4. Cetak dashboard
5. Lampirkan dengan laporan data buku & pengembalian
6. Serahkan ke kepala sekolah
```

---

## ✅ Validasi Sistem

### Validasi yang Sudah Diterapkan:

**Saat Peminjaman:**

- ✅ Stok buku harus tersedia
- ✅ Tanggal kembali minimal 1 hari ke depan
- ✅ User max 5 peminjaman aktif
- ✅ Stok berkurang saat pengajuan dibuat

**Saat Approval Peminjaman:**

- ✅ Validasi stok ulang (case stok berkurang)
- ✅ Pencatatan admin yang approve
- ✅ Jika ditolak: stok dikembalikan

**Saat Pengembalian:**

- ✅ Perhitungan hari terlambat otomatis
- ✅ Denda otomatis (Rp 10,000 per hari)
- ✅ Pencatatan admin yang approve
- ✅ Stok otomatis dikembalikan

---

## 🐛 Troubleshooting

### Q: Tombol laporan tidak muncul?

**A:**

- Pastikan sudah login sebagai admin
- Refresh browser (F5)
- Clear cache: `php artisan cache:clear`

### Q: Laporan kosong?

**A:**

- Pastikan ada data peminjaman di database
- Cek filter tanggal, mungkin terlalu sempit

### Q: Cetak tidak terlihat rapih?

**A:**

- Gunakan **Print Preview** sebelum cetak
- Pastikan margin browser minimal "None"
- Gunakan ukuran kertas A4

### Q: Denda tidak muncul?

**A:**

- Pastikan tanggal pengembalian sudah lewat deadline
- Pastikan migration sudah dijalankan
- Cek database apakah kolom `denda` ada

---

## 📞 Support & Maintenance

- **Error saat migration:** Cek apakah tabel `peminjamen` sudah ada
- **Data tidak terupdate:** Clear cache dan restart server
- **Permission denied:** Pastikan user adalah admin

---

**Terakhir diupdate:** 08 Maret 2026
