<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.create_brand') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('dashboard.includes.validations-errors')

                <form action="{{ route('dashboard.brands.store') }}" class="form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('dashboard.name_ar') }}</label>
                        <input type="text" name="name[ar]" class="form-control" id="name"
                            placeholder="{{ __('dashboard.name_ar') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('dashboard.name_en') }}</label>
                        <input type="text" name="name[en]" class="form-control" id="name"
                            placeholder="{{ __('dashboard.name_en') }}">
                    </div>

                    <div class="form-group">
                        <label for="image">{{ __('dashboard.logo') }}</label>
                        <input type="file" name="logo" class="form-control" id="single-image"
                            placeholder="{{ __('dashboard.image') }}">
                    </div>

                    <div class="form-group">
                        <label>{{ __('dashboard.status') }}</label>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="ft-x"></i>{{ __('dashboard.close') }}</button>
                        <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i>
                            {{ __('dashboard.save') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
