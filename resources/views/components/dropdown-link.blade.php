{{-- resources/views/components/dropdown-link.blade.php --}}
@props(['href' => '#'])

{{--
    Komponen untuk tautan di dalam dropdown.
    Jika href null, akan merender sebagai <button>.
--}}
@if (is_null($href))
    <button {{ $attributes->merge(['type' => 'button', 'class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out']) }}>
        {{ $slot }}
    </button>
@else
    <a {{ $attributes->merge(['href' => $href, 'class' => 'block px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out']) }}>
        {{ $slot }}
    </a>
@endif