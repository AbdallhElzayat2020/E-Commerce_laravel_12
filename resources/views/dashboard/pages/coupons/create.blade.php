<!-- Modal -->
<div class="modal fade" id="couponModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.create_coupon') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{-- validations error --}}
                <div class="alert alert-danger" id="error_div" style="display: none;">
                    <ul id="error_list"></ul>
                </div>


                <form action="" id="createCoupon" class="form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('dashboard.code') }}</label>
                        <input type="text" name="code" class="form-control" id="code"
                            placeholder="{{ __('dashboard.code') }}">
                        <strong class="text-danger" id="error_code"></strong>
                    </div>


                    <div class="form-group">
                        <label for="name">{{ __('dashboard.discount') }}</label>
                        <input type="text" name="discount_percentage" class="form-control" id="discount_percentage"
                            placeholder="{{ __('dashboard.discount') }}">
                        <strong class="text-danger" id=""></strong>

                    </div>

                    <div class="form-group">
                        <label for="limitation">{{ __('dashboard.limitation') }}</label>
                        <input type="number" name="limit" class="form-control"
                            placeholder="{{ __('dashboard.limitation') }}">
                        <strong class="text-danger" id="error_limit"></strong>

                    </div>

                    <div class="form-group">
                        <label for="limitation">{{ __('dashboard.start_date') }}</label>
                        <input type="date" name="start_date" class="form-control"
                            placeholder="{{ __('dashboard.start_date') }}">
                    </div>
                    <div class="form-group">
                        <label for="limitation">{{ __('dashboard.end_date') }}</label>
                        <input type="date" name="end_date" class="form-control"
                            placeholder="{{ __('dashboard.end_date') }}">
                    </div>

                    <div class="form-group">
                        <label>{{ __('dashboard.is_active') }}</label>
                        <div class="input-group">
                            <div class="d-inline-block custom-control custom-radio mr-1">
                                <input type="radio" value="active" name="status" class="custom-control-input"
                                    id="yes1">
                                <label class="custom-control-label" for="yes1">{{ __('dashboard.active') }}</label>
                            </div>
                            <div class="d-inline-block custom-control custom-radio">
                                <input type="radio" value="inactive" name="status" class="custom-control-input"
                                    id="no1">
                                <label class="custom-control-label"
                                    for="no1">{{ __('dashboard.inactive') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="ft-x"></i>{{ __('dashboard.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i>
                            {{ __('dashboard.save') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
