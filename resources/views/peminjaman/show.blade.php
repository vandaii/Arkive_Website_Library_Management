<x-layouts.user-dashboard>
    <div class="bg-white rounded-lg">

        <div class="mb-10">
            <h1 class="capitalize text-xl">{{ __('Detail') }}</h1>
        </div>

        <div class="flex gap-x-8 relative">
            <img class="rounded-md h-90 max-w-max" src="{{ asset('storage/' . $detail->buku->cover_buku) }}"
                alt="cover">

            <div class="flex flex-col gap-y-5">
                <div>
                    <h2 class="text-2xl font-bold">{{ $detail->buku->judul }}</h2>
                    <h3 class="text-xl">Penulis</h3>
                    <h3 class="text-md text-gray-600">Penerbit: <span>{{ $detail->buku->penerbit }}</span></h3>
                    <h3 class="text-md text-gray-600">Tahun Terbit: <span>{{ $detail->buku->tahun_terbit }}</span>
                    </h3>
                    <h3 class="text-md text-gray-600">Kategori:
                        <span>{{ $detail->buku->kategoriBukuRelasi->implode('kategori.nama_kategori', ', ') }}</span>
                    </h3>
                </div>
                <div>
                    <h3 class="text-xl">{{ $detail->user->nama_lengkap }}</h3>
                    <h3 class="text-md text-gray-600">Jumlah Buku: <span>{{ $detail->stok }}</span></h3>
                    <h3 class="text-md text-gray-600">Tanggal Peminjaman:
                        <span>{{ $detail->tanggal_peminjaman }}</span>
                    </h3>
                    <h3 class="text-md text-gray-600">Estimasi Tanggal Pengembalian:
                        <span>{{ $detail->tanggal_pengembalian }}</span>
                    </h3>
                </div>
                @if ($detail->status_peminjaman == 'Dipinjam')
                    <form class="mt-5" action="{{ route('peminjaman.kembalikanBuku', $detail->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="px-3 py-2 bg-indigo-500 text-white rounded-md" type="submit">Kembalikan
                            Buku</button>
                    </form>
                @endif
            </div>
            <h3 class="font-medium bg-green-500 text-white py-1 px-2 rounded-lg absolute right-0 top-0">
                {{ $detail->status_peminjaman }}
            </h3>

        </div>

    </div>
</x-layouts.user-dashboard>
