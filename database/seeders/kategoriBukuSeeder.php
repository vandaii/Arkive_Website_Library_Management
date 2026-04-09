<?php

namespace Database\Seeders;

use App\Models\KategoriBukuRelasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class kategoriBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriBuku = [
            [
                'buku_id' => 1,
                'kategori_id' => 1
            ],
            [
                'buku_id' => 1,
                'kategori_id' => 4
            ],
            [
                'buku_id' => 2,
                'kategori_id' => 2
            ],
            [
                'buku_id' => 3,
                'kategori_id' => 5
            ],
            [
                'buku_id' => 3,
                'kategori_id' => 3
            ],
            [
                'buku_id' => 4,
                'kategori_id' => 3
            ],
            [
                'buku_id' => 4,
                'kategori_id' => 12
            ],
            [
                'buku_id' => 4,
                'kategori_id' => 6
            ],
            [
                'buku_id' => 5,
                'kategori_id' => 2
            ],
            [
                'buku_id' => 5,
                'kategori_id' => 6
            ],
            [
                'buku_id' => 6,
                'kategori_id' => 6
            ],
            [
                'buku_id' => 7,
                'kategori_id' => 2
            ],
            [
                'buku_id' => 8,
                'kategori_id' => 7
            ],
            [
                'buku_id' => 8,
                'kategori_id' => 14
            ],
            [
                'buku_id' => 9,
                'kategori_id' => 7
            ],
        ];

        foreach ($kategoriBuku as $relasi) {
            KategoriBukuRelasi::create($relasi);
        }
    }
}
