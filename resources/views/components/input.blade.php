{{-- resources/views/components/input.blade.php --}}
@props(['name', 'id', 'label', 'type' => 'text', 'value' => ''])

{{-- Jika ada properti 'label', tampilkan label terlebih dahulu --}}
@isset($label)
    <x-label :for="$id ?? $name" :value="$label" />
@endisset

{{-- Tampilkan field input --}}
<input 
    {{ $attributes->merge(['type' => $type, 'name' => $name, 'id' => $id ?? $name, 'value' => $value]) }}
    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"
>