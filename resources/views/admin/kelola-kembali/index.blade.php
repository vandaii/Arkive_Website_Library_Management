<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white px-10 py-8 rounded-lg">

        <div class="mb-10">
            <h1 class="capitalize text-2xl font-medium">{{ __($title) }}</h1>
        </div>

        <div class="flex justify-between items-center mb-5">
            <form class="relative w-1/2" action="{{ route('kelola-kembali.index') }}" method="GET">
                <x-search-input></x-search-input>
            </form>
            <div class="flex items-center gap-2">
                <button onclick="window.print()"
                    class="no-print flex items-center gap-1.5 px-4 py-3 border border-(--third-color) text-(--third-color) rounded-lg hover:bg-(--third-color) hover:text-white transition-all duration-200 cursor-pointer">
                    <i class="size-4" data-lucide="printer"></i>Cetak
                </button>
                <a class="no-print flex items-center gap-1.5 px-4 py-3 border border-emerald-600 text-emerald-600 rounded-lg hover:bg-emerald-600 hover:text-white transition-all duration-200"
                    href="{{ route('laporan.pengembalian') }}" target="_blank">
                    <i class="size-4" data-lucide="file-down"></i>Unduh PDF
                </a>
                <div class="relative no-print">
                    <a class="flex items-center gap-1.5 px-4 py-3 bg-(--third-color) text-white rounded-lg hover:bg-(--second-color) transition-all duration-200"
                        href="{{ route('kelola-kembali.pengajuan-kembali') }}">
                        <i class="size-4" data-lucide="inbox"></i>Pengajuan Pengembalian
                    </a>
                    @if ($counts > 0)
                        <span class="absolute -right-2 -top-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold animate-pulse">
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
                    <th class="w-2/12 py-3">Tgl Kembali</th>
                    <th class="w-1/12 py-3">Jumlah</th>
                    <th class="w-1/12 py-3">Status</th>
                    <th class="w-1/12 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengembalians as $pengembalian)
                    <tr class="border-b border-gray-500/40 odd:bg-white even:bg-black/5 hover:bg-blue-50/50 transition-colors duration-150">
                        <td class="py-3 px-2">
                            <p class="font-medium line-clamp-1">{{ $pengembalian->buku->judul }}</p>
                            <p class="text-xs text-black/40">{{ $pengembalian->buku->penulis }}</p>
                        </td>
                        <td class="py-3">{{ $pengembalian->user->nama_lengkap }}</td>
                        <td class="py-3 text-sm">{{ $pengembalian->tanggal_peminjaman }}</td>
                        <td class="py-3 text-sm">{{ $pengembalian->tanggal_pengembalian }}</td>
                        <td class="py-3">{{ $pengembalian->stok }}</td>
                        <td class="py-3">
                            @php
                                $statusClass = match($pengembalian->status_peminjaman) {
                                    'Dikembalikan' => 'badge-dikembalikan',
                                    'Terlambat' => 'badge-terlambat',
                                    'Ditolak' => 'badge-ditolak',
                                    default => 'badge-pending'
                                };
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ $pengembalian->status_peminjaman }}</span>
                        </td>
                        <td class="py-3">
                            <div class="flex justify-center gap-2">
                                <button onclick="openAjaxModal('{{ route('kelola-kembali.detail', $pengembalian->id) }}', 'Detail Pengembalian')"
                                    class="p-1.5 rounded-lg hover:bg-blue-50 text-blue-600 cursor-pointer transition-colors" title="Detail">
                                    <i class="size-4" data-lucide="eye"></i>
                                </button>
                                <a href="{{ route('kelola-kembali.show', $pengembalian->id) }}"
                                    class="p-1.5 rounded-lg hover:bg-amber-50 text-amber-600 transition-colors" title="Detail Page">
                                    <i class="size-4" data-lucide="pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 pt-8 pb-4">
                            <i class="size-12 mx-auto mb-2 text-gray-300" data-lucide="book-down"></i>
                            <p>Tidak ada data pengembalian</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($pengembalians->hasPages())
            <div class="flex justify-center mt-4">
                {{ $pengembalians->links('components.pagination') }}
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
            if (modal) { modal.classList.remove('active'); setTimeout(() => modal.classList.add('hidden'), 300); }
        }
    </script>
</x-layouts.admin-dashboard>
