<div class="form-group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

        <button user-id="{{ $user->id }}" type="button" class="manage_user_status  btn btn-outline-info">
            {{ __('dashboard.status_management') }} <i class="la la-stop"></i>
        </button>

        <button id="btnGroupDrop2" user-id="{{ $user->id }}" type="button"
            class="delete_confirm_btn btn btn-outline-danger">
            {{ __('dashboard.delete') }}<i class="la la-trash"></i>
        </button>

    </div>
</div>
