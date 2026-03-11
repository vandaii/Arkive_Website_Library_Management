<div class="bg-white h-screen w-60 z-100 border-black/20">
    <ul>
        <li>
            <div class="flex items-center h-20 px-5 border-b-2 border-white/40">
                <h1 class="">Logo</h1>
            </div>
        </li>
        <li class="px-5 space-y-2 flex flex-col py-5">
            <x-sidebar-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">Dashboard</x-sidebar-link>
            <x-sidebar-link href="{{ route('employee-management.index') }}" :active="request()->routeIs('employee-management.index') ||
                request()->routeIs('employee-management.create') ||
                request()->routeIs('employee-management.show')">Kelola
                Petugas</x-sidebar-link>
            <x-sidebar-link href="{{ route('user-management.index') }}" :active="request()->routeIs('user-management.index') ||
                request()->routeIs('user-management.create') ||
                request()->routeIs('user-management.show')">Kelola
                Peminjam</x-sidebar-link>
            <x-sidebar-link href="{{ route('kategori.index') }}" :active="request()->routeIs('kategori.index') ||
                request()->routeIs('kategori.create') ||
                request()->routeIs('kategori.show')">Kategori</x-sidebar-link>
            <x-sidebar-link href="{{ route('data-buku.index') }}" :active="request()->routeIs('data-buku.index') ||
                request()->routeIs('data-buku.create') ||
                request()->routeIs('data-buku.show')">Data Buku</x-sidebar-link>
            <x-sidebar-link href="{{ route('kelola-pinjam.index') }}" :active="request()->routeIs('kelola-pinjam.index') ||
                request()->routeIs('kelola-pinjam.show') ||
                request()->routeIs('kelola-pinjam.pengajuan-pinjaman')">Data Peminjaman</x-sidebar-link>

            <x-sidebar-link href="{{ route('kelola-kembali.index') }}" :active="request()->routeIs('kelola-kembali.index') ||
                request()->routeIs('kelola-kembali.show') ||
                request()->routeIs('kelola-kembali.pengajuan-kembali')">Data
                Kembali</x-sidebar-link>

            {{-- <div>
                <button onclick="toggleReportMenu()" class="w-full flex items-center pl-3 justify-between rounded-lg">
                    <span class="text-gray-500">Laporan</span>
                    <span id="reportMenuIcon"><i data-lucide="chevron-down" class="size-4"></i></span>
                </button>
                <div id="reportMenu" class="hidden pl-4">
                    <x-sidebar-link href="{{ route('reports.dashboard') }}" :active="request()->routeIs('reports.dashboard')">Dashboard</x-sidebar-link>
                    <x-sidebar-link href="{{ route('reports.buku') }}" :active="request()->routeIs('reports.buku')">Data Buku</x-sidebar-link>
                    <x-sidebar-link href="{{ route('reports.user') }}" :active="request()->routeIs('reports.user')">Data Peminjam</x-sidebar-link>
                    <x-sidebar-link href="{{ route('reports.peminjaman') }}" :active="request()->routeIs('reports.peminjaman')">Data
                        Peminjaman</x-sidebar-link>
                    <x-sidebar-link href="{{ route('reports.pengembalian') }}" :active="request()->routeIs('reports.pengembalian')">Data
                        Pengembalian</x-sidebar-link>
                </div>
            </div> --}}
        </li>
    </ul>
</div>

<script>
    function toggleReportMenu() {
        const menu = document.getElementById('reportMenu');
        const icon = document.getElementById('reportMenuIcon');

        menu.classList.toggle('hidden');

        // Toggle icon direction
        if (menu.classList.contains('hidden')) {
            icon.classList.remove('rotate-180');
            menu.classList.remove('flex');
            menu.classList.remove('flex-col');
        } else {
            icon.classList.add('rotate-180');
            menu.classList.add('flex');
            menu.classList.add('flex-col');
        }
    }

    // Auto-open menu jika user berada di halaman reports
    window.addEventListener('load', function() {
        const isReportsPage = {{ request()->routeIs('reports.*') ? 'true' : 'false' }};
        if (isReportsPage) {
            document.getElementById('reportMenu').classList.remove('hidden');
            document.getElementById('reportMenu').classList.add('flex');
            document.getElementById('reportMenu').classList.add('flex-col');
            document.getElementById('reportMenuIcon').classList.add('rotate-180');
        }
    });
</script>
