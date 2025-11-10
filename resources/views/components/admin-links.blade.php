@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block py-2 px-4 pt-2 border-b-2 border-gray-400 text-sm font-semibold leading-5 text-gray-900 focus:outline-none focus:border-gray-700 transition duration-150 ease-in-out'
            : 'block py-2 px-4 pt-2 border-b-2 border-transparent text-sm font-semibold leading-5 text-gray-900 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
