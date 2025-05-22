@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-sm font-medium text-black bg-gray-100'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-black hover:border-gray-300 hover:bg-gray-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
