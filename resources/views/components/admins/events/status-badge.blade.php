{{-- resources/views/components/admins/events/status-badge.blade.php --}}
{{-- 'pending', 'approved', 'cancelled', 'completed' --}}
@props(['status'])

@php
    $classes = [
        'pending' => 'bg-warning text-white',
        'approved' => 'bg-success text-white',
        'cancelled' => 'bg-danger text-white',
        'completed' => 'bg-primary text-white',
    ];
@endphp

<span class="px-2 py-1 rounded-md {{ $classes[(string) $status] ?? 'bg-secondary text-white' }}">
    {{ ucfirst($status) }}
</span>
