{{-- resources/views/components/textarea.blade.php --}}
@props(['name', 'id', 'value' => ''])

<textarea 
    {{ $attributes->merge(['name' => $name, 'id' => $id]) }} 
    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm"
>{{ $value }}</textarea>