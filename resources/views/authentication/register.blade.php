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

<body class="bg-indigo-500"
    style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif">

    <div class="flex justify-center items-center h-screen">
        <div class="flex flex-col w-full sm:w-100 justify-center py-8 px-6 lg:px-8 bg-white rounded-2xl">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-2 mb-10 text-center text-2xl/9 font-bold tracking-tight">Register</h2>
            </div>

            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <form action="#" method="POST" class="space-y-4">
                    <div>
                        <label for="namaLengkap" class="block text-sm/6 font-medium text-gray-800">Nama Lengkap</label>
                        <div class="mt-2">
                            <input id="namaLengkap" type="text" name="namaLengkap" required
                                autocomplete="namaLengkap"
                                class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6" />
                        </div>
                    </div>

                    <div>
                        <label for="username" class="block text-sm/6 font-medium text-gray-800">Username</label>
                        <div class="mt-2">
                            <input id="username" type="email" name="username" required autocomplete="username"
                                class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6" />
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm/6 font-medium text-gray-800">Email address</label>
                        <div class="mt-2">
                            <input id="email" type="email" name="email" required autocomplete="email"
                                class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6" />
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm/6 font-medium text-gray-800">Password</label>
                        </div>
                        <div class="mt-2">
                            <input id="password" type="password" name="password" required
                                autocomplete="current-password"
                                class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6" />
                        </div>
                    </div>

                    <div>
                        <label for="alamat" class="block text-sm/6 font-medium text-gray-800">Alamat</label>
                        <div class="mt-2">
                            <input id="alamat" type="text" name="alamat" required autocomplete="alamat"
                                class="block w-full rounded-md bg-black/5 px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-black/20 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-black/70 sm:text-sm/6" />
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-indigo-500  px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-transparent hover:outline-1 hover:outline-indigo-500 hover:text-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-200">Register</button>
                        <p class="text-sm text-center mt-4">Sudah punya akun? <a href="{{ route('login') }}"
                                class="text-indigo-500 hover:text-indigo-800 hover:underline">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
