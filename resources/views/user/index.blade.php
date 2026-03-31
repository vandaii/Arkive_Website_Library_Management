<x-layouts.user-dashboard>
    <section class="min-h-screen bg-white px-5 py-5 rounded-lg">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-medium">Jelajahi Buku</h1>
            <h2 class="font-medium flex items-center gap-x-2">Kategori<i class="size-4" data-lucide="list-filter"></i></h2>
            <form hidden action="" method="get">
            </form>
        </div>
        <div class="flex gap-x-4 gap-y-6 flex-wrap">
            @forelse ($books as $book)
                <div>
                    <a class="group block" href="{{ route('book.show', $book->id) }}">
                        <div class="rounded-md overflow-hidden w-40 aspect-3/4">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                src="{{ asset('storage/' . $book->cover_buku) }}" alt="cover">
                        </div>
                        <div class="w-40">
                            <div class="inline-block py-0.5 rounded-full text-xs">
                                {{ $book->kategoriBukuRelasi->implode('kategori.nama_kategori', ', ') }}</div>
                            <h1 class="line-clamp-1 mb-0.5 text-base font-semibold text-ellipsis overflow-hidden">
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
</x-layouts.user-dashboard>
