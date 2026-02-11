@props([
    'type' => 'success',
    'dismissible' => true
])

@php
$typeClasses = match($type) {
    'success' => 'bg-green-50 border-green-200 text-green-800',
    'error' => 'bg-red-50 border-red-200 text-red-800',
    'warning' => 'bg-amber-50 border-amber-200 text-amber-800',
    'info' => 'bg-blue-50 border-blue-200 text-blue-800',
    default => 'bg-gray-50 border-gray-200 text-gray-800'
};
@endphp

<div class="px-4 sm:px-6 lg:px-8 mt-4" 
     @if($dismissible) x-data="{ show: true }" x-show="show" @endif>
    <div class="border {{ $typeClasses }} p-4 rounded-xl text-sm flex justify-between items-center">
        <p>{{ $slot }}</p>
        @if($dismissible)
            <button @click="show = false" class="ml-4 text-current hover:opacity-75 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        @endif
    </div>
</div>
