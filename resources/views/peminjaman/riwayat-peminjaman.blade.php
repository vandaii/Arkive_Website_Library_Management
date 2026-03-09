<x-layouts.user-dashboard>
    <div class="flex flex-col gap-y-10">
        <div class="flex flex-col gap-y-8">
            <div class="flex justify-between">
                <h1 class="text-2xl font-bold">Riwayat Peminjaman</h1>
            </div>
            <div class="flex gap-5 flex-col w-full justify-center">
                @forelse ($historys as $history)
                    <a href="{{ route('peminjaman.show', $history->id) }}">
                        <div class="flex gap-x-3 rounded-lg p-2 shadow-md bg-white w-full relative" id="card">
                            <img class="border max-h-30 object-cover rounded-lg border-none"
                                src="{{ asset('storage/' . $history->buku->cover_buku) }}" alt="cover">
                            <div class="relative">
                                <h1 class="font-medium text-lg mt-2 line-clamp-1 overflow-hidden text-ellipsis">
                                    {{ $history->buku->judul }}
                                </h1>
                                <h2 class="text-base">{{ $history->buku->penulis }}</h2>
                                <h2 class="text-base">Jumlah Buku: {{ $history->stok }}</h2>
                                <h2 class="text-base">Estimasi Tanggal Pengembalian:
                                    {{ $history->tanggal_pengembalian }}</h2>
                            </div>
                            <h2 class="text-sm py-1 px-1.5 rounded-sm absolute right-3 top-3 text-white font-semibold"
                                style="background-color: 
                                @switch($history->status_peminjaman)
                                    @case('Pending')
                                        #f1c21b
                                    @break
                                    @case('Dipinjam')
                                        #0043ce
                                    @break
                                    @case('Pending Dikembalikan')
                                        #ff832b
                                    @break
                                    @case('Dikembalikan')
                                        #24a148
                                    @break
                                    @default
                                        #666666
                                @endswitch
                                ">
                                {{ $history->status_peminjaman }}
                            </h2>
                        </div>
                    </a>
                @empty
                    <p>Tidak Ada Yang Dipinjam</p>
                @endforelse
            </div>
        </div>
</x-layouts.user-dashboard>
