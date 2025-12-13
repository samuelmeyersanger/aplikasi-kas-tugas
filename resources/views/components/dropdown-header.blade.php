{{-- resources/views/components/dropdown-header.blade.php --}}
@props(['align' => 'right'])

{{--
    Komponen untuk menampilkan judul di dalam dropdown.
--}}
<div {{ $attributes->merge(['class' => 'block px-4 py-2 text-xs text-gray-700 dark:text-gray-300 uppercase tracking-wider']) }}>
    {{ $slot }}
</div>