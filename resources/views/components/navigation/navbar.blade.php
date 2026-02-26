@if (Route::is('index') ||
        Route::is('book.show') ||
        Route::is('peminjaman.index') ||
        Route::is('peminjaman.riwayat-peminjaman'))
    <nav>
        <ul class="flex justify-between space-x-15 items-center">
            <li>
                <div class="flex space-x-10 text-lg w-6xl">
                    <div class="w-70">
                        <a href="{{ route('index') }}">
                            <h1 class="mt-1">Perpustakaan Saya</h1>
                        </a>
                    </div>
                    <form action="" class="relative w-full">
                        <x-search-input></x-search-input>
                    </form>
                    <a class="mt-1" href="">Kategori</a>
                    @if (Auth::check())
                        <a class="mt-1" href="{{ route('peminjaman.index') }}">Peminjaman</a>
                    @endif
                </div>
            </li>
            <li>
                <div class="space-x-5 items-center flex">
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
                        <a class="py-1 px-4 text-indigo-500 outline-2 outline-indigo-500 rounded-lg text-center"
                            href="{{ route('auth.register') }}">Register</a>
                        <a class="py-1 px-6 text-white bg-indigo-500 outline-2 outline-indigo-500 rounded-lg text-center"
                            href="{{ route('login') }}">Login</a>
                    @endif
                </div>
            </li>
        </ul>
    </nav>
@else
    <nav>
        <ul class="flex justify-between space-x-15 items-center">
            <li class="ml-65">
                <h1 class="capitalize">{{ __('dashboard ' . Auth::user()->role) }}</h1>
            </li>
            <li>
                <div class="space-x-5 flex">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                    <a href="">
                        <p class="text-lg/tight">{{ Auth::user()->username ?? 'User' }}</p>
                        <p class="text-sm/tight hover:underline">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
@endif
