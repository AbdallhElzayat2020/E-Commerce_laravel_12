@extends('dashboard.layouts.master')

@section('title', __('dashboard.create_category'))

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-9 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.categories') }}</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.home') }}">{{ __('dashboard.dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">
                                {{ __('dashboard.categories') }}</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="">
                                {{ __('dashboard.category_create') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-11">
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">
                            {{ __('dashboard.category_create') }}
                        </h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            {{-- alert --}}
                            @include('dashboard.includes.validations-errors')

                            <form class="form" action="{{ route('dashboard.categories.store') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="eventRegInput1">{{ __('dashboard.name_en') }}</label>
                                        <input type="text" value="{{ old('name.en') }}" class="form-control"
                                               placeholder="{{ __('dashboard.name_en') }}" name="name[en]">
                                    </div>
                                    <div class="form-group">
                                        <label for="eventRegInput1">{{ __('dashboard.name_ar') }}</label>
                                        <input type="text" value="{{ old('name.ar') }}" class="form-control"
                                               placeholder="{{ __('dashboard.name_ar') }}" name="name[ar]">
                                    </div>
                                    <div class="form-group">
                                        <label for="eventRegInput1">{{ __('dashboard.select_Parent') }}</label>
                                        <select name="parent_id" class="form-control">
                                            <option value="">{{ __('dashboard.select_Parent') }}</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}" @selected(old('parent_id') == $cat->id)>
                                                    {{ $cat->getTranslation('name', app()->getLocale()) ?? $cat->getTranslation('name', 'en') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">{{ __('dashboard.icon') }}</label>
                                        <input type="file" name="icon" class="form-control" id="single-image"
                                               placeholder="icon">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('dashboard.status') }}</label>
                                        <div class="input-group">
                                            <div class="d-inline-block custom-control custom-radio mr-1">
                                                <input type="radio" value="active" @checked(old('status', 'active') === 'active')
                                                name="status" class="custom-control-input" id="yes1">
                                                <label class="custom-control-label" for="yes1">
                                                    {{ __('dashboard.active') }}
                                                </label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" value="inactive" @checked(old('status') === 'inactive')
                                                name="status" class="custom-control-input" id="no1">
                                                <label class="custom-control-label"
                                                       for="no1">{{ __('dashboard.inactive') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions left">
                                    <a href="{{ url()->previous() }}" type="button" class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> {{ __('dashboard.cancel') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> {{ __('dashboard.save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
