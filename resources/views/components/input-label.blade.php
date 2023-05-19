@props(['value'])

<label {{ $attributes->merge(['class' => 'mb-2 inline-block text-sm text-gray-800 sm:text-base']) }}>
    {{ $value ?? $slot }}
</label>
