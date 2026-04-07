<x-layouts.admin-dashboard>
    <x-slot:title>Pengajuan Pengembalian</x-slot:title>
    <div class="bg-white px-10 py-8 rounded-lg">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-medium">Pengajuan Pengembalian</h1>
                <p class="text-sm text-black/50 mt-1">Daftar pengajuan pengembalian buku yang menunggu persetujuan</p>
            </div>
            <a href="{{ route('kelola-kembali.index') }}"
                class="flex items-center gap-1.5 px-4 py-2.5 border border-black/20 rounded-lg hover:bg-black/5 transition-all duration-200 text-sm">
                <i class="size-4" data-lucide="arrow-left"></i>Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($pengajuans as $pengajuan)
                <div class="group border border-black/10 rounded-xl p-5 hover:shadow-lg hover:border-(--third-color)/30 transition-all duration-300 cursor-pointer relative"
                    onclick="openPengajuanKembaliDetail({{ $pengajuan->id }})">
                    <div class="absolute top-4 right-4">
                        <span class="badge badge-pending-kembali">
                            <i class="size-3 mr-1" data-lucide="clock"></i>Menunggu
                        </span>
                    </div>

                    <div class="flex gap-4">
                        <img class="w-16 h-24 object-cover rounded-lg shadow-sm shrink-0"
                            src="{{ asset('storage/' . $pengajuan->buku->cover_buku) }}"
                            alt="{{ $pengajuan->buku->judul }}">

                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-base line-clamp-1 group-hover:text-(--third-color) transition-colors">
                                {{ $pengajuan->buku->judul }}
                            </h3>
                            <p class="text-sm text-black/50 mb-3">{{ $pengajuan->buku->penulis }}</p>

                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-violet-400 to-purple-500 flex items-center justify-center text-white text-[10px] font-bold shrink-0">
                                    {{ strtoupper(substr($pengajuan->user->nama_lengkap, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium leading-tight">{{ $pengajuan->user->nama_lengkap }}</p>
                                    <p class="text-xs text-black/40">{{ $pengajuan->user->email }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 text-xs text-black/40 mt-2">
                                <span class="flex items-center gap-1">
                                    <i class="size-3" data-lucide="layers"></i>
                                    {{ $pengajuan->stok }} buku
                                </span>
                                <span class="flex items-center gap-1">
                                    <i class="size-3" data-lucide="calendar"></i>
                                    {{ $pengajuan->tanggal_peminjaman }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2 mt-4 pt-4 border-t border-black/5" onclick="event.stopPropagation()">
                        <form action="{{ route('kelola-kembali.setuju-kembali', $pengajuan->id) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Setujui pengembalian ini?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-1.5 px-4 py-2.5 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-all duration-200 text-sm font-medium cursor-pointer">
                                <i class="size-4" data-lucide="check"></i>Setujui
                            </button>
                        </form>
                        <form action="{{ route('kelola-kembali.tolak-kembali', $pengajuan->id) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Tolak pengembalian ini?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-1.5 px-4 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all duration-200 text-sm font-medium cursor-pointer">
                                <i class="size-4" data-lucide="x"></i>Tolak
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-16">
                    <i class="size-16 mx-auto mb-3 text-gray-300" data-lucide="inbox"></i>
                    <p class="text-gray-500 text-lg">Tidak ada pengajuan pengembalian</p>
                    <p class="text-gray-400 text-sm mt-1">Semua pengajuan sudah diproses</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Detail Modal --}}
    <x-detail-modal id="pengajuanKembaliModal" title="Detail Pengajuan Pengembalian">
        <div class="flex gap-5 mb-5">
            <img id="pengajuanKembaliCover" class="w-24 h-36 object-cover rounded-lg shadow-md shrink-0" src="" alt="Cover">
            <div class="flex-1">
                <h3 class="font-semibold text-lg mb-1" id="pengajuanKembaliTitle">-</h3>
                <p class="text-sm text-black/60 mb-1" id="pengajuanKembaliAuthor">-</p>
                <p class="text-sm text-black/40 mb-3" id="pengajuanKembaliUserName">-</p>
                <span class="badge badge-pending-kembali"><i class="size-3 mr-1" data-lucide="clock"></i>Menunggu Persetujuan</span>
            </div>
        </div>

        <div class="border border-black/10 rounded-xl p-4">
            <h4 class="font-semibold text-sm text-black/70 mb-3 pb-2 border-b border-black/10">Informasi Pengajuan</h4>
            <div class="grid grid-cols-2 gap-x-6">
                <div class="modal-info-row">
                    <span class="modal-info-label"><i class="size-3.5" data-lucide="user"></i>Peminjam</span>
                    <span class="modal-info-value" id="pengajuanKembaliInfoUser">-</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label"><i class="size-3.5" data-lucide="mail"></i>Email</span>
                    <span class="modal-info-value" id="pengajuanKembaliInfoEmail">-</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label"><i class="size-3.5" data-lucide="book-open"></i>Judul Buku</span>
                    <span class="modal-info-value" id="pengajuanKembaliInfoTitle">-</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label"><i class="size-3.5" data-lucide="hash"></i>Jumlah</span>
                    <span class="modal-info-value" id="pengajuanKembaliInfoQty">-</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label"><i class="size-3.5" data-lucide="calendar"></i>Tgl Pinjam</span>
                    <span class="modal-info-value" id="pengajuanKembaliInfoDate">-</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label"><i class="size-3.5" data-lucide="calendar-check"></i>Est. Kembali</span>
                    <span class="modal-info-value" id="pengajuanKembaliInfoReturn">-</span>
                </div>
            </div>
        </div>
    </x-detail-modal>

    <script>
        const pengajuanKembaliData = @json($pengajuans);
        const storageBase = "{{ asset('storage') }}/";

        function openPengajuanKembaliDetail(id) {
            const p = pengajuanKembaliData.find(x => x.id === id);
            if (!p) return;

            document.getElementById('pengajuanKembaliCover').src = storageBase + (p.buku ? p.buku.cover_buku : '');
            document.getElementById('pengajuanKembaliTitle').textContent = p.buku ? p.buku.judul : '-';
            document.getElementById('pengajuanKembaliAuthor').textContent = p.buku ? p.buku.penulis : '-';
            document.getElementById('pengajuanKembaliUserName').textContent = 'Peminjam: ' + (p.user ? p.user.nama_lengkap : '-');
            document.getElementById('pengajuanKembaliInfoUser').textContent = p.user ? p.user.nama_lengkap : '-';
            document.getElementById('pengajuanKembaliInfoEmail').textContent = p.user ? p.user.email : '-';
            document.getElementById('pengajuanKembaliInfoTitle').textContent = p.buku ? p.buku.judul : '-';
            document.getElementById('pengajuanKembaliInfoQty').textContent = p.stok || '-';
            document.getElementById('pengajuanKembaliInfoDate').textContent = p.tanggal_peminjaman || '-';
            document.getElementById('pengajuanKembaliInfoReturn').textContent = p.estimasi_tanggal_pengembalian || p.tanggal_pengembalian || '-';

            openModal('pengajuanKembaliModal');
        }

        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal) { modal.classList.remove('hidden'); requestAnimationFrame(() => modal.classList.add('active')); }
        }
        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) { modal.classList.remove('active'); setTimeout(() => modal.classList.add('hidden'), 300); }
        }
    </script>
</x-layouts.admin-dashboard>
