<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white px-10 py-8 rounded-lg">

        <div class="mb-10">
            <h1 class="capitalize text-2xl font-medium">{{ __($title) }}</h1>
        </div>

        <div class="flex justify-between items-center mb-5">
            <form class="w-1/2" action="{{ route('kelola-pinjam.index') }}" method="GET">
                <x-search-input class="w-full"></x-search-input>
            </form>
            <div class="flex items-center gap-2">
                <!-- <button onclick="window.print()"
                    class="no-print flex items-center gap-1.5 px-4 py-2 bg-(--logo-color) text-white rounded-lg hover:bg-(--logo-color)/70 transition-all duration-200 cursor-pointer">
                    <i class="size-4" data-lucide="printer"></i>Cetak
                </button> -->
                <a class="no-print flex items-center gap-1.5 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500 transition-all duration-200"
                    href="{{ route('laporan.peminjaman') }}" target="_blank">
                    <i class="size-4" data-lucide="file-down"></i>Laporan
                </a>
                <div class="relative no-print">
                    <a class="flex items-center gap-1.5 px-4 py-2 bg-(--third-color) text-white rounded-lg hover:bg-(--second-color) transition-all duration-200"
                        href="{{ route('kelola-pinjam.pengajuan-pinjaman') }}">
                        <i class="size-4" data-lucide="inbox"></i>Pengajuan Pinjaman
                    </a>
                    @if ($counts > 0)
                    <span class="absolute -right-2 -top-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                        {{ $counts }}
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <table class="table-fixed w-full">
            <thead>
                <tr class="border-b border-gray-500/40 text-left bg-black/5">
                    <th class="w-3/12 py-3 px-2">Judul Buku</th>
                    <th class="w-2/12 py-3">Peminjam</th>
                    <th class="w-2/12 py-3">Tgl Pinjam</th>
                    <th class="w-2/12 py-3">Est. Kembali</th>
                    <th class="w-2/12 py-3">Status</th>
                    <th class="w-1/12 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peminjamans as $peminjaman)
                <tr class="border-b border-gray-500/40 odd:bg-white even:bg-black/5 transition-colors duration-150">
                    <td class="py-3 px-2">
                        <p class="font-medium line-clamp-1">{{ $peminjaman->buku->judul }}</p>
                        <p class="text-xs text-black/40">{{ $peminjaman->buku->penulis }}</p>
                    </td>
                    <td class="py-3">{{ $peminjaman->user->nama_lengkap }}</td>
                    <td class="py-3 text-sm">{{ $peminjaman->tanggal_peminjaman }}</td>
                    <td class="py-3 text-sm">{{ $peminjaman->estimasi_tanggal_pengembalian ?? $peminjaman->tanggal_pengembalian }}</td>
                    <td class="py-3">
                        @php
                        $statusClass = match($peminjaman->status_peminjaman) {
                        'Pending' => 'badge-pending',
                        'Dipinjam' => 'badge-dipinjam',
                        'Dikembalikan' => 'badge-dikembalikan',
                        'Terlambat' => 'badge-terlambat',
                        'Ditolak' => 'badge-ditolak',
                        'Pending Dikembalikan' => 'badge-pending-kembali',
                        default => 'badge-pending'
                        };
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ $peminjaman->status_peminjaman }}</span>
                    </td>
                    <td class="py-3">
                        <div class="flex justify-center gap-2">
                            <button onclick="openAjaxModal('{{ route('kelola-pinjam.detail', $peminjaman->id) }}', 'Detail Peminjaman')"
                                class="rounded-lg cursor-pointer transition-colors" title="Detail">
                                <i class="size-4" data-lucide="eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-500 pt-8 pb-4">
                        <i class="size-12 mx-auto mb-2 text-gray-300" data-lucide="book-up"></i>
                        <p>Tidak ada data peminjaman</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if ($peminjamans->hasPages())
        <div class="flex justify-center mt-4">
            {{ $peminjamans->links('components.pagination') }}
        </div>
        @endif
    </div>

    {{-- AJAX Detail Modal --}}
    <x-detail-modal id="ajaxDetailModal" title="Detail">
        <div id="ajaxModalContent">
            <p class="text-center text-gray-400 py-8">Memuat...</p>
        </div>
    </x-detail-modal>

    <script>
        function openAjaxModal(url, title) {
            const modal = document.getElementById('ajaxDetailModal');
            const content = document.getElementById('ajaxModalContent');
            const titleEl = modal.querySelector('h2');
            if (titleEl) titleEl.textContent = title;
            content.innerHTML = '<p class="text-center text-gray-400 py-8">Memuat...</p>';
            modal.classList.remove('hidden');
            requestAnimationFrame(() => modal.classList.add('active'));

            fetch(url)
                .then(r => r.text())
                .then(html => {
                    content.innerHTML = html;
                    if (typeof lucide !== 'undefined') lucide.createIcons();
                })
                .catch(() => {
                    content.innerHTML = '<p class="text-center text-red-400 py-8">Gagal memuat data</p>';
                });
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('active');
                setTimeout(() => modal.classList.add('hidden'), 300);
            }
        }
    </script>

</x-layouts.admin-dashboard>