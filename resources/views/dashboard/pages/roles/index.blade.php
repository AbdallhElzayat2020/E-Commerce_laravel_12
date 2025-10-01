@extends('dashboard.layouts.master')
@section('title', __('dashboard_roles.roles_management'))
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">
                <i class="la la-shield"></i> {{ __('dashboard_roles.roles_management') }}
            </h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.home') }}">
                                <i class="la la-home"></i> {{ __('dashboard_roles.Home') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('dashboard.roles.index') }}">{{ __('dashboard_roles.role') }}
                            </a>
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
                                            <i class="la la-list"></i> Roles Management
                                        </h5>
                                    </div>
                                    <a href="{{ route('dashboard.roles.create') }}"
                                       class="btn btn-primary btn-lg shadow-sm">
                                        <i class="la la-plus"></i> {{ __('dashboard_roles.create_role') }}
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
                                            {{ __('dashboard_roles.name') }}
                                        </th>
                                        <th class="border-0">
                                            <i class="la la-toggle-on text-primary"></i>
                                            {{ __('dashboard_roles.status') }}
                                        </th>
                                        <th class="border-0 text-center">
                                            <i class="la la-cogs text-primary"></i>
                                            {{ __('dashboard_roles.actions') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($roles as $index => $role)
                                        <tr class="{{ $role->id === 1 ? 'table-warning' : '' }} role-row">
                                            <th scope="row" class="align-middle">
                                                <span class="badge badge-light-primary">{{ $index + 1 }}</span>
                                            </th>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    @if ($role->id === 1)
                                                        <i class="la la-crown text-warning mr-3"
                                                           style="font-size: 20px;" title="Super Admin"></i>
                                                    @else
                                                        <i class="la la-shield text-primary mr-3"
                                                           style="font-size: 20px;"></i>
                                                    @endif
                                                    <div>
                                                            <span class="font-weight-bold text-dark"
                                                                  style="font-size: 16px;">
                                                                {{ $role->getTranslation('name', app()->getLocale()) }}
                                                            </span>
                                                        @if ($role->id === 1)
                                                            <span class="badge badge-warning ml-2">Super Admin</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                @if ($role->id !== 1)
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                               class="custom-control-input status-switch"
                                                               id="status_{{ $role->id }}"
                                                               {{ $role->status === 'active' ? 'checked' : '' }}
                                                               data-role-id="{{ $role->id }}"
                                                               data-current-status="{{ $role->status }}">
                                                        <label class="custom-control-label"
                                                               for="status_{{ $role->id }}">
                                                                <span
                                                                    class="badge {{ $role->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                                                                    {{ $role->status === 'active' ? __('dashboard_roles.active') : __('dashboard_roles.inactive') }}
                                                                </span>
                                                        </label>
                                                    </div>
                                                @else
                                                    <span class="badge badge-success">{{ __('dashboard_roles.active') }}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="btn-group" role="group">
                                                    @if ($role->id !== 1)
                                                        <a href="{{ route('dashboard.roles.edit', $role->id) }}"
                                                           class="btn btn-primary btn-sm mr-1 shadow-sm"
                                                           title="{{ __('dashboard_roles.edit') }}">
                                                            <i class="la la-edit"></i>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-secondary btn-sm mr-1" disabled
                                                                title="Cannot edit Super Admin">
                                                            <i class="la la-lock"></i>
                                                        </button>
                                                    @endif

                                                    @if ($role->id !== 1)
                                                        <a href="#" data-toggle="modal"
                                                           data-target="#deleteRole_{{ $role->id }}"
                                                           class="btn btn-danger btn-sm shadow-sm"
                                                           title="{{ __('dashboard_roles.delete') }}">
                                                            <i class="la la-trash"></i>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-secondary btn-sm" disabled
                                                                title="Cannot delete Super Admin">
                                                            <i class="la la-lock"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        @if ($role->id !== 1)
                                            @include('dashboard.pages.roles.delete')
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-5">
                                                <div class="alert alert-warning border-0 shadow-sm"
                                                     style="border-radius: 12px;">
                                                    <i class="la la-exclamation-triangle" style="font-size: 24px;"></i>
                                                    <h5 class="mt-2 mb-1">
                                                        {{ __('dashboard_roles.no_roles_found') }}</h5>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>

                                    <div class="mx-2">
                                        {{ $roles->links() }}
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
        --ink: #0f172a;
        --muted: #64748b;
        --line: #e2e8f0;
        --soft: #f8fafc;
        --primary: #2563eb;
        --success: #16a34a;
        --danger: #dc2626;
        --warning: #f59e0b;
    }

    .table-responsive {
        border-radius: 10px;
        border: 1px solid var(--line);
        background: #fff;
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

    .role-row {
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

    .custom-control-label .badge {
        margin-left: 8px
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
