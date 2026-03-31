<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            'Fiksi',
            'Non-Fiksi',
            'Drama',
            'Puisi',
            'Essay',
            'Biografi',
            'Ilmiah',
            'Teknologi',
            'Seni',
            'Sejarah',
            'Petualangan',
            'Misteri',
            'Fantasi',
            'Komedi',
            'Pendidikan',
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create([
                'nama_kategori' => $kategori,
            ]);
        }
    }
}
