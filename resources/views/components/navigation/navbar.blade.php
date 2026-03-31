<nav class="container mx-auto px-4 py-3 bg-white">
    <ul class="flex items-center justify-between">
        <li class="mr-36">
            <a class="flex items-center gap-x-2 text-xl font-medium" href="{{ route('index') }}">
                <img class="h-10" src="{{ asset('img/logo-arkive.png') }}" alt="logo arkive">
                <h1 class="text-(--logo-color)">Arkive</h1>
            </a>
        </li>
        @if (Route::is('book.show') ||
                Route::is('peminjaman.index') ||
                Route::is('peminjaman.riwayat-peminjaman') ||
                Route::is('peminjaman.show') ||
                Route::is('user.index'))
            <li class="w-full">
                <form action="" method="get">
                    <x-search-input></x-search-input>
                </form>
            </li>
        @elseif (!Route::is('index'))
            <li class="w-full">
                <h1 class="capitalize font-medium">{{ __('dashboard ' . Auth::user()->role) }}</h1>
            </li>
        @endif
        <li>
            <div class="flex items-center gap-1.5">
                @if (Auth::check())
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
                            class="absolute opacity-0 -left-15 invisible top-10 mt-3 w-30 flex flex-col gap-y-3 shadow-lg p-4 border border-gray-300 rounded-lg bg-white group-hover:opacity-100 group-hover:visible transition-all ease-out duration-300">
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
                    <a hidden class="py-1 px-4 text-indigo-500 outline-2 outline-indigo-500 rounded-lg text-center"
                        href="{{ route('auth.register') }}">Register</a>
                    <a hidden
                        class="py-1 px-6 text-white bg-indigo-500 outline-2 outline-indigo-500 rounded-lg text-center"
                        href="{{ route('login') }}">Login</a>
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
