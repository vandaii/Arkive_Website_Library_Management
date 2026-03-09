@props(['active'])

@php
    $classes =
        $active ?? false ? 'px-3 py-2 bg-indigo-500 rounded-lg text-white' : 'px-3 py-2 text-black/50 hover:text-black';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
