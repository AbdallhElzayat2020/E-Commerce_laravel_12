<div class="modal fade" id="deleteRole_{{ $role->id }}" tabindex="-1" role="dialog"
     aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRoleModalLabel">
                        <i class="la la-exclamation-triangle text-warning"></i>
                        {{ __('dashboard_roles.confirm_delete') }}
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="text-danger">
                        <i class="la la-info-circle"></i>
                        {{ __('dashboard_roles.delete_warning') }}
                    </p>
                    <p>
                        <strong>{{ __('dashboard_roles.role_name') }}:</strong>
                        {{ $role->getTranslation('name', app()->getLocale()) }}
                    </p>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        <i class="la la-times"></i> {{ __('dashboard_roles.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="la la-trash"></i> {{ __('dashboard_roles.delete') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
