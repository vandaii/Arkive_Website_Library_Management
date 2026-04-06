<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Welcome Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
        <p class="text-black/50 mt-1">Selamat datang kembali, {{ Auth::user()->nama_lengkap ?? 'Admin' }}! Berikut ringkasan aktivitas perpustakaan.</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        {{-- Total Buku --}}
        <div class="relative overflow-hidden bg-white rounded-xl p-5 shadow-sm border border-black/5 hover:shadow-md transition-shadow duration-300 group">
            <div class="absolute -right-3 -top-3 w-20 h-20 bg-blue-500/10 rounded-full group-hover:scale-110 transition-transform duration-300"></div>
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="text-sm text-black/50 mb-1">Total Buku</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ number_format($totalBuku) }}</h3>
                    <p class="text-xs text-black/40 mt-2">Koleksi perpustakaan</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center">
                    <i class="size-6 text-blue-600" data-lucide="book-open"></i>
                </div>
            </div>
        </div>

        {{-- Total User --}}
        <div class="relative overflow-hidden bg-white rounded-xl p-5 shadow-sm border border-black/5 hover:shadow-md transition-shadow duration-300 group">
            <div class="absolute -right-3 -top-3 w-20 h-20 bg-emerald-500/10 rounded-full group-hover:scale-110 transition-transform duration-300"></div>
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="text-sm text-black/50 mb-1">Total Peminjam</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ number_format($totalUser) }}</h3>
                    <p class="text-xs text-black/40 mt-2">Pengguna terdaftar</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center">
                    <i class="size-6 text-emerald-600" data-lucide="users"></i>
                </div>
            </div>
        </div>

        {{-- Peminjaman Aktif --}}
        <div class="relative overflow-hidden bg-white rounded-xl p-5 shadow-sm border border-black/5 hover:shadow-md transition-shadow duration-300 group">
            <div class="absolute -right-3 -top-3 w-20 h-20 bg-amber-500/10 rounded-full group-hover:scale-110 transition-transform duration-300"></div>
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="text-sm text-black/50 mb-1">Peminjaman Aktif</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ number_format($peminjamanAktif) }}</h3>
                    <p class="text-xs text-black/40 mt-2">Sedang dipinjam</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 flex items-center justify-center">
                    <i class="size-6 text-amber-600" data-lucide="book-up"></i>
                </div>
            </div>
        </div>

        {{-- Total Pengembalian --}}
        <div class="relative overflow-hidden bg-white rounded-xl p-5 shadow-sm border border-black/5 hover:shadow-md transition-shadow duration-300 group">
            <div class="absolute -right-3 -top-3 w-20 h-20 bg-violet-500/10 rounded-full group-hover:scale-110 transition-transform duration-300"></div>
            <div class="flex items-start justify-between relative z-10">
                <div>
                    <p class="text-sm text-black/50 mb-1">Total Pengembalian</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ number_format($totalPengembalian) }}</h3>
                    <p class="text-xs text-black/40 mt-2">Buku dikembalikan</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-violet-500/10 flex items-center justify-center">
                    <i class="size-6 text-violet-600" data-lucide="book-down"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Summary Badges --}}
    <div class="flex gap-3 mb-8">
        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg border border-black/5 shadow-sm">
            <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
            <span class="text-sm text-black/60">Pending: <strong class="text-gray-800">{{ $totalPending }}</strong></span>
        </div>
        <div class="flex items-center gap-2 px-4 py-2 bg-white rounded-lg border border-black/5 shadow-sm">
            <span class="w-2.5 h-2.5 rounded-full bg-red-400"></span>
            <span class="text-sm text-black/60">Terlambat: <strong class="text-gray-800">{{ $totalTerlambat }}</strong></span>
        </div>
    </div>

    {{-- Tables Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Peminjaman --}}
        <div class="bg-white rounded-xl p-6 shadow-sm border border-black/5">
            <div class="flex justify-between items-center mb-5">
                <h2 class="font-semibold text-gray-800">Peminjaman Terbaru</h2>
                <a href="{{ route('kelola-pinjam.index') }}" class="text-sm text-(--third-color) hover:underline">Lihat Semua</a>
            </div>
            <div class="space-y-3">
                @forelse ($recentPeminjaman as $p)
                    <div class="flex items-center justify-between py-2.5 px-3 rounded-lg hover:bg-black/[0.02] transition-colors">
                        <div class="flex items-center gap-3 min-w-0">
                            <img class="w-8 h-12 rounded object-cover shrink-0 shadow-sm"
                                src="{{ asset('storage/' . $p->buku->cover_buku) }}" alt="">
                            <div class="min-w-0">
                                <p class="text-sm font-medium truncate">{{ $p->buku->judul }}</p>
                                <p class="text-xs text-black/40">{{ $p->user->nama_lengkap }} · {{ $p->tanggal_peminjaman }}</p>
                            </div>
                        </div>
                        @php
                            $statusClass = match($p->status_peminjaman) {
                                'Pending' => 'badge-pending',
                                'Dipinjam' => 'badge-dipinjam',
                                'Dikembalikan' => 'badge-dikembalikan',
                                'Terlambat' => 'badge-terlambat',
                                'Ditolak' => 'badge-ditolak',
                                'Pending Dikembalikan' => 'badge-pending-kembali',
                                default => 'badge-pending'
                            };
                        @endphp
                        <span class="badge {{ $statusClass }} shrink-0 ml-2">{{ $p->status_peminjaman }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-6">Belum ada data peminjaman</p>
                @endforelse
            </div>
        </div>

        {{-- Popular Books --}}
        <div class="bg-white rounded-xl p-6 shadow-sm border border-black/5">
            <div class="flex justify-between items-center mb-5">
                <h2 class="font-semibold text-gray-800">Buku Populer</h2>
                <a href="{{ route('data-buku.index') }}" class="text-sm text-(--third-color) hover:underline">Lihat Semua</a>
            </div>
            <div class="space-y-3">
                @forelse ($popularBooks as $index => $book)
                    <div class="flex items-center justify-between py-2.5 px-3 rounded-lg hover:bg-black/[0.02] transition-colors">
                        <div class="flex items-center gap-3 min-w-0">
                            <span class="w-6 h-6 rounded-full bg-black/5 flex items-center justify-center text-xs font-bold text-black/50 shrink-0">
                                {{ $index + 1 }}
                            </span>
                            <img class="w-8 h-12 rounded object-cover shrink-0 shadow-sm"
                                src="{{ asset('storage/' . $book->cover_buku) }}" alt="">
                            <div class="min-w-0">
                                <p class="text-sm font-medium truncate">{{ $book->judul }}</p>
                                <p class="text-xs text-black/40">{{ $book->penulis }}</p>
                            </div>
                        </div>
                        <div class="text-right shrink-0 ml-2">
                            <p class="text-sm font-semibold text-(--third-color)">{{ $book->peminjaman_count }}</p>
                            <p class="text-xs text-black/40">pinjaman</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-6">Belum ada data buku</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.admin-dashboard>
