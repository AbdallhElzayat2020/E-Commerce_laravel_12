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

            <button id="btnGroupDrop2" type="button" class="btn btn-outline-danger dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('dashboard.delete') }}<i class="la la-trash"></i>
            </button>

            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                <form action="{{ route('dashboard.coupons.destroy', $coupon->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete_confirm dropdown-item">{{ __('dashboard.delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
