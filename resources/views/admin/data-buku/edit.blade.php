<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="ml-45 bg-white px-10 py-8 rounded-lg">
        <div class="mb-10">
            <h1 class="capitalize text-xl">{{ $title }}</h1>
        </div>

        <div>
            <form class="grid grid-cols-2 gap-5" action="">

                {{-- Nama Lengkap --}}
                <div>
                    <label for="nama_lengkap" class="block text-sm/6 font-medium text-gray-800">Nama Lengkap</label>
                    <div class="mt-1">
                        <input id="nama_lengkap" placeholder="John Doe" value="{{ old('nama_lengkap') }}" type="text"
                            name="nama_lengkap" required autocomplete="nama_lengkap"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6 
                                @error('nama_lengkap') 
                                    input-error 
                                @enderror" />
                    </div>
                    @error('name')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Judul --}}
                <div>
                    <label for="judul" class="block text-sm/6 font-medium text-gray-800">Judul</label>
                    <div class="mt-1">
                        <input id="judul" placeholder="Pulang" type="text" name="judul" required
                            autocomplete="judul" value="{{ old('judul') }}"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6
                                @error('judul') 
                                    input-error    
                                @enderror" />
                    </div>
                    @error('judul')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Penulis --}}
                <div>
                    <label for="penulis" class="block text-sm/6 font-medium text-gray-800">Penulis</label>
                    <div class="mt-1">
                        <input id="penulis" type="text" name="penulis" placeholder="Tere Liye"
                            value="{{ old('penulis') }}" required autocomplete="penulis"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6
                                @error('penulis')
                                    input-error
                                @enderror" />
                    </div>
                    @error('penulis')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Penerbit --}}
                <div>
                    <label for="penerbit" class="block text-sm/6 font-medium text-gray-800">Penerbit</label>
                    <div class="mt-1">
                        <input id="penerbit" placeholder="Gramedia" value="{{ old('penerbit') }}" type="text"
                            name="penerbit" required autocomplete="penerbit"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6
                                @error('penerbit')
                                    input-error
                                @enderror" />
                    </div>
                    @error('penerbit')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Penerbit --}}
                <div>
                    <label for="tahun_terbit" class="block text-sm/6 font-medium text-gray-800">Tahun Terbit</label>
                    <div class="mt-1">
                        <input id="tahun_terbit" placeholder="2020" value="{{ old('tahun_terbit') }}" type="number"
                            name="tahun_terbit" required autocomplete="tahun_terbit"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6
                                @error('tahun_terbit')
                                    input-error
                                @enderror" />
                    </div>
                    @error('tahun_terbit')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="kategori_id" class="block text-sm/6 font-medium text-gray-800">Kategori</label>
                    <div class="mt-1">
                        <select
                            class="outline-2 w-full px-3 py-1.5 rounded-md focus:border-b-none -outline-offset-1 outline-black/70 bg-black/5 text-base  text-gray-800"
                            name="kategori_id" id="kategori_id">
                            <option class="outline-2 -outline-offset-1 outline-black/70" value="">Pilih Kategori
                            </option>
                            <option class="outline-2 -outline-offset-1 outline-black/70" value="">haha</option>
                            <option class="outline-2 -outline-offset-1 outline-black/70" value="">hihi</option>
                        </select>
                    </div>
                </div>

                <div class="col-span-2 w-fit">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-500  px-3 py-3 text-sm/6 font-semibold text-white hover:bg-indigo-700 hover:outline-1 hover:outline-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-200 capitalize">edit
                        buku</button>
                </div>

            </form>
        </div>
    </div>
</x-layouts.admin-dashboard>
