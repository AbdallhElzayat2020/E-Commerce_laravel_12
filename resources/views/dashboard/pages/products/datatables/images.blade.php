{{-- product = row row->images --}}
<div id="carouselExampleControls_{{ $row->id }}" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach ($row->images as $key => $image)
            <div class="carousel-item @if ($key == 0) active @endif">
                <img src="{{ asset('uploads/products/' . $image->file_name) }}" class="d-block w-100" alt="...">
            </div>
        @endforeach
    </div>
    <a href="#carouselExampleControls_{{ $row->id }}" class="carousel-control-prev" type="button"
        data-target="#carouselExampleControls_{{ $row->id }}" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a href="#carouselExampleControls_{{ $row->id }}" class="carousel-control-next" type="button"
        data-target="#carouselExampleControls_{{ $row->id }}" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="mt-1">
    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#fullscreenModal_{{ $row->id }}">
        <i class="fa fa-expand"></i> Fullscreen
    </button>
</div>


<!-- Fullscreen Modal -->
<div class="modal fade" id="fullscreenModal_{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="fullscreenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullscreenModalLabel">Fullscreen View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="fullscreenCarousel_{{ $row->id }}" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($row->images as $key => $image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ asset('uploads/products/' . $image->file_name) }}" class="d-block w-100"
                                    alt="Fullscreen Image">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#fullscreenCarousel_{{ $row->id }}" role="button"
                        data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#fullscreenCarousel_{{ $row->id }}" role="button"
                        data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
