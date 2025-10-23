@php
    // Assuming $row is passed to this view (as it usually is in DataTables partials)
    $status = $row->status ?? 'inactive';
@endphp

@if ($status === 'active')
    <span class="badge badge-success">{{ __('dashboard.active') }}</span>
@else
    <span class="badge badge-danger">{{ __('dashboard.inactive') }}</span>
@endif
