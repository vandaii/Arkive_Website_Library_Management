<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="ml-45 bg-white px-10 py-8 rounded-lg">
        <div class="mb-10">
            <h1 class="capitalize text-xl">{{ $title }}</h1>
        </div>

        <div>
            <form class="grid grid-cols-2 gap-5" action="">

                {{-- Nama Lengkap --}}
                <div>
                    <label for="nama_lengkap" class="block text-sm/6 font-medium text-gray-800">Nama Lengkap</label>
                    <div class="mt-1">
                        <input id="nama_lengkap" placeholder="John Doe" value="{{ old('nama_lengkap') }}" type="text"
                            name="nama_lengkap" required autocomplete="nama_lengkap"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6 
                                @error('nama_lengkap') 
                                    input-error 
                                @enderror" />
                    </div>
                    @error('name')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Username --}}
                <div>
                    <label for="username" class="block text-sm/6 font-medium text-gray-800">Username</label>
                    <div class="mt-1">
                        <input id="username" placeholder="johndoe33" type="text" name="username" required
                            autocomplete="username" value="{{ old('username') }}"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6
                                @error('username') 
                                    input-error    
                                @enderror" />
                    </div>
                    @error('username')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-800">Email address</label>
                    <div class="mt-1">
                        <input id="email" type="email" name="email" placeholder="johndoe@example.com"
                            value="{{ old('email') }}" required autocomplete="email"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6
                                @error('email')
                                    input-error
                                @enderror" />
                    </div>
                    @error('email')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-800">Password</label>
                    </div>
                    <div class="mt-1">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6" />
                    </div>
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-800">Konfirmasi
                            Password</label>
                    </div>
                    <div class="mt-1">
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6" />
                    </div>
                </div>

                {{-- Alamat --}}
                <div>
                    <label for="alamat" class="block text-sm/6 font-medium text-gray-800">Alamat</label>
                    <div class="mt-1">
                        <input id="alamat" placeholder="Jakarta" value="{{ old('alamat') }}" type="text"
                            name="alamat" required autocomplete="alamat"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6
                                @error('alamat')
                                    input-error
                                @enderror" />
                    </div>
                    @error('alamat')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="col-span-2 w-fit">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-500  px-3 py-3 text-sm/6 font-semibold text-white hover:bg-indigo-700 hover:outline-1 hover:outline-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-200 capitalize">tambah
                        user</button>
                </div>

            </form>
        </div>
    </div>
</x-layouts.admin-dashboard>
