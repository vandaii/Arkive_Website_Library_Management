<?php

use App\Http\Controllers\AuthenticationController;
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

Route::get('/admin/kelola-user/', function () {
    return view('admin.user-management.index', ['title' => 'Kelola User']);
})->name('user-management.index');

Route::get('/admin/kelola-user/tambah', function () {
    return view('admin.user-management.create', ['title' => 'Tambah User']);
})->name('user-management.create');

Route::get('/admin/kelola-user/edit', function () {
    return view('admin.user-management.edit', ['title' => 'edit user']);
})->name('user-management.show');

Route::get('/data-kategori', function () {
    return view('admin.kategori.index', ['title' => 'kategori']);
})->name('kategori.index');

Route::get('/data-kategori/tambah', function () {
    return view('admin.kategori.create', ['title' => 'tambah kategori']);
})->name('kategori.create');

Route::get('/data-kategori/edit', function () {
    return view('admin.kategori.edit', ['title' => 'edit kategori']);
})->name('kategori.show');
