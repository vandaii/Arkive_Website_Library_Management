<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white px-10 py-8 rounded-lg">

        <div class="mb-10">
            <h1 class="capitalize text-2xl font-medium">{{ __($title) }}</h1>
        </div>

        <div class="flex justify-between items-center mb-5">
            <form class="relative w-1/2" action="{{ route('ulasan.index') }}" method="GET">
                <x-search-input></x-search-input>
            </form>
        </div>

        <table class="table-fixed w-full text-left">
            <thead>
                <tr class="border-b border-gray-500/40 bg-black/5">
                    <th class="py-3 px-2 w-2/12">Pengguna</th>
                    <th class="py-3 w-3/12">Judul Buku</th>
                    <th class="py-3 w-1/12">Rating</th>
                    <th class="py-3 w-4/12">Ulasan</th>
                    <th class="py-3 w-2/12">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ulasans as $ulasan)
                    <tr class="border-b border-gray-500/40 odd:bg-white even:bg-black/5 hover:bg-blue-50/50 transition-colors duration-150">
                        <td class="py-3 px-2">
                            <div class="flex items-center gap-2">
                                @if (!empty($ulasan->user->photo_profile))
                                    <img class="w-8 h-8 rounded-full object-cover shrink-0" src="{{ asset('storage/' . $ulasan->user->photo_profile) }}" alt="Avatar">
                                @else
                                    <img class="w-8 h-8 rounded-full object-cover shrink-0" src="{{ asset('img/user.png') }}" alt="Avatar">
                                @endif
                                <span class="truncate text-sm">{{ $ulasan->user->nama_lengkap ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="py-3">
                            <p class="font-medium text-sm line-clamp-1">{{ $ulasan->buku->judul ?? '-' }}</p>
                            <p class="text-xs text-black/40">{{ $ulasan->buku->penulis ?? '' }}</p>
                        </td>
                        <td class="py-3">
                            <div class="flex items-center gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="size-3.5 stroke-0 {{ $i <= $ulasan->rating ? 'fill-amber-400' : 'fill-black/15' }}" data-lucide="star"></i>
                                @endfor
                            </div>
                        </td>
                        <td class="py-3">
                            <p class="text-sm text-black/70 line-clamp-2">{{ $ulasan->ulasan }}</p>
                        </td>
                        <td class="py-3 text-sm text-black/50">
                            {{ $ulasan->created_at ? $ulasan->created_at->format('d M Y') : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 pt-8 pb-4">
                            <i class="size-12 mx-auto mb-2 text-gray-300" data-lucide="message-square"></i>
                            <p>Tidak ada data ulasan</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($ulasans->hasPages())
            <div class="flex justify-center mt-4">
                {{ $ulasans->links('components.pagination') }}
            </div>
        @endif
    </div>
</x-layouts.admin-dashboard>
