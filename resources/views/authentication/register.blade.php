<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div class="flex items-center justify-center py-10 px-6 lg:px-16 overflow-y-auto h-screen">
        <div class="w-full max-w-md">
            <div class="mb-7">
                <h2 class="text-2xl font-medium tracking-tight">Register</h2>
                <p class="text-black/50 text-base">Mulai perjalanan membaca anda sekarang — ini gratis</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Nama Lengkap --}}
                <div>
                    <label for="nama_lengkap" class="text-sm font-medium">Nama Lengkap</label>
                    <div class="relative mt-1.5 text-gray-500 hover:text-black transition-all duration-100">
                        <i data-lucide="user" class="absolute left-3.5 top-1/2 -translate-y-1/2 size-4"></i>
                        <input id="nama_lengkap" placeholder="John Doe" value="{{ old('nama_lengkap') }}" type="text"
                            name="nama_lengkap" required autocomplete="nama_lengkap"
                            class="flex h-9 w-full min-w-0 px-3 py-1 text-base outline-1 outline-black/20 hover:outline-black transition-all duration-100 pl-10 rounded-md
                                @error('nama_lengkap') 
                                    input-error 
                                @enderror" />
                    </div>
                    @error('nama_lengkap')
                        <div class="text-red-500 font-medium text-sm">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Username --}}
                <div>
                    <label for="username" class="text-sm font-medium">Username</label>
                    <div class="relative mt-1.5 text-gray-500 hover:text-black transition-all duration-100">
                        <i data-lucide="user" class="absolute left-3.5 top-1/2 -translate-y-1/2 size-4"></i>
                        <input id="username" placeholder="johndoe33" type="text" name="username" required
                            autocomplete="username" value="{{ old('username') }}"
                            class="flex h-9 w-full min-w-0 px-3 py-1 text-base outline-1 outline-black/20 hover:outline-black transition-all duration-100 pl-10 rounded-md
                                @error('username') 
                                    input-error    
                                @enderror" />
                    </div>
                    @error('username')
                        <div class="text-red-500 font-medium text-sm">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="text-sm font-medium">Email address</label>
                    <div class="relative mt-1.5 text-gray-500 hover:text-black transition-all duration-100">
                        <i data-lucide="mail" class="absolute left-3.5 top-1/2 -translate-y-1/2 size-4"></i>
                        <input id="email" type="email" name="email" placeholder="johndoe@example.com"
                            value="{{ old('email') }}" required autocomplete="email"
                            class="flex h-9 w-full min-w-0 px-3 py-1 text-base outline-1 outline-black/20 hover:outline-black transition-all duration-100 pl-10 rounded-md
                                @error('email')
                                    input-error
                                @enderror" />
                    </div>
                    @error('email')
                        <div class="text-red-500 font-medium text-sm">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- No. Handphone --}}
                <div>
                    <label for="phone_number" class="text-sm font-medium">No. Handphone</label>
                    <div class="relative mt-1.5 text-gray-500 hover:text-black transition-all duration-100">
                        <i data-lucide="phone" class="absolute left-3.5 top-1/2 -translate-y-1/2 size-4"></i>
                        <input id="phone_number" placeholder="johndoe33" type="text" name="phone_number" required
                            autocomplete="phone_number" value="{{ old('phone_number') }}"
                            class="flex h-9 w-full min-w-0 px-3 py-1 text-base outline-1 outline-black/20 hover:outline-black transition-all duration-100 pl-10 rounded-md
                                @error('phone_number') 
                                    input-error    
                                @enderror" />
                    </div>
                    @error('phone_number')
                        <div class="text-red-500 font-medium text-sm">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-3">
                    {{-- Password --}}
                    <div>
                        <label for="password" class="text-sm font-medium">Password</label>
                        <div class="relative mt-1.5 text-gray-500 hover:text-black transition-all duration-100">
                            <i data-lucide="lock" class="absolute left-3.5 top-1/2 -translate-y-1/2 size-4"></i>
                            <input id="password" type="password" name="password" required
                                autocomplete="current-password" placeholder="********"
                                class="flex h-9 w-full min-w-0 px-3 py-1 text-base outline-1 outline-black/20 hover:outline-black transition-all duration-100 pl-10 rounded-md" />
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label for="password_confirmation" class="text-sm font-medium">Konfirmasi
                            Password</label>
                        <div class="relative mt-1.5 text-gray-500 hover:text-black transition-all duration-100">
                            <i data-lucide="lock" class="absolute left-3.5 top-1/2 -translate-y-1/2 size-4"></i>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                placeholder="********" required
                                class="flex h-9 w-full min-w-0 px-3 py-1 text-base outline-1 outline-black/20 hover:outline-black transition-all duration-100 pl-10 rounded-md" />
                        </div>
                    </div>
                    @error('password')
                        <div class="text-red-500 font-medium text-sm">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center items-center gap-x-2 rounded-full bg-(--third-color) px-3 py-2 text-sm font-medium text-(--primary-color) hover:bg-(--third-color)/90 transition-all duration-200">Register
                        <i data-lucide="arrow-right" class="size-4"></i></button>
                    <div class="mt-6 pt-5 border-t text-center border-black/15">
                        <p class="text-black/55 text-sm">Sudah punya akun? <a href="{{ route('login') }}"
                                class="text-(--third-color) hover:underline text-sm font-medium">Login</a>
                        </p>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('index') }}"
                            class="text-sm text-black/35 flex justify-center items-center gap-x-2"><i
                                data-lucide="move-left" class="size-3"></i>Kembali ke beranda</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
