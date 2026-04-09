<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white px-10 py-8 rounded-lg">
        <div class="mb-10">
            <h1 class="capitalize text-xl">{{ $title }}</h1>
        </div>

        <div>
            <form class="grid grid-cols-1 gap-5" action="{{ route('kategori.store') }}" method="POST">
                @csrf

                {{-- Nama Kategori --}}
                <div>
                    <label for="nama_kategori" class="block text-sm/6 font-medium text-gray-800">Nama Kategori</label>
                    <div class="mt-1">
                        <input id="nama_kategori" placeholder="Novel" value="{{ old('nama_kategori') }}" type="text"
                            name="nama_kategori" required autocomplete="nama_kategori"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6 
                                @error('nama_kategori') 
                                    input-error 
                                @enderror" />
                    </div>
                    @error('nama_kategori')
                        <div class="text-red-600 font-medium text-xs">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="col-span-2 w-fit">
                    <div class="flex gap-x-5">
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-(--third-color)  px-3 py-3 text-sm/6 font-semibold text-white hover:bg-(--second-color) capitalize">tambah
                            kategori</button>
                        <a href="{{ route('kategori.index') }}"
                            class="flex justify-center rounded-md bg-yellow-400 px-3 py-3 text-sm/6 font-semibold text-white hover:bg-yellow-500 capitalize">Kembali</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-layouts.admin-dashboard>
