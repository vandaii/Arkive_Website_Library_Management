<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\EmployeeManagementController;
use App\Http\Controllers\KelolaKembaliController;
use App\Http\Controllers\KelolaPinjamController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\UlasanController;

Route::get('/', [PageController::class, 'index'])->name('index');

// Authentication
Route::get('/register', [AuthenticationController::class, 'registerPage'])->name('auth.register');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::get('/login', [AuthenticationController::class, 'loginPage'])->name('auth.login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::get('/dashboard/', [PageController::class, 'userDashboard'])->name('user.index');
Route::get('/show/{id}', [PageController::class, 'show'])->name('book.show');

Route::get('/admin', function () {
    return view('admin.index', ['title' => 'Dashboard Admin']);
})->name('admin.index')->middleware('auth');

// Kelola Peminjam
Route::get('/admin/kelola-user/', [UserManagementController::class, 'index'])->name('user-management.index');
Route::get('/admin/kelola-user/tambah', [UserManagementController::class, 'create'])->name('user-management.create');
Route::post('/admin/kelola-user/tambah/', [UserManagementController::class, 'store'])->name('user-management.store');
Route::get('/admin/kelola-user/{id}/', [UserManagementController::class, 'show'])->name('user-management.show');
Route::put('/admin/kelola-user/{id}/update', [UserManagementController::class, 'update'])->name('user-management.update');
Route::patch('/admin/kelola-user/{id}/deactivate', [UserManagementController::class, 'deactivate'])->name('user-management.deactivate');
Route::delete('/admin/kelola-user/{id}/delete', [UserManagementController::class, 'destroy'])->name('user-management.destroy');

// Kelola Admin/Petugas
Route::get('/admin/kelola-employee/', [EmployeeManagementController::class, 'index'])->name('employee-management.index');
Route::get('/admin/kelola-employee/tambah', [EmployeeManagementController::class, 'create'])->name('employee-management.create');
Route::post('/admin/kelola-employee/tambah/', [EmployeeManagementController::class, 'store'])->name('employee-management.store');
Route::get('/admin/kelola-employee/{id}/', [EmployeeManagementController::class, 'show'])->name('employee-management.show');
Route::put('/admin/kelola-employee/{id}/update', [EmployeeManagementController::class, 'update'])->name('employee-management.update');
Route::patch('/admin/kelola-employee/{id}/deactivate', [EmployeeManagementController::class, 'deactivate'])->name('employee-management.deactivate');
Route::delete('/admin/kelola-employee/{id}/delete', [EmployeeManagementController::class, 'destroy'])->name('employee-management.destroy');

// Kategori
Route::get('/data-kategori/', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/data-kategori/tambah', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/data-kategori/tambah/', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/data-kategori/{id}/', [KategoriController::class, 'show'])->name('kategori.show');
Route::put('/data-kategori/{id}/update', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/data-kategori/{id}/delete', [KategoriController::class, 'destroy'])->name('kategori.destroy');

// Data Buku
Route::get('/data-buku/', [BukuController::class, 'index'])->name('data-buku.index');
Route::get('/data-buku/tambah', [BukuController::class, 'create'])->name('data-buku.create');
Route::post('/data-buku/tambah', [BukuController::class, 'store'])->name('data-buku.store');
Route::get('/data-buku/{id}', [BukuController::class, 'show'])->name('data-buku.show');
Route::put('/data-buku/{id}/update', [BukuController::class, 'update'])->name('data-buku.update');
Route::delete('/data-buku/{id}/delete', [BukuController::class, 'destroy'])->name('data-buku.destroy');

// Pinjam
Route::get('/peminjaman/', [PinjamController::class, 'index'])->name('peminjaman.index');
Route::post('/peminjaman/tambah', [PinjamController::class, 'store'])->name('peminjaman.store')->middleware('auth');
Route::get('/peminjaman/detail/{id}', [PinjamController::class, 'show'])->name('peminjaman.show');
Route::patch('/peminjaman/detail/{id}/pengembalian', [PinjamController::class, 'kembalikanBuku'])->name('peminjaman.kembalikanBuku');
Route::get('/peminjaman/riwayat-peminjaman', [PinjamController::class, 'history'])->name('peminjaman.riwayat-peminjaman')->middleware('auth');

// Kelola Pinjam
Route::get('/kelola-pinjam/', [KelolaPinjamController::class, 'index'])->name('kelola-pinjam.index');
Route::get('/kelola-pinjam/detail/{id}', [KelolaPinjamController::class, 'show'])->name('kelola-pinjam.show');
Route::get('/kelola-pinjam/pengajuan-pinjaman/', [KelolaPinjamController::class, 'pengajuanPeminjaman'])->name('kelola-pinjam.pengajuan-pinjaman');
Route::patch('/kelola-pinjam/pengajuan-pinjaman/{id}/setuju', [KelolaPinjamController::class, 'setujuPinjam'])->name('kelola-pinjam.setuju-pinjam');
Route::patch('/kelola-pinjam/pengajuan-pinjaman/{id}/tolak', [KelolaPinjamController::class, 'tolakPinjam'])->name('kelola-pinjam.tolak-pinjam');

// Kelola Kembali
Route::get('/kelola-kembali/', [KelolaKembaliController::class, 'index'])->name('kelola-kembali.index');
Route::get('/kelola-kembali/detail/{id}', [KelolaKembaliController::class, 'show'])->name('kelola-kembali.show');
Route::get('/kelola-kembali/pengajuan-kembali/', [KelolaKembaliController::class, 'pengajuanPengembalian'])->name('kelola-kembali.pengajuan-kembali');
Route::patch('/kelola-kembali/pengajuan-kembali/{id}/setuju', [KelolaKembaliController::class, 'setujuKembali'])->name('kelola-kembali.setuju-kembali');
Route::patch('/kelola-kembali/pengajuan-kembali/{id}/tolak', [KelolaKembaliController::class, 'tolakKembali'])->name('kelola-kembali.tolak-kembali');

// Ulasan (Reviews)
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store')->middleware('auth');
Route::put('/ulasan/{id}', [UlasanController::class, 'update'])->name('ulasan.update')->middleware('auth');
Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.destroy')->middleware('auth');
