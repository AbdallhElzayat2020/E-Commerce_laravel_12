<section class="blog about-blog footer-padding">
    <div class="container">
        <div class="blog-bradcrum">
            <span><a href="{{ route('website.home') }}">{{ __('website.home') }}</a></span>
            <span class="devider">/</span>
            <span><a href="javascript:void(0)" class="active">{{ __('website.products') }}</a></span>
        </div>
        <div class="blog-item" data-aos="fade-up">
            <div class="cart-img">
                <img src="{{ asset('assets/frontend/images/homepage-one/empty-wishlist.webp') }}"
                    alt="{{ __('website.no_products') }}">
            </div>
            <div class="cart-content">
                <p class="content-title">{{ __('website.no_products') }}</p>
                <a href="{{ route('website.home') }}" class="shop-btn">{{ __('website.back_to_shop') }}</a>
            </div>
        </div>
    </div>
</section>
