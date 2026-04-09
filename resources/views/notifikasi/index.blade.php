<x-layouts.user-dashboard>
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-medium">Notifikasi</h1>
                <p class="text-black/50 text-sm mt-1">Kelola semua notifikasi Anda</p>
            </div>
            <div class="flex items-center gap-3">
                @if ($notifikasis->where('is_read', true)->count() > 0)
                    <form action="{{ route('notifikasi.destroy-all') }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus semua notifikasi yang sudah dibaca?')">
                        @csrf
                        @method('DELETE')
                        <button
                            class="flex items-center gap-2 text-sm font-medium text-red-500 hover:text-red-600 transition-colors cursor-pointer">
                            <i class="size-4" data-lucide="trash-2"></i>Hapus Sudah Dibaca
                        </button>
                    </form>
                @endif

                @if ($notifikasis->where('is_read', false)->count() > 0)
                    <form action="{{ route('notifikasi.read-all') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button
                            class="flex items-center gap-2 text-sm font-medium text-(--third-color) hover:text-(--second-color) transition-colors cursor-pointer">
                            <i class="size-4" data-lucide="check-check"></i>Tandai Semua Dibaca
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="flex flex-col gap-3">
            @forelse ($notifikasis as $notifikasi)
                <div
                    class="group flex items-start gap-4 p-5 rounded-2xl transition-all duration-200 {{ $notifikasi->is_read ? 'bg-white' : 'bg-white ring-1 ring-(--third-color)/20' }}">

                    {{-- Icon berdasarkan tipe --}}
                    <div
                        class="flex items-center justify-center w-10 h-10 rounded-full shrink-0 {{ $notifikasi->is_read ? 'bg-gray-100' : 'bg-(--third-color)/10' }}">
                        @switch($notifikasi->tipe)
                            @case('success')
                                <i class="size-5 {{ $notifikasi->is_read ? 'text-gray-400' : 'text-green-500' }}"
                                    data-lucide="check-circle"></i>
                            @break

                            @case('warning')
                                <i class="size-5 {{ $notifikasi->is_read ? 'text-gray-400' : 'text-yellow-500' }}"
                                    data-lucide="alert-triangle"></i>
                            @break

                            @case('error')
                                <i class="size-5 {{ $notifikasi->is_read ? 'text-gray-400' : 'text-red-500' }}"
                                    data-lucide="alert-circle"></i>
                            @break

                            @default
                                <i class="size-5 {{ $notifikasi->is_read ? 'text-gray-400' : 'text-(--third-color)' }}"
                                    data-lucide="bell"></i>
                        @endswitch
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h2
                                    class="font-semibold text-sm {{ $notifikasi->is_read ? 'text-black/50' : 'text-black' }}">
                                    {{ $notifikasi->judul }}</h2>
                                <p class="text-sm {{ $notifikasi->is_read ? 'text-black/40' : 'text-black/60' }} mt-0.5">
                                    {{ $notifikasi->pesan }}</p>
                            </div>
                            @if (!$notifikasi->is_read)
                                <div class="w-2.5 h-2.5 rounded-full bg-(--third-color) shrink-0 mt-1.5"></div>
                            @endif
                        </div>
                        <div class="flex items-center gap-4 mt-2">
                            <span class="text-xs text-black/30">{{ $notifikasi->created_at->diffForHumans() }}</span>

                            @if (!$notifikasi->is_read)
                                <form action="{{ route('notifikasi.read', $notifikasi->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        class="text-xs text-(--third-color) hover:text-(--second-color) font-medium cursor-pointer">Tandai
                                        Dibaca</button>
                                </form>
                            @else
                                <form action="{{ route('notifikasi.destroy', $notifikasi->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus notifikasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="text-xs text-red-400 hover:text-red-500 font-medium cursor-pointer flex items-center gap-1">
                                        <i class="size-3" data-lucide="trash-2"></i>Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-20 bg-white rounded-2xl">
                    <i class="size-16 text-black/10 mb-4" data-lucide="bell-off"></i>
                    <h2 class="text-lg font-medium text-black/40">Belum ada notifikasi</h2>
                    <p class="text-sm text-black/30 mt-1">Notifikasi baru akan muncul di sini</p>
                </div>
            @endforelse
        </div>

        @if ($notifikasis->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $notifikasis->links('components.pagination') }}
            </div>
        @endif
    </div>
</x-layouts.user-dashboard>
