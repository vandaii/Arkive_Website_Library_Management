<div class="bg-white min-h-screen w-56">
    <ul>
        <li class="px-5 space-y-3 flex flex-col py-10">
            @if (Route::is('user.index') || Route::is('peminjaman.index') || Route::is('book.show'))
                <x-sidebar-link class="group flex items-center gap-x-4" href="{{ route('user.index') }}"
                    :active="request()->routeIs('user.index')"><x-span-icon :active="request()->routeIs('user.index')"><i class="size-5"
                            data-lucide="house"></i></x-span-icon>Beranda</x-sidebar-link>
                <x-sidebar-link class="group flex items-center gap-x-4" href="{{ route('peminjaman.index') }}"
                    :active="request()->routeIs('peminjaman.index')"><x-span-icon :active="request()->routeIs('peminjaman.index')"><i class="size-5"
                            data-lucide="book-up"></i></x-span-icon>Pinjaman</x-sidebar-link>
            @else
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
                    request()->routeIs('kelola-pinjam.pengajuan-pinjaman')">Data
                    Peminjaman</x-sidebar-link>

                <x-sidebar-link href="{{ route('kelola-kembali.index') }}" :active="request()->routeIs('kelola-kembali.index') ||
                    request()->routeIs('kelola-kembali.show') ||
                    request()->routeIs('kelola-kembali.pengajuan-kembali')">Data
                    Kembali</x-sidebar-link>
            @endif
        </li>
    </ul>
</div>
