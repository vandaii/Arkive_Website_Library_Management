<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="ml-45 bg-white px-10 py-8 rounded-lg">
        <div class="mb-10">
            <h1 class="capitalize text-xl">{{ $title }}</h1>
        </div>

        <div>
            <form class="grid grid-cols-1 gap-5" action="{{ route('kategori.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- Nama Lengkap --}}
                <div>
                    <label for="nama_kategori" class="block text-sm/6 font-medium text-gray-800">Nama Kategori</label>
                    <div class="mt-1">
                        <input id="nama_kategori" placeholder="Novel"
                            value="{{ old('nama_kategori', $category->nama_kategori) }}" type="text"
                            name="nama_kategori" required autocomplete="nama_kategori"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6 
                                @error('nama_kategori') 
                                    input-error 
                                @enderror" />
                    </div>
                    @error('name')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="col-span-2 w-fit">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-500  px-3 py-3 text-sm/6 font-semibold text-white hover:bg-indigo-700 hover:outline-1 hover:outline-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-200 capitalize">edit
                        kategori</button>
                </div>

            </form>
        </div>
    </div>
</x-layouts.admin-dashboard>
