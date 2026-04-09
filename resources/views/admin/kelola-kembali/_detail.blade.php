<div class="flex gap-5 mb-5">
    <img class="w-24 h-36 object-cover rounded-lg shadow-md shrink-0" src="{{ asset('storage/' . $pengembalian->buku->cover_buku) }}" alt="Cover">
    <div class="flex-1">
        <h3 class="font-semibold text-lg mb-1">{{ $pengembalian->buku->judul ?? '-' }}</h3>
        <p class="text-sm text-black/60 mb-1">{{ $pengembalian->buku->penulis ?? '-' }}</p>
        <p class="text-sm text-black/40 mb-3">Peminjam: {{ $pengembalian->user->nama_lengkap ?? '-' }}</p>
        @php
            $statusClass = match($pengembalian->status_peminjaman) {
                'Dikembalikan' => 'badge-dikembalikan',
                'Terlambat' => 'badge-terlambat',
                'Ditolak' => 'badge-ditolak',
                default => 'badge-pending'
            };
        @endphp
        <span class="badge {{ $statusClass }}">{{ $pengembalian->status_peminjaman }}</span>
    </div>
</div>

<div class="border border-black/10 rounded-xl p-4">
    <h4 class="font-semibold text-sm text-black/70 mb-3 pb-2 border-b border-black/10">Informasi Pengembalian</h4>
    <div class="grid grid-cols-2 gap-x-6">
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="user"></i>Peminjam</span>
            <span class="modal-info-value">{{ $pengembalian->user->nama_lengkap ?? '-' }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="book-open"></i>Judul Buku</span>
            <span class="modal-info-value">{{ $pengembalian->buku->judul ?? '-' }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="calendar"></i>Tgl Pinjam</span>
            <span class="modal-info-value">{{ $pengembalian->tanggal_peminjaman ?? '-' }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="calendar-check"></i>Tgl Kembali</span>
            <span class="modal-info-value">{{ $pengembalian->tanggal_pengembalian ?? '-' }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="hash"></i>Jumlah Buku</span>
            <span class="modal-info-value">{{ $pengembalian->stok ?? '-' }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="info"></i>Status</span>
            <span class="modal-info-value">{{ $pengembalian->status_peminjaman }}</span>
        </div>
    </div>
</div>
