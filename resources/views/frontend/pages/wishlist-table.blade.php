@extends('frontend.layouts.master')
@section('title', __('website.wishlist'))

@section('content')

    {{-- bradcrum --}}
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{ route('website.home') }}">{{ __('website.home') }}</a></span>
                <span class="devider">/</span>
                <span><a href="{{ route('website.wishlist') }}">{{ __('website.wishlist') }}</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">{{ __('website.wishlist') }}</h1>
            </div>
        </div>
    </section>

    {{-- wishlist --}}
    <section class="cart product wishlist footer-padding" data-aos="fade-up">
        @livewire('website.wishlist.wish-list-table', ['wishlists' => $wishlists])
    </section>
@endsection
