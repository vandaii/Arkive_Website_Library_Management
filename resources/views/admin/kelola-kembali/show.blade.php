<x-layouts.admin-dashboard>
    <div class="ml-45 bg-white px-10 py-8 rounded-lg">

        <div class="mb-10">
            <h1 class="capitalize text-xl">{{ __($title) }}</h1>
        </div>

        <div class="flex gap-x-8 relative">
            <img class="rounded-md h-90 max-w-max" src="{{ asset('storage/' . $pengembalian->buku->cover_buku) }}"
                alt="cover">

            <div class="flex flex-col gap-y-5">
                <div>
                    <h2 class="text-2xl font-bold">{{ $pengembalian->buku->judul }}</h2>
                    <h3 class="text-xl">{{ $pengembalian->buku->penulis }}</h3>
                    <h3 class="text-md text-gray-600">Penerbit: <span>{{ $pengembalian->buku->penerbit }}</span></h3>
                    <h3 class="text-md text-gray-600">Tahun Terbit: <span>{{ $pengembalian->buku->tahun_terbit }}</span>
                    </h3>
                    <h3 class="text-md text-gray-600">Kategori:
                        <span>{{ $pengembalian->buku->kategoriBukuRelasi->implode('kategori.nama_kategori', ', ') }}
                    </h3>
                </div>
                <div>
                    <h3 class="text-xl">{{ $pengembalian->user->nama_lengkap }}</h3>
                    <h3 class="text-md text-gray-600">Jumlah Buku: <span>{{ $pengembalian->stok }}</span></h3>
                    <h3 class="text-md text-gray-600">Tanggal Peminjaman:
                        <span>{{ $pengembalian->tanggal_peminjaman }}</span>
                    </h3>
                    <h3 class="text-md text-gray-600">Tanggal Pengembalian:
                        <span>{{ $pengembalian->user->tanggal_pengembalian }}</span>
                    </h3>
                </div>
            </div>
            <h3 class="font-medium bg-green-500 text-white py-1 px-2 rounded-lg absolute right-0 top-0">
                {{ $pengembalian->status_peminjaman }}
            </h3>

        </div>

    </div>
</x-layouts.admin-dashboard>
