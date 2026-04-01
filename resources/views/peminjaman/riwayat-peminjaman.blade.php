<x-layouts.user-dashboard>
    <div class="container mx-auto px-6 py-8">
        <div class="flex flex-col gap-y-8">
            <div class="flex justify-between">
                <h1 class="text-4xl font-medium">Riwayat Peminjaman</h1>
            </div>
            <div class="flex gap-5 flex-col w-full">
                @forelse ($historys as $history)
                    <a class="group flex items-center gap-5 p-5 rounded-2xl transition-all hover:shadow-md bg-white"
                        href="#">
                        <div class="w-18 h-24 rounded-xl overflow-hidden shrink-0">
                            <img class="border h-40 object-cover rounded-lg mx-auto border-none"
                                src="{{ asset('storage/' . $history->buku->cover_buku) }}" alt="cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-3 mb-2">
                                <div>
                                    <h1 class="text-black font-bold mb-1">
                                        {{ $history->buku->judul }}
                                    </h1>
                                    <h2 class="text-black/50 text-sm">{{ $history->buku->penulis }}</h2>
                                </div>
                                <h2 class="px-3 py-1 rounded-full shrink-0 text-xs font-semibold">
                                    {{ $history->status_peminjaman }}
                                </h2>
                            </div>
                            <div class="flex flex-wrap gap-x-6 gap-y-1 text-sm">
                                <h2 class="text-black/50 text-xs">Tanggal Peminjaman: <span
                                        class="text-black font-medium text-sm">{{ $history->stok }}</span></h2>
                                @if ($history->status == 'Dikembalikan')
                                    <h2 class="text-base w-60">Tanggal Pengembalian:
                                        {{ $history->tanggal_pengembalian }}</h2>
                                @else
                                    <h2 class="text-black/50 text-xs">Estimasi Tanggal Pengembalian: <span
                                            class="text-black font-medium text-sm">{{ $history->estimasi_tanggal_pengembalian }}</span>
                                    </h2>
                                @endif
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
