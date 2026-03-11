<x-layouts.user-dashboard>
    <div class="flex flex-col gap-y-10">
        <div class="flex flex-col gap-y-8">
            <div class="flex justify-between">
                <h1 class="text-2xl font-bold">Riwayat Peminjaman</h1>
            </div>
            <div class="flex gap-5 flex-col w-full justify-center">
                @forelse ($historys as $history)
                    <div class="flex gap-x-3 rounded-lg p-2 shadow-md bg-white w-full relative">
                        <a href="{{ route('peminjaman.show', $history->id) }}" class="flex gap-x-3 flex-1">
                            <img class="border max-h-30 object-cover rounded-lg border-none"
                                src="{{ asset('storage/' . $history->buku->cover_buku) }}" alt="cover">
                            <div class="relative">
                                <h1 class="font-medium text-lg mt-2 line-clamp-1 overflow-hidden text-ellipsis">
                                    {{ $history->buku->judul }}
                                </h1>
                                <h2 class="text-base">{{ $history->buku->penulis }}</h2>
                                <h2 class="text-base">Jumlah Buku: {{ $history->stok }}</h2>
                                <h2 class="text-base">Estimasi Tanggal Pengembalian:
                                    {{ $history->tanggal_pengembalian }}</h2>
                            </div>
                        </a>

                        {{-- Tombol Bukti --}}
                        <div class="flex gap-x-2 items-end justify-center pr-3">
                            @if (in_array($history->status_peminjaman, ['Dipinjam']))
                                <a href="{{ route('peminjaman.bukti-peminjaman', $history->id) }}" target="_blank"
                                    class="px-3 py-1.5 bg-blue-600 text-white text-base rounded-lg hover:bg-blue-700 whitespace-nowrap">
                                    📄 Bukti Peminjaman
                                </a>
                            @endif
                            @if (in_array($history->status_peminjaman, ['Pending Dikembalikan', 'Dikembalikan', 'Terlambat']))
                                <a href="{{ route('peminjaman.bukti-pengembalian', $history->id) }}" target="_blank"
                                    class="px-3 py-1.5 bg-green-600 text-white text-base rounded-lg hover:bg-green-700 whitespace-nowrap">
                                    📄 Bukti Pengembalian
                                </a>
                                @if ($history->status_peminjaman == 'Dikembalikan' || $history->status_peminjaman == 'Terlambat')
                                    <button onclick="document.getElementById('reviewModal').classList.remove('hidden')"
                                        class="px-3 py-1.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer flex items-center gap-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                        Tulis Ulasan
                                    </button>
                                @endif
                            @endif
                        </div>

                        {{-- Modal --}}
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <form action="{{ route('ulasan.store') }}" method="POST" id="create_review_form">
                                    @csrf
                                    <input type="hidden" name="buku_id" value="{{ $history->buku->id }}">
                                    <input type="hidden" name="rating" id="rating_input" value="0">

                                    <div class="flex items-center gap-x-3 mb-4">
                                        <label class="font-medium text-gray-700">Rating</label>
                                        <div id="star_container" class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg data-value="{{ $i }}"
                                                    class="create-star cursor-pointer w-7 h-7 text-yellow-400 transition-colors"
                                                    viewBox="0 0 20 20" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
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

                        <h2 class="text-sm py-1 px-1.5 rounded-sm absolute right-3 top-3 text-white font-semibold"
                            style="background-color: 
                            @switch($history->status_peminjaman)
                                @case('Pending')
                                    #f1c21b
                                @break
                                @case('Dipinjam')
                                    #0043ce
                                @break
                                @case('Pending Dikembalikan')
                                    #ff832b
                                @break
                                @case('Dikembalikan')
                                    #24a148
                                @break
                                @default
                                    #666666
                            @endswitch
                            ">
                            {{ $history->status_peminjaman }}
                        </h2>
                    </div>
                @empty
                    <p>Tidak Ada Yang Dipinjam</p>
                @endforelse
            </div>
        </div>
    </div>
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
</x-layouts.user-dashboard>
