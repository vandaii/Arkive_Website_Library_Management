<x-layouts.admin-dashboard>
    <div class="ml-45 bg-white px-10 py-8 rounded-lg">

        <div class="mb-10">
            <h1 class="capitalize text-xl">{{ __($title) }}</h1>
        </div>

        <div class="flex gap-x-8">
            <img class="rounded-md h-90 max-w-max" src="{{ asset('storage/' . $peminjaman->buku->cover_buku) }}"
                alt="cover">

            <div class="flex flex-col gap-y-5">
                <div>
                    <h2 class="text-2xl font-bold">{{ $peminjaman->buku->judul }}</h2>
                    <h3 class="text-xl">{{ $peminjaman->buku->penulis }}</h3>
                    <h3 class="text-md text-gray-600">Penerbit: <span>{{ $peminjaman->buku->penerbit }}</span></h3>
                    <h3 class="text-md text-gray-600">Tahun Terbit: <span>{{ $peminjaman->buku->tahun_terbit }}</span>
                    </h3>
                    <h3 class="text-md text-gray-600">Kategori:
                        <span>{{ $peminjaman->buku->kategoriBukuRelasi->implode('kategori.nama_kategori', ', ') }}</span>
                    </h3>
                </div>
                <div>
                    <h3 class="text-xl">{{ $peminjaman->user->nama_lengkap }}</h3>
                    <h3 class="text-md text-gray-600">Jumlah Buku: <span>{{ $peminjaman->stok }}</span></h3>
                    <h3 class="text-md text-gray-600">Tanggal Peminjaman:
                        <span>{{ $peminjaman->tanggal_peminjaman }}</span>
                    </h3>
                    <h3 class="text-md text-gray-600">Estimasi Tanggal Pengembalian:
                        <span>{{ $peminjaman->tanggal_pengembalian }}</span>
                    </h3>
                    <h3 class="text-md text-gray-600">Status: <span>{{ $peminjaman->status_peminjaman }}</span></h3>
                </div>
            </div>

        </div>

    </div>
</x-layouts.admin-dashboard>
