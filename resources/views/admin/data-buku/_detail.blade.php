<div class="flex gap-5 mb-5">
    <img class="w-28 h-40 object-cover rounded-lg shadow-md shrink-0" src="{{ asset('storage/' . $book->cover_buku) }}" alt="Cover">
    <div class="flex-1">
        <h3 class="font-semibold text-xl mb-1">{{ $book->judul }}</h3>
        <p class="text-sm text-black/60 mb-2">{{ $book->penulis }}</p>
        <div class="flex items-center gap-2 mb-2">
            <span class="badge {{ $book->stok > 0 ? 'badge-dikembalikan' : 'badge-terlambat' }}">Stok: {{ $book->stok }}</span>
            <span class="text-sm text-black/40">{{ $categories }}</span>
        </div>
        <div class="flex items-center gap-1 text-amber-500">
            <i class="size-4" data-lucide="star"></i>
            <span class="text-sm font-medium">{{ $avgRating }}</span>
            <span class="text-xs text-black/40">({{ $reviewCount }} ulasan)</span>
        </div>
    </div>
</div>

<div class="border border-black/10 rounded-xl p-4 mb-5">
    <h4 class="font-semibold text-sm text-black/70 mb-3 pb-2 border-b border-black/10">Informasi Buku</h4>
    <div class="grid grid-cols-2 gap-x-6">
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="book-open"></i>Judul</span>
            <span class="modal-info-value">{{ $book->judul }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="user"></i>Penulis</span>
            <span class="modal-info-value">{{ $book->penulis }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="building"></i>Penerbit</span>
            <span class="modal-info-value">{{ $book->penerbit }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="calendar"></i>Tahun Terbit</span>
            <span class="modal-info-value">{{ $book->tahun_terbit }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="hash"></i>ISBN</span>
            <span class="modal-info-value">{{ $book->isbn_number ?? '-' }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="file-text"></i>Halaman</span>
            <span class="modal-info-value">{{ $book->jumlah_halaman ?? '-' }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="package"></i>Stok</span>
            <span class="modal-info-value">{{ $book->stok }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="tag"></i>Kategori</span>
            <span class="modal-info-value">{{ $categories }}</span>
        </div>
    </div>
</div>

@if ($book->deskripsi)
<div class="border border-black/10 rounded-xl p-4">
    <h4 class="font-semibold text-sm text-black/70 mb-3 pb-2 border-b border-black/10">Deskripsi</h4>
    <p class="text-sm text-black/60 leading-relaxed">{{ $book->deskripsi }}</p>
</div>
@endif
