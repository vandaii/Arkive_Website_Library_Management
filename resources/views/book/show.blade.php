<x-layouts.user-dashboard>
    <div class="flex flex-col gap-y-15">
        {{-- Detail Buku --}}
        <div class="flex mt-10 gap-10">
            <div>
                <img class="rounded-md h-96 max-w-max" src="{{ asset('storage/' . $book->cover_buku) }}" alt="">
            </div>
            <div class="py-3 px-5 h-fit">
                <div class="flex justify-between">
                    <div>
                        <div>
                            <h1 class="text-2xl font-bold w-96">{{ $book->judul }}</h1>
                            <h2 class="text-xl">{{ $book->penulis }}</h2>
                        </div>
                        <div>
                            <h3 class="text-md"><span class="text-gray-600">Penerbit: </span>{{ $book->penerbit }}</h3>
                            <h3 class="text-md"><span class="text-gray-600">Tahun Terbit:
                                </span>{{ $book->tahun_terbit }}
                            </h3>
                            <h3 class="text-md"><span class="text-gray-600">Kategori: </span>{{ $book->kategoriBukuRelasi->implode('kategori.nama_kategori', ', ') }}</h3>
                        </div>
                    </div>
                    <form action="" method="">
                        <button type="submit"
                            class="flex items-center cursor-pointer text-indigo-500 hover:text-indigo-600"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4 mx-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>Tambah Favorit</button>
                    </form>
                </div>
            </div>
            <div class="border border-black/30 rounded-md py-3 px-5 h-fit max-w-max">
                <form class="" action="" method="">
                    <div class="flex gap-x-2">
                        <input
                            class="w-25 outline-1 outline-black/30 focus:outline-1 focus:outline-black/70 p-1 rounded-sm"
                            min="0" max="10" type="number" name="" id="" placeholder="0">
                        <p>Stok: {{ $book->stok }}</p>
                    </div>
                    <div class="flex items-center py-2 mt-3">
                        <label for="">Tanggal Pengembalian</label>
                        <input class="ml-2 py-1 px-4 border-l border-indigo-500 outline-none" type="date"
                            name="" id="">
                    </div>
                    <button class="mt-5 px-4 py-3 w-full bg-indigo-500 text-white rounded-lg hover:bg-indigo-600"
                        type="submit">Pinjam
                        Buku</button>
                </form>
            </div>
        </div>

        {{-- Ulasan --}}
        <div>
            <h1>INI ULASAN</h1>
        </div>
    </div>
</x-layouts.user-dashboard>
