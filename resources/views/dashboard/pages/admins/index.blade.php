@extends('dashboard.layouts.master')
@section('title', __('dashboard_admins.title'))
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">
                <i class="la la-users"></i> {{ __('dashboard_admins.title') }}
            </h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.home') }}">
                                <i class="la la-home"></i> Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('dashboard.admins.index') }}">{{ __('dashboard_admins.labels.admin') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <!-- Basic form layout section start -->
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <h5 class="mb-1 text-primary">
                                            <i class="la la-list"></i> {{ __('dashboard_admins.title') }}
                                        </h5>
                                    </div>
                                    <a href="{{ route('dashboard.admins.create') }}"
                                       class="btn btn-primary btn-lg shadow-sm">
                                        <i class="la la-plus"></i> {{ __('dashboard_admins.buttons.add_new') }}
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th class="border-0">
                                            <i class="la la-hashtag text-primary"></i> #
                                        </th>
                                        <th class="border-0">
                                            <i class="la la-user text-primary"></i>
                                            {{ __('dashboard_admins.table.name') }}
                                        </th>
                                        <th class="border-0">
                                            <i class="la la-envelope text-primary"></i>
                                            {{ __('dashboard_admins.table.email') }}
                                        </th>
                                        <th class="border-0">
                                            <i class="la la-shield text-primary"></i>
                                            {{ __('dashboard_admins.table.role') }}
                                        </th>
                                        <th class="border-0">
                                            <i class="la la-toggle-on text-primary"></i>
                                            {{ __('dashboard_admins.table.status') }}
                                        </th>
                                        <th class="border-0 text-center">
                                            <i class="la la-cogs text-primary"></i>
                                            {{ __('dashboard_admins.table.actions') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($admins as $index => $admin)
                                        <tr class="{{ $admin->id === 1 ? 'table-warning' : '' }} admin-row">
                                            <th scope="row" class="align-middle">
                                                <span class="badge badge-primary">{{ $index + 1 }}</span>
                                            </th>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    @if ($admin->id === 1)
                                                        <i class="la la-crown text-warning mr-3"
                                                           style="font-size: 20px;" title="Super Admin"></i>
                                                    @else
                                                        <i class="la la-user text-primary mr-3"
                                                           style="font-size: 20px;"></i>
                                                    @endif
                                                    <div>
                                                            <span class="font-weight-bold text-dark"
                                                                  style="font-size: 16px;">
                                                                {{ $admin->name }}
                                                            </span>
                                                        @if ($admin->id === 1)
                                                            <span
                                                                class="badge badge-warning ml-2">{{ __('dashboard_admins.labels.super_admin') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-muted">{{ $admin->email }}</span>
                                            </td>
                                            <td class="align-middle">
                                                @if ($admin->role)
                                                    <span class="badge badge-primary">
                                                            {{ $admin->role->getTranslation('name', app()->getLocale()) }}
                                                        </span>
                                                @else
                                                    <span
                                                        class="badge badge-secondary">{{ __('dashboard_admins.labels.no_role') }}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                @if ($admin->id !== 1)
                                                    <a href="#" data-toggle="modal"
                                                       data-target="#statusChangeModal_{{ $admin->id }}"
                                                       class="btn btn-sm {{ $admin->status === 'active' ? 'btn-success' : 'btn-danger' }} shadow-sm"
                                                       title="{{ __('dashboard_admins.tooltips.change_status') }}">
                                                        <i
                                                            class="la la-toggle-{{ $admin->status === 'active' ? 'on' : 'off' }}"></i>
                                                        {{ $admin->status === 'active' ? __('dashboard_admins.status.active') : __('dashboard_admins.status.inactive') }}
                                                    </a>
                                                @else
                                                    <span
                                                        class="badge badge-success">{{ __('dashboard_admins.status.active') }}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="btn-group" role="group">
                                                    @if ($admin->id !== 1)
                                                        <a href="{{ route('dashboard.admins.edit', $admin->id) }}"
                                                           class="btn btn-primary btn-sm mr-1 shadow-sm"
                                                           title="{{ __('dashboard_admins.tooltips.edit') }}">
                                                            <i class="la la-edit"></i>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-secondary btn-sm mr-1" disabled
                                                                title="{{ __('dashboard_admins.tooltips.cannot_edit_super_admin') }}">
                                                            <i class="la la-lock"></i>
                                                        </button>
                                                    @endif

                                                    @if ($admin->id !== 1)
                                                        <a href="#" data-toggle="modal"
                                                           data-target="#deleteAdmin_{{ $admin->id }}"
                                                           class="btn btn-danger btn-sm shadow-sm"
                                                           title="{{ __('dashboard_admins.tooltips.delete') }}">
                                                            <i class="la la-trash"></i>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-secondary btn-sm" disabled
                                                                title="{{ __('dashboard_admins.tooltips.cannot_delete_super_admin') }}">
                                                            <i class="la la-lock"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        @if ($admin->id !== 1)
                                            @include('dashboard.pages.admins.delete', [
                                                'admin' => $admin,
                                            ])
                                            @include('dashboard.pages.admins.change_status', [
                                                'admin' => $admin,
                                            ])
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <div class="alert alert-warning border-0 shadow-sm"
                                                     style="border-radius: 12px;">
                                                    <i class="la la-exclamation-triangle" style="font-size: 24px;"></i>
                                                    <h5 class="mt-2 mb-1">
                                                        {{ __('dashboard_admins.labels.no_admins_found') }}</h5>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>

                                <div class="mx-2">
                                    {{ $admins->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

<style>
    :root {
        --primary: #007bff;
        --secondary: #6c757d;
        --success: #28a745;
        --danger: #dc3545;
        --warning: #ffc107;
        --info: #17a2b8;
        --light: #f8f9fa;
        --dark: #343a40;
        --ink: #2c3e50;
        --muted: #6c757d;
        --soft: #f8f9fa;
        --line: #e9ecef;
    }

    .table th {
        background: var(--soft);
        border-bottom: 1px solid var(--line);
        font-weight: 600;
        color: var(--muted);
        padding: 12px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: .02em;
    }

    .table td {
        vertical-align: middle;
        border-top: 1px solid var(--line);
        padding: 14px 12px;
        color: var(--ink);
    }

    .table-hover tbody tr:hover {
        background-color: #f6faff;
    }

    .admin-row {
        transition: background-color .2s ease
    }

    .badge {
        border-radius: 999px;
        font-weight: 600;
        padding: .35rem .6rem;
        font-size: 11px
    }

    .badge-success {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0
    }

    .badge-danger {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca
    }

    .badge-warning {
        background: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a
    }

    .badge-light-primary {
        background: #eef2ff;
        color: #3730a3;
        border: 1px solid #c7d2fe
    }

    .btn {
        border-radius: 8px;
        transition: background .15s ease, transform .15s ease
    }

    .btn:hover {
        transform: translateY(-1px)
    }

    .btn-sm {
        padding: 6px 10px;
        font-size: 12px
    }

    .btn-lg {
        padding: 10px 18px;
        font-size: 14px
    }

    .card {
        border: 1px solid var(--line);
        border-radius: 12px
    }

    .card-header {
        background: #fff;
        border-bottom: 1px solid var(--line);
        border-radius: 12px 12px 0 0 !important
    }

    .alert {
        border-radius: 10px;
        border: 1px solid var(--line);
        background: var(--soft)
    }

    .alert-warning {
        background: #fffbeb;
        color: #92400e;
        border-color: #fde68a
    }

    @media (max-width: 768px) {
        .table-responsive {
            font-size: 14px
        }

        .btn-group .btn {
            margin-bottom: 5px
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            align-items: flex-start !important
        }

        .d-flex.justify-content-between .btn {
            margin-top: 12px;
            width: 100%
        }
    }
</style>
