<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="ml-45 bg-white px-10 py-8 rounded-lg">
        <div class="mb-10">
            <h1 class="capitalize text-xl">{{ $title }}</h1>
        </div>

        <div>
            <form class="grid grid-cols-2 gap-5" action="{{ route('data-buku.update', $book->id) }}"
                enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')

                {{-- Cover --}}
                <div class="col-span-2 flex gap-x-15">
                    <div>
                        <img class="w-40 h-auto border-dashed rounded-md" id="img-preview"
                            src="{{ asset('storage/' . $book->cover_buku) }}">
                    </div>
                    <div class="w-full">
                        <label for="cover_buku" class="block text-sm/6 font-medium text-gray-800">Cover Buku</label>
                        <div class="mt-1">
                            <input id="cover_buku" accept="image/*" type="file" name="cover_buku"
                                autocomplete="cover_buku"
                                class="w-full cursor-pointer hover:file:text-black/80 rounded-md bg-black/5 text-base file:bg-gray-200 file:cursor-pointer file:text-black/60 file:py-1.5 file:px-3 file:border-r-2 file:border-r-gray-300 text-gray-800 outline-1 -outline-offset-1 outline-black/20
                                    @error('cover_buku') 
                                        input-error 
                                    @enderror"
                                onchange="previewImage(event)" />
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep the current cover</p>
                        @error('cover_buku')
                            <div class="">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Judul --}}
                <div>
                    <label for="judul" class="block text-sm/6 font-medium text-gray-800">Judul</label>
                    <div class="mt-1">
                        <input id="judul" placeholder="Pulang" type="text" name="judul" required
                            autocomplete="judul" value="{{ old('judul', $book->judul) }}"
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
                            value="{{ old('penulis', $book->penulis) }}" required autocomplete="penulis"
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
                        <input id="penerbit" placeholder="Gramedia" value="{{ old('penerbit', $book->penerbit) }}"
                            type="text" name="penerbit" required autocomplete="penerbit"
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

                {{-- Tahun Terbit --}}
                <div>
                    <label for="tahun_terbit" class="block text-sm/6 font-medium text-gray-800">Tahun Terbit</label>
                    <div class="mt-1">
                        <input id="tahun_terbit" placeholder="2020"
                            value="{{ old('tahun_terbit', $book->tahun_terbit) }}" type="number" name="tahun_terbit"
                            required autocomplete="tahun_terbit"
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

                {{-- Stok --}}
                <div>
                    <label for="stok" class="block text-sm/6 font-medium text-gray-800">Stok</label>
                    <div class="mt-1">
                        <input id="stok" placeholder="100" value="{{ old('stok', $book->stok) }}" type="text"
                            name="stok" required autocomplete="stok"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6 
                                @error('stok') 
                                    input-error 
                                @enderror" />
                    </div>
                    @error('stok')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="kategori" class="block text-sm/6 font-medium text-gray-800">Kategori</label>
                    <div class="mt-1">
                        <select
                            class="outline-2 w-full px-3 py-1.5 rounded-md focus:border-b-none -outline-offset-1 outline-black/70 bg-black/5 text-base  text-gray-800"
                            name="kategori" id="kategori">
                            @foreach ($categories as $category)
                                <option class="outline-2 -outline-offset-1 outline-black/70"
                                    value="{{ $category->id }}"
                                    @if($book->kategoriBukuRelasi->first()?->kategori_id == $category->id) selected @endif>
                                    {{ $category->nama_kategori }}</option>
                            @endforeach
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

    <Script>
        function previewImage(event) {
            const preview = document.getElementById('img-preview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        }
    </Script>
</x-layouts.admin-dashboard>
