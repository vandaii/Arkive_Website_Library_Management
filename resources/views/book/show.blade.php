<x-layouts.user-dashboard>
    <div class="container mx-auto px-6 py-8 max-w-6xl">
        <a class="flex items-center gap-2 text-black/60 text-sm font-medium" href="{{ route('user.index') }}"><i
                class="size-4 rotate-180" data-lucide="arrow-right"></i> Kembali</a>

        {{-- Detail Buku --}}
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8 mt-4">
            <div class="lg:col-span-1">
                <div class="flex flex-col gap-4 rounded-2xl overflow-hidden bg-white">
                    <img class="w-full aspect-3/4 object-cover" src="{{ asset('storage/' . $book->cover_buku) }}"
                        alt="Cover {{ $book->judul }}">
                    <div class="p-4">
                        @foreach ($book->kategoriBukuRelasi as $category)
                            <div class="inline-block px-3 py-1 rounded-full text-sm mb-2 text-white bg-(--third-color)">
                                {{ $category->kategori->nama_kategori }}
                            </div>
                        @endforeach
                        <div class="space-y-2 text-sm font-medium">
                            <div class="flex justify-between">
                                <p class="text-black/60">Jumlah Halaman:</p>
                                <p class="text-black">{{ $book->jumlah_halaman ?? '-' }}</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-black/60">Penerbit:</p>
                                <p class="text-black">{{ $book->penerbit }}</p>
                            </div>
                            <div class="flex justify-between border-b border-black/10 pb-1.5">
                                <p class="text-black/60">Tahun Terbit:</p>
                                <p class="text-black">{{ $book->tahun_terbit }}</p>
                            </div>
                            <div class="flex justify-between border-b border-black/10 pb-1.5">
                                <p class="text-black/60">ISBN:</p>
                                <p class="text-black">{{ $book->isbn_number }}</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-black/60">Tersedia:</p>
                                @if ($book->stok < 1)
                                    <p class="text-red-500 font-semibold">Tidak Tersedia</p>
                                @else
                                    <p class="text-(--third-color) font-semibold">Tersedia</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2">
                <div class="flex flex-col gap-6 rounded-2xl p-6 mb-6 bg-white">
                    <div class="flex justify-between">
                        <h1 class="text-black mb-2 text-2xl font-medium">{{ $book->judul }}</h1>
                        @if ($koleksi->isEmpty())
                            <form class="mt-2" action="{{ route('koleksi.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <input class="hidden" type="text" name="buku_id" value="{{ $book->id }}">
                                <button class="cursor-pointer"><i data-lucide="bookmark"></i></button>
                            </form>
                        @else
                            <form class="mt-2" action="{{ route('koleksi.destroy') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input class="hidden" type="text" name="buku_id" value="{{ $book->id }}">
                                <button class="cursor-pointer"><i data-lucide="bookmark-check"></i></button>
                            </form>
                        @endif
                    </div>
                    <div class="flex items-center gap-2 mb-4">
                        <i class="size-4 opacity-60" data-lucide="user"></i>
                        <p class="text-base text-black/60">{{ $book->penulis }}</p>
                    </div>
                    @php
                        $avg = $book->averageRating();
                        $starRating = ($avg / 5) * 100;
                        $countTotalRating = $countRating->count();

                        $count5Star = $countRating->where('rating', '==', 5)->count();
                        $avg5Star = $countTotalRating > 0 ? ($count5Star * 100) / $countTotalRating : 0;

                        $count4Star = $countRating->where('rating', '==', 4)->count();
                        $avg4Star = $countTotalRating > 0 ? ($count4Star * 100) / $countTotalRating : 0;

                        $count3Star = $countRating->where('rating', '==', 3)->count();
                        $avg3Star = $countTotalRating > 0 ? ($count3Star * 100) / $countTotalRating : 0;

                        $count2Star = $countRating->where('rating', '==', 2)->count();
                        $avg2Star = $countTotalRating > 0 ? ($count2Star * 100) / $countTotalRating : 0;

                        $count1Star = $countRating->where('rating', '==', 1)->count();
                        $avg1Star = $countTotalRating > 0 ? ($count1Star * 100) / $countTotalRating : 0;
                    @endphp
                    <div class="flex items-center gap-4 pb-6 border-b border-black/10">
                        <div class="flex relative justify-center">
                            <i class="stroke-1 stroke-(--third-color) size-4" data-lucide="star"></i>
                            <i class="stroke-1 stroke-(--third-color) size-4" data-lucide="star"></i>
                            <i class="stroke-1 stroke-(--third-color) size-4" data-lucide="star"></i>
                            <i class="stroke-1 stroke-(--third-color) size-4" data-lucide="star"></i>
                            <i class="stroke-1 stroke-(--third-color) size-4" data-lucide="star"></i>
                            <div class="w-20 absolute top-0">
                                <div class="overflow-hidden" style="width: {{ $starRating }}%">
                                    <div class="w-34.25 flex">
                                        <i class="stroke-none size-4 fill-(--third-color)" data-lucide="star"></i>
                                        <i class="stroke-none size-4 fill-(--third-color)" data-lucide="star"></i>
                                        <i class="stroke-none size-4 fill-(--third-color)" data-lucide="star"></i>
                                        <i class="stroke-none size-4 fill-(--third-color)" data-lucide="star"></i>
                                        <i class="stroke-none size-4 fill-(--third-color)" data-lucide="star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h1 class="font-medium">{{ $avg }}</h1>
                        <p class="text-black/60">({{ $countTotalRating }} Reviews)</p>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-black mb-4">Deskripsi</h3>
                        <p class="text-black/80 text-base text-justify">{{ $book->deskripsi }}</p>
                    </div>
                    @if ($book->stok > 0)
                        <button onclick="showFormLoan()" id="loan-button"
                            class="h-10 w-full flex items-center justify-center gap-x-2 bg-(--third-color) hover:bg-(--second-color) text-(--primary-color) font-medium rounded-md transition-colors duration-200 cursor-pointer">
                            <i class="size-5" data-lucide="book-open"></i>Ajukan Peminjaman
                        </button>
                    @endif
                </div>
                @if ($book->stok > 0)
                    <div class="hidden flex-col gap-6 rounded-2xl p-6 mb-6 bg-white" id="form-loan">
                        <h2 class="text-black mb-4 text-xl font-medium">Formulir Pengajuan Peminjaman</h2>
                        <form class="space-y-4" action="{{ route('peminjaman.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="buku_id" value="{{ $book->id }}">

                            {{-- Nama Lengkap --}}
                            <div>
                                <label class="flex items-center text-sm font-medium mb-1.5" for="nama_lengkap">Nama
                                    Lengkap</label>
                                <input
                                    class="flex h-9 w-full min-w-0 bg-black/10 outline-1 outline-black/30 rounded-md px-2 py-1 focus:outline-2 focus:outline-black/30"
                                    type="text" name="nama_lengkap" id="nama_lengkap"
                                    placeholder="Masukkan Nama Lengkap" value="{{ Auth::user()->nama_lengkap }}"
                                    disabled>
                                @error('nama_lengkap')
                                    <div class="">
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="flex items-center text-sm font-medium mb-1.5"
                                    for="email">Email</label>
                                <input
                                    class="flex h-9 w-full min-w-0 outline-1 bg-black/10 outline-black/30 rounded-md px-2 py-1 focus:outline-2 focus:outline-black/30"
                                    type="text" name="email" id="email" value="{{ Auth::user()->email }}"
                                    disabled>
                                @error('email')
                                    <div class="">
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            {{-- Phone Number --}}
                            <div>
                                <label class="flex items-center text-sm font-medium mb-1.5" for="phone_number">No.
                                    Handphone</label>
                                <input
                                    class="flex h-9 w-full min-w-0 bg-black/10 outline-1 outline-black/30 rounded-md px-2 py-1 focus:outline-2 focus:outline-black/30"
                                    type="text" name="phone_number" id="phone_number"
                                    value="{{ Auth::user()->phone_number }}" required>
                                @error('phone_number')
                                    <div class="">
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                {{-- Tanggal Peminjaman --}}
                                <div>
                                    <label class="flex items-center text-sm font-medium mb-1.5"
                                        for="tanggal_peminjaman">Tanggal Peminjaman</label>
                                    <input
                                        class="flex relative h-9 w-full min-w-0 outline-1 date-input outline-black/30 rounded-md px-2 py-1 focus:outline-2 focus:outline-black/30"
                                        type="date" name="tanggal_peminjaman" id="tanggal_peminjaman"
                                        value="{{ old('tanggal_peminjaman') }}" required>
                                    @error('tanggal_peminjaman')
                                        <div class="">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                {{-- Tanggal Pengembalian --}}
                                <div>
                                    <label class="flex items-center text-sm font-medium mb-1.5"
                                        for="estimasi_tanggal_pengembalian">Tanggal Pengembalian</label>
                                    <input
                                        class="flex relative h-9 w-full min-w-0 outline-1 date-input outline-black/30 rounded-md px-2 py-1 focus:outline-2 focus:outline-black/30"
                                        type="date" name="estimasi_tanggal_pengembalian"
                                        id="estimasi_tanggal_pengembalian"
                                        value="{{ old('estimasi_tanggal_pengembalian') }}" required>
                                    @error('estimasi_tanggal_pengembalian')
                                        <div class="">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex gap-3 pt-4">
                                <button onclick="hideFormLoan()"
                                    class="flex items-center justify-center w-full h-9 px-4 py-2 outline-1 outline-(--third-color) text-(--third-color) font-medium rounded-md hover:outline-(--second-color) hover:text-(--second-color) transition-all duration-200 cursor-pointer"
                                    type="button">Batal</button>
                                <button
                                    class="flex items-center justify-center w-full h-9 px-4 py-2 bg-(--third-color) text-(--primary-color) font-medium rounded-md hover:bg-(--second-color) transition-all duration-200 cursor-pointer">Pinjam</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </section>

        {{-- Ulasan Section --}}
        <section class="flex flex-col gap-6 rounded-2xl p-8 bg-white">
            <h2 class="flex items-center text-xl font-medium gap-x-3">
                <div class="p-2 rounded-xl bg-(--third-color)/10">
                    <i class="size-5 text-(--third-color)" data-lucide="message-square"></i>
                </div>
                Ulasan Pembaca
            </h2>

            {{-- Overall rating --}}
            <div class="flex gap-6 p-5 rounded-2xl mb-8">
                <div>
                    <div class="flex flex-col">
                        <h1 class="text-5xl font-medium mb-1">{{ $avg }}</h1>
                        <div class="flex relative justify-center">
                            <i class="stroke-1 stroke-(--third-color) size-4" data-lucide="star"></i>
                            <i class="stroke-1 stroke-(--third-color) size-4" data-lucide="star"></i>
                            <i class="stroke-1 stroke-(--third-color) size-4" data-lucide="star"></i>
                            <i class="stroke-1 stroke-(--third-color) size-4" data-lucide="star"></i>
                            <i class="stroke-1 stroke-(--third-color) size-4" data-lucide="star"></i>
                            <div class="w-20 absolute top-0">
                                <div class="overflow-hidden" style="width: {{ $starRating }}%">
                                    <div class="w-34.25 flex">
                                        <i class="stroke-none size-4 fill-(--third-color)" data-lucide="star"></i>
                                        <i class="stroke-none size-4 fill-(--third-color)" data-lucide="star"></i>
                                        <i class="stroke-none size-4 fill-(--third-color)" data-lucide="star"></i>
                                        <i class="stroke-none size-4 fill-(--third-color)" data-lucide="star"></i>
                                        <i class="stroke-none size-4 fill-(--third-color)" data-lucide="star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-black/60 text-center mt-3">{{ $countTotalRating }} ulasan</div>
                    </div>
                </div>
                <div class="flex flex-col w-full">
                    {{-- 5 Star --}}
                    <div class="flex items-center w-full gap-8">
                        <p class="flex items-center text-sm text-black/50 font-medium">5<i
                                class="stroke-0 fill-black/50 size-3" data-lucide="star"></i></p>
                        <div class="relative bg-black/15 w-full rounded-full h-1.5">
                            <div class="flex absolute top-0 bg-(--third-color) rounded-full h-1.5"
                                style="width: {{ $avg5Star }}%">
                            </div>
                        </div>
                    </div>

                    {{-- 4 Star --}}
                    <div class="flex items-center w-full gap-8">
                        <p class="flex items-center text-sm text-black/50 font-medium">4<i
                                class="stroke-0 fill-black/50 size-3" data-lucide="star"></i></p>
                        <div class="relative bg-black/15 w-full rounded-full h-1.5">
                            <div class="flex absolute top-0 bg-(--third-color) rounded-full h-1.5"
                                style="width: {{ $avg4Star }}%">
                            </div>
                        </div>
                    </div>

                    {{-- 3 Star --}}
                    <div class="flex items-center w-full gap-8">
                        <p class="flex items-center text-sm text-black/50 font-medium">3<i
                                class="stroke-0 fill-black/50 size-3" data-lucide="star"></i></p>
                        <div class="relative bg-black/15 w-full rounded-full h-1.5">
                            <div class="flex absolute top-0 bg-(--third-color) rounded-full h-1.5"
                                style="width: {{ $avg3Star }}%">
                            </div>
                        </div>
                    </div>


                    {{-- 2 Star --}}
                    <div class="flex items-center w-full gap-8">
                        <p class="flex items-center text-sm text-black/50 font-medium">2<i
                                class="stroke-0 fill-black/50 size-3" data-lucide="star"></i></p>
                        <div class="relative bg-black/15 w-full rounded-full h-1.5">
                            <div class="flex absolute top-0 bg-(--third-color) rounded-full h-1.5"
                                style="width: {{ $avg2Star }}%">
                            </div>
                        </div>
                    </div>


                    {{-- 1 Star --}}
                    <div class="flex items-center w-full gap-8">
                        <p class="flex items-center text-sm text-black/50 font-medium">1<i
                                class="stroke-0 fill-black/50 size-3" data-lucide="star"></i></p>
                        <div class="relative bg-black/15 w-full rounded-full h-1.5">
                            <div class="flex absolute top-0 bg-(--third-color) rounded-full h-1.5"
                                style="width: {{ $avg1Star }}%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Daftar Ulasan --}}
            <div class="space-y-4">
                @forelse ($ulasans as $review)
                    <div id="review_{{ $review->id }}"
                        class="p-5 rounded-xl border border-black/15 bg-white hover:shadow-sm transition-shadow duration-200">

                        {{-- Header: Avatar, Nama, Waktu, Menu --}}
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-(--third-color)/10 flex items-center justify-center shrink-0">
                                    @if (!empty($review->user->photo_profile))
                                        <img class="w-10 h-10 rounded-full object-cover"
                                            src="{{ asset('storage/' . $review->user->photo_profile) }}"
                                            alt="">
                                    @else
                                        <!-- <span class="text-sm font-bold text-(--third-color)">{{ strtoupper(substr($review->user->username ?? 'A', 0, 1)) }}</span> -->
                                        <img class="w-10 h-10 rounded-full object-cover"
                                            src="{{ asset('img/user.png') }}" alt="">
                                    @endif
                                </div>
                                <div>
                                    <div class="font-semibold text-sm">
                                        {{ $review->user->nama_lengkap ?? ($review->user->username ?? 'Anonim') }}
                                    </div>
                                    <div class="text-xs text-black/40">{{ $review->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>

                            {{-- Dropdown menu (edit/hapus) hanya untuk pemilik ulasan --}}
                            <div class="relative">
                                @if (Auth::check() && Auth::id() === $review->user_id)
                                    <button
                                        class="review-actions-btn p-1.5 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer"
                                        data-review-id="{{ $review->id }}">
                                        <i class="size-4 text-black/30" data-lucide="more-horizontal"></i>
                                    </button>
                                    <div class="actions-dropdown absolute right-0 mt-1 w-36 bg-white border border-black/10 rounded-xl shadow-lg hidden z-10 overflow-hidden"
                                        data-review-id="{{ $review->id }}">
                                        <button
                                            class="w-full text-left px-4 py-2.5 text-sm hover:bg-gray-50 edit-review-btn transition-colors cursor-pointer"
                                            data-review-id="{{ $review->id }}">Edit</button>
                                        <form action="{{ route('ulasan.destroy', $review->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus ulasan?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full text-left px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors cursor-pointer">Hapus</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Bintang rating ulasan --}}
                        <div class="mt-3 flex items-center gap-1" id="rating_display_{{ $review->id }}">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <i class="size-4 stroke-0 fill-(--third-color)" data-lucide="star"></i>
                                @else
                                    <i class="size-4 stroke-0 fill-black/15" data-lucide="star"></i>
                                @endif
                            @endfor
                        </div>

                        {{-- Teks ulasan --}}
                        <div class="mt-3 text-sm text-black/70 leading-relaxed" id="review_text_{{ $review->id }}">
                            {{ $review->ulasan }}</div>

                        {{-- Form edit ulasan (tersembunyi, muncul saat klik Edit) --}}
                        @if (Auth::check() && Auth::id() === $review->user_id)
                            <div class="mt-3 hidden" id="edit_form_{{ $review->id }}">
                                <form action="{{ route('ulasan.update', $review->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="rating" id="edit_rating_input_{{ $review->id }}"
                                        value="{{ $review->rating }}">

                                    {{-- Bintang interaktif untuk edit --}}
                                    <div class="flex items-center gap-2 mb-3">
                                        <label class="text-sm font-medium">Rating</label>
                                        <div class="edit-star-container flex gap-0.5"
                                            data-review-id="{{ $review->id }}">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i data-lucide="star" data-value="{{ $i }}"
                                                    class="edit-star cursor-pointer w-5 h-5 stroke-0 hover:scale-110 transition-transform {{ $i <= $review->rating ? 'fill-(--third-color)' : 'fill-gray-300' }}"></i>
                                            @endfor
                                        </div>
                                    </div>

                                    <textarea name="ulasan" rows="3"
                                        class="w-full bg-gray-50 border border-black/10 rounded-xl p-3 text-sm focus:outline-none focus:border-(--third-color) resize-none"
                                        required>{{ $review->ulasan }}</textarea>
                                    <div class="mt-3 flex gap-2">
                                        <button type="submit"
                                            class="px-4 py-1.5 bg-(--third-color) text-white rounded-full text-sm font-medium hover:bg-(--second-color) transition-colors cursor-pointer">Simpan</button>
                                        <button type="button"
                                            class="px-4 py-1.5 bg-gray-100 rounded-full text-sm font-medium cancel-edit-btn hover:bg-gray-200 transition-colors cursor-pointer"
                                            data-review-id="{{ $review->id }}">Batal</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-12">
                        <i class="size-12 text-black/10 mb-3" data-lucide="message-square"></i>
                        <p class="text-black/30 font-medium">Belum ada ulasan</p>
                        <p class="text-xs text-black/20 mt-1">Jadilah yang pertama mengulas buku ini</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</x-layouts.user-dashboard>

<script>
    document.addEventListener('click', function(event) {

        // --- Toggle dropdown menu ---
        const actionsBtn = event.target.closest('.review-actions-btn');
        if (actionsBtn) {
            event.stopPropagation();
            const reviewId = actionsBtn.dataset.reviewId;
            const dropdown = document.querySelector('.actions-dropdown[data-review-id="' + reviewId + '"]');
            if (!dropdown) return;

            // Tutup semua dropdown lain
            document.querySelectorAll('.actions-dropdown').forEach(function(d) {
                if (d !== dropdown) d.classList.add('hidden');
            });
            dropdown.classList.toggle('hidden');
            return;
        }

        // --- Klik tombol Edit ---
        const editBtn = event.target.closest('.edit-review-btn');
        if (editBtn) {
            const reviewId = editBtn.dataset.reviewId;
            const editForm = document.getElementById('edit_form_' + reviewId);
            const reviewText = document.getElementById('review_text_' + reviewId);
            const ratingDisplay = document.getElementById('rating_display_' + reviewId);
            if (!editForm || !reviewText) return;

            reviewText.classList.add('hidden');
            if (ratingDisplay) ratingDisplay.classList.add('hidden');
            editForm.classList.remove('hidden');

            // Tutup dropdown
            const dropdown = document.querySelector('.actions-dropdown[data-review-id="' + reviewId + '"]');
            if (dropdown) dropdown.classList.add('hidden');
            return;
        }

        // --- Klik tombol Batal edit ---
        const cancelBtn = event.target.closest('.cancel-edit-btn');
        if (cancelBtn) {
            const reviewId = cancelBtn.dataset.reviewId;
            const editForm = document.getElementById('edit_form_' + reviewId);
            const reviewText = document.getElementById('review_text_' + reviewId);
            const ratingDisplay = document.getElementById('rating_display_' + reviewId);

            if (editForm) editForm.classList.add('hidden');
            if (reviewText) reviewText.classList.remove('hidden');
            if (ratingDisplay) ratingDisplay.classList.remove('hidden');
            return;
        }

        // --- Klik bintang edit rating ---
        const editStar = event.target.closest('.edit-star');
        if (editStar) {
            const container = editStar.closest('.edit-star-container');
            if (!container) return;

            const reviewId = container.dataset.reviewId;
            const ratingInput = document.getElementById('edit_rating_input_' + reviewId);
            const selectedValue = Number(editStar.getAttribute('data-value'));

            if (ratingInput) ratingInput.value = selectedValue;

            // Update tampilan semua bintang dalam container
            container.querySelectorAll('.edit-star').forEach(function(star) {
                const starValue = Number(star.getAttribute('data-value'));
                if (starValue <= selectedValue) {
                    star.classList.remove('fill-gray-300');
                    star.classList.add('fill-(--third-color)');
                } else {
                    star.classList.remove('fill-(--third-color)');
                    star.classList.add('fill-gray-300');
                }
            });
            return;
        }

        // --- Tutup semua dropdown jika klik di luar ---
        document.querySelectorAll('.actions-dropdown').forEach(function(d) {
            d.classList.add('hidden');
        });
    });

    // --- Form Peminjaman toggle ---
    function showFormLoan() {
        document.getElementById('form-loan').classList.replace('hidden', 'flex');
        document.getElementById('loan-button').classList.replace('flex', 'hidden');
    }

    function hideFormLoan() {
        document.getElementById('form-loan').classList.replace('flex', 'hidden');
        document.getElementById('loan-button').classList.replace('hidden', 'flex');
    }
</script>
