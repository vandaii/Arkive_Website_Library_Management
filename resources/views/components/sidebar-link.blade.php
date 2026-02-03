@props(['active'])

@php
    $classes = $active ?? false ? 'p-3 bg-indigo-500 rounded-lg text-white' : 'p-3 text-black/50 hover:text-black';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
