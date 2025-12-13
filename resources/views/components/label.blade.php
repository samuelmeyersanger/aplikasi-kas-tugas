{{-- resources/views/components/label.blade.php --}}
@props(['for', 'value'])

<label {{ $attributes->merge(['for' => $for ?? null]) }}>{{ $value }}</label>