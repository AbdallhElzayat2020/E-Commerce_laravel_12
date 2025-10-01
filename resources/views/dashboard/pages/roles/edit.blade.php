@extends('dashboard.layouts.master')
@section('title')
    Create Role
@endsection
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard_roles.create_role') }}</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.home') }}">{{ __('dashboard_roles.roles_management') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.roles.index') }}">{{ __('dashboard_roles.roles') }}</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">{{ __('dashboard_roles.create_role') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    @include('dashboard.includes.messages')
                    <form class="form" action="{{ route('dashboard.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role_en"> {{ __('dashboard_roles.role_name_english') }}</label>
                                        <input type="text" id="role_en"
                                            value="{{ old('name.en', $role->getTranslation('name', 'en')) }}"
                                            class="form-control border-primary"
                                            placeholder="{{ __('dashboard_roles.name') }}" name="name[en]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role_ar"> {{ __('dashboard_roles.role_name_arabic') }}</label>
                                        <input type="text"
                                            value="{{ old('name.ar', $role->getTranslation('name', 'ar')) }}"
                                            id="role_ar" class="form-control border-primary"
                                            placeholder="{{ __('dashboard_roles.name') }}" name="name[ar]">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-control border-primary">
                                            <option value="active"
                                                {{ old('status', $role->status) === 'active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="inactive"
                                                {{ old('status', $role->status) === 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <style>
                                    .custom-permission-checkbox {
                                        display: flex;
                                        align-items: center;
                                        background: linear-gradient(135deg, #f8fafc 0%, #e0e7ef 100%);
                                        border-radius: 12px;
                                        padding: 12px 10px;
                                        margin-bottom: 15px;
                                        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.07);
                                        transition: box-shadow 0.2s;
                                    }

                                    .custom-permission-checkbox:hover {
                                        box-shadow: 0 4px 16px rgba(44, 62, 80, 0.13);
                                        background: linear-gradient(135deg, #e3e9f3 0%, #f8fafc 100%);
                                    }

                                    .custom-permission-checkbox input[type="checkbox"] {
                                        accent-color: #5A8DEE;
                                        width: 20px;
                                        height: 20px;
                                        margin-right: 10px;
                                        margin-left: 10px;
                                        border-radius: 6px;
                                        border: 2px solid #5A8DEE;
                                        background: #fff;
                                        transition: border 0.2s;
                                    }

                                    .custom-permission-checkbox label {
                                        margin: 0;
                                        font-weight: 500;
                                        color: #34495e;
                                        cursor: pointer;
                                        font-size: 15px;
                                    }

                                    .custom-permission-checkbox i {
                                        color: #5A8DEE;
                                        font-size: 18px;
                                        margin-right: 8px;
                                    }
                                </style>
                                @if (Config::get('app.locale') == 'ar')
                                    @foreach (config('permissions_ar') as $key => $value)
                                        @php $inputId = 'perm_' . $key; @endphp
                                        <div class="col-md-2">
                                            <div class="custom-permission-checkbox">
                                                <i class="la la-shield-alt"></i>
                                                <input id="{{ $inputId }}" value="{{ $key }}"
                                                    type="checkbox" name="permissions[]" class="checkbox"
                                                    {{ $role->permissions ? (in_array($key, json_decode($role->permissions, true)) ? 'checked' : '') : '' }}>
                                                <label for="{{ $inputId }}">{{ $value }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach (config('permissions_en') as $key => $value)
                                        @php $inputId = 'perm_' . $key; @endphp
                                        <div class="col-md-2">
                                            <div class="custom-permission-checkbox">
                                                <i class="la la-shield-alt"></i>
                                                <input id="{{ $inputId }}" value="{{ $key }}"
                                                    type="checkbox" name="permissions[]" class="checkbox"
                                                    {{ $role->permissions ? (in_array($key, json_decode($role->permissions, true)) ? 'checked' : '') : '' }}>
                                                <label for="{{ $inputId }}">{{ $value }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-actions right">
                            <a href="{{ route('dashboard.roles.index') }}" class="btn btn-warning mr-1">
                                <i class="ft-x"></i> {{ __('dashboard_roles.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-check-square-o"></i> {{ __('dashboard_roles.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
