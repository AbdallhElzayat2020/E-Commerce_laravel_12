@php
    $isActive = $category->status === 'active';
@endphp
<span class="badge {{ $isActive ? 'badge-success' : 'badge-danger' }}">
    {{ $isActive ? __('dashboard.active') : __('dashboard.inactive') }}
</span>
