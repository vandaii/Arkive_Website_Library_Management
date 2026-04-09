<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'username' => 'admin',
            'nama_lengkap' => 'Administrator',
            'email' => 'admin@library.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone_number' => '08123456789',
            'alamat' => 'Jalan Admin No. 1',
            'isActive' => true,
        ]);

        // Petugas Users
        User::create([
            'username' => 'petugas1',
            'nama_lengkap' => 'Petugas Perpustakaan 1',
            'email' => 'petugas1@library.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'phone_number' => '08123456790',
            'alamat' => 'Jalan Petugas No. 1',
            'isActive' => true,
        ]);

        User::create([
            'username' => 'petugas2',
            'nama_lengkap' => 'Petugas Perpustakaan 2',
            'email' => 'petugas2@library.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'phone_number' => '08123456791',
            'alamat' => 'Jalan Petugas No. 2',
            'isActive' => true,
        ]);

        // Peminjam Users
        User::create([
            'username' => 'peminjam1',
            'nama_lengkap' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => Hash::make('password'),
            'role' => 'peminjam',
            'phone_number' => '08112345678',
            'alamat' => 'Jalan Merdeka No. 123',
            'isActive' => true,
        ]);

        User::create([
            'username' => 'peminjam2',
            'nama_lengkap' => 'Siti Nurhaliza',
            'email' => 'siti@example.com',
            'password' => Hash::make('password'),
            'role' => 'peminjam',
            'phone_number' => '08112345679',
            'alamat' => 'Jalan Ahmad Yani No. 45',
            'isActive' => true,
        ]);

        User::create([
            'username' => 'peminjam3',
            'nama_lengkap' => 'Ahmad Rizki',
            'email' => 'ahmad@example.com',
            'password' => Hash::make('password'),
            'role' => 'peminjam',
            'phone_number' => '08112345680',
            'alamat' => 'Jalan Diponegoro No. 78',
            'isActive' => true,
        ]);

        User::create([
            'username' => 'peminjam4',
            'nama_lengkap' => 'Nur Azizah',
            'email' => 'nur@example.com',
            'password' => Hash::make('password'),
            'role' => 'peminjam',
            'phone_number' => '08112345681',
            'alamat' => 'Jalan Sudirman No. 56',
            'isActive' => true,
        ]);
    }
}
