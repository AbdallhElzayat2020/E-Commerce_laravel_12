<div>
    @if($cartItems->count() > 0)
        <div class="container">
            <div class="cart-section">
                <table>
                    <tbody>
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
                                    <h5 class="table-heading">QUANTITY</h5>
                                </div>
                            </td>
                            <td class="table-wrapper wrapper-total">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">TOTAL</h5>
                                </div>
                            </td>
                            <td class="table-wrapper wrapper-total">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">Attributes</h5>
                                </div>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">ACTION</h5>
                                </div>
                            </td>
                        </tr>
                        @foreach ($cartItems as $item)
                            <tr class="table-row ticket-row">
                                <td class="table-wrapper wrapper-product">
                                    <div class="wrapper">
                                        <div class="wrapper-img">
                                            <img src="{{ asset('uploads/products/' . $item->product->images->first()->file_name) }}"
                                                alt="img">
                                        </div>
                                        <div class="wrapper-content">
                                            <h5 class="heading"> {{ $item->product->name }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        <h5 class="heading">{{ $item->price }}</h5>
                                    </div>
                                </td>
                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        <div class="quantity">
                                            <a href="" wire:click.prevent="decreaseQuantity({{ $item->id }})" class="minus">
                                                -
                                            </a>
                                            <span class="number">{{ $item->quantity }}</span>
                                            <a href="" wire:click.prevent="increaseQuantity({{ $item->id }})" class="plus">
                                                +
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-wrapper wrapper-total">
                                    <div class="table-wrapper-center">
                                        <h5 class="heading">{{ $item->price * $item->quantity }}</h5>
                                    </div>
                                </td>

                                {{-- attributes --}}
                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        @php
                                            $attributes = $item->attributes;
                                            // Handle case where attributes might be stored as JSON string
                                            if (is_string($attributes)) {
                                                $attributes = json_decode($attributes, true);
                                            }
                                        @endphp
                                        @if($attributes && is_array($attributes) && count($attributes) > 0)
                                            @foreach ($attributes as $attr => $value)
                                                <h5 style="margin-right: 6px" class="heading"> {{ $attr . ': ' . $value }} </h5>
                                            @endforeach
                                        @else
                                            <h5 class="heading">No Attributes</h5>
                                        @endif
                                    </div>
                                </td>
                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        <a href="javascript:void(0)" wire:click="removeItem({{ $item->id }})">
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                                    fill="#AAAAAA"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="wishlist-btn cart-btn">
                <a href="" wire:click.prevent="clearCart" class="clean-btn">Clear Cart</a>
                <button href="#" @click="$dispatch('updateCart')" class="shop-btn update-btn">Update Cart</button>
                <a href="#" class="shop-btn">Proceed to Checkout</a>
            </div>
        </div>

    @else
        <section class="blog about-blog footer-padding">
            <div class="container">
                <div class="blog-item" data-aos="fade-up">
                    <div class="cart-img">
                        <img src="{{ asset('assets/website/assets/images/homepage-one/empty-wishlist.webp') }}" alt>
                    </div>
                    <div class="cart-content">
                        <p class="content-title">{{ __('website.no_products') }}</p>
                        <a href="{{ route('website.shop') }}" class="shop-btn">{{ __('website.back_to_shop') }}</a>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
