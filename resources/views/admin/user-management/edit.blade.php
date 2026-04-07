<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white px-10 py-8 rounded-lg">
        <div class="mb-10">
            <h1 class="capitalize text-2xl font-medium">{{ $title }}</h1>
        </div>

        <div>
            <form class="grid grid-cols-2 gap-5" action="{{ route('user-management.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Lengkap --}}
                <div>
                    <label for="nama_lengkap" class="block text-sm/6 font-medium text-gray-800">Nama Lengkap</label>
                    <div class="mt-1">
                        <input id="nama_lengkap" placeholder="John Doe"
                            value="{{ old('nama_lengkap', $user->nama_lengkap) }}" type="text" name="nama_lengkap"
                            required autocomplete="nama_lengkap"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6 
                                @error('nama_lengkap') 
                                    input-error 
                                @enderror" />
                    </div>
                    @error('nama_lengkap')
                        <div class="text-xs text-red-600 font-medium">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Username --}}
                <div>
                    <label for="username" class="block text-sm/6 font-medium text-gray-800">Username</label>
                    <div class="mt-1">
                        <input id="username" placeholder="johndoe33" type="text" name="username" required
                            autocomplete="username" value="{{ old('username', $user->username) }}"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6
                                @error('username') 
                                    input-error    
                                @enderror" />
                    </div>
                    @error('username')
                        <div class="text-xs text-red-600 font-medium">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-800">Email address</label>
                    <div class="mt-1">
                        <input id="email" type="email" name="email" placeholder="johndoe@example.com"
                            value="{{ old('email', $user->email) }}" required autocomplete="email"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6
                                @error('email')
                                    input-error
                                @enderror" />
                    </div>
                    @error('email')
                        <div class="text-xs text-red-600 font-medium">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div>
                    <label for="alamat" class="block text-sm/6 font-medium text-gray-800">Alamat</label>
                    <div class="mt-1">
                        <input id="alamat" placeholder="Jakarta" value="{{ old('alamat', $user->alamat) }}"
                            type="text" name="alamat" autocomplete="alamat"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6
                                @error('alamat')
                                    input-error
                                @enderror" />
                    </div>
                    @error('alamat')
                        <div class="text-xs text-red-600 font-medium">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- No.Handphone --}}
                <div>
                    <label for="phone_number" class="block text-sm/6 font-medium text-gray-800">No. Handphone</label>
                    <div class="mt-1">
                        <input id="phone_number" placeholder="Jakarta"
                            value="{{ old('phone_number', $user->phone_number) }}" type="text" name="phone_number"
                            autocomplete="phone_number"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6
                                @error('phone_number')
                                    input-error
                                @enderror" />
                    </div>
                    @error('phone_number')
                        <div class="text-xs text-red-600 font-medium">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label for="role" class="block text-sm/6 font-medium text-gray-800">Role</label>
                    <div class="mt-1">
                        <select
                            class="outline-2 w-full px-3 py-1.5 rounded-md focus:border-b-none -outline-offset-1 outline-black/70 bg-black/5 text-base  text-gray-800"
                            name="role" id="role">
                            <option class="outline-2 -outline-offset-1 outline-black/70" value="">Pilih Kategori
                            </option>
                            <option class="outline-2 -outline-offset-1 outline-black/70" value="admin"
                                {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option class="outline-2 -outline-offset-1 outline-black/70" value="peminjam"
                                {{ $user->role == 'peminjam' ? 'selected' : '' }}>Peminjam
                            </option>
                            <option class="outline-2 -outline-offset-1 outline-black/70" value="petugas"
                                {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-span-2 w-fit">
                    <div class="flex gap-x-5">
                        <button type="submit"
                            class="flex items-center gap-1.5 w-full rounded-md bg-(--third-color)  px-3 py-3 text-sm/6 font-semibold text-white hover:bg-(--second-color) hover:outline-1 hover:outline-(--second-color) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-200 capitalize">
                            <i class="size-5" data-lucide="user-pen"></i>
                            edit user</button>
                        <a href="{{ route('user-management.index') }}"
                            class="flex justify-center rounded-md bg-yellow-400 px-3 py-3 text-sm/6 font-semibold text-white hover:bg-yellow-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-200 capitalize">Kembali</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="bg-white px-10 py-8 rounded-lg mt-10">
        <form class="grid grid-cols-2 gap-5" action="{{ route('user-management.change-password', $user->id) }}"
            method="POST">
            @csrf
            @method('PATCH')

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm/6 font-medium text-gray-800">Password</label>
                <div class="mt-1">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6" />
                </div>
                @error('password')
                    <div class="text-xs text-red-600 font-medium">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-800">Konfirmasi
                    Password</label>
                <div class="mt-1">
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6" />
                </div>
            </div>

            <div class="col-span-2 w-fit">
                <div class="flex gap-x-5">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-(--third-color)  px-3 py-3 text-sm/6 font-semibold text-white hover:bg-(--second-color) hover:outline-1 hover:outline-(--second-color) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-200 capitalize">Ubah
                        Password</button>
                </div>
            </div>
        </form>
    </div>
</x-layouts.admin-dashboard>
