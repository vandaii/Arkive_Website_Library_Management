<x-layouts.user-dashboard>
    <div class="flex flex-col gap-y-10">
        <div class="flex flex-col gap-y-8">
            <div class="flex justify-between">
                <h1 class="text-2xl font-bold">Dipinjam</h1>
                <a class="text-gray-500" href="">Riwayat Pinjaman</a>
            </div>
            <div class="flex gap-5 flex-wrap w-full justify-center">
                @forelse ($peminjamans as $peminjaman)
                    <a href="#">
                        <div class="flex gap-x-3 rounded-lg p-2 shadow-md/30 bg-white">
                            <img class="border h-40 object-cover rounded-lg mx-auto border-none"
                                src="{{ asset('storage/' . $peminjaman->buku->cover_buku) }}" alt="cover">
                            <div class="relative">
                                <h1
                                    class="font-medium text-lg w-65 mt-2 whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ $peminjaman->buku->judul }}
                                </h1>
                                <h2 class="text-base">{{ $peminjaman->buku->penulis }}</h2>
                                <h2 class="text-base">Jumlah Buku: {{ $peminjaman->stok }}</h2>
                                <h2 class="text-base w-60">Estimasi Tanggal Pengembalian:
                                    {{ $peminjaman->tanggal_pengembalian }}</h2>
                                <h2
                                    class="text-sm py-1 px-1.5 rounded-sm bg-amber-400 absolute right-0 bottom-0 text-white">
                                    {{ $peminjaman->status_peminjaman }}
                                </h2>
                            </div>
                        </div>
                    </a>
                @empty
                    <p>Tidak Ada Yang Dipinjam</p>
                @endforelse
            </div>
        </div>
        <div class="flex flex-col gap-y-8">
            <h1 class="text-2xl font-bold">Dikembalikan</h1>
            <div class="flex gap-5 flex-wrap w-full justify-center">
                @forelse ($returns as $return)
                    <a href="#">
                        <div class="flex gap-x-3 rounded-lg p-2 shadow-md/30 bg-white">
                            <img class="border h-40 object-cover rounded-lg mx-auto border-none"
                                src="{{ asset('img/cover/cover-bumi.jpg') }}" alt="cover">
                            <div class="relative">
                                <h1
                                    class="font-medium text-lg w-65 mt-2 whitespace-nowrap overflow-hidden text-ellipsis">
                                    Cerelian Fineassaince
                                </h1>
                                <h2 class="text-base">Clyona</h2>
                                <h2 class="text-base">Jumlah Buku: 3</h2>
                                <h2 class="text-base w-60">Tanggal Pengembalian: 22-10-2007</h2>
                                <h2
                                    class="text-sm py-1 px-1.5 rounded-sm bg-amber-400 absolute right-0 bottom-0 text-white">
                                    Pending
                                </h2>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="capitalize">Tidak ada data buku kembali</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.user-dashboard>
