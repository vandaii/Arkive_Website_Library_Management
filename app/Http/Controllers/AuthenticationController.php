<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function registerPage()
    {
        return view('authentication.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username',
            'nama_lengkap' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'required|string'
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'alamat' => $validated['alamat'],
        ]);

        Auth::login($user);

        return redirect()->route('user.index')->with('success', 'Selamat datang di Arkivr');
    }

    public function loginPage()
    {
        return view('authentication.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->isActive == true) {
                $request->session()->regenerate();
                return redirect()->intended(route('user.index'))->with('success', 'Login berhasil');
            }

            return back();
        }

        return back()->withErrors(['email' => 'Email atau Password Salah'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index')->with('success', 'Log Out berhasil.');
    }
}
