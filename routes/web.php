<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/register', function () {
    return view('authentication.register');
})->name('register');

Route::get('/login', function () {
    return view('authentication.login');
})->name('login');

Route::get('/show', function () {
    return view('book.show');
})->name('book.show');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

Route::get('/admin/kelola-user/', function () {
    return view('admin.user-management.index');
})->name('user-management.index');
