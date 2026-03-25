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
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                    <a href="">
                        <p class="text-lg/tight">{{ Auth::user()->username ?? 'User' }}</p>
                        <p class="text-sm/tight hover:underline">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                    </a>
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
