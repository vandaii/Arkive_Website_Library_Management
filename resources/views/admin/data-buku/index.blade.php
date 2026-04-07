<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white px-10 py-8 rounded-lg">

        <div class="mb-10">
            <h1 class="capitalize text-2xl font-medium">{{ __($title) }}</h1>
        </div>

        <div class="flex justify-between items-center mb-5">
            <form class="relative w-1/2" action="{{ route('data-buku.index') }}" method="GET">
                <x-search-input></x-search-input>
            </form>
            <div class="flex items-center gap-2">
                <button onclick="window.print()"
                    class="no-print flex items-center gap-1.5 px-4 py-2 bg-(--logo-color) text-white rounded-lg hover:bg-(--logo-color)/70 transition-all duration-200 cursor-pointer">
                    <i class="size-4" data-lucide="printer"></i>Cetak
                </button>
                <a class="no-print flex items-center gap-1.5 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500 transition-all duration-200"
                    href="{{ route('laporan.buku') }}" target="_blank">
                    <i class="size-4" data-lucide="file-down"></i>Unduh PDF
                </a>
                <a class="no-print flex items-center gap-1.5 px-4 py-2 bg-(--third-color) text-white rounded-lg hover:bg-(--second-color) transition-all duration-200"
                    href="{{ route('data-buku.create') }}">
                    <i class="size-4" data-lucide="plus"></i>Tambah Buku
                </a>
            </div>
        </div>

        <table class="table-fixed w-full">
            <thead>
                <tr class="border-b border-gray-500/40 text-left bg-black/5">
                    <th class="py-3 px-2 w-1/12">Cover</th>
                    <th class="w-3/12">Judul</th>
                    <th class="w-2/12">Penulis</th>
                    <th class="w-2/12">Penerbit</th>
                    <th class="w-1/12">Tahun</th>
                    <th class="w-1/12">Stok</th>
                    <th class="w-2/12 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr
                        class="border-b border-gray-500/40 odd:bg-white even:bg-black/5 hover:bg-blue-50/50 transition-colors duration-150">
                        <td class="py-3 px-2">
                            <img class="rounded-md h-16 w-12 object-cover"
                                src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}">
                        </td>
                        <td class="pr-2">
                            <p class="font-medium line-clamp-2">{{ $book->judul }}</p>
                            <p class="text-xs text-black/40 mt-0.5">
                                {{ $book->kategoriBukuRelasi->pluck('kategori.nama_kategori')->filter()->implode(', ') ?: '-' }}
                            </p>
                        </td>
                        <td class="pr-2 text-sm">{{ $book->penulis }}</td>
                        <td class="pr-2 text-sm">{{ $book->penerbit }}</td>
                        <td class="pr-2 text-sm">{{ $book->tahun_terbit }}</td>
                        <td class="pr-2">
                            <span class="badge {{ $book->stok > 0 ? 'badge-dikembalikan' : 'badge-terlambat' }}">
                                {{ $book->stok }}
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center justify-center gap-2">
                                <button
                                    onclick="openAjaxModal('{{ route('data-buku.detail', $book->id) }}', 'Detail Buku')"
                                    class="rounded-lg cursor-pointer transition-colors" title="Detail">
                                    <i class="size-4" data-lucide="eye"></i>
                                </button>
                                <a href="{{ route('data-buku.show', $book->id) }}"
                                    class="rounded-lg text-(--third-color) transition-colors" title="Edit">
                                    <i class="size-4" data-lucide="pencil"></i>
                                </a>
                                <form action="{{ route('data-buku.destroy', $book->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="rounded-lg text-red-500 cursor-pointer transition-colors" title="Hapus">
                                        <i class="size-4" data-lucide="trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 pt-8 pb-4">
                            <i class="size-12 mx-auto mb-2 text-gray-300" data-lucide="book-x"></i>
                            <p>Tidak ada data buku</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
