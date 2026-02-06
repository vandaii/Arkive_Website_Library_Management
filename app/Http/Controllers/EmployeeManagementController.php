<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeManagementController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->where('isActive', '!=', false)->where('role', '!=', 'peminjam')->get();
        return view('admin.employee-management.index', compact('users'), ['title' => 'Kelola User']);
    }

    public function create()
    {
        return view('admin.employee-management.create', ['title' => 'Tambah User']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username',
            'nama_lengkap' => 'required|string',
            'alamat' => 'string|nullable',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|string'
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'alamat' => $validated['alamat'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role']
        ]);

        return redirect()->route('employee-management.index')->with('success');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.employee-management.edit', compact('user'), ['title' => 'edit user']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username',
            'nama_lengkap' => 'required|string',
            'alamat' => 'string|nullable',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|string'
        ]);

        $user = User::find($id);
        $user->update([
            'username' => $validated['username'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'alamat' => $validated['alamat'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role']
        ]);

        return redirect()->route('employee-management.index')->with('success');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('employee-management.index')->with('success');
    }

    public function deactivate(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'isActive' => false
        ]);

        return redirect()->route('employee-management.index')->with('success');
    }
}
