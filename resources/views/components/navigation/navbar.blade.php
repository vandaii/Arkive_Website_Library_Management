@if (Route::is('index') || Route::is('book.show'))
    <nav>
        <ul class="flex justify-between space-x-15 items-center">
            <li>
                <div class="flex space-x-10 text-lg w-6xl">
                    <div class="w-53">
                        <a href="{{ route('index') }}">
                            <h1 class="mt-1">Perpustakaan Saya</h1>
                        </a>
                    </div>
                    <form action="" class="relative w-full">
                        <x-search-input></x-search-input>
                    </form>
                    <a class="mt-1" href="">Kategori</a>
                    <a class="hidden mt-1" href="">Peminjaman</a>
                </div>
            </li>
            <li>
                <div class="space-x-5">
                    <a class="py-1 px-4 text-indigo-500 outline-2 outline-indigo-500 rounded-lg text-center"
                        href="{{ route('register') }}">Register</a>
                    <a class="py-1 px-6 text-white bg-indigo-500 outline-2 outline-indigo-500 rounded-lg text-center"
                        href="{{ route('login') }}">Login</a>
                    <a class="hidden" href="">
                        <p class="text-lg/tight">User</p>
                        <p class="text-sm/tight hover:underline">user@example.com</p>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
@else
    <nav>
        <ul class="flex justify-between space-x-15 items-center">
            <li class="ml-65">
                <h1>Admin Dashboard</h1>
            </li>
            <li>
                <div class="space-x-5">
                    <a href="">
                        <p class="text-lg/tight">User</p>
                        <p class="text-sm/tight hover:underline">user@example.com</p>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
@endif
