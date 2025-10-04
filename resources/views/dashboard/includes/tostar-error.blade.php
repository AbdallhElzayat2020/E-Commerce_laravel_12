<div class="row mt-1">
    <button @if (session('error')) style="display: block" @else style="display: none" @endif type="button"
        class="tostar_error btn btn-lg btn-block btn-outline-danger mb-2" id="type-danger">
        {{ session('error') }}
    </button>
</div>
