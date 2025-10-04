<div class="row mt-1">
    <button @if (session('success')) style="display: block" @else style="display: none" @endif type="button"
        class="tostar_success btn btn-lg btn-block btn-outline-success mb-2" id="type-danger">
        {{ session('success') }}
    </button>
</div>
