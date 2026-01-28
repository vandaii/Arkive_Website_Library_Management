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
