@extends('dashboard.layouts.master')
@section('title', __('dashboard.products'))
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-9 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.product_create') }}</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.home') }}">{{ __('dashboard.dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">
                                {{ __('dashboard.products') }}</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="#">
                                {{ __('dashboard.product_create') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-12">
            <div class="content-body">
                <section id="icon-tabs">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    {{--                                    <h4 class="card-title">{{ __('dashboard.create_product') }}</h4>--}}
                                    <a class="heading-elements-toggle">
                                        <i class="la la-ellipsis-h font-medium-3"></i>
                                    </a>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        @livewire('dashboard.create-product', ['categories' => $categories, 'brands' => $brands])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('dashboard_css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/vendors/css/forms/tags/tagging.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/custom/product.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
@endpush

@push('js')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('showFullscreenModal', () => {
                $('#fullscreenModal').modal('show');
            });
        });
    </script>
@endpush
