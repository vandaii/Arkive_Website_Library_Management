<x-layouts.admin-dashboard>
    <div class="ml-45 bg-white px-10 py-8 rounded-lg">

        <div class="mb-10">
            <h1 class="capitalize text-xl">{{ __('Detail Pinjaman') }}</h1>
        </div>

        <div class="flex gap-x-8">
            <img class="rounded-md h-90 max-w-max" src="{{ asset('img/cover/cover-bumi.jpg') }}" alt="cover">

            <div class="flex flex-col gap-y-5">
                <div>
                    <h2 class="text-2xl font-bold">Judul</h2>
                    <h3 class="text-xl">Penulis</h3>
                    <h3 class="text-md text-gray-600">Penerbit: <span>Penerbit</span></h3>
                    <h3 class="text-md text-gray-600">Tahun Terbit: <span>Tahun Terbit</span>
                    </h3>
                    <h3 class="text-md text-gray-600">Kategori:
                        <span>Kategori
                    </h3>
                </div>
                <div>
                    <h3 class="text-xl">Nama Lengkap</h3>
                    <h3 class="text-md text-gray-600">Jumlah Buku: <span>stok</span></h3>
                    <h3 class="text-md text-gray-600">Tanggal Peminjaman:
                        <span>Tanggal Peminjaman</span>
                    </h3>
                    <h3 class="text-md text-gray-600">Estimasi Tanggal Pengembalian:
                        <span>Tanggal Pengembalian</span>
                    </h3>
                    <h3 class="text-md text-gray-600">Status: <span>Status</span></h3>
                </div>
            </div>

        </div>

    </div>
</x-layouts.admin-dashboard>
