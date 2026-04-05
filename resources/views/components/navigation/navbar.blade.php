<nav class="w-full mx-auto px-4 py-3 bg-white">
    <ul class="flex items-center justify-between">
        <li class="mr-36">
            <a class="flex items-center gap-x-2 text-xl font-medium" href="{{ route('index') }}">
                <img class="h-10" src="{{ asset('img/logo-arkive.png') }}" alt="logo arkive">
                <h1 class="text-(--logo-color)">Arkive</h1>
            </a>
        </li>
        @if (Route::is([
                'book.show',
                'peminjaman.index',
                'peminjaman.riwayat-peminjaman',
                'peminjaman.show',
                'user.index',
                'peminjaman.detailRiwayat',
                'koleksi.index',
                'search.buku',
            ]))
            <li class="w-full">
                <form action="{{ route('search.buku') }}" method="get">
                    <x-search-input class="w-10/12"></x-search-input>
                </form>
            </li>
        @elseif (!Route::is(['index', 'profil.index', 'notifikasi.index']))
            <li class="w-full">
                <h1 class="capitalize font-medium">{{ __('dashboard ' . Auth::user()->role) }}</h1>
            </li>
        @endif
        <li>
            <div class="flex items-center gap-1.5">
                @if (Auth::check())
                    {{-- Notification Bell --}}
                    <div class="relative group/notif">
                        <a href="{{ route('notifikasi.index') }}"
                            class="relative flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 transition-all duration-200">
                            <i class="size-5 text-black/60" data-lucide="bell"></i>
                            @if (($unreadNotifCount ?? 0) > 0)
                                <span
                                    class="absolute -top-0.5 -right-0.5 flex items-center justify-center min-w-5 h-5 text-[10px] font-bold text-white bg-red-500 rounded-full px-1 shadow-sm">
                                    {{ $unreadNotifCount > 99 ? '99+' : $unreadNotifCount }}
                                </span>
                            @endif
                        </a>

                        {{-- Dropdown Notifikasi --}}
                        <div
                            class="absolute right-0 top-12 w-80 bg-white rounded-2xl shadow-2xl border border-black/5 opacity-0 invisible group-hover/notif:opacity-100 group-hover/notif:visible transition-all duration-300 z-50">
                            <div class="p-4 border-b border-black/5">
                                <div class="flex items-center justify-between">
                                    <h3 class="font-semibold text-sm">Notifikasi</h3>
                                    @if (($unreadNotifCount ?? 0) > 0)
                                        <span
                                            class="text-xs bg-(--third-color)/10 text-(--third-color) px-2 py-0.5 rounded-full font-medium">{{ $unreadNotifCount }}
                                            baru</span>
                                    @endif
                                </div>
                            </div>
                            <div class="max-h-72 overflow-y-auto">
                                @forelse (($latestNotifikasi ?? collect()) as $notif)
                                    <form action="{{ route('notifikasi.read', $notif->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition-colors {{ !$notif->is_read ? 'bg-(--third-color)/5' : '' }}">
                                            <div
                                                class="flex items-center justify-center w-8 h-8 rounded-full shrink-0 mt-0.5
                                                {{ !$notif->is_read ? 'bg-(--third-color)/10' : 'bg-gray-100' }}">
                                                @switch($notif->tipe)
                                                    @case('success')
                                                        <i class="size-4 text-green-500" data-lucide="check-circle"></i>
                                                    @break

                                                    @case('warning')
                                                        <i class="size-4 text-yellow-500" data-lucide="alert-triangle"></i>
                                                    @break

                                                    @case('error')
                                                        <i class="size-4 text-red-500" data-lucide="alert-circle"></i>
                                                    @break

                                                    @default
                                                        <i class="size-4 text-(--third-color)" data-lucide="bell"></i>
                                                @endswitch
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p
                                                    class="text-xs font-semibold text-start {{ !$notif->is_read ? 'text-black' : 'text-black/50' }} line-clamp-1">
                                                    {{ $notif->judul }}</p>
                                                <p
                                                    class="text-[11px] text-start {{ !$notif->is_read ? 'text-black/60' : 'text-black/40' }} line-clamp-2 mt-0.5">
                                                    {{ $notif->pesan }}</p>
                                                <p class="text-[10px] text-start text-black/30 mt-1">
                                                    {{ $notif->created_at->diffForHumans() }}</p>
                                            </div>
                                            @if (!$notif->is_read)
                                                <div class="w-2 h-2 rounded-full bg-(--third-color) shrink-0 mt-2">
                                                </div>
                                            @endif
                                        </button>
                                    </form>
                                    @empty
                                        <div class="px-4 py-8 text-center">
                                            <i class="size-8 text-black/10 mx-auto mb-2" data-lucide="bell-off"></i>
                                            <p class="text-xs text-black/30">Belum ada notifikasi</p>
                                        </div>
                                    @endforelse
                                </div>
                                <a href="{{ route('notifikasi.index') }}"
                                    class="block text-center text-xs font-medium text-(--third-color) hover:text-(--second-color) py-3 border-t border-black/5 transition-colors">
                                    Lihat Semua Notifikasi
                                </a>
                            </div>
                        </div>

                        {{-- User Profile --}}
                        <div class="group relative flex items-center gap-x-1">
                            <a class="flex items-center gap-2" href="{{ route('profil.index') }}">
                                @if (empty(Auth::user()->photo_profile))
                                    <img class="aspect-square w-10 rounded-full object-cover"
                                        src="{{ asset('img/user.png') }}" alt="photo_profile">
                                @else
                                    <img class="aspect-square w-10 rounded-full object-cover"
                                        src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="photo_profile">
                                @endif
                            </a>
                            <i class="size-5 group-hover:rotate-180 transition-all duration-300"
                                data-lucide="chevron-down"></i>
                            <div
                                class="absolute opacity-0 -left-20 invisible top-10 mt-3 w-30 flex flex-col gap-y-3 shadow-2xl p-4 rounded-lg bg-white group-hover:opacity-100 group-hover:visible transition-all ease-out duration-300">
                                <a class="text-black/80 hover:text-black" href="{{ route('profil.index') }}">Profil</a>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button
                                        class="text-red-600/80 hover:text-red-600 flex items-center gap-x-2 cursor-pointer"
                                        type="submit"><i data-lucide="log-out"
                                            class="text-red-600/80 hover:text-red-600  rotate-180 size-4"></i>Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a class="whitespace-nowrap text-base font-medium transition-all outline-none px-4 py-2"
                            href="{{ route('auth.register') }}">Register</a>
                        <a class="whitespace-nowrap text-base font-medium transition-all bg-(--third-color) text-(--primary-color) hover:bg-(--third-color)/90 px-5 py-2 rounded-full"
                            href="{{ route('login') }}">Login</a>
                    @endif
                </div>
            </li>
        </ul>
    </nav>
