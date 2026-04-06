<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white px-10 py-8 rounded-lg">

        <div class="mb-10">
            <h1 class="capitalize text-2xl font-medium">{{ __($title) }}</h1>
        </div>

        <div class="flex justify-between items-center mb-5">
            <form class="w-2/4" action="{{ route('employee-management.index') }}" method="GET">
                <div class="flex w-full items-center gap-2">
                    <div class="flex-1 w-full">
                        <x-search-input class="w-full"></x-search-input>
                    </div>
                    <div class="relative">
                        <select
                            class="appearance-none border border-black/50 rounded-full px-4 pr-8 py-2 text-sm focus:border-(--third-color) focus:outline-none cursor-pointer transition-all duration-200"
                            name="role" id="role" onchange="this.form.submit()">
                            <option value="All" {{ request('role') == 'All' || !request('role') ? 'selected' : '' }}>
                                Semua Status</option>
                            <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>
                                Admin</option>
                            <option value="Petugas" {{ request('role') == 'Petugas' ? 'selected' : '' }}>
                                Petugas</option>
                        </select>
                        <i class="absolute right-2.5 top-1/2 -translate-y-1/2 size-3.5 text-black/40 pointer-events-none"
                            data-lucide="chevron-down"></i>
                    </div>
                </div>
            </form>
            <div class="flex items-center gap-2">
                <button onclick="window.print()"
                    class="no-print flex items-center gap-1.5 px-4 py-2 rounded-lg bg-(--logo-color) text-white hover:bg-(--logo-color)/70 transition-all duration-200 cursor-pointer">
                    <i class="size-4" data-lucide="printer"></i>Cetak
                </button>
                <a class="no-print flex items-center gap-1.5 px-4 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-500 transition-all duration-200"
                    href="{{ route('laporan.employee') }}" target="_blank">
                    <i class="size-4" data-lucide="file-down"></i>Unduh PDF
                </a>
                <a class="flex items-center gap-1.5 px-4 py-2 bg-(--third-color) text-white rounded-lg hover:bg-(--second-color) transition-all duration-200 no-print"
                    href="{{ route('employee-management.create') }}"><i class="size-5"
                        data-lucide="user-plus"></i>Tambah
                    Petugas</a>
            </div>
        </div>

        <table class="table-fixed w-full text-left">
            <thead>
                <tr class="border-b border-gray-500/40 bg-black/5">
                    <th class="py-3 px-2 w-3/12">Nama Lengkap</th>
                    <th class="py-3 w-3/12">Username</th>
                    <th class="py-3 w-3/12">Email</th>
                    <th class="py-3 w-2/12">Posisi</th>
                    <th class="py-3 w-2/12">Bergabung</th>
                    <th class="py-3 w-1/12 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr
                        class="border-b border-gray-500/40 odd:bg-white even:bg-black/5 hover:bg-blue-50/50 transition-colors duration-150">
                        <td class="py-3 px-4">{{ $user->nama_lengkap }}</td>
                        <td class="py-3">{{ $user->username }}</td>
                        <td class="py-3 truncate">{{ $user->email }}</td>
                        <td class="py-3">
                            <span
                                class="capitalize badge {{ $user->role == 'admin' ? 'badge-dipinjam' : 'badge-dikembalikan' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="py-3 text-sm text-black/50">
                            {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                        <td class="py-3">
                            <div class="flex justify-center gap-2">
                                <button
                                    onclick="openAjaxModal('{{ route('employee-management.detail', $user->id) }}', 'Detail Petugas')"
                                    class="rounded-lg hover:bg-blue-50 cursor-pointer transition-colors" title="Detail">
                                    <i class="size-4" data-lucide="eye"></i>
                                </button>
                                <a class="rounded-lg hover:bg-amber-50 text-(--third-color) transition-colors"
                                    href="{{ route('employee-management.edit', $user->id) }}" title="Edit">
                                    <i class="size-4" data-lucide="user-pen"></i>
                                </a>
                                <form onsubmit="return confirm('Yakin ingin menonaktifkan user ini?')"
                                    action="{{ route('employee-management.deactivate', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        class="rounded-lg hover:bg-red-50 text-red-500 cursor-pointer transition-colors"
                                        type="submit" title="Nonaktifkan">
                                        <i class="size-4" data-lucide="trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 pt-8 pb-4">
                            <i class="size-12 mx-auto mb-2 text-gray-300" data-lucide="users"></i>
                            <p>Tidak ada data petugas</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($users->hasPages())
            <div class="flex justify-center mt-6">
                {{ $users->links('components.pagination') }}
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
