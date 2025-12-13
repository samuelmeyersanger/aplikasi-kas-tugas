{{-- resources/views/components/card.blade.php --}}
@props(['class'])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ' . ($class ?? '')]) }}>
    {{ $slot }}
</div>