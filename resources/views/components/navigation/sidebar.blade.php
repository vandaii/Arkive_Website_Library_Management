<div class="bg-white min-h-screen w-56">
    <ul>
        <li class="px-5 space-y-3 flex flex-col py-10">
            @if (Auth::user()->role == 'peminjam')
                <x-sidebar-link class="group flex items-center gap-x-4" href="{{ route('user.index') }}"
                    :active="request()->routeIs('user.index')"><x-span-icon :active="request()->routeIs('user.index')"><i class="size-5"
                            data-lucide="house"></i></x-span-icon>Beranda</x-sidebar-link>
                <x-sidebar-link class="group flex items-center gap-x-4" href="{{ route('peminjaman.index') }}"
                    :active="request()->routeIs([
                        'peminjaman.index',
                        'peminjaman.show',
                        'peminjaman.riwayat-peminjaman',
                        'peminjaman.detailRiwayat',
                    ])"><x-span-icon :active="request()->routeIs([
                        'peminjaman.index',
                        'peminjaman.show',
                        'peminjaman.riwayat-peminjaman',
                        'peminjaman.detailRiwayat',
                    ])"><i class="size-5"
                            data-lucide="book-up"></i></x-span-icon>Pinjaman</x-sidebar-link>
                <x-sidebar-link class="group flex items-center gap-x-4" href="{{ route('koleksi.index') }}"
                    :active="request()->routeIs('koleksi.index')"><x-span-icon :active="request()->routeIs('koleksi.index')"><i class="size-5"
                            data-lucide="bookmark"></i></x-span-icon>Koleksi</x-sidebar-link>
            @else
                <x-sidebar-link class="group flex items-center gap-x-4" href="{{ route('admin.index') }}"
                    :active="request()->routeIs('admin.index')"><x-span-icon :active="request()->routeIs('admin.index')"><i class="size-5"
                            data-lucide="house"></i></x-span-icon>Dashboard</x-sidebar-link>
                @if (Auth::user()->role == 'admin')
                    <x-sidebar-link class="group flex items-center gap-x-4"
                        href="{{ route('employee-management.index') }}" :active="request()->routeIs([
                            'employee-management.index',
                            'employee-management.create',
                            'employee-management.show',
                        ])"><x-span-icon
                            :active="request()->routeIs([
                                'employee-management.index',
                                'employee-management.create',
                                'employee-management.show',
                            ])"><i class="size-5" data-lucide="user"></i></x-span-icon>Kelola
                        Petugas</x-sidebar-link>
                    <x-sidebar-link class="group flex items-center gap-x-4" href="{{ route('user-management.index') }}"
                        :active="request()->routeIs([
                            'user-management.index',
                            'user-management.create',
                            'user-management.show',
                        ])"><x-span-icon :active="request()->routeIs([
                            'user-management.index',
                            'user-management.create',
                            'user-management.show',
                        ])"><i class="size-5"
                                data-lucide="user"></i></x-span-icon>Kelola
                        Peminjam</x-sidebar-link>
                @endif
                <x-sidebar-link class="group flex items-center gap-x-4" href="{{ route('kategori.index') }}"
                    :active="request()->routeIs(['kategori.index', 'kategori.create', 'kategori.show'])"><x-span-icon :active="request()->routeIs(['kategori.index', 'kategori.create', 'kategori.show'])"><i class="size-5"
                            data-lucide="layout-grid"></i></x-span-icon>Kategori</x-sidebar-link>
                <x-sidebar-link class="group flex items-center gap-x-4" href="{{ route('data-buku.index') }}"
                    :active="request()->routeIs(['data-buku.index', 'data-buku.show', 'data-buku.create'])"><x-span-icon :active="request()->routeIs(['data-buku.index', 'data-buku.show', 'data-buku.create'])"><i class="size-5"
                            data-lucide="book"></i></x-span-icon>Data
                    Buku</x-sidebar-link>
                <x-sidebar-link class="group flex items-center gap-x-4" href="{{ route('kelola-pinjam.index') }}"
                    :active="request()->routeIs([
                        'kelola-pinjam.index',
                        'kelola-pinjam.show',
                        'kelola-pinjam.pengajuan-pinjaman',
                    ])"><x-span-icon :active="request()->routeIs([
                        'kelola-pinjam.index',
                        'kelola-pinjam.show',
                        'kelola-pinjam.pengajuan-pinjaman',
                    ])"><i class="size-5"
                            data-lucide="book-up"></i></x-span-icon>Data
                    Peminjaman</x-sidebar-link>

                <x-sidebar-link class="group flex items-center gap-x-4" href="{{ route('kelola-kembali.index') }}"
                    :active="request()->routeIs([
                        'kelola-kembali.index',
                        'kelola-kembali.show',
                        'kelola-kembali.pengajuan-kembali',
                    ])"><x-span-icon :active="request()->routeIs([
                        'kelola-kembali.index',
                        'kelola-kembali.show',
                        'kelola-kembali.pengajuan-kembali',
                    ])"><i class="size-5"
                            data-lucide="book-down"></i></x-span-icon> Data
                    Kembali</x-sidebar-link>

                <x-sidebar-link class="group flex items-center gap-x-4" href="{{ route('ulasan.index') }}"
                    :active="request()->routeIs('ulasan.index')"><x-span-icon :active="request()->routeIs('ulasan.index')"><i class="size-5"
                            data-lucide="message-square"></i></x-span-icon>Kelola
                    Ulasan</x-sidebar-link>
            @endif
        </li>
    </ul>
</div>
