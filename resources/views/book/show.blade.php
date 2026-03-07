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
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf
                    <div class="flex gap-x-2">
                        <input
                            class="w-25 outline-1 outline-black/30 focus:outline-1 focus:outline-black/70 p-1 rounded-sm"
                            min="0" max="10" type="number" name="stok" id="stok" placeholder="0">
                        <p>Stok:
                            {{ $book->stok < 1 ? 'Stok Buku Habis' : $book->stok }}
                        </p>
                    </div>
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
            <h2 class="text-xl font-semibold">Ulasan</h2>

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

            {{-- Review form (placed below overall rating) --}}
            <div class="mt-4 p-4 bg-white border border-gray-200 rounded-sm max-w-2xl">

                <form action="{{ route('ulasan.store') }}" method="POST" id="create_review_form">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $book->id }}">
                    <input type="hidden" name="rating" id="rating_input" value="5">
                    <div class="flex items-center gap-x-3">
                        <label class="font-medium">Beri Rating</label>
                        <div id="star_container" class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg data-value="{{ $i }}"
                                    class="create-star cursor-pointer w-6 h-6 text-yellow-400" viewBox="0 0 20 20"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966a1 1 0 00.95.69h4.167c.969 0 1.371 1.24.588 1.81l-3.37 2.449a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.538 1.118L10 14.347l-3.37 2.449c-.783.57-1.838-.196-1.538-1.118l1.286-3.966a1 1 0 00-.364-1.118L2.644 9.393c-.783-.57-.38-1.81.588-1.81h4.167a1 1 0 00.95-.69L9.049 2.927z" />
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <div class="mt-3">
                        <textarea name="ulasan" id="ulasan" rows="3" class="w-full mt-2 p-2 border rounded"
                            placeholder="Tulis ulasan Anda..." required></textarea>
                    </div>
                    <div class="mt-3 flex gap-x-2">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Kirim Ulasan</button>
                    </div>
                </form>
            </div>

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
                                <form action="{{ route('ulasan.update', $u->id) }}" method="POST"
                                    class="edit-form">
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
</x-layouts.user-dashboard>

<script>
    (function() {
        // Create form stars
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
