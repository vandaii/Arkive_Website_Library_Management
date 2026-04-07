<div class="flex items-center gap-4 mb-5">
    @if (!empty($user->photo_profile))
        <img class="w-16 h-16 rounded-full object-cover shrink-0" src="{{ asset('storage/' . $user->photo_profile) }}" alt="Avatar">
    @else
        <img class="w-16 h-16 rounded-full object-cover shrink-0" src="{{ asset('img/user.png') }}" alt="Avatar">
    @endif
    <div>
        <h3 class="font-semibold text-lg">{{ $user->nama_lengkap }}</h3>
        <p class="text-sm text-black/50">{{ $user->email }}</p>
    </div>
    <span class="ml-auto badge {{ $user->role == 'Admin' ? 'badge-dipinjam' : 'badge-dikembalikan' }}">
        {{ ucfirst($user->role) }}
    </span>
</div>

<div class="border border-black/10 rounded-xl p-4 mb-5">
    <h4 class="font-semibold text-sm text-black/70 mb-3 pb-2 border-b border-black/10">Informasi Pengguna</h4>
    <div class="grid grid-cols-2 gap-x-6">
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="user"></i>Nama Lengkap</span>
            <span class="modal-info-value">{{ $user->nama_lengkap }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="at-sign"></i>Username</span>
            <span class="modal-info-value">{{ $user->username }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="mail"></i>Email</span>
            <span class="modal-info-value">{{ $user->email }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="phone"></i>No. Handphone</span>
            <span class="modal-info-value">{{ $user->phone_number ?? '-' }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="briefcase"></i>Posisi</span>
            <span class="modal-info-value">{{ ucfirst($user->role) }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="map-pin"></i>Alamat</span>
            <span class="modal-info-value">{{ $user->alamat ?? '-' }}</span>
        </div>
        <div class="modal-info-row">
            <span class="modal-info-label"><i class="size-3.5" data-lucide="calendar"></i>Bergabung</span>
            <span class="modal-info-value">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</span>
        </div>
    </div>
</div>

<div class="border border-black/10 rounded-xl p-4">
    <h4 class="font-semibold text-sm text-black/70 mb-3 pb-2 border-b border-black/10">Pinjaman Terakhir</h4>
    <div class="space-y-2">
        @forelse ($user->peminjaman->take(5) as $p)
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
            <div class="flex items-center justify-between px-3 py-2.5 border border-black/10 rounded-lg hover:bg-black/[0.02] transition-colors">
                <div class="flex items-center gap-3">
                    <i class="size-4 text-black/40" data-lucide="book-up"></i>
                    <div>
                        <p class="text-sm font-medium">{{ $p->buku->judul ?? '-' }}</p>
                        <p class="text-xs text-black/40">Pinjam: {{ $p->tanggal_peminjaman ?? '-' }}</p>
                    </div>
                </div>
                <span class="badge {{ $statusClass }}">{{ $p->status_peminjaman }}</span>
            </div>
        @empty
            <p class="text-sm text-gray-400 text-center py-2">Tidak ada pinjaman</p>
        @endforelse
    </div>
</div>
