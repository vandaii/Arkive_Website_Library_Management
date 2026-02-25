<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaKembaliController extends Controller
{
    public function index()
    {
        return view('admin.kelola-kembali.index');
    }
}
