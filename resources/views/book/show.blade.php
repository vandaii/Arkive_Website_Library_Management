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
                            <h3 class="text-md"><span class="text-gray-600">Kategori:
                                </span>{{ $book->kategoriBukuRelasi->implode('kategori.nama_kategori', ', ') }}</h3>
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
                @error('stok')
                    <div class="">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf
                    {{-- <div class="flex gap-x-2">
                        <input
                            class="w-25 outline-1 outline-black/30 focus:outline-1 focus:outline-black/70 p-1 rounded-sm"
                            min="0" max="10" type="number" name="stok" id="stok" placeholder="0">
                        <p>Stok:
                            {{ $book->stok < 1 ? 'Stok Buku Habis' : $book->stok }}
                        </p>
                    </div> --}}
                    <div class="flex items-center py-2 mt-3">
                        <label for="">Tanggal Pengembalian</label>
                        <input class="ml-2 py-1 px-4 border-l border-indigo-500 outline-none" type="date"
                            name="tanggal_pengembalian" id="tanggal_pengembalian">
                    </div>

                    <input hidden class="ml-2 py-1 px-4 border-l border-indigo-500 outline-none" type="text"
                        name="buku_id" id="buku_id" value="{{ $book->id }}">

                    <button class="mt-5 px-4 py-3 w-full bg-indigo-500 text-white rounded-lg hover:bg-indigo-600"
                        type="submit">Pinjam
                        Buku</button>
                </form>
            </div>
        </div>

        {{-- Ulasan --}}
        <div class="mt-8">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold">Ulasan</h2>

                {{-- @if ($canReview)
                    <button onclick="document.getElementById('reviewModal').classList.remove('hidden')"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        Tulis Ulasan
                    </button>
                @endif --}}
            </div>

            {{-- Overall rating --}}
            <div class="flex items-center gap-x-3 mt-3">
                @php $avg = $book->averageRating(); @endphp
                <div class="flex items-center">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= round($avg))
                            <svg class="w-6 h-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.449a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.538 1.118L10 14.347l-3.37 2.449c-.783.57-1.838-.196-1.538-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.644 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69L9.049 2.927z" />
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-gray-300" viewBox="0 0 20 20" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.449a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.538 1.118L10 14.347l-3.37 2.449c-.783.57-1.838-.196-1.538-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.644 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69L9.049 2.927z" />
                            </svg>
                        @endif
                    @endfor
                </div>
                <div class="text-sm text-gray-600">{{ $avg }} dari 5</div>
            </div>

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="mt-3 text-green-600">{{ session('success') }}</div>
            @endif

            {{-- Review list (compact cards) --}}
            <div class="mt-4 space-y-3 max-w-2xl">
                @foreach ($book->ulasan()->with('user')->latest()->get() as $u)
                    <div id="review_{{ $u->id }}" class="p-3 border border-gray-200 rounded-sm bg-white">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="font-semibold">{{ $u->user->username ?? 'Anon' }}</div>
                                <div class="text-xs text-gray-500">{{ $u->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="relative">
                                @if (Auth::check() && Auth::id() === $u->user_id)
                                    <button class="review-actions-btn p-1 rounded hover:bg-gray-100"
                                        data-id="{{ $u->id }}" aria-expanded="false" aria-label="More">
                                        <svg class="w-5 h-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm4 0a2 2 0 114 0 2 2 0 01-4 0zM2 10a2 2 0 114 0 2 2 0 01-4 0z" />
                                        </svg>
                                    </button>
                                    <div class="actions-dropdown absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded shadow-sm hidden"
                                        data-id="{{ $u->id }}">
                                        <button
                                            class="w-full text-left px-3 py-2 text-sm hover:bg-gray-50 edit-review-btn"
                                            data-id="{{ $u->id }}">Edit</button>
                                        <form action="{{ route('ulasan.destroy', $u->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus ulasan?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-gray-50">Hapus</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mt-2 flex items-center gap-x-2" id="jj_{{ $u->id }}">
                            <div class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $u->rating)
                                        <svg class="w-4 h-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.449a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.538 1.118L10 14.347l-3.37 2.449c-.783.57-1.838-.196-1.538-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.644 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69L9.049 2.927z" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.449a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.538 1.118L10 14.347l-3.37 2.449c-.783.57-1.838-.196-1.538-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.644 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69L9.049 2.927z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                        </div>

                        <div class="mt-2 text-gray-700" id="review_text_{{ $u->id }}">{{ $u->ulasan }}
                        </div>

                        {{-- Inline edit form (hidden) --}}
                        @if (Auth::check() && Auth::id() === $u->user_id)
                            <div class="mt-2 hidden" id="edit_form_{{ $u->id }}">
                                <form action="{{ route('ulasan.update', $u->id) }}" method="POST" class="edit-form">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="rating" id="edit_rating_input_{{ $u->id }}"
                                        value="{{ $u->rating }}">
                                    <div class="flex items-center gap-x-3">
                                        <label class="font-medium">Rating</label>
                                        <div class="edit-star-container flex" data-id="{{ $u->id }}">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg data-value="{{ $i }}"
                                                    class="edit-star cursor-pointer w-5 h-5 {{ $i <= $u->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.449a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.538 1.118L10 14.347l-3.37 2.449c-.783.57-1.838-.196-1.538-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.644 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69L9.049 2.927z" />
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <textarea name="ulasan" rows="3" class="w-full p-2 border rounded" required>{{ $u->ulasan }}</textarea>
                                    </div>
                                    <div class="mt-2 flex gap-x-2">
                                        <button type="submit"
                                            class="px-3 py-1 bg-green-600 text-white rounded text-sm">Simpan</button>
                                        <button type="button"
                                            class="px-3 py-1 bg-gray-200 rounded text-sm cancel-edit-btn"
                                            data-id="{{ $u->id }}">Batal</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Modal Ulasan --}}
    @if ($canReview)
        <div id="reviewModal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
            {{-- Overlay --}}
            <div class="absolute inset-0 bg-black/50"
                onclick="document.getElementById('reviewModal').classList.add('hidden')"></div>

            {{-- Modal Content --}}
            <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-lg mx-4 p-6 z-10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Tulis Ulasan</h3>
                    <button onclick="document.getElementById('reviewModal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('ulasan.store') }}" method="POST" id="create_review_form">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $book->id }}">
                    <input type="hidden" name="rating" id="rating_input" value="0">

                    <div class="flex items-center gap-x-3 mb-4">
                        <label class="font-medium text-gray-700">Rating</label>
                        <div id="star_container" class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg data-value="{{ $i }}"
                                    class="create-star cursor-pointer w-7 h-7 text-yellow-400 transition-colors"
                                    viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.449a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.538 1.118L10 14.347l-3.37 2.449c-.783.57-1.838-.196-1.538-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.644 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69L9.049 2.927z" />
                                </svg>
                            @endfor
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Ulasan Anda</label>
                        <textarea name="ulasan" id="ulasan" rows="4"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                            placeholder="Bagikan pengalaman Anda membaca buku ini..." required></textarea>
                    </div>

                    <div class="flex justify-end gap-x-3">
                        <button type="button"
                            onclick="document.getElementById('reviewModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 cursor-pointer">Batal</button>
                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer">Kirim
                            Ulasan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</x-layouts.user-dashboard>

<script>
    (function() {
        // Create form stars (modal)
        const createStars = document.querySelectorAll('.create-star');
        const createRatingInput = document.getElementById('rating_input');
        if (createStars.length && createRatingInput) {
            function setCreateRating(v) {
                createRatingInput.value = v;
                createStars.forEach(s => {
                    const val = Number(s.getAttribute('data-value'));
                    if (val <= v) {
                        s.classList.remove('text-gray-300');
                        s.classList.add('text-yellow-400');
                    } else {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-300');
                    }
                });
            }
            createStars.forEach(s => s.addEventListener('click', function() {
                setCreateRating(Number(this.dataset.value));
            }));
        }

        // Dropdown toggle for each review
        document.querySelectorAll('.review-actions-btn').forEach(btn => {
            const id = btn.dataset.id;
            const dropdown = document.querySelector('.actions-dropdown[data-id="' + id + '"]');
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (!dropdown) return;
                dropdown.classList.toggle('hidden');
            });
        });
        // Close dropdowns on outside click
        document.addEventListener('click', function() {
            document.querySelectorAll('.actions-dropdown').forEach(d => d.classList.add('hidden'));
        });

        // Edit flow
        document.querySelectorAll('.edit-review-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const id = this.dataset.id;
                const editFormWrap = document.getElementById('edit_form_' + id);
                const reviewText = document.getElementById('review_text_' + id);
                const starTop = document.getElementById('jj_' + id);
                if (!editFormWrap || !reviewText) return;
                // hide existing review text and show form
                reviewText.classList.add('hidden');
                starTop.classList.add('hidden');
                editFormWrap.classList.remove('hidden');
                // close dropdown
                const dropdown = document.querySelector('.actions-dropdown[data-id="' + id + '"]');
                if (dropdown) dropdown.classList.add('hidden');
            });
        });

        // Cancel edit
        document.querySelectorAll('.cancel-edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const editFormWrap = document.getElementById('edit_form_' + id);
                const reviewText = document.getElementById('review_text_' + id);
                if (editFormWrap) editFormWrap.classList.add('hidden');
                if (reviewText) reviewText.classList.remove('hidden');
            });
        });

        // Edit stars handling
        document.querySelectorAll('.edit-star-container').forEach(container => {
            const id = container.dataset.id;
            const stars = container.querySelectorAll('.edit-star');
            const input = document.getElementById('edit_rating_input_' + id);
            if (!input) return;

            function setEditRating(v) {
                input.value = v;
                stars.forEach(s => {
                    const val = Number(s.getAttribute('data-value'));
                    if (val <= v) {
                        s.classList.remove('text-gray-300');
                        s.classList.add('text-yellow-400');
                    } else {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-300');
                    }
                });
            }
            stars.forEach(s => s.addEventListener('click', function() {
                setEditRating(Number(this.dataset.value));
            }));
        });
    })();
</script>
