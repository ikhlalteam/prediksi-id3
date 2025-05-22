@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-black bg-gray-100'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-black hover:border-gray-300 hover:bg-gray-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
