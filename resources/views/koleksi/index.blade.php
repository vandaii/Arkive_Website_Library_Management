<x-layouts.user-dashboard>
    <section class="bg-white px-5 py-5 rounded-lg pb-15">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-medium">Koleksi Buku</h1>
            <h2 class="font-medium flex items-center gap-x-2">Kategori<i class="size-4" data-lucide="list-filter"></i></h2>
            <form hidden action="" method="get">
            </form>
        </div>
        <div class="flex gap-x-4 gap-y-6 flex-wrap">
            @forelse ($collections as $collection)
            <div>
                <a class="group block" href="{{ route('book.show', $collection->buku->id) }}">
                    <div class="rounded-md overflow-hidden w-40 aspect-3/4">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            src="{{ asset('storage/' . $collection->buku->cover_buku) }}" alt="cover">
                    </div>
                    <div class="w-40">
                        <div class="inline-block py-0.5 rounded-full text-xs">
                            {{ $collection->buku->kategoriBukuRelasi->implode('kategori.nama_kategori', ', ') }}
                        </div>
                        <h1 class="line-clamp-1 mb-0.5 text-base font-semibold text-ellipsis overflow-hidden">
                            {{ $collection->buku->judul }}
                        </h1>
                        <h2 class="text-sm text-black/50">{{ $collection->buku->penulis }}</h2>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center gap-1">
                                <i class="stroke-0 size-4 fill-(--second-color)" data-lucide="star"></i>
                                @php
                                $avg = $collection->buku->averageRating();
                                @endphp

                                <p class="text-xs font-semibold">{{ $avg }}</p>
                                <p class="text-xs text-black/40">({{ $collection->buku->ulasan->count() }})</p>
                            </div>

                            @if($collection->buku->stok < 1)
                                <p class="text-xs text-red-600 font-medium">Tidak Tersedia</p>
                                @else
                                <p class="text-xs text-(--third-color) font-medium">Tersedia</p>
                                @endif
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