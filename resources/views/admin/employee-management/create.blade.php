<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white px-10 py-8 rounded-lg">
        <div class="mb-10">
            <h1 class="capitalize text-2xl font-medium">{{ $title }}</h1>
        </div>

        <div>
            <form class="grid grid-cols-2 gap-5" action="{{ route('employee-management.store') }}" method="POST">
                @csrf

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
                            autocomplete="username" value="{{ old('username') }}"
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
                            value="{{ old('email') }}" required autocomplete="email"
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

                {{-- Role --}}
                <div>
                    <label for="role" class="block text-sm/6 font-medium text-gray-800">Role</label>
                    <div class="mt-1">
                        <select
                            class="outline-1 w-full px-3 py-1.5 rounded-md focus:border-b-none -outline-offset-1 outline-black/60 bg-black/5 text-base  text-gray-800"
                            name="role" id="role">
                            <option class="outline-2 -outline-offset-1 outline-black/70" value="">Pilih Kategori
                            </option>
                            <option class="outline-2 -outline-offset-1 outline-black/70" value="admin">Admin</option>
                            <option class="outline-2 -outline-offset-1 outline-black/70" value="peminjam">Peminjam
                            </option>
                            <option class="outline-2 -outline-offset-1 outline-black/70" value="petugas">Petugas
                            </option>
                        </select>
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm/6 font-medium text-gray-800">Password</label>
                    <div class="mt-1">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="********"
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
                            placeholder="********"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6" />
                    </div>
                </div>

                <div class="col-span-2 w-fit">
                    <div class="flex gap-5">
                        <button type="submit"
                            class="flex items-center gap-1.5 w-full rounded-lg bg-(--third-color)  p-3 text-sm/6 font-medium text-white hover:bg-(--second-color)-700 hover:outline-1 hover:outline-(--second-color) focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-(--second-color) capitalize"><i
                                class="size-5" data-lucide="user-plus"></i>tambah petugas</button>

                        <a href="{{ route('employee-management.index') }}"
                            class="flex justify-center rounded-md bg-yellow-400 px-3 py-3 text-sm/6 font-medium text-white hover:bg-amber-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-200 capitalize">Kembali</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-layouts.admin-dashboard>
