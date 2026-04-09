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
                        <label for="cover_buku" class="block text-sm/6 sm:text-base/6 font-medium text-gray-800">Cover
                            Buku</label>
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
                    <label for="judul" class="block text-sm/6 sm:text-base/6 font-medium text-gray-800">Judul</label>
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
                    <label for="penulis"
                        class="block text-sm/6 sm:text-base/6 font-medium text-gray-800">Penulis</label>
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
                    <label for="penerbit"
                        class="block text-sm/6 sm:text-base/6 font-medium text-gray-800">Penerbit</label>
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
                    <label for="tahun_terbit" class="block text-sm/6 sm:text-base/6 font-medium text-gray-800">Tahun
                        Terbit</label>
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

                {{-- No. ISBN --}}
                <div>
                    <label for="isbn_number" class="block text-sm/6 sm:text-base/6 font-medium text-gray-800">No.
                        ISBN</label>
                    <div class="mt-1">
                        <input id="isbn_number" placeholder="9871xxxxxx" value="{{ old('isbn_number', $book->isbn_number) }}"
                            type="text" name="isbn_number" required autocomplete="isbn_number"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6
                                @error('isbn_number')
                                    input-error
                                @enderror" />
                    </div>
                    @error('isbn_number')
                    <div class="">
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                {{-- Jumlah Halaman --}}
                <div>
                    <label for="jumlah_halaman" class="block text-sm/6 sm:text-base/6 font-medium text-gray-800">Jumlah
                        Halaman</label>
                    <div class="mt-1">
                        <input id="jumlah_halaman" placeholder="100" value="{{ old('jumlah_halaman', $book->jumlah_halaman) }}" type="number"
                            name="jumlah_halaman" required autocomplete="jumlah_halaman"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6 
                                @error('jumlah_halaman') 
                                    input-error 
                                @enderror" />
                    </div>
                    @error('jumlah_halaman')
                    <div class="">
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                {{-- Stok --}}
                <div>
                    <label for="stok" class="block text-sm/6 sm:text-base/6 font-medium text-gray-800">Stok</label>
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
                <div class="col-span-2">
                    <label for="kategori"
                        class="block text-sm/6 sm:text-base/6 font-medium text-gray-800">Kategori</label>

                    <div id="parent-input">
                        @foreach ($relations as $relation)
                        <div class="child-input mt-2 flex gap-x-10">
                            <select
                                class="outline-2 w-full px-3 py-1.5 rounded-md focus:border-b-none -outline-offset-1 outline-black/30 bg-black/5 text-base text-gray-800"
                                name="kategori[]">
                                @foreach ($categories as $category)
                                <option class="outline-2 -outline-offset-1 outline-black/70"
                                    value="{{ $category->id }}"
                                    @if ($relation->kategori_id == $category->id) selected @endif>
                                    {{ $category->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                            <button type="button" class="delete-button cursor-pointer hidden"
                                onclick="deleteButtonCategory(this)">
                                <i class="size-5 text-red-600" data-lucide="trash-2"></i>
                            </button>
                        </div>
                        @endforeach

                        <div class="child-input mt-2 flex gap-x-10">
                            <select
                                class="outline-2 w-full px-3 py-1.5 rounded-md focus:border-b-none -outline-offset-1 outline-black/30 bg-black/5 text-base text-gray-800"
                                name="kategori[]">
                                @foreach ($categories as $category)
                                <option class="outline-2 -outline-offset-1 outline-black/70"
                                    value="{{ $category->id }}">
                                    {{ $category->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                            <button type="button" class="delete-button cursor-pointer hidden"
                                onclick="deleteButtonCategory(this)">
                                <i class="size-5 text-red-600" data-lucide="trash-2"></i>
                            </button>
                        </div>
                    </div>

                    <button type="button" class="flex items-center text-sm/10 cursor-pointer"
                        onclick="addButtonCategory()">
                        <i class="size-4" data-lucide="plus"></i>Tambah Kategori
                    </button>
                </div>

                {{-- Deskripsi --}}
                <div class="col-span-2">
                    <label for="deskripsi"
                        class="block text-sm/6 sm:text-base/6 font-medium text-gray-800">Deskripsi</label>
                    <div class="mt-1">
                        <textarea
                            class="w-full bg-gray-100 mt-1 rounded-lg px-4 py-2 outline outline-black/30 focus:outline-black/30 focus:outline-2"
                            name="deskripsi" id="deskripsi" rows="3" placeholder="Deskripsi Buku...">{{ $book->deskripsi }}</textarea>
                    </div>
                    @error('deskripsi')
                    <div class="">
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <div class="col-span-2 w-fit">
                    <div class="flex gap-x-5">
                        <button type="submit"
                            class="flex gap-1.5 w-full items-center rounded-md bg-(--third-color) px-3 py-3 text-sm/6 sm:text-base/6 font-semibold text-white hover:bg-(--second-color) capitalize cursor-pointer"><i
                                class="size-4" data-lucide="pencil"></i>edit
                            buku</button>
                        <a href="{{ route('data-buku.index') }}"
                            class="flex rounded-md bg-yellow-400 px-3 py-3 text-sm/6 font-semibold text-white hover:bg-yellow-500 capitalize">Kembali</a>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <Script>
        const parent = document.getElementById('parent-input');
        const deleteButton = document.getElementById('delete-button');

        function previewImage(event) {
            const preview = document.getElementById('img-preview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
                preview.classList.remove('bg-gray-200');
                preview.classList.remove('border-2');
                preview.classList.remove('h-50');
                preview.classList.add('h-auto');
            }

            reader.readAsDataURL(file);
        }

        const categoryContainer = document.getElementById('parent-input');

        function refreshDeleteButtons() {
            const children = Array.from(categoryContainer.children);
            children.forEach(child => {
                const deleteBtn = child.querySelector('.delete-button');
                if (children.length === 1) {
                    deleteBtn.classList.add('hidden');
                } else {
                    deleteBtn.classList.remove('hidden');
                }
            });
        }

        function addButtonCategory() {
            const node = categoryContainer.lastElementChild;

            const originalSelects = node.querySelectorAll('select');
            const selectedValues = Array.from(originalSelects).map(s => s.value);

            const clone = node.cloneNode(true);

            originalSelects.forEach((select, i) => select.value = selectedValues[i]);

            clone.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

            categoryContainer.appendChild(clone);

            refreshDeleteButtons();

            if (typeof lucide !== 'undefined') lucide.createIcons();
        }

        function deleteButtonCategory(blyat) {
            if (categoryContainer.children.length > 1) {
                blyat.closest('.child-input').remove();
            }

            refreshDeleteButtons();
        }

        document.addEventListener('DOMContentLoaded', refreshDeleteButtons);
    </Script>
</x-layouts.admin-dashboard>