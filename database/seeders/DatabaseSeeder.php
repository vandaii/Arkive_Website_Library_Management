<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil semua seeder
        $this->call([
            KategoriSeeder::class,
            BukuSeeder::class,
            UserSeeder::class,
            kategoriBukuSeeder::class,
        ]);
    }
}
