<div class="flex items-center">
    @php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-3 py-2 | bg-gray-900 | text-sm font-medium leading-5 text-white | rounded-md focus:outline-none | transition duration-150 ease-in-out'
                : 'inline-flex items-center px-3 py-2 | hover:bg-gray-700 | text-sm font-medium leading-5 text-gray-300 | rounded-md focus:outline-none | transition duration-150 ease-in-out';
    @endphp

    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>


</div>