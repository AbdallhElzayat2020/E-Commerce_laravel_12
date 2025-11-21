@extends('frontend.layouts.master')
@section('title', __('dashboard.brands'))
@section('content')

    {{-- breadcrump and header title --}}
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{ route('website.home') }}">{{ __('website.home') }}</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:void(0)" class="active">{{ __('website.all_brands') }}</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">{{ __('dashboard.brands') }}</h1>
            </div>
        </div>
    </section>

    {{-- Brands section --}}
    <section class="product brand" data-aos="fade-up">
        <div class="container">

            <div style="margin-bottom: 80px" class="brand-section">
                @forelse ($brands as $item)
                    <div style="margin: 6px" class="product-wrapper">
                        <div class="wrapper-img">
                            <a href="">
                                <img src="{{ asset($item->logo) }}" alt="{{ $item->name }}">
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-danger">{{ __('dashboard.not_found') }}</div>
                @endforelse

            </div>
        </div>
    </section>

@endsection
