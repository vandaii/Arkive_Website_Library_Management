<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-500/10">
    <header class="px-10 sticky top-0 bg-white py-5 shadow-md">
        <x-navigation.navbar></x-navigation.navbar>
    </header>

    <main class="px-30 mt-5">
        {{ $slot }}
    </main>
</body>

</html>
