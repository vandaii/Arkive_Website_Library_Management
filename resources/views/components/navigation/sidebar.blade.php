<div class="bg-white h-screen w-60 z-100 border-black/20">
    <ul>
        <li>
            <div class="flex items-center h-20 px-5 border-b-2 border-white/40">
                <h1 class="">Logo</h1>
            </div>
        </li>
        <li class="px-5 space-y-3 flex flex-col py-10">
            <x-sidebar-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">Dashboard</x-sidebar-link>
            <x-sidebar-link href="{{ route('employee-management.index') }}" :active="request()->routeIs('employee-management.index') ||
                request()->routeIs('employee-management.create') ||
                request()->routeIs('employee-management.show')">Kelola
                Petugas</x-sidebar-link>
            <x-sidebar-link href="{{ route('user-management.index') }}" :active="request()->routeIs('user-management.index') ||
                request()->routeIs('user-management.create') ||
                request()->routeIs('user-management.show')">Kelola User</x-sidebar-link>
            <x-sidebar-link href="{{ route('kategori.index') }}" :active="request()->routeIs('kategori.index') ||
                request()->routeIs('kategori.create') ||
                request()->routeIs('kategori.show')">Kategori</x-sidebar-link>
            <x-sidebar-link href="{{ route('data-buku.index') }}" :active="request()->routeIs('data-buku.index') ||
                request()->routeIs('data-buku.create') ||
                request()->routeIs('data-buku.show')">Data Buku</x-sidebar-link>
            <x-sidebar-link href="{{ route('kelola-pinjam.index') }}" :active="request()->routeIs('kelola-pinjam.index')">Kelola Pinjam</x-sidebar-link>
        </li>
    </ul>
</div>
