@props(['active'])

@php
    $classes =
        $active ?? false ? 'py-2 font-medium' : 'py-2 text-black/50 hover:text-black  transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
