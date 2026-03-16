<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-500/10 w-full">
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
                    <a href="" class="text-(--primary-color) font-medium flex items-center gap-x-3">Eksplor Buku
                        <i data-lucide="arrow-right" class="size-4"></i></a>
                </div>
            </div>
            <div class="h-full bg-[url(/public/img/bg-landing-perpus.jpg)] bg-cover rounded-l-md">
            </div>
        </section>
        <section class="grid grid-cols-2 h-screen mt-44 gap-x-5 px-5">
            <div class="grid grid-cols-5 grid-rows-4 gap-1 h-full">
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
        <section>
            <div class="flex gap-5 flex-wrap w-full">
                @forelse ($books as $book)
                    <a href="{{ route('book.show', $book->id) }}">
                        <div class="w-70 sm:w-45 rounded-lg px-2 py-4 shadow-md/30 bg-white">
                            <img class="border h-40 object-cover rounded-lg mx-auto border-none"
                                src="{{ asset('storage/' . $book->cover_buku) }}" alt="cover">
                            <div>
                                <h1 class="font-medium text-lg mt-2 whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ $book->judul }}</h1>
                                <h2 class="text-base">{{ $book->penulis }}</h2>
                                <div class="flex space-x-1.5 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="yellow" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5 stroke-none">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                    </svg>
                                    @php
                                        $avg = $book->averageRating();
                                    @endphp

                                    <p class="text-sm">{{ $avg }}</p>

                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <h1>Tidak Ada Data</h1>
                @endforelse
            </div>
        </section>
    </main>
    <footer>
        <div class="bg-(--primary-color) flex justify-between items-center py-5 px-5">
            <div class="flex items-center gap-x-2">
                <img class="max-h-15" src="{{ asset('img/logo-arkive.png') }}" alt="logo arkive">
                <p class="text-2xl font-medium text-(--logo-color)">Arkive</p>
            </div>
            <p class="text-(--third-color) text-sm">© 2023 Arkive. All Rights Reserved.</p>
            <div class="flex gap-2 text-(--third-color)">
                <a class="hover:text-(--second-color) transition-all duration-300" href="">
                    <i class="stroke-2" data-lucide="instagram"></i>
                </a>
                <a class="hover:text-(--second-color) transition-all duration-300" href="">
                    <i data-lucide="facebook"></i>
                </a>
                <a class="hover:text-(--second-color) transition-all duration-300" href="">
                    <i data-lucide="mail"></i>
                </a>
            </div>
        </div>
    </footer>
</body>

</html>
