@props([
    'status',
    'type' => 'member'
])

@php
$statusConfig = match($status) {
    'Active', 'active' => [
        'label' => 'Active',
        'classes' => 'bg-green-100 text-green-800'
    ],
    'Expired', 'expired' => [
        'label' => 'Expired',
        'classes' => 'bg-red-100 text-red-800'
    ],
    'Inactive', 'inactive' => [
        'label' => 'Inactive',
        'classes' => 'bg-gray-200 text-gray-800'
    ],
    'Pending', 'pending' => [
        'label' => 'Pending',
        'classes' => 'bg-amber-100 text-amber-800'
    ],
    default => [
        'label' => ucfirst($status),
        'classes' => 'bg-gray-200 text-gray-800'
    ]
};
@endphp

<span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusConfig['classes'] }}">
    {{ $statusConfig['label'] }}
</span>
