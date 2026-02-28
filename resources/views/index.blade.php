<x-layouts.user-dashboard>
    <section class="py-20 px-4">
        <div class="container mx-auto text-center max-w-4xl">
            <h1 class="text-black text-6xl font-medium mb-6">Lorem ipsum dolor adipisicing.</h1>
            <p class="mb-8 max-w-2xl mx-auto text-xl text-black/80">Lorem ipsum dolor, sit amet
                consectetur adipisicing
                elit. Hic,
                dolorum
                omnis. Enim
                et obcaecati eligendi
                error fuga nostrum ducimus. Fugit neque consectetur laudantium sequi in voluptatibus, repudiandae
                explicabo eveniet accusantium!</p>
            <div class="mt-10 grid grid-cols-3 gap-8 max-w-2xl mx-auto">
                <div>
                    <h2 class="text-(--third-color) font-medium" style="font-size: 2.5rem">10K</h2>
                    <h3 class="capitalize text-base text-black/70">new this month</h3>
                </div>
                <div>
                    <h2 class="text-(--third-color) font-medium" style="font-size: 2.5rem">10K</h2>
                    <h3 class="capitalize text-base text-black/70">new this month</h3>
                </div>
                <div>
                    <h2 class="text-(--third-color) font-medium" style="font-size: 2.5rem">10K</h2>
                    <h3 class="capitalize text-base text-black/70">new this month</h3>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 px-4 bg-white">
        <div class="container mx-auto">
            <div class="mb-8">
                <h2 class="text-xl font-medium capitalize">Eksplor Buku</h2>
                <h2 class="text-md text-black/60 mt-2">Eksplor buku koleksi kami</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($books as $book)
                    <a href="{{ route('book.show', $book->id) }}">
                        <div
                            class="group cursor-pointer rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                            <div class="relative aspect-3/4 overflow-hidden">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    src="{{ asset('storage/' . $book->cover_buku) }}" alt="cover">
                            </div>
                            <div class="p-5">
                                @php
                                    $category = $book->kategoriBukuRelasi->pluck('kategori.nama_kategori')->toArray();
                                @endphp
                                <p class="text-sm text-black/60">
                                    {{ implode(', ', $category) }}
                                </p>
                                <h3 class="mb-1 line-clamp-2 text-lg font-medium">
                                    {{ $book->judul }}</h3>
                                <p class="mb-3 text-base text-black/80">{{ $book->penulis }}</p>
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="star"
                                            class="size-5 fill-(--third-color) stroke-1 stroke-(--third-color)"></i>
                                        @php
                                            $avg = $book->averageRating();
                                        @endphp

                                        <p class="text-sm">{{ $avg }}</p>
                                    </div>
                                    <p class="text-sm text-black/60">({{ $book->ulasan->count() }})</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <h1>Tidak Ada Data</h1>
                @endforelse
            </div>
        </div>
    </section>
</x-layouts.user-dashboard>
