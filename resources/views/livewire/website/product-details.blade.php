<div class="product-info-content">
    {{-- price --}}
    <div class="price">
        @php
            $firstVariant = $variants->first();
            $displayVariantPrice = $price ?? optional($firstVariant)->price;
        @endphp
        @if($product->isSimple())
            @if($product->has_discount == 0)
                <span class="new-price">{{$product->price}} EGP</span>
            @else
                <span class="price-cut">{{$product->price}} EGP</span>
                <span class="new-price">{{$product->getPriceAfterDiscount()}} EGP</span>
            @endif
        @else
            @if($displayVariantPrice)
                <span class="new-price">{{$displayVariantPrice}} EGP</span>
            @else
                <span class="new-price">{{__('website.select_variant')}}</span>
            @endif
        @endif
    </div>

    {{-- product desc --}}
    <p class="content-paragraph">
        {{$product->small_description}}
    </p>

    {{-- product availability --}}
    <div class="product-availability">
        <span>{{__('website.availabillity')}} : </span>
        <span class="inner-text">
            @if($product->has_variants)
                {{$quantity}} - {{__('website.in_stock')}}
            @else
                {{$product->manage_stock == 1 ? $product->quantity : __('website.available')}}
            @endif
        </span>
    </div>

    {{-- product variants --}}
    @if($product->has_variants)
        <div class="product-size {{ $showVariants ? 'active' : '' }}">
            <p class="size-title">{{__('website.variants')}}</p>
            <div class="size-section {{ $showVariants ? 'active' : '' }}" wire:click="$toggle('showVariants')">
                <span class="size-text">
                    @if($variantId)
                        @foreach($product->variants->find($variantId)->VariantAttribute as $itemAttr)
                            {{$itemAttr->attributeValue->attribute->name}}: {{$itemAttr->attributeValue->value}}
                            @if(!$loop->last)
                                ,
                            @endif
                        @endforeach
                    @else
                        {{__('website.select_variant')}}
                    @endif
                </span>
                <div class="toggle-btn">
                    <span class="toggle-btn2"></span>
                    <span class="chevron">
                        <svg width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.4 6.8L0 1.4L1.4 0L5.4 4L9.4 0L10.8 1.4L5.4 6.8Z" fill="#222222" />
                        </svg>
                    </span>
                </div>
            </div>

            @if($product->variants && $variants->count() > 0)
                <ul class="size-option">
                    @foreach($variants as $item)
                        <li>
                            <button type="button" wire:click.prevent="changeVariant({{$item->id}})"
                                onclick="event.preventDefault(); event.stopPropagation(); return false;"
                                class="option {{ $variantId == $item->id ? 'active' : '' }}"
                                style="background: none; border: none; cursor: pointer; width: 100%; text-align: left;">
                                @foreach($item->VariantAttribute as $itemAttr)
                                    <span class="option-text">
                                        {{$itemAttr->attributeValue->attribute->name}} :
                                        {{$itemAttr->attributeValue->value}}
                                        @if(!$loop->last)
                                            ,
                                        @endif
                                    </span>
                                @endforeach
                            </button>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif


    {{-- add to cart --}}
    <div class="product-quantity">
        <div class="quantity-wrapper">
            <div class="quantity">
                <button type="button" wire:click.prevent="decrementCartQuantity"
                    onclick="event.preventDefault(); event.stopPropagation(); return false;" class="minus"
                    style="background: none; border: none; cursor: pointer;">
                    -
                </button>
                <span class="number">{{ $cartQuantity }}</span>
                <button type="button" wire:click.prevent="incrementCartQuantity"
                    onclick="event.preventDefault(); event.stopPropagation(); return false;" class="plus"
                    style="background: none; border: none; cursor: pointer;">
                    +
                </button>
            </div>
        </div>

        <a href="javascript:void(0)" wire:click.prevent="addToCart"
            onclick="event.preventDefault(); event.stopPropagation(); return false;" class="shop-btn"
            style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
            <span>
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.25357 3.32575C8.25357 4.00929 8.25193 4.69283 8.25467 5.37583C8.25576 5.68424 8.31536 5.74439 8.62431 5.74439C9.964 5.74603 11.3031 5.74275 12.6428 5.74603C13.2728 5.74767 13.7397 6.05663 13.9246 6.58104C14.2209 7.42098 13.614 8.24232 12.6762 8.25052C11.5919 8.25982 10.5075 8.25271 9.4232 8.25271C9.17714 8.25271 8.93107 8.25216 8.68501 8.25271C8.2913 8.2538 8.25412 8.29154 8.25412 8.69838C8.25357 10.0195 8.25686 11.3412 8.25248 12.6624C8.25029 13.2836 7.92603 13.7544 7.39891 13.9305C6.56448 14.2088 5.75848 13.6062 5.74863 12.6821C5.73824 11.7251 5.74645 10.7687 5.7459 9.81173C5.7459 9.41965 5.74754 9.02812 5.74535 8.63604C5.74371 8.30849 5.69012 8.2538 5.36204 8.25326C4.02235 8.25162 2.68321 8.25545 1.34352 8.25107C0.719613 8.24943 0.249902 7.93008 0.0710952 7.40348C-0.212153 6.57065 0.388245 5.75916 1.31017 5.74658C2.14843 5.73564 2.98669 5.74384 3.82495 5.74384C4.30779 5.74384 4.79062 5.74384 5.274 5.74384C5.72184 5.7433 5.7459 5.71869 5.7459 5.25716C5.7459 3.95406 5.74317 2.65096 5.74699 1.34786C5.74863 0.720643 6.0625 0.253102 6.58799 0.0704598C7.40875 -0.213893 8.21803 0.370671 8.25248 1.27349C8.25303 1.29154 8.25303 1.31013 8.25303 1.32817C8.25357 1.99531 8.25357 2.66026 8.25357 3.32575Z"
                        fill="white" />
                </svg>
            </span>
            <span>{{__('website.add_to_cart')}}</span>
        </a>
    </div>
    {{-- add to cart --}}
</div>


@script
<script>
    $wire.on('successMessage', (event) => {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: event,
            showConfirmButton: false,
            timer: 1500
        });
    });

    $wire.on('errorMessage', (event) => {
        Swal.fire({
            position: "top-center",
            icon: "error",
            title: event,
            showConfirmButton: false,
            timer: 1500
        });
    });
</script>
@endscript
