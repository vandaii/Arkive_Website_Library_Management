<x-layouts.user-dashboard>
    <div class="container mx-auto px-6 py-8 max-w-6xl">
        <a class="flex items-center gap-2 text-black/60 text-sm font-medium" href="{{ route('user.index') }}"><i
                class="size-4 rotate-180" data-lucide="arrow-right"></i> Kembali</a>
        {{-- Detail Buku --}}
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8 mt-4">
            <div class="lg:col-span-1">
                <div class="flex flex-col gap-4 rounded-2xl overflow-hidden bg-white">
                    <img class="w-full aspect-3/4 object-cover" src="{{ asset('storage/' . $book->cover_buku) }}"
                        alt="">
                    <div class="p-4">
                        @foreach ($book->kategoriBukuRelasi as $category)
                            <div class="inline-block px-3 py-1 rounded-full text-sm mb-2 text-white bg-(--third-color)">
                                {{ $category->kategori->nama_kategori }}
                            </div>
                        @endforeach
                        <div class="space-y-2 text-sm font-medium">
                            <div class="flex justify-between">
                                <p class="text-black/60">Jumlah Halaman:</p>
                                <p class="text-black">12</p>
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
                                    <p class="text-black">Tidak Tersedia</p>
                                @else
                                    <p class="text-(--third-color)">Tersedia</p>
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
                                <input class="hidden" type="text" name="buku_id" id="buku_id"
                                    value="{{ $book->id }}">
                                <button class="cursor-pointer"><i data-lucide="bookmark"></i></button>
                            </form>
                        @else
                            <form class="mt-2" action="{{ route('koleksi.destroy') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input class="hidden" type="text" name="buku_id" id="buku_id"
                                    value="{{ $book->id }}">
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
                        if ($count5Star > 0) {
                            $avg5Star = ($count5Star * 100) / $countTotalRating;
                        } else {
                            $avg5Star = 0;
                        }

                        $count4Star = $countRating->where('rating', '==', 4)->count();
                        if ($count4Star > 0) {
                            $avg4Star = ($count4Star * 100) / $countTotalRating;
                        } else {
                            $avg4Star = 0;
                        }

                        $count3Star = $countRating->where('rating', '==', 3)->count();
                        if ($count3Star > 0) {
                            $avg3Star = ($count3Star * 100) / $countTotalRating;
                        } else {
                            $avg3Star = 0;
                        }

                        $count2Star = $countRating->where('rating', '==', 2)->count();
                        if ($count2Star > 0) {
                            $avg2Star = ($count2Star * 100) / $countTotalRating;
                        } else {
                            $avg2Star = 0;
                        }

                        $count1Star = $countRating->where('rating', '==', 1)->count();
                        if ($count1Star > 0) {
                            $avg1Star = ($count1Star * 100) / $countTotalRating;
                        } else {
                            $avg1Star = 0;
                        }
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
                        <p class="text-black/80 text-base text-justify">Pride and Prejudice is a romantic novel of
                            {{ $book->deskripsi }}</p>
                    </div>
                    <button onclick="showFormLoan()" id="loan-button"
                        class="h-10 w-full flex items-center justify-center gap-x-2 bg-(--third-color) hover:bg-(--second-color) text-(--primary-color) font-medium rounded-md transition-colors duration-200"><i
                            class="size-5" data-lucide="book-open"></i>Ajukan
                        Peminjaman</button>
                </div>
                <div class="hidden flex-col gap-6 rounded-2xl p-6 mb-6 bg-white" id="form-loan">
                    <h2 class="text-black mb-4 text-xl font-medium">Formulir Pengajuan Peminjaman</h2>
                    <form class="space-y-4" action="{{ route('peminjaman.store') }}" method="POST">
                        @csrf
                        @method('POST')

                        {{-- ID Buku (Hidden) --}}
                        <input type="hidden" name="buku_id" id="buku_id" value="{{ $book->id }}">

                        {{-- Nama Lengkap --}}
                        <div>
                            <label class="flex items-center text-sm font-medium mb-1.5" for="nama_lengkap">Nama
                                Lengkap</label>
                            <input
                                class="flex h-9 w-full min-w-0 bg-black/10 outline-1 outline-black/30 rounded-md px-2 py-1 focus:outline-2 focus:outline-black/30 @error('nama_lengkap') 
                                    input-error 
                                @enderror"
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
                            <label class="flex items-center text-sm font-medium mb-1.5" for="email">Email</label>
                            <input
                                class="flex h-9 w-full min-w-0 outline-1 bg-black/10 outline-black/30 rounded-md px-2 py-1 focus:outline-2 focus:outline-black/30 @error('email') 
                                    input-error 
                                @enderror"
                                type="text" name="email" id="email" placeholder="email.anda@example.com"
                                value="{{ Auth::user()->email }}" disabled>
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
                                class="flex h-9 w-full min-w-0 bg-black/10 outline-1 outline-black/30 rounded-md px-2 py-1 focus:outline-2 focus:outline-black/30 @error('phone_number') 
                                    input-error 
                                @enderror"
                                type="text" name="phone_number" id="phone_number" placeholder="081211221122"
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
                                class="flex items-center justify-center w-full h-9 px-4 py-2 outline-1 outline-(--third-color) text-(--third-color) font-medium rounded-md hover:outline-(--second-color) hover:text-(--second-color) transition-all duration-200"
                                type="button">Batal</button>
                            <button
                                class="flex items-center justify-center w-full h-9 px-4 py-2 bg-(--third-color) text-(--primary-color) font-medium rounded-md hover:bg-(--second-color) transition-all duration-200">Pinjam</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        {{-- Ulasan --}}
        <section class="flex flex-col gap-6 rounded-xl p-8 bg-white">
            <h2 class="flex items-center text-xl font-medium gap-x-4"><i class="size-5 stroke-(--third-color)"
                    data-lucide="message-square"></i>Ulasan
                Pembaca</h2>

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
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Kirim
                            Ulasan</button>
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
        </section>
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

    function showFormLoan() {
        const formLoan = document.getElementById("form-loan");
        const loanButton = document.getElementById("loan-button");
        formLoan.classList.replace("hidden", "flex");
        loanButton.classList.replace("flex", "hidden");
    }

    function hideFormLoan() {
        const formLoan = document.getElementById("form-loan");
        const loanButton = document.getElementById("loan-button");
        formLoan.classList.replace("flex", "hidden");
        loanButton.classList.replace("hidden", "flex");
    }
</script>
