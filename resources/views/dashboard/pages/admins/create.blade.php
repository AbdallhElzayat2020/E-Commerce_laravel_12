@extends('dashboard.layouts.master')
@section('title', __('dashboard_admins.create_title'))
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">
                <i class="la la-user-plus"></i> {{ __('dashboard_admins.create_title') }}
            </h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.home') }}">
                                <i class="la la-home"></i> Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.admins.index') }}">{{ __('dashboard_admins.labels.admin') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('dashboard_admins.buttons.create') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body"></div>
    <section id="basic-form-layouts">
        <div class="row match-height">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="la la-user-plus text-primary"></i> {{ __('dashboard_admins.labels.admin') }}
                            {{ __('dashboard_admins.labels.required_field') }}
                        </h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('dashboard.includes.alerts')

                            <form class="form" action="{{ route('dashboard.admins.store') }}" method="POST">
                                @csrf

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">{{ __('dashboard_admins.form.name') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="name"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name') }}" placeholder="Enter admin name" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">{{ __('dashboard_admins.form.email') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" id="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" placeholder="Enter admin email" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">{{ __('dashboard_admins.form.password') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" placeholder="Enter password" required>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    for="password_confirmation">{{ __('dashboard_admins.form.password_confirmation') }}
                                                    <span class="text-danger">*</span></label>
                                                <input type="password" id="password_confirmation" class="form-control"
                                                    name="password_confirmation" placeholder="Confirm password" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role_id">{{ __('dashboard_admins.form.role') }} <span
                                                        class="text-danger">*</span></label>
                                                <select id="role_id"
                                                    class="form-control @error('role_id') is-invalid @enderror"
                                                    name="role_id" required>
                                                    <option value="">{{ __('dashboard_admins.form.select_role') }}
                                                    </option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                            {{ $role->getTranslation('name', app()->getLocale()) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('role_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">{{ __('dashboard_admins.form.status') }} <span
                                                        class="text-danger">*</span></label>
                                                <select id="status"
                                                    class="form-control @error('status') is-invalid @enderror"
                                                    name="status" required>
                                                    <option value="">{{ __('dashboard_admins.form.select_status') }}
                                                    </option>
                                                    <option value="active"
                                                        {{ old('status') == 'active' ? 'selected' : '' }}>
                                                        {{ __('dashboard_admins.status.active') }}
                                                    </option>
                                                    <option value="inactive"
                                                        {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                        {{ __('dashboard_admins.status.inactive') }}
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions text-right">
                                    <a href="{{ route('dashboard.admins.index') }}" class="btn btn-secondary mr-1">
                                        <i class="la la-times"></i> {{ __('dashboard_admins.buttons.cancel') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check"></i> {{ __('dashboard_admins.buttons.create') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>

@endsection

<style>
    .form-control {
        border-radius: 8px;
        border: 1px solid #e9ecef;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .form-group label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .card {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background: #fff;
        border-bottom: 1px solid #e9ecef;
        border-radius: 12px 12px 0 0 !important;
    }

    .btn {
        border-radius: 8px;
        transition: all 0.15s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }
</style>
