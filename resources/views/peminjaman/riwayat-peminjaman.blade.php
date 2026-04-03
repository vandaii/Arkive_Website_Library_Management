<x-layouts.user-dashboard>
    <div class="container mx-auto px-6 py-8">
        <div class="flex flex-col gap-y-8">
            <div class="p-5 rounded-2xl bg-white">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-4xl font-medium">Riwayat Peminjaman</h1>
                    <a class="group flex items-center gap-1 text-gray-500 border rounded-full h-fit font-medium text-sm px-3 py-2 hover:text-black transition-all duration-200"
                        href="{{ route('peminjaman.index') }}">
                        <i class="size-4 rotate-180 group-hover:text-black" data-lucide="arrow-right"></i>
                        Pinjaman
                    </a>
                </div>
                <div>
                    <form class="flex gap-3 items-center" action="{{ route('peminjaman.riwayat-peminjaman') }}" method="GET">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="search" name="search" id="search" placeholder="Cari judul buku..."
                                    value="{{ request('search') }}"
                                    class="w-full py-2 rounded-full pl-11 pr-4 outline-1 outline-black/20 focus:outline-(--third-color) focus:outline-2 text-sm transition-all duration-200">
                                <i class="absolute top-2.5 left-4 size-4 my-auto stroke-black/40" data-lucide="search"></i>
                            </div>
                        </div>
                        <div class="relative">
                            <select
                                class="appearance-none border border-black/20 rounded-full px-4 pr-8 py-2 text-sm focus:border-(--third-color) focus:outline-none cursor-pointer transition-all duration-200"
                                name="status_peminjaman" id="status_peminjaman" onchange="this.form.submit()">
                                <option value="All" {{ request('status_peminjaman') == 'All' || !request('status_peminjaman') ? 'selected' : '' }}>Semua Status</option>
                                <option value="Pending" {{ request('status_peminjaman') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Dipinjam" {{ request('status_peminjaman') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="Pending Dikembalikan" {{ request('status_peminjaman') == 'Pending Dikembalikan' ? 'selected' : '' }}>Pending Dikembalikan</option>
                                <option value="Dikembalikan" {{ request('status_peminjaman') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                <option value="Terlambat" {{ request('status_peminjaman') == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                            </select>
                            <i class="absolute right-2.5 top-1/2 -translate-y-1/2 size-3.5 text-black/40 pointer-events-none" data-lucide="chevron-down"></i>
                        </div>
                        <button type="submit" class="bg-(--third-color) text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-(--second-color) transition-all duration-200 cursor-pointer">
                            <i class="size-4" data-lucide="search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="flex gap-5 flex-col w-full">
                @forelse ($historys as $history)
                    <div class="group relative flex items-center gap-5 p-5 rounded-2xl transition-all hover:shadow-lg bg-white">
                        <a class="flex items-center gap-5 flex-1 min-w-0" href="{{ route('peminjaman.detailRiwayat', $history->id) }}">
                            <div class="w-18 h-24 rounded-xl overflow-hidden shrink-0">
                                <img class="w-full h-full object-cover"
                                    src="{{ asset('storage/' . $history->buku->cover_buku) }}" alt="cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-3 mb-2">
                                    <div>
                                        <h1 class="text-black font-bold mb-1">
                                            {{ $history->buku->judul }}
                                        </h1>
                                        <h2 class="text-black/50 text-sm">{{ $history->buku->penulis }}</h2>
                                    </div>
                                    @php
                                        $statusColor = match($history->status_peminjaman) {
                                            'Pending' => 'bg-yellow-100 text-yellow-700',
                                            'Dipinjam' => 'bg-blue-100 text-blue-700',
                                            'Pending Dikembalikan' => 'bg-purple-100 text-purple-700',
                                            'Dikembalikan' => 'bg-green-100 text-green-700',
                                            'Terlambat' => 'bg-red-100 text-red-700',
                                            'Ditolak' => 'bg-gray-100 text-gray-700',
                                            default => 'bg-gray-100 text-gray-700',
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full shrink-0 text-xs font-semibold {{ $statusColor }}">
                                        {{ $history->status_peminjaman }}
                                    </span>
                                </div>
                                <div class="flex flex-wrap gap-x-6 gap-y-1 text-sm">
                                    <h2 class="text-black/50 text-xs">Tanggal Peminjaman: <span
                                            class="text-black font-medium text-sm">{{ $history->tanggal_peminjaman }}</span></h2>
                                    @if (in_array($history->status_peminjaman, ['Dikembalikan', 'Terlambat']))
                                        <h2 class="text-black/50 text-xs">Tanggal Pengembalian: <span
                                                class="text-black font-medium text-sm">{{ $history->tanggal_pengembalian }}</span></h2>
                                    @else
                                        <h2 class="text-black/50 text-xs">Estimasi Pengembalian: <span
                                                class="text-black font-medium text-sm">{{ $history->estimasi_tanggal_pengembalian }}</span>
                                        </h2>
                                    @endif
                                </div>
                            </div>
                        </a>

                        {{-- Tombol Tulis Ulasan --}}
                        @if (in_array($history->status_peminjaman, ['Dikembalikan', 'Terlambat']))
                            @php
                                $sudahReview = $history->buku->ulasan->where('user_id', Auth::id())->count() > 0;
                            @endphp
                            @if (!$sudahReview)
                                <button type="button"
                                    onclick="openReviewModal({{ $history->buku->id }}, '{{ addslashes($history->buku->judul) }}')"
                                    class="flex absolute right-4 bottom-2 items-center gap-2 px-4 py-2 rounded-full text-sm font-medium text-(--third-color) border border-(--third-color)/30 hover:bg-(--third-color) hover:text-white transition-all duration-200 shrink-0 cursor-pointer">
                                    <i class="size-4" data-lucide="message-square-plus"></i>Tulis Ulasan
                                </button>
                            @else
                                <span class="flex absolute right-4 bottom-2 items-center gap-1.5 px-3 py-2 rounded-full text-xs font-medium text-green-600 bg-green-50 shrink-0">
                                    <i class="size-3.5" data-lucide="check-circle"></i>Sudah Diulas
                                </span>
                            @endif
                        @endif
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-20 bg-white rounded-2xl">
                        <i class="size-16 text-black/10 mb-4" data-lucide="history"></i>
                        <h2 class="text-lg font-medium text-black/40">Belum Ada Riwayat</h2>
                        <p class="text-sm text-black/30 mt-1">Riwayat peminjaman Anda akan muncul di sini</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($historys->hasPages())
                <div class="flex justify-center">
                    {{ $historys->links('components.pagination') }}
                </div>
            @endif
        </div>
    </div>

    {{-- Modal Review --}}
    <div id="reviewModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeReviewModal()"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg p-8 z-10 animate-modal-in">
                <button onclick="closeReviewModal()" class="absolute top-4 right-4 text-black/30 hover:text-black transition-colors cursor-pointer">
                    <i class="size-5" data-lucide="x"></i>
                </button>

                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2.5 rounded-xl bg-(--third-color)/10">
                        <i class="size-5 text-(--third-color)" data-lucide="message-square-plus"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold">Tulis Ulasan</h2>
                        <p class="text-sm text-black/50" id="reviewBookTitle"></p>
                    </div>
                </div>

                <form action="{{ route('ulasan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="buku_id" id="reviewBukuId">

                    {{-- Star Rating --}}
                    <div class="mb-5">
                        <label class="text-sm font-medium mb-2 block">Rating</label>
                        <input type="hidden" name="rating" id="modalRatingInput" value="5">
                        <div class="flex items-center gap-1" id="modalStarContainer">
                            @for ($i = 1; $i <= 5; $i++)
                            <i data-lucide="star" data-value="{{ $i }}" class="modal-star cursor-pointer w-8 h-8 fill-(--third-color) text-(--third-color) stroke-1 hover:scale-110 transition-transform"></i>
                            @endfor
                        </div>
                    </div>

                    {{-- Komentar --}}
                    <div class="mb-6">
                        <label class="text-sm font-medium mb-2 block" for="modalUlasan">Komentar</label>
                        <textarea name="ulasan" id="modalUlasan" rows="4"
                            class="w-full bg-gray-50 border border-black/10 rounded-xl px-4 py-3 focus:outline-none focus:border-(--third-color) focus:ring-1 focus:ring-(--third-color)/20 text-sm transition-all duration-200 resize-none"
                            placeholder="Bagikan pengalaman Anda membaca buku ini..." required></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="closeReviewModal()"
                            class="flex-1 py-2.5 rounded-full border border-black/15 font-medium text-sm hover:bg-gray-50 transition-all duration-200 cursor-pointer">Batal</button>
                        <button type="submit"
                            class="flex-1 py-2.5 rounded-full bg-(--third-color) text-white font-medium text-sm hover:bg-(--second-color) transition-all duration-200 cursor-pointer">Kirim Ulasan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.95) translateY(10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .animate-modal-in {
            animation: modalIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>

    <script>
        function openReviewModal(bukuId, judul) {
            document.getElementById('reviewBukuId').value = bukuId;
            document.getElementById('reviewBookTitle').textContent = judul;
            document.getElementById('reviewModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Modal star rating
        document.addEventListener('DOMContentLoaded', function() {
            const modalStars = document.querySelectorAll('.modal-star');
            const modalRatingInput = document.getElementById('modalRatingInput');

            function setModalRating(v) {
                modalRatingInput.value = v;
                modalStars.forEach(s => {
                    const val = Number(s.getAttribute('data-value'));
                    if (val <= v) {
                        s.classList.remove('text-gray-300');
                        s.classList.add('fill-(--third-color)');
                } else {
                        s.classList.remove('fill-(--third-color)');
                        s.classList.add('text-gray-300');
                }
            });
            }

            modalStars.forEach(s => s.addEventListener('click', function() {
                setModalRating(Number(this.dataset.value));
            }));
        });
    </script>
</x-layouts.user-dashboard>
