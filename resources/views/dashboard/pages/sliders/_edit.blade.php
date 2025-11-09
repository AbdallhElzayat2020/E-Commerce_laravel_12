<!-- Modal -->
<div class="modal fade" id="editSliderModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{ __('dashboard.edit_slider') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('dashboard.includes.validations-errors')

                <form action="" id="editSliderForm" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="slider_id" id="edit_slider_id">

                    <div class="form-group">
                        <label for="edit_note_ar">{{ __('dashboard.note_ar') }}</label>
                        <input type="text" name="note[ar]" class="form-control" id="edit_note_ar"
                            placeholder="{{ __('dashboard.note_ar') }}">
                    </div>
                    <div class="form-group">
                        <label for="edit_note_en">{{ __('dashboard.note_en') }}</label>
                        <input type="text" name="note[en]" class="form-control" id="edit_note_en"
                            placeholder="{{ __('dashboard.note_en') }}">
                    </div>

                    <div class="form-group">
                        <label for="edit_image">{{ __('dashboard.image') }}</label>
                        <input type="file" name="file_name" class="form-control" id="edit-single-image"
                            placeholder="{{ __('dashboard.image') }}">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="ft-x"></i>{{ __('dashboard.close') }}</button>
                        <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i>
                            {{ __('dashboard.update') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
