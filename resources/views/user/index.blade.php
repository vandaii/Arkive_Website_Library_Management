<x-layouts.user-dashboard>
    <section class="bg-white px-5 py-5 rounded-lg pb-15">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-medium">Jelajahi Buku</h1>
        </div>

        {{-- Sorting & Filter --}}
        <div class="flex items-center gap-3 mb-8 flex-wrap">
            <form id="filterForm" action="{{ route('user.index') }}" method="get" class="flex items-center gap-3 flex-wrap">
                {{-- Kategori Filter --}}
                <div class="relative">
                    <select name="kategori" id="kategori"
                        onchange="document.getElementById('filterForm').submit()"
                        class="appearance-none pl-3 pr-8 py-2 text-sm rounded-full border border-black/15 bg-white focus:outline-none focus:border-(--third-color) cursor-pointer transition-all duration-200">
                        <option value="all" {{ request('kategori') == 'all' || !request('kategori') ? 'selected' : '' }}>Semua Kategori</option>
                        @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('kategori') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                    <i class="absolute right-2.5 top-1/2 -translate-y-1/2 size-3.5 text-black/40 pointer-events-none" data-lucide="chevron-down"></i>
                </div>

                {{-- Sort Dropdown --}}
                <div class="relative">
                    <select name="sort" id="sort"
                        onchange="document.getElementById('filterForm').submit()"
                        class="appearance-none pl-3 pr-8 py-2 text-sm rounded-full border border-black/15 bg-white focus:outline-none focus:border-(--third-color) cursor-pointer transition-all duration-200">
                        <option value="" {{ !request('sort') ? 'selected' : '' }}>Terbaru</option>
                        <option value="judul_asc" {{ request('sort') == 'judul_asc' ? 'selected' : '' }}>Judul A-Z</option>
                        <option value="judul_desc" {{ request('sort') == 'judul_desc' ? 'selected' : '' }}>Judul Z-A</option>
                        <option value="tahun_desc" {{ request('sort') == 'tahun_desc' ? 'selected' : '' }}>Tahun Terbaru</option>
                        <option value="tahun_asc" {{ request('sort') == 'tahun_asc' ? 'selected' : '' }}>Tahun Terlama</option>
                    </select>
                    <i class="absolute right-2.5 top-1/2 -translate-y-1/2 size-3.5 text-black/40 pointer-events-none" data-lucide="chevron-down"></i>
                </div>

                @if (request('kategori') && request('kategori') !== 'all' || request('sort'))
                <a href="{{ route('user.index') }}"
                    class="flex items-center gap-1 text-xs text-black/50 hover:text-black font-medium transition-colors">
                    <i class="size-3" data-lucide="x"></i>Reset
                </a>
                @endif
            </form>
        </div>

        @if (isset($search) && $search)
        <div class="flex items-center gap-2 mb-6 px-1">
            <p class="text-sm text-black/50">Hasil pencarian untuk: <span class="font-semibold text-black">"{{ $search }}"</span></p>
            <span class="text-xs text-black/30">({{ $books->count() }} buku ditemukan)</span>
        </div>
        @endif

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
                            {{ $book->kategoriBukuRelasi->implode('kategori.nama_kategori', ', ') }}
                        </div>
                        <h1 class="line-clamp-1 mb-0.5 text-base font-semibold text-ellipsis overflow-hidden">
                            {{ $book->judul }}
                        </h1>
                        <h2 class="text-sm text-black/50">{{ $book->penulis }}</h2>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center gap-2">
                                <i class="stroke-0 size-4 fill-(--second-color)" data-lucide="star"></i>
                                @php
                                $avg = $book->averageRating();
                                @endphp

                                <p class="text-xs font-semibold">{{ $avg }}</p>
                                <p class="text-xs text-black/40">({{ $book->ulasan->count() }})</p>
                            </div>
                            @if($book->stok < 1)
                                <p class="text-xs text-red-600 font-medium">Tidak Tersedia</p>
                                @else
                                <p class="text-xs text-(--third-color) font-medium">Tersedia</p>
                                @endif

                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center w-full py-16">
                <i class="size-16 text-black/10 mb-4" data-lucide="book-x"></i>
                <h2 class="text-lg font-medium text-black/40">Tidak Ada Buku Ditemukan</h2>
                <p class="text-sm text-black/30 mt-1">Coba ubah filter atau kata kunci pencarian</p>
            </div>
            @endforelse
        </div>
    </section>
</x-layouts.user-dashboard>