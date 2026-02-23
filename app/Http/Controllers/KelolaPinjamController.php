<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaPinjamController extends Controller
{
    public function index()
    {
        return view('admin.kelola-pinjam.index');
    }
}
