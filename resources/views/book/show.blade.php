<x-user-dashboard>
    <div class="flex mt-10">
        <div class="w-70">
            <img class="h-auto rounded-md" src="{{ asset('img/cover/cover-bumi.jpg') }}" alt="">
        </div>
        <div class="flex flex-col ml-10 px-10 justify-around outline-1 outline-black/20 rounded-lg">
            <div class="flex justify-between">
                <div>
                    <div>
                        <h1 class="text-3xl font-bold">Bumi</h1>
                        <h2 class="text-2xl/tight">Tere Liye</h2>
                    </div>
                    <div class="mt-3">
                        <h3 class="text-md"><span class="text-gray-500">Penerbit: </span>Gramedia</h3>
                        <h3 class="text-md"><span class="text-gray-500">Tahun Terbit: </span>2022</h3>
                        <h3 class="text-md"><span class="text-gray-500">Kategori: </span>Action</h3>
                    </div>
                </div>
                <form action="" method="">
                    <button class="flex items-center cursor-pointer text-indigo-500 hover:text-indigo-600"><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 mx-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>Tambah Favorit</button>
                </form>
            </div>
            <div class=" border border-indigo-500/30 rounded-md py-3 px-5">
                <form class="flex justify-center flex-col" action="" method="">
                    <div>
                        <label for="">Tanggal Pengembalian</label>
                        <input class="ml-2 py-2 px-4 border-l border-indigo-500 outline-none" type="date"
                            name="" id="">
                    </div>
                    <button
                        class="mt-5 px-4 py-3 outline-1 outline-indigo-500 text-indigo-500 rounded-lg hover:bg-indigo-500 hover:text-white cursor-pointer"
                        type="submit">Pinjam
                        Buku</button>
                </form>
            </div>
        </div>
    </div>
</x-user-dashboard>
