<div class="form-group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

        <a href="{{ route('dashboard.pages.edit', $page->id) }}" class="btn btn-outline-success">
            {{ __('dashboard.edit') }} <i class="la la-edit"></i>
        </a>

        <a href="javascript:void(0)" page-id="{{ $page->id }}" class="delete_confirm_btn btn btn-outline-danger">
            {{ __('dashboard.delete') }} <i class="la la-trash"></i>
        </a>

    </div>
</div>
