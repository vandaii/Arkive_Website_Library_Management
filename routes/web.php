<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\EmployeeManagementController;
use App\Http\Controllers\KelolaKembaliController;
use App\Http\Controllers\KelolaPinjamController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\BuktiController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\LaporanController;

Route::get('/', [PageController::class, 'index'])->name('index');

// Authentication
Route::get('/register', [AuthenticationController::class, 'registerPage'])->name('auth.register');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::get('/login', [AuthenticationController::class, 'loginPage'])->name('auth.login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard/', [PageController::class, 'userDashboard'])->name('user.index')->middleware('auth');
Route::get('/show/{id}', [PageController::class, 'show'])->name('book.show')->middleware('auth');

// Search
Route::get('/search-buku', [PageController::class, 'search'])->name('search.buku')->middleware('auth');

// Profil Page
Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index')->middleware('auth');
Route::put('/profil/{id}', [ProfilController::class, 'update'])->name('profil.update')->middleware('auth');
Route::patch('/profil/{id}', [ProfilController::class, 'changePassword'])->name('profil.changePassword')->middleware('auth');

Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.index')->middleware(['auth', 'role:admin,petugas']);

// Kelola Peminjam
Route::get('/admin/kelola-user/', [UserManagementController::class, 'index'])->name('user-management.index')->middleware(['auth', 'role:admin']);
Route::get('/admin/kelola-user/tambah', [UserManagementController::class, 'create'])->name('user-management.create')->middleware(['auth', 'role:admin']);
Route::post('/admin/kelola-user/tambah/', [UserManagementController::class, 'store'])->name('user-management.store')->middleware(['auth', 'role:admin']);
Route::get('/admin/kelola-user/{id}/', [UserManagementController::class, 'show'])->name('user-management.show')->middleware(['auth', 'role:admin']);
Route::get('/admin/kelola-user/{id}/detail', [UserManagementController::class, 'detail'])->name('user-management.detail')->middleware(['auth', 'role:admin']);
Route::put('/admin/kelola-user/{id}/update', [UserManagementController::class, 'update'])->name('user-management.update')->middleware(['auth', 'role:admin']);
Route::patch('/admin/kelola-user/{id}/change-password', [UserManagementController::class, 'changePassword'])->name('user-management.change-password')->middleware(['auth', 'role:admin']);
Route::patch('/admin/kelola-user/{id}/deactivate', [UserManagementController::class, 'deactivate'])->name('user-management.deactivate')->middleware(['auth', 'role:admin']);
Route::delete('/admin/kelola-user/{id}/delete', [UserManagementController::class, 'destroy'])->name('user-management.destroy')->middleware(['auth', 'role:admin']);

// Kelola Admin/Petugas
Route::get('/admin/kelola-employee/', [EmployeeManagementController::class, 'index'])->name('employee-management.index')->middleware(['auth', 'role:admin']);
Route::get('/admin/kelola-employee/tambah', [EmployeeManagementController::class, 'create'])->name('employee-management.create')->middleware(['auth', 'role:admin']);
Route::post('/admin/kelola-employee/tambah/', [EmployeeManagementController::class, 'store'])->name('employee-management.store')->middleware(['auth', 'role:admin']);
Route::get('/admin/kelola-employee/{id}/detail', [EmployeeManagementController::class, 'detail'])->name('employee-management.detail')->middleware(['auth', 'role:admin']);
Route::get('/admin/kelola-employee/{id}/edit', [EmployeeManagementController::class, 'edit'])->name('employee-management.edit')->middleware(['auth', 'role:admin']);
Route::put('/admin/kelola-employee/{id}/update', [EmployeeManagementController::class, 'update'])->name('employee-management.update')->middleware(['auth', 'role:admin']);
Route::patch('/admin/kelola-employee/{id}/change-password', [EmployeeManagementController::class, 'changePassword'])->name('employee-management.change-password')->middleware(['auth', 'role:admin']);
Route::patch('/admin/kelola-employee/{id}/deactivate', [EmployeeManagementController::class, 'deactivate'])->name('employee-management.deactivate')->middleware(['auth', 'role:admin']);
Route::delete('/admin/kelola-employee/{id}/delete', [EmployeeManagementController::class, 'destroy'])->name('employee-management.destroy')->middleware(['auth', 'role:admin']);

// Kategori
Route::get('/data-kategori/', [KategoriController::class, 'index'])->name('kategori.index')->middleware(['auth', 'role:admin,petugas']);
Route::get('/data-kategori/tambah', [KategoriController::class, 'create'])->name('kategori.create')->middleware(['auth', 'role:admin,petugas']);
Route::post('/data-kategori/tambah/', [KategoriController::class, 'store'])->name('kategori.store')->middleware(['auth', 'role:admin,petugas']);
Route::get('/data-kategori/{id}/', [KategoriController::class, 'show'])->name('kategori.show')->middleware(['auth', 'role:admin,petugas']);
Route::put('/data-kategori/{id}/update', [KategoriController::class, 'update'])->name('kategori.update')->middleware(['auth', 'role:admin,petugas']);
Route::delete('/data-kategori/{id}/delete', [KategoriController::class, 'destroy'])->name('kategori.destroy')->middleware(['auth', 'role:admin,petugas']);

// Data Buku
Route::get('/data-buku/', [BukuController::class, 'index'])->name('data-buku.index')->middleware(['auth', 'role:admin,petugas']);
Route::get('/data-buku/tambah', [BukuController::class, 'create'])->name('data-buku.create')->middleware(['auth', 'role:admin,petugas']);
Route::post('/data-buku/tambah', [BukuController::class, 'store'])->name('data-buku.store')->middleware(['auth', 'role:admin,petugas']);
Route::get('/data-buku/{id}/detail', [BukuController::class, 'detail'])->name('data-buku.detail')->middleware(['auth', 'role:admin,petugas']);
Route::get('/data-buku/{id}', [BukuController::class, 'show'])->name('data-buku.show')->middleware(['auth', 'role:admin,petugas']);
Route::put('/data-buku/{id}/update', [BukuController::class, 'update'])->name('data-buku.update')->middleware(['auth', 'role:admin,petugas']);
Route::delete('/data-buku/{id}/delete', [BukuController::class, 'destroy'])->name('data-buku.destroy')->middleware(['auth', 'role:admin,petugas']);

// Pinjam
Route::get('/peminjaman/', [PinjamController::class, 'index'])->name('peminjaman.index')->middleware('auth');
Route::post('/peminjaman/tambah', [PinjamController::class, 'store'])->name('peminjaman.store')->middleware('auth');
Route::get('/peminjaman/detail/{id}', [PinjamController::class, 'show'])->name('peminjaman.show')->middleware('auth');
Route::patch('/peminjaman/detail/{id}/pengembalian', [PinjamController::class, 'kembalikanBuku'])->name('peminjaman.kembalikanBuku')->middleware('auth');
Route::get('/peminjaman/riwayat-peminjaman', [PinjamController::class, 'history'])->name('peminjaman.riwayat-peminjaman')->middleware('auth');
Route::get('/peminjaman/riwayat-peminjaman/detail/{id}', [PinjamController::class, 'detailRiwayat'])->name('peminjaman.detailRiwayat')->middleware('auth');

// Kelola Pinjam
Route::get('/kelola-pinjam/', [KelolaPinjamController::class, 'index'])->name('kelola-pinjam.index')->middleware(['auth', 'role:admin,petugas']);
Route::get('/kelola-pinjam/{id}/detail', [KelolaPinjamController::class, 'detail'])->name('kelola-pinjam.detail')->middleware(['auth', 'role:admin,petugas']);
Route::get('/kelola-pinjam/detail/{id}', [KelolaPinjamController::class, 'show'])->name('kelola-pinjam.show')->middleware(['auth', 'role:admin,petugas']);
Route::get('/kelola-pinjam/pengajuan-pinjaman/', [KelolaPinjamController::class, 'pengajuanPeminjaman'])->name('kelola-pinjam.pengajuan-pinjaman')->middleware(['auth', 'role:admin,petugas']);
Route::patch('/kelola-pinjam/pengajuan-pinjaman/{id}/setuju', [KelolaPinjamController::class, 'setujuPinjam'])->name('kelola-pinjam.setuju-pinjam')->middleware(['auth', 'role:admin,petugas']);
Route::patch('/kelola-pinjam/pengajuan-pinjaman/{id}/tolak', [KelolaPinjamController::class, 'tolakPinjam'])->name('kelola-pinjam.tolak-pinjam')->middleware(['auth', 'role:admin,petugas']);

// Kelola Kembali
Route::get('/kelola-kembali/', [KelolaKembaliController::class, 'index'])->name('kelola-kembali.index')->middleware(['auth', 'role:admin,petugas']);
Route::get('/kelola-kembali/{id}/detail', [KelolaKembaliController::class, 'detail'])->name('kelola-kembali.detail')->middleware(['auth', 'role:admin,petugas']);
Route::get('/kelola-kembali/detail/{id}', [KelolaKembaliController::class, 'show'])->name('kelola-kembali.show')->middleware(['auth', 'role:admin,petugas']);
Route::get('/kelola-kembali/pengajuan-kembali/', [KelolaKembaliController::class, 'pengajuanPengembalian'])->name('kelola-kembali.pengajuan-kembali')->middleware(['auth', 'role:admin,petugas']);
Route::patch('/kelola-kembali/pengajuan-kembali/{id}/setuju', [KelolaKembaliController::class, 'setujuKembali'])->name('kelola-kembali.setuju-kembali')->middleware(['auth', 'role:admin,petugas']);
Route::patch('/kelola-kembali/pengajuan-kembali/{id}/tolak', [KelolaKembaliController::class, 'tolakKembali'])->name('kelola-kembali.tolak-kembali')->middleware(['auth', 'role:admin,petugas']);

// Ulasan (Reviews)
Route::get('/admin/kelola-ulasan', [UlasanController::class, 'index'])->name('ulasan.index')->middleware('auth')->middleware('auth');
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store')->middleware('auth')->middleware('auth');
Route::put('/ulasan/{id}', [UlasanController::class, 'update'])->name('ulasan.update')->middleware('auth')->middleware('auth');
Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.destroy')->middleware('auth')->middleware('auth');

// Koleksi
Route::get('/koleksi', [KoleksiController::class, 'index'])->name('koleksi.index')->middleware('auth');
Route::post('/koleksi/', [KoleksiController::class, 'store'])->name('koleksi.store')->middleware('auth');
Route::delete('/koleksi/', [KoleksiController::class, 'destroy'])->name('koleksi.destroy')->middleware('auth');

// Notifikasi
Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index')->middleware('auth');
Route::patch('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.read')->middleware('auth');
Route::patch('/notifikasi/read-all', [NotifikasiController::class, 'markAllRead'])->name('notifikasi.read-all')->middleware('auth');
Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy')->middleware('auth');
Route::delete('/notifikasi', [NotifikasiController::class, 'destroyAll'])->name('notifikasi.destroy-all')->middleware('auth');

// Bukti PDF
Route::get('/bukti/{id}/cetak', [BuktiController::class, 'cetak'])->name('bukti.cetak')->middleware('auth');
Route::get('/bukti/{id}/download', [BuktiController::class, 'download'])->name('bukti.download')->middleware('auth');

// Laporan PDF
Route::get('/admin/laporan/buku', [LaporanController::class, 'laporanBuku'])->name('laporan.buku')->middleware(['auth', 'role:admin,petugas']);
Route::get('/admin/laporan/employee', [LaporanController::class, 'laporanEmployee'])->name('laporan.employee')->middleware(['auth', 'role:admin,petugas']);
Route::get('/admin/laporan/user', [LaporanController::class, 'laporanUser'])->name('laporan.user')->middleware(['auth', 'role:admin,petugas']);
Route::get('/admin/laporan/peminjaman', [LaporanController::class, 'laporanPeminjaman'])->name('laporan.peminjaman')->middleware(['auth', 'role:admin,petugas']);
Route::get('/admin/laporan/pengembalian', [LaporanController::class, 'laporanPengembalian'])->name('laporan.pengembalian')->middleware(['auth', 'role:admin,petugas']);
