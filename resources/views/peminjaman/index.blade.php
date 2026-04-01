<x-layouts.user-dashboard>
    <div class="container mx-auto px-6 py-8">
        <div class="flex flex-col gap-y-8">
            <div class="flex justify-between">
                <h1 class="text-4xl font-medium">Pinjaman</h1>
                <a class="group flex items-center gap-1 text-gray-500 border rounded-full font-medium text-sm px-3 hover:text-black transition-all duration-200"
                    href="{{ route('peminjaman.riwayat-peminjaman') }}"><i class="size-4 group-hover:text-black"
                        data-lucide="history"></i>Riwayat
                    Pinjaman</a>
            </div>
            <div class="flex gap-5 flex-col w-full">
                @forelse ($peminjamans as $peminjaman)
                    <a class="group flex items-center gap-5 p-5 rounded-2xl transition-all hover:shadow-md bg-white"
                        href="{{ route('peminjaman.show', $peminjaman->id) }}">
                        <div class="w-18 h-24 rounded-xl overflow-hidden shrink-0">
                            <img class="w-full h-full object-cover"
                                src="{{ asset('storage/' . $peminjaman->buku->cover_buku) }}" alt="cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-3 mb-2">
                                <div>
                                    <h1 class="text-black font-bold mb-1">
                                        {{ $peminjaman->buku->judul }}
                                    </h1>
                                    <h2 class="text-black/50 text-sm">{{ $peminjaman->buku->penulis }}</h2>
                                </div>
                                <h2 class="px-3 py-1 rounded-full shrink-0 text-xs font-semibold">
                                    {{ $peminjaman->status_peminjaman }}
                                </h2>
                            </div>
                            <div class="flex flex-wrap gap-x-6 gap-y-1 text-sm">
                                <h2 class="text-black/50 text-xs">Tanggal Peminjaman: <span
                                        class="text-black font-medium text-sm">{{ $peminjaman->tanggal_peminjaman }}</span>
                                </h2>
                                <h2 class="text-black/50 text-xs">Estimasi Tanggal Pengembalian: <span
                                        class="text-black font-medium text-sm">{{ $peminjaman->estimasi_tanggal_pengembalian }}</span>
                                </h2>
                            </div>
                        </div>
                    </a>
                @empty
                    <p>Tidak Ada Yang Dipinjam</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.user-dashboard>
