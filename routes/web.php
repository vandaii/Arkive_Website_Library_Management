<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserManagementController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

// Authentication
Route::get('/register', [AuthenticationController::class, 'registerPage'])->name('auth.register');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::get('/login', [AuthenticationController::class, 'loginPage'])->name('auth.login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::get('/show', function () {
    return view('book.show');
})->name('book.show');

Route::get('/admin', function () {
    return view('admin.index', ['title' => 'Dashboard Admin']);
})->name('admin.index')->middleware('auth');

Route::get('/admin/kelola-user/', [UserManagementController::class, 'index'])->name('user-management.index');
Route::get('/admin/kelola-user/tambah', [UserManagementController::class, 'create'])->name('user-management.create');
Route::post('/admin/kelola-user/tambah/', [UserManagementController::class, 'store'])->name('user-management.store');
Route::get('/admin/kelola-user/{id}/', [UserManagementController::class, 'show'])->name('user-management.show');
Route::put('/admin/kelola-user/{id}/update', [UserManagementController::class, 'update'])->name('user-management.update');
Route::delete('/admin/kelola-user/{id}/delete', [UserManagementController::class, 'destroy'])->name('user-management.destroy');

Route::get('/admin/data-kategori/', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/admin/data-kategori/tambah', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/admin/data-kategori/tambah/', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/admin/data-kategori/{id}/', [KategoriController::class, 'show'])->name('kategori.show');
Route::put('/admin/data-kategori/{id}/update', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/admin/data-kategori/{id}/delete', [KategoriController::class, 'destroy'])->name('kategori.destroy');

Route::get('/data-buku', function () {
    return view('admin.data-buku.index', ['title' => 'data buku']);
})->name('data-buku.index');

Route::get('/data-buku/tambah', function () {
    return view('admin.data-buku.create', ['title' => 'tambah buku']);
})->name('data-buku.create');

Route::get('/data-buku/edit', function () {
    return view('admin.data-buku.edit', ['title' => 'edit buku']);
})->name('data-buku.show');
