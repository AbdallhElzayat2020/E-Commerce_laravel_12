@extends('frontend.layouts.master')
@section('title', __('dashboard.categories'))
@section('content')

    {{-- breadcrump and header title --}}
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{ route('website.home') }}">{{ __('website.home') }}</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:void(0)" class="active">{{ __('website.all_categories') }}</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">{{ __('dashboard.categories') }}</h1>
            </div>
        </div>
    </section>

    {{-- categories section --}}
    <section class="product-category my-4">
        <div class="container">
            <div style="margin-bottom: 80px" class="category-section">
                @forelse ($categories as $item)
                    <div class="product-wrapper" data-aos="fade-right" data-aos-duration="100">
                        <div class="wrapper-img">
                            <img src="{{ asset($item->icon) }}" alt="{{ $item->name }}">
                        </div>

                        <div class="wrapper-info">
                            <a href=""
                               class="wrapper-details">{{ $item->name }}</a>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">{{ __('website.no_categories') }}</div>
                @endforelse

            </div>
        </div>
    </section>


@endsection
