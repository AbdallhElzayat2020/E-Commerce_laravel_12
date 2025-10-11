<div class="form-group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

        <button type="button"
                class="edit_coupon btn btn-outline-success"
                coupon-id="{{ $coupon->id }}"
                coupon-code="{{ $coupon->code }}"
                coupon-limit="{{ $coupon->limit }}"
                coupon-discount="{{ $coupon->discount_percentage }}"
                coupon-start-date="{{ $coupon->start_date }}"
                coupon-end-date="{{ $coupon->end_date }}"
                coupon-status="{{ $coupon->status }}">
            {{ __('dashboard.edit') }}<i class="la la-edit"></i>
        </button>

        <div class="btn-group" role="group">

            <button id="btnGroupDrop2" type="button" class="btn btn-outline-danger delete_confirm_btn" coupon-id="{{$coupon->id}}">
                {{ __('dashboard.delete') }}<i class="la la-trash"></i>
            </button>

        </div>
    </div>
</div>
