{{-- resources/views/components/responsive-nav-link.blade.php --}}
@props(['href' => '#', 'active' => false])

{{--
    Komponen untuk tautan di menu navigasi mobile.
    Menangani status aktif dengan gaya berbeda.
--}}
@if ($href === '#')
    <button {{ $attributes->merge(['type' => 'button', 'class' => (
            'flex items-center w-full px-4 py-2 text-base font-medium text-start ' .
            ($active
                ? 'text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/50 border-r-4 border-indigo-500'
                : 'text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900')
        ) . ' focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 dark:focus:bg-gray-900 transition duration-150 ease-in-out'
    ]) }}>
        {{ $slot }}
    </button>
@else
    <a {{ $attributes->merge(['href' => $href, 'class' => (
            'flex items-center w-full px-4 py-2 text-base font-medium ' .
            ($active
                ? 'text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/50 border-r-4 border-indigo-500'
                : 'text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900')
        ) . ' focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 dark:focus:bg-gray-900 transition duration-150 ease-in-out'
    ]) }}>
        {{ $slot }}
    </a>
@endif