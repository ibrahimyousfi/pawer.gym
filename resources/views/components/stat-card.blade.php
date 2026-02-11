@props([
    'label',
    'value',
    'color' => 'blue',
    'subtitle' => null
])

@php
$iconColors = match($color) {
    'emerald' => 'text-green-600',
    'red' => 'text-red-600',
    'orange' => 'text-orange-600',
    'blue' => 'text-blue-600',
    'purple' => 'text-purple-600',
    default => 'text-blue-600'
};
@endphp

<div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-600">{{ $label }}</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $value }}</p>
            @if($subtitle)
                <p class="text-xs text-gray-500 mt-1">{{ $subtitle }}</p>
            @endif
        </div>
        @isset($icon)
            <div class="{{ $iconColors }}">
                {{ $icon }}
            </div>
        @endisset
    </div>
</div>
