<!-- Status Change Confirmation Modal -->
<div class="modal fade" id="statusChangeModal_{{ $role->id }}" tabindex="-1" role="dialog"
    aria-labelledby="statusChangeModalLabel_{{ $role->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusChangeModalLabel_{{ $role->id }}">
                    <i class="la la-toggle-on text-primary"></i> Change Role Status
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="la la-shield text-primary" style="font-size: 48px;"></i>
                    </div>
                    <h6 class="mb-3">Are you sure you want to change the status of this role?</h6>
                    <p class="text-muted mb-0">
                        Role: <strong>{{ $role->getTranslation('name', app()->getLocale()) }}</strong><br>
                        Current Status:
                        <span class="badge {{ $role->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                            {{ $role->status === 'active' ? __('dashboard_roles.active') : __('dashboard_roles.inactive') }}
                        </span><br>
                        New Status:
                        <span class="badge {{ $role->status === 'active' ? 'badge-danger' : 'badge-success' }}">
                            {{ $role->status === 'active' ? __('dashboard_roles.inactive') : __('dashboard_roles.active') }}
                        </span>
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="la la-times"></i> Cancel
                </button>
                <form action="{{ route('dashboard.roles.update-status') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="id" value="{{ $role->id }}">
                    <input type="hidden" name="status"
                        value="{{ $role->status === 'active' ? 'inactive' : 'active' }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check"></i> Confirm Change
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
