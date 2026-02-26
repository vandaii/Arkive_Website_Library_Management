<x-layouts.user-dashboard>
    <div class="flex flex-col gap-y-10">
        <div class="flex flex-col gap-y-8">
            <div class="flex justify-between">
                <h1 class="text-2xl font-bold">Riwayat Peminjaman</h1>
            </div>
            <div class="flex gap-5 flex-wrap w-full justify-center">
                @forelse ($historys as $history)
                    <a href="#">
                        <div class="flex gap-x-3 rounded-lg p-2 shadow-md/30 bg-white">
                            <img class="border h-40 object-cover rounded-lg mx-auto border-none"
                                src="{{ asset('storage/' . $history->buku->cover_buku) }}" alt="cover">
                            <div class="relative">
                                <h1
                                    class="font-medium text-lg w-65 mt-2 whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ $history->buku->judul }}
                                </h1>
                                <h2 class="text-base">{{ $history->buku->penulis }}</h2>
                                <h2 class="text-base">Jumlah Buku: {{ $history->stok }}</h2>
                                <h2 class="text-base w-60">Estimasi Tanggal Pengembalian:
                                    {{ $history->tanggal_pengembalian }}</h2>
                                <h2
                                    class="text-sm py-1 px-1.5 rounded-sm bg-amber-400 absolute right-0 bottom-0 text-white">
                                    {{ $history->status_peminjaman }}
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
