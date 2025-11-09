{{-- product = row row->images --}}
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active ">
            <img src="{{ asset($slider->file_name) }}" class="d-block w-100" alt="...">
        </div>
    </div>
</div>

<div class="mt-1">
    <button class="btn btn-outline-primary" data-toggle="modal"
            data-target="#fullscreenModal_{{ $slider->id }}">
        <i class="fa fa-expand"></i> {{ __('dashboard.fullscreen') }}
    </button>
</div>

{{-- fullscreen modal --}}

<!-- Fullscreen Modal -->
<div class="modal fade" id="fullscreenModal_{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="fullscreenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullscreenModalLabel">{{ __('dashboard.fullscreen') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="fullscreenCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset($slider->file_name) }}" class="d-block w-100" alt="Fullscreen Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
