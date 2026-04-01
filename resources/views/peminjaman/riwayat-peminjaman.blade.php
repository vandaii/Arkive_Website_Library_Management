<x-layouts.user-dashboard>
    <div class="container mx-auto px-6 py-8">
        <div class="flex flex-col gap-y-8">
            <div class="p-5 rounded-2xl bg-white">
                <div class="flex justify-between space-y-12">
                    <h1 class="text-4xl font-medium">Riwayat Peminjaman</h1>
                    <div
                        class="group flex items-center gap-1 text-gray-500 border rounded-full h-fit font-medium text-sm px-3 py-2 hover:text-black transition-all duration-200">
                        <i class="size-4 rotate-180 group-hover:text-black" data-lucide="arrow-right"></i>
                        <a class="" href="{{ route('peminjaman.index') }}">Pinjaman</a>
                    </div>
                </div>
                <div>
                    <form class="flex justify-between" action="">
                        <div class="w-full">
                            <x-search-input></x-search-input>
                        </div>
                        <select class="border border-black/50 rounded-md px-2 text-sm focus:border-black/50"
                            name="status_peminjaman" id="status_peminjaman">
                            <option value="All" selected>All</option>
                            <option value="Pending">Pending</option>
                            <option value="Dipinjam">Dipinjam</option>
                            <option value="Pending Dikembalikan">Pending Dikembalikan</option>
                            <option value="Dikembalikan">Dikembalikan</option>
                            <option value="Terlambat">Terlambat</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="flex gap-5 flex-col w-full">
                @forelse ($historys as $history)
                    <a class="group flex items-center gap-5 p-5 rounded-2xl transition-all hover:shadow-md bg-white"
                        href="{{ route('peminjaman.detailRiwayat', $history->id) }}">
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
