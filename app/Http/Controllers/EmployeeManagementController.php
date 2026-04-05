<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('isActive', '!=', false)->where('role', '!=', 'peminjam');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nama_lengkap', 'like', "%{$search}%")->Where('username', 'like', "%{$search}%");
        }

        if ($request->filled('role') && $request->role != 'All') {
            $query->where('role', $request->role);
        }
        $users = $query->paginate(10)->withQueryString();
        return view('admin.employee-management.index', compact('users'), ['title' => 'Kelola Petugas']);
    }

    public function create()
    {
        return view('admin.employee-management.create', ['title' => 'Tambah User']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|string'
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role']
        ]);

        return redirect()->route('employee-management.index')->with('success', 'Berhasil menambahkan pengguna baru!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.employee-management.edit', compact('user'), ['title' => 'edit petugas']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string',
            'username' => 'required|string|unique:users,username,' . $id,
            'email' => 'required|string|email|unique:users,email,' . $id,
            'alamat' => 'string|nullable',
            'phone_number' => 'string|nullable',
            'role' => 'required|string'
        ]);

        $user = User::find($id);
        $user->update([
            'username' => $validated['username'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'alamat' => $validated['alamat'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'role' => $validated['role']
        ]);

        return redirect()->route('employee-management.index')->with('success', 'Data berhasil diubah!');
    }

    public function changePassword(Request $request, $id)
    {
        $validated = $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::find($id);
        $user->update([
            'password' => $validated['password']
        ]);

        return redirect()->route('employee-management.index')->with('success', 'Password ' . $user->username . ' sudah diubah!');
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
