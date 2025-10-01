<!-- Delete Admin Confirmation Modal -->
<div class="modal fade" id="deleteAdmin_{{ $admin->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteAdminLabel_{{ $admin->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAdminLabel_{{ $admin->id }}">
                    <i class="la la-trash text-danger"></i> {{ __('dashboard_admins.modal.delete_title') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="la la-user text-danger" style="font-size: 48px;"></i>
                    </div>
                    <h6 class="mb-3">{{ __('dashboard_admins.modal.delete_message') }}</h6>
                    <p class="text-muted mb-0">
                        {{ __('dashboard_admins.labels.admin') }}: <strong>{{ $admin->name }}</strong><br>
                        {{ __('dashboard_admins.form.email') }}: <strong>{{ $admin->email }}</strong><br>
                        {{ __('dashboard_admins.form.role') }}:
                        <strong>{{ $admin->role ? $admin->role->getTranslation('name', app()->getLocale()) : __('dashboard_admins.labels.no_role') }}</strong>
                    </p>
                    <div class="alert alert-warning mt-3">
                        <i class="la la-exclamation-triangle"></i>
                        <strong>{{ __('dashboard_admins.modal.delete_warning') }}</strong>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="la la-times"></i> {{ __('dashboard_admins.buttons.cancel') }}
                </button>
                <form action="{{ route('dashboard.admins.destroy', $admin->id) }}" method="POST"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="la la-trash"></i> {{ __('dashboard_admins.buttons.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
