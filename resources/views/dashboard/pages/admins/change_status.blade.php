<!-- Status Change Confirmation Modal -->
<div class="modal fade" id="statusChangeModal_{{ $admin->id }}" tabindex="-1" role="dialog"
    aria-labelledby="statusChangeModalLabel_{{ $admin->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusChangeModalLabel_{{ $admin->id }}">
                    <i class="la la-toggle-on text-primary"></i> {{ __('dashboard_admins.modal.status_change_title') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="la la-user text-primary" style="font-size: 48px;"></i>
                    </div>
                    <h6 class="mb-3">{{ __('dashboard_admins.modal.status_change_message') }}</h6>
                    <p class="text-muted mb-0">
                        {{ __('dashboard_admins.labels.admin') }}: <strong>{{ $admin->name }}</strong><br>
                        {{ __('dashboard_admins.form.email') }}: <strong>{{ $admin->email }}</strong><br>
                        {{ __('dashboard_admins.modal.current_status') }}:
                        <span class="badge {{ $admin->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                            {{ $admin->status === 'active' ? __('dashboard_admins.status.active') : __('dashboard_admins.status.inactive') }}
                        </span><br>
                        {{ __('dashboard_admins.modal.new_status') }}:
                        <span class="badge {{ $admin->status === 'active' ? 'badge-danger' : 'badge-success' }}">
                            {{ $admin->status === 'active' ? __('dashboard_admins.status.inactive') : __('dashboard_admins.status.active') }}
                        </span>
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="la la-times"></i> {{ __('dashboard_admins.buttons.cancel') }}
                </button>
                <form action="{{ route('dashboard.admins.update-status') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $admin->id }}">
                    <input type="hidden" name="status"
                        value="{{ $admin->status === 'active' ? 'inactive' : 'active' }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check"></i> {{ __('dashboard_admins.buttons.confirm') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
