<div class="">
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
    <hr>
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
    <div class="product-size">
        <P class="size-title">{{__('website.variants')}}</P>
        <div class="size-section">
            <span class="size-text">{{__('website.select_variant')}}</span>
            <div class="toggle-btn">
                <span class="toggle-btn2"></span>
                <span class="chevron">
                    <svg width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.4 6.8L0 1.4L1.4 0L5.4 4L9.4 0L10.8 1.4L5.4 6.8Z" fill="#222222" />
                    </svg>
                </span>
            </div>
        </div>

        @if($product->variants)
            <ul class="size-option">
                @foreach($variants as $item)
                    <a wire:click="changeVariant({{$item->id}})" href="javascript:void(0)" class="option">
                        @foreach($item->VariantAttribute as $itemAttr)
                            <span class="option-text">
                            {{$itemAttr->attributeValue->attribute->name}} :
                            {{$itemAttr->attributeValue->value}}
                        </span>
                        @endforeach
                    </a>
                @endforeach
            </ul>
        @endif
    </div>
</div>
