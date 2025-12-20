<div>
{{--    @if ($couponInfo != null)--}}
{{--        <p class="paragraph" style="color: rgb(210, 77, 77)"> {{ $couponInfo }}</p>--}}
{{--    @endif--}}

{{--    @if ($cartItemsCount > 0 && $cart->coupon == null)--}}
        <div class=" account-inner-form">
            <div class="review-form-name">
                <input wire:model="code" class="form-control" placeholder="Coupon Code">
                <button wire:click="applyCoupon" type="button" class="shop-btn">Apply</button>
            </div>
        </div>
{{--    @endif--}}
</div>


@script
<script>
    $wire.on('couponApplied', (event) => {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: event,
            showConfirmButton: false,
            timer: 10000
        });
    });

    $wire.on('couponNotValid', (event) => {
        Swal.fire({
            position: "top-center",
            icon: "error",
            title: event,
            showConfirmButton: false,
            timer: 3500
        });
    });
</script>
@endscript
