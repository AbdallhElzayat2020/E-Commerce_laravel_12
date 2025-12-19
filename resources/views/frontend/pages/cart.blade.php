@extends('frontend.layouts.master')
@section('title', 'Shopping Cart')

@section('content')

    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{ route('website.home') }}">Home</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:void(0)">Cart</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">Cart</h1>
            </div>
        </div>
    </section>


    <section class="product-cart product footer-padding">
        @livewire('website.cart.cart-table-page')
    </section>
@endsection
