{{-- resources/views/components/text-area.blade.php --}}
@props(['name', 'id', 'value' => ''])

<textarea {{ $attributes->merge(['name' => $name, 'id' => $id]) }}>{{ $value }}</textarea>