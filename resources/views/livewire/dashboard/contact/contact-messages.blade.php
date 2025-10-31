<!-- Contact Messages Page -->
<div class="email-app-list">
    <div class="card-body">
        <fieldset class="form-group position-relative has-icon-left m-0 pb-1">
            <input type="text" wire:model.live="itemSearch" class="form-control" placeholder="Search email">
            <div class="form-control-position">
                <i class="ft-search"></i>
            </div>
        </fieldset>
    </div>
    <div class="list-group">
        @forelse ($messages as $msg)
            <a wire:click="showMessage({{ $msg->id }})" href="#" class="media border-0 {{ $msg->id == $opendMsgId ? 'bg-light' : '' }}">

                <div class="media-left pr-1">
                    <span class="avatar avatar-md">
                        <span class="media-object rounded-circle text-circle bg-info">T</span>
                    </span>
                </div>

                <div class="media-body w-100">
                    <h6 class="font-weight-bold">{{ $msg->name }}
                        <span class="float-right text-muted">{{ $msg->created_at->diffForHumans() }}</span>
                    </h6>
                    <p class="text-bold-600 mb-0">{{ $msg->subject }}</p>
                    <p class="mb-0 text-muted">{{ Str::limit($msg->message, 50) }}
                        <span class="float-right">
                            <span class="badge badge-{{ $msg->is_read ? 'success' : 'danger' }}">{{ $msg->is_read ? 'Read' : 'New' }}</span>
                        </span>
                    </p>
                </div>

            </a>
        @empty
            <div class="text-center p-3">{{__('dashboard.not_found')}}</div>
        @endforelse
        {{-- livewire from vendor --}}
        {{ $messages->links('vendor.livewire.simple-bootstrap') }}

    </div>
</div>
