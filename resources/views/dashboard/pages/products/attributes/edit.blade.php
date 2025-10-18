<!-- Modal -->
<div class="modal fade" id="editAttributeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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

                <div class="alert alert-danger" id="error_div_edit" style="display: none">
                    <ul id="error_list_edit">

                    </ul>
                </div>



                <form action="" id="" class="form updateAttributeForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input hidden name="id" value="" id="attributeId">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">{{ __('dashboard.attribute_name_ar') }}</label>
                                <input type="text" name="name[ar]" class="form-control" id="attributeNameAr"
                                    placeholder="{{ __('dashboard.attribute_name_ar') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">{{ __('dashboard.attribute_name_en') }}</label>
                                <input type="text" name="name[en]" class="form-control" id="attributeNameEn"
                                    placeholder="{{ __('dashboard.attribute_name_en') }}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row attributeValuesContainer">

                    </div>



                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary add_more_edit"><i
                                    class="ft-plus"></i></button>
                        </div>
                    </div><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-dismiss="modal">
                            <i class="ft-x"></i>{{ __('dashboard.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> {{ __('dashboard.update') }}
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
