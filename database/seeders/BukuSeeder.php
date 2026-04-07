<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bukus = [
            [
                'cover_buku' => 'cover/Bintang_cover.jpg',
                'judul' => 'Bintang',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang',
                'tahun_terbit' => 2005,
                'isbn_number' => '9789799065120',
                'jumlah_halaman' => 353,
                'deskripsi' => 'Novel tentang perjuangan sekelompok guru dan siswa di Sekolah Dasar Muhammadiyah Gantong.',
                'stok' => 5,
            ],
            [
                'cover_buku' => 'cover/educated-terdidik_cover.jpg',
                'judul' => 'Educated Terdidik',
                'penulis' => 'B. Rahmanto',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 1980,
                'isbn_number' => '9789793063980',
                'jumlah_halaman' => 412,
                'deskripsi' => 'Novel yang mengisahkan perjalanan hidup Minke dalam menghadapi perubahan zaman kolonia.',
                'stok' => 3,
            ],
            [
                'cover_buku' => 'cover/Home_Sweet_Loan_cover.jpg',
                'judul' => 'Home Sweet Loan',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang',
                'tahun_terbit' => 2006,
                'isbn_number' => '9789799065137',
                'jumlah_halaman' => 416,
                'deskripsi' => 'Kelanjutan dari Laskar Pelangi yang menceritakan mimpi-mimpi besar dari para tokoh.',
                'stok' => 4,
            ],
            [
                'cover_buku' => 'cover/laskar-pelangi_cover.jpg',
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang',
                'tahun_terbit' => 2012,
                'isbn_number' => '9789799065267',
                'jumlah_halaman' => 464,
                'deskripsi' => 'Triologi penutup dari kisah Laskar Pelangi dengan cerita yang lebih kompleks.',
                'stok' => 2,
            ],
            [
                'cover_buku' => 'cover/Laut-Bercerita_cover.jpg',
                'judul' => 'Laut Bercerita',
                'penulis' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Hasta Mitra',
                'tahun_terbit' => 1988,
                'isbn_number' => '9789793630382',
                'jumlah_halaman' => 385,
                'deskripsi' => 'Kumpulan cerita pendek yang menyentuh berbagai aspek kehidupan manusia.',
                'stok' => 6,
            ],
            [
                'cover_buku' => 'cover/Nebula_cover.jpg',
                'judul' => 'Nebula',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Kompas',
                'tahun_terbit' => 2017,
                'isbn_number' => '9789799067234',
                'jumlah_halaman' => 240,
                'deskripsi' => 'Buku tentang kebijaksanaan Stoic dan penerapannya dalam kehidupan modern.',
                'stok' => 8,
            ],
            [
                'cover_buku' => "cover/pagi-di-amerika_cover'.jpg",
                'judul' => 'Pagi di Amerika',
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => 2008,
                'isbn_number' => '9780136083238',
                'jumlah_halaman' => 464,
                'deskripsi' => 'Panduan praktis untuk menulis kode yang bersih dan mudah dipahami.',
                'stok' => 3,
            ],
            [
                'cover_buku' => 'cover/sagaras_cover.jpeg',
                'judul' => 'Sagaras',
                'penulis' => 'David Thomas & Andrew Hunt',
                'penerbit' => 'Addison-Wesley',
                'tahun_terbit' => 1999,
                'isbn_number' => '9780135957059',
                'jumlah_halaman' => 352,
                'deskripsi' => 'Buku panduan untuk menjadi programmer yang lebih baik dan produktif.',
                'stok' => 2,
            ],
            [
                'cover_buku' => 'cover/Selena_cover.jpg',
                'judul' => 'Selena',
                'penulis' => 'Yuval Noah Harari',
                'penerbit' => 'Harvill Secker',
                'tahun_terbit' => 2011,
                'isbn_number' => '9780771038518',
                'jumlah_halaman' => 443,
                'deskripsi' => 'Sejarah singkat umat manusia dari perspektif yang unik dan menarik.',
                'stok' => 7,
            ],
        ];

        foreach ($bukus as $buku) {
            Buku::create($buku);
        }
    }
}
