<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        return view('authentication.profil-page');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'photo_profile' => 'image|mimes:png,jpg|max:2048',
            'nama_lengkap' => 'required|string',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|string|email|unique:users,email,' . $id,
            'alamat' => 'string|nullable',
            'phone_number' => 'string|nullable'
        ]);

        $user = User::findOrFail($id);
        if ($request->has('photo_profile')) {
            $oldCoverPath = '/storage/' . $user->photo_profile;
            if (File::exists(public_path($oldCoverPath))) {
                File::delete(public_path($oldCoverPath));
            }
            $coverPath = $request->file('photo_profile')->store('photo_profile', 'public');
            $user->update([
                'photo_profile' => $coverPath
            ]);
        }

        $user->update([
            'nama_lengkap' => $validated['nama_lengkap'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'alamat' => $validated['alamat'],
            'phone_number' => $validated['phone_number'],
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diupdate!');
    }

    public function changePassword(Request $request, $id)
    {
        $validated = $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->back()->with('success');
    }
}
