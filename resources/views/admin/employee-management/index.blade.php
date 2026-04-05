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
                            class="appearance-none border border-black/50 rounded-full px-4 pr-8 py-3 text-sm focus:border-(--third-color) focus:outline-none cursor-pointer transition-all duration-200"
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
            <a class="flex items-center gap-1.5 px-4 py-3 bg-(--third-color) text-white rounded-lg hover:bg-(--second-color)"
                href="{{ route('employee-management.create') }}"><i class="size-5" data-lucide="user-plus"></i>Tambah
                Petugas</a>
        </div>

        <table class="table-fixed w-full text-left">
            <thead>
                <tr class="border-b border-gray-500/40 bg-black/10">
                    <th class="py-3 px-2 w-4/10">Nama Lengkap</th>
                    <th class="py-3 w-2/10">Username</th>
                    <th class="py-3 w-2/10">Email</th>
                    <th class="py-3 w-1/10">Posisi</th>
                    <th class="py-3 w-1/10">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-b border-gray-500/40 odd:bg-white even:bg-black/10">
                        <td class="py-3 px-2">{{ $user->nama_lengkap }}</td>
                        <td class="py-3">{{ $user->username }}</td>
                        <td class="py-3">{{ $user->email }}</td>
                        <td class="capitalize py-3">{{ $user->role }}</td>
                        <td class="flex py-3 gap-2">
                            <a class="mt-1.5" href="{{ route('employee-management.edit', $user->id) }}">
                                <i class="size-5" data-lucide="user-pen"></i>
                            </a>
                            <form onsubmit="return confirm('Yakin?')"
                                action="{{ route('employee-management.deactivate', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="mt-1.5 cursor-pointer" type="submit">
                                    <i class="size-5 stroke-red-600" data-lucide="trash-2"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-base text-gray-600 pt-5">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($users->hasPages())
            <div class="flex justify-center">
                {{ $users->links('components.pagination') }}
            </div>
        @endif
    </div>

    {{-- Detail Modal --}}
    <div id="detailModal" class="fixed inset-0 z-100">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick=""></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl py-4 z-10 animate-modal-in">
                <div class="flex justify-between items-center border-b border-black/20 pb-4 px-4">
                    <h1 class="text-xl font-medium">Detail Pengguna</h1>
                    <button class="p-1.5 rounded-full border border-black/20 cursor-pointer hover:border-black/50">
                        <i class="size-5" data-lucide="x"></i>
                    </button>
                </div>
                <div class="flex items-center px-4 mt-4 gap-4">
                    <div>
                        <img class="aspect-square w-15 object-cover rounded-full"
                            src="{{ asset('img/cover/cover-bumi.jpg') }}" alt="">
                    </div>
                    <div>
                        <h2 class="font-medium">Administrator</h2>
                        <h3 class="text-black/60 text-sm">admin@example.com</h3>
                    </div>
                </div>
                <div class="p-4">
                    <div class="border border-black/20 rounded-lg p-2">
                        <h2 class="font-medium border-b border-black/15 pb-1">Informasi Pengguna</h2>
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div class="flex justify-between">
                                <div class="flex items-center gap-1.5">
                                    <i class="size-4 stroke-black/60" data-lucide="user"></i>
                                    <p class="text-black/60 text-sm">Nama Lengkap:</p>
                                </div>
                                <p class="text-black">Administrator</p>
                            </div>
                            <div class="flex justify-between">
                                <div class="flex items-center gap-1.5">
                                    <i class="size-4 stroke-black/60" data-lucide="user"></i>
                                    <p class="text-black/60 text-sm">Username:</p>
                                </div>
                                <p class="text-black">Administrator</p>
                            </div>
                            <div class="flex justify-between">
                                <div class="flex items-center gap-1.5">
                                    <i class="size-4 stroke-black/60" data-lucide="mail"></i>
                                    <p class="text-black/60 text-sm">Email:</p>
                                </div>
                                <p class="text-black">Administrator</p>
                            </div>
                            <div class="flex justify-between">
                                <div class="flex items-center gap-1.5">
                                    <i class="size-4 stroke-black/60" data-lucide="phone"></i>
                                    <p class="text-black/60 text-sm">No. Handphone:</p>
                                </div>
                                <p class="text-black">Administrator</p>
                            </div>
                            <div class="flex justify-between">
                                <div class="flex items-center gap-1.5">
                                    <i class="size-4 stroke-black/60" data-lucide="briefcase"></i>
                                    <p class="text-black/60 text-sm">Posisi:</p>
                                </div>
                                <p class="text-black">Administrator</p>
                            </div>
                            <div class="flex justify-between">
                                <div class="flex items-center gap-1.5">
                                    <i class="size-4 stroke-black/60" data-lucide="map"></i>
                                    <p class="text-black/60 text-sm">Alamat:</p>
                                </div>
                                <p class="text-black">Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 space-y-2">
                    <h2 class="font-medium mb-4">Pinjaman Terakhir</h2>
                    <div class="relative flex items-center px-4 py-2 border border-black/15 gap-x-6">
                        <i class="size-4 stroke-black/50" data-lucide="book-up"></i>
                        <p class="absolute right-2 top-1 text-xs text-black/50">Pending</p>
                        <div>
                            <p class="text-sm">Laskar Pelangi</p>
                            <div class="flex gap-x-2">
                                <p class="text-xs text-black/50">Tanggal Peminjaman: 21-21-2022</p>
                                <p class="text-xs text-black/50">Tanggal Pengembalian: 21-21-2022</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.admin-dashboard>
