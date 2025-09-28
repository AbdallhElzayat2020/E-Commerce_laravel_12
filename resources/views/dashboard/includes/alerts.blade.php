@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert"
        style="display: block !important; opacity: 1 !important;">
        <i class="ft-check-circle"></i>
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert"
        style="display: block !important; opacity: 1 !important;">
        <i class="ft-alert-circle"></i>
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert"
        style="display: block !important; opacity: 1 !important;">
        <i class="ft-alert-circle"></i>
        <strong>Validation Error:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@include('dashboard.includes.alert-scripts')
