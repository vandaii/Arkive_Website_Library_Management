<x-layouts.user-dashboard>

    {{-- Profil Information --}}
    <div class="bg-white p-5 rounded-lg mb-8">
        <h1 class="text-2xl font-medium mb-8">Informasi Profil</h1>
        <form action="{{ route('profil.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Photo Profile --}}
            <div class="flex gap-8 mb-8">
                <div class="w-30">
                    @if (!empty(Auth::user()->photo_profile))
                        <img class="rounded-full aspect-square w-full object-cover"
                            src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="" id="img-preview">
                    @else
                        <img class="rounded-full aspect-square w-full object-cover" src="{{ asset('img/user.png') }}"
                            alt="" id="img-preview">
                    @endif
                </div>
                <div>
                    <label for="photo_profile" class="block text-sm/6 sm:text-base/6 font-medium text-gray-800">Ganti
                        Foto Profil</label>
                    <div class="mt-1">
                        <input id="photo_profile" value="{{ old('photo_profile') }}" accept="image/*" type="file"
                            name="photo_profile" autocomplete="photo_profile"
                            class="w-full cursor-pointer hover:file:text-black/80 rounded-md bg-black/5 text-base file:bg-gray-200 file:cursor-pointer file:text-black/60 file:py-1.5 file:px-3 file:border-r-2 file:border-r-gray-300 text-gray-800 outline-1 -outline-offset-1 outline-black/20
                                        @error('photo_profile') 
                                            input-error 
                                        @enderror"
                            onchange="previewImage(event)" />
                    </div>
                    @error('photo_profile')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-x-4 gap-y-2">
                {{-- Nama Lengkap --}}
                <div>
                    <label for="nama_lengkap" class="block text-sm/6 font-medium text-gray-800">Nama Lengkap</label>
                    <div class="mt-1">
                        <input id="nama_lengkap" placeholder="John Doe" value="{{ Auth::user()->nama_lengkap }}"
                            type="text" name="nama_lengkap" required autocomplete="nama_lengkap"
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
                            autocomplete="username" value="{{ Auth::user()->username }}"
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
                            value="{{ Auth::user()->email }}" required autocomplete="email"
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

                {{-- Alamat --}}
                <div>
                    <label for="alamat" class="block text-sm/6 font-medium text-gray-800">Alamat</label>
                    <div class="mt-1">
                        <input id="alamat" placeholder="Jakarta" value="{{ Auth::user()->alamat }}" type="text"
                            name="alamat" autocomplete="alamat"
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

                {{-- No. Handphone --}}
                <div>
                    <label for="phone_number" class="block text-sm/6 font-medium text-gray-800">No. Handphone</label>
                    <div class="mt-1">
                        <input id="phone_number" placeholder="0812xxxxxxxx" type="text" name="phone_number" required
                            autocomplete="phone_number" value="{{ Auth::user()->phone_number }}"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6
                                @error('phone_number') 
                                    input-error    
                                @enderror" />
                    </div>
                    @error('phone_number')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button
                    class=" px-4 py-3 bg-(--third-color) text-sm text-white font-medium rounded-lg hover:bg-(--second-color)">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="bg-white p-5 rounded-lg">
        <h1 class="text-2xl font-medium mb-8">Ganti Password</h1>
        <form action="{{ route('profil.changePassword', Auth::user()->id) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-2 gap-x-4 gap-y-2">
                {{-- Password --}}
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-800">Password</label>
                    </div>
                    <div class="mt-1">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6 @error('phone_number') 
                                    input-error    
                                @enderror" />
                    </div>
                    @error('phone_number')
                        <div class="">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password_confirmation"
                            class="block text-sm/6 font-medium text-gray-800">Konfirmasi
                            Password</label>
                    </div>
                    <div class="mt-1">
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6" />
                    </div>

                    <div class="flex justify-end mt-6">
                        <button
                            class=" px-4 py-3 bg-(--third-color) text-sm text-white font-medium rounded-lg hover:bg-(--second-color)">Ubah
                            Password</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function previewImage(event) {
            const preview = document.getElementById('img-preview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
                preview.classList.remove('bg-gray-200');
                preview.classList.remove('border-2');
                preview.classList.remove('h-50');
                preview.classList.add('h-auto');
            }

            reader.readAsDataURL(file);
        }
    </script>
</x-layouts.user-dashboard>
