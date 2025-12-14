<div>
    @if ($wishlists->count() > 0)
        <div class="container">
            <div class="cart-section wishlist-section">
                <table>
                    <tbody>
                        {{-- headers table --}}
                        <tr class="table-row table-top-row">
                            <td class="table-wrapper wrapper-product">
                                <h5 class="table-heading">PRODUCT</h5>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">PRICE</h5>
                                </div>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">ACTION</h5>
                                </div>
                            </td>
                        </tr>

                        {{-- rows products in wishlist --}}
                        @foreach ($wishlists as $wishlist)
                            <tr class="table-row ticket-row">

                                <td class="table-wrapper wrapper-product">
                                    <div class="wrapper">
                                        <div class="wrapper-img">
                                            <img src="{{ asset('uploads/products/' . $wishlist->product->images->first()->file_name) }}"
                                                alt="img" />
                                        </div>
                                        <div class="wrapper-content">
                                            <h5 class="heading">{{ $wishlist->product->name }}</h5>
                                        </div>
                                    </div>
                                </td>

                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        <h5 class="heading">{{ $wishlist->product->price }}</h5>
                                    </div>
                                    @if ($wishlist->product->has_variants)
                                        <h5 class="heading">{{__('website.has_variants') }}</h5>
                                    @endif
                                </td>

                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        <span>
                                            <a wire:click.prevent="removeFromWishlist({{ $wishlist->id }})"
                                                href="javascript:void(0)">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                                        fill="#AAAAAA">
                                                    </path>
                                                </svg>
                                            </a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="wishlist-btn">
                <a wire:click.prevent="clearWishlist" href="javascript:void(0)" class="clean-btn">{{__('website.clean_wishlist')}}</a>
                <a href="#" class="shop-btn">View Cards</a>
            </div>
        </div>
    @else
        @include('frontend.pages.empty')
    @endif
</div>
