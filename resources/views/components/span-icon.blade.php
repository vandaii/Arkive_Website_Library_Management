@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'bg-(--third-color) p-1.5 rounded-md  text-white'
            : 'p-1.5 rounded-md group-hover:bg-(--third-color) group-hover:text-white  transition-all duration-300';
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
