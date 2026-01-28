<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav>
        <ul class="flex justify-between space-x-15 px-20 py-5 mt-4 items-center">
            <li>
                <div class="flex space-x-10 text-lg w-5xl">
                    <h1 class="mt-1">Logo</h1>
                    <form action="" class="relative w-full">
                        <input type="search" name="search" id="search"
                            class="relative z-10 bg-transparent w-full h-10 rounded-full border outline-none cursor-pointer pl-16 pr-4 focus:border-indigo-500 focus:cursor-text focus:pl-16 focus:pr-4">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="absolute inset-y-0 my-auto h-8 w-12 px-3.5 stroke-gray-500 border-r border-gray-500/50"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </form>
                    <a class="mt-1" href="">Kategori</a>
                </div>
            </li>
            <li>
                <div class="mt-1 space-x-5">
                    <a class="py-1 px-4 text-indigo-500 outline-2 outline-indigo-500 rounded-lg text-center"
                        href="{{ route('register') }}">Register</a>
                    <a class="py-1 px-6 text-white bg-indigo-500 outline-2 outline-indigo-500 rounded-lg text-center"
                        href="{{ route('login') }}">Login</a>
                </div>
            </li>
        </ul>
    </nav>
</body>

</html>
