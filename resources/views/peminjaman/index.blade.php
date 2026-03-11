<x-layouts.user-dashboard>
    <div class="flex flex-col gap-y-10">
        <div class="flex flex-col gap-y-8">
            <div class="flex justify-between">
                <h1 class="text-2xl font-bold">Dipinjam</h1>
                <a class="text-gray-500" href="{{ route('peminjaman.riwayat-peminjaman') }}">Riwayat Pinjaman</a>
            </div>
            <div class="flex gap-5 flex-col w-full justify-center">
                @forelse ($peminjamans as $peminjaman)
                    <div class="flex gap-x-3 rounded-lg p-2 shadow-md bg-white w-full relative">
                        <a href="{{ route('peminjaman.show', $peminjaman->id) }}" class="flex gap-x-3 flex-1">
                            <img class="border max-h-30 object-cover rounded-lg border-none"
                                src="{{ asset('storage/' . $peminjaman->buku->cover_buku) }}" alt="cover">
                            <div>
                                <h1 class="font-medium text-lg mt-2 line-clamp-1 overflow-hidden text-ellipsis">
                                    {{ $peminjaman->buku->judul }}
                                </h1>
                                <h2 class="text-base">{{ $peminjaman->buku->penulis }}</h2>
                                <h2 class="text-base">Jumlah Buku: {{ $peminjaman->stok }}</h2>
                                <h2 class="text-base">Estimasi Tanggal Pengembalian:
                                    {{ $peminjaman->tanggal_pengembalian }}</h2>
                            </div>
                        </a>

                        {{-- Tombol Bukti --}}
                        <div class="flex flex-col gap-y-2 items-end justify-center pr-3">
                            @if ($peminjaman->status_peminjaman === 'Dipinjam' || $peminjaman->status_peminjaman === 'Pending')
                                <a href="{{ route('peminjaman.bukti-peminjaman', $peminjaman->id) }}" target="_blank"
                                    class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 whitespace-nowrap">
                                    📄 Bukti Peminjaman
                                </a>
                            @endif
                            @if (in_array($peminjaman->status_peminjaman, ['Pending Dikembalikan', 'Dikembalikan', 'Terlambat']))
                                <a href="{{ route('peminjaman.bukti-pengembalian', $peminjaman->id) }}" target="_blank"
                                    class="px-3 py-1.5 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 whitespace-nowrap">
                                    📄 Bukti Pengembalian
                                </a>
                            @endif
                        </div>

                        <h2 class="text-sm py-1 px-1.5 rounded-sm absolute right-3 top-3 text-white font-semibold"
                            style="background-color: 
                            @switch($peminjaman->status_peminjaman)
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
                            {{ $peminjaman->status_peminjaman }}
                        </h2>
                    </div>
                @empty
                    <p>Tidak Ada Yang Dipinjam</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.user-dashboard>
