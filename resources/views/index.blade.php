<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <header class="sticky top-0 z-50">
        <x-navigation.navbar></x-navigation.navbar>
    </header>

    <main class="px-5">
        <section class="grid grid-cols-2 px-5 mb-30 h-screen">
            <div class="flex flex-col justify-center py-20 pr-16 z-10">
                <h1 class="mb-6 tracking-tight text-7xl font-medium capitalize">Di sinilah setiap <span
                        class="text-(--second-color)">cerita</span> menemukan
                    pembacanya.
                </h1>
                <p class="mb-10 max-w-lg text-base/relaxed text-black/65 font-medium">Jelajahi buku pada
                    setiap genre. Pinjam, temukan, dan kembalikan — semuanya dari satu platform yang sangat sederhana.
                </p>
                <div class="flex justify-center items-center bg-(--third-color) w-fit px-5 py-3 rounded-full z-10">
                    <a href="{{ route('user.index') }}"
                        class="text-(--primary-color) font-medium flex items-center gap-x-3">Eksplor Buku
                        <i data-lucide="arrow-right" class="size-4"></i></a>
                </div>
            </div>
            <div class="h-full bg-[url(/public/img/bg-landing-perpus.jpg)] bg-cover rounded-l-md">
            </div>
        </section>
        <section class="grid grid-cols-2 h-screen mt-30 gap-x-5 px-5 mb-30">
            <div class="grid grid-cols-5 grid-rows-4 gap-2 h-full">
                <div class="col-span-2 row-span-2 bg-[url(/public/img/book1.jpg)] bg-cover rounded-md"></div>
                <div class="col-span-3 row-span-2 bg-[url(/public/img/book3.jpg)] bg-cover rounded-md"></div>
                <div class="col-span-3 row-span-2 bg-[url(/public/img/book4.jpg)] bg-cover rounded-md"></div>
                <div class="col-span-2 row-span-2 bg-[url(/public/img/book2.jpg)] bg-cover rounded-md"></div>
            </div>
            <div class="h-full flex flex-col max-w-10/12 justify-center ml-10">
                <h1 class="text-6xl font-medium">Temukan Buku yang <span class="text-(--second-color)">Mengubah
                        Cara</span> Kamu Melihat Dunia.</h1>
                <p class="font-medium text-base/relaxed mt-10">Dari fiksi klasik hingga sains populer — koleksi Arkive
                    dikurasi dengan cermat untuk setiap jenis
                    pembaca. Pinjam kapan saja, kembalikan sesukamu.</p>
            </div>
        </section>
        <section class="mt-30 px-5">
            <div class="flex justify-between items-center gap-6 mb-10">
                <h1 class="text-3xl/tight font-medium">Buku Unggulan</h1>
                <a class="flex items-center gap-x-1 border-2 px-4 py-2 rounded-full font-medium"
                    href="{{ route('user.index') }}">Lihat
                    Semua Buku <i class="size-4" data-lucide="arrow-right"></i></a>
            </div>
            <div class="flex gap-6 overflow-x-auto pb-4 snap-mandatory mb-30">
                @forelse ($books as $book)
                    <div class="snap-start">
                        <a class="group block" href="{{ route('book.show', $book->id) }}">
                            <div class="rounded-2xl overflow-hidden mb-4 w-55 h-73.25 aspect-3/4">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    src="{{ asset('storage/' . $book->cover_buku) }}" alt="cover">
                            </div>
                            <div>
                                <div class="inline-block py-0.5 rounded-full text-xs">
                                    {{ $book->kategoriBukuRelasi->implode('kategori.nama_kategori', ', ') }}</div>
                                <h1 class="line-clamp-1 mb-0.5 text-base font-semibold">
                                    {{ $book->judul }}</h1>
                                <h2 class="text-sm text-black/50">{{ $book->penulis }}</h2>
                                <div class="flex items-center gap-1 mt-2">
                                    <i class="stroke-0 size-4 fill-(--second-color)" data-lucide="star"></i>
                                    @php
                                        $avg = $book->averageRating();
                                    @endphp

                                    <p class="text-xs font-semibold">{{ $avg }}</p>
                                    <p class="text-xs text-black/40">({{ $book->ulasan->count() }})</p>

                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <h1>Tidak Ada Data</h1>
                @endforelse
            </div>
        </section>
    </main>
</body>

</html>
