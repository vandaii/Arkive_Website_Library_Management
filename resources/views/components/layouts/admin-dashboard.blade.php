<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-(--primary-color)">
    <header class="sticky top-0 z-50">
        <x-navigation.navbar></x-navigation.navbar>
    </header>

    <aside class="fixed top-10 left-0">
        <x-navigation.sidebar></x-navigation.sidebar>
    </aside>

    <main class="px-30 mt-5 w-full">
        {{ $slot }}
    </main>

    <x-toast />
</body>

</html>
