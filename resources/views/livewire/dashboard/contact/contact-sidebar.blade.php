<div>
    <div class="form-group text-center">
        <!-- Dropup Button -->
        <div class="btn-group dropup w-100">
            <button class="btn btn-danger btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ft-mail"></i> Actions
            </button>
            <div class="dropdown-menu w-100 text-center">
                <a wire:click.prevent="markAllAsRead" href="#" class="dropdown-item">
                    <i class="ft-trash-2"></i> Mark All As Read
                </a>
                <a wire:click.prevent="deleteAllReadContacts" href="#" class="dropdown-item">
                    <i class="ft-trash-2"></i> Delete All Read Contacts
                </a>
                <a wire:click.prevent="deleteAllAnswereContacts" href="#" class="dropdown-item">
                    <i class="ft-trash-2"></i> Delete All Answere Contacts
                </a>
            </div>
        </div>
    </div>

    <h6 class="text-muted font-weight-bold">Messages</h6>
    <div class="list-group">
        <a wire:click.prevent="selectScreen('inbox')" href="#" class="list-group-item {{ $screen == 'inbox' ? 'active' : '' }} border-0">
            <i class="ft-inbox mr-1"></i> Inbox <span class="badge badge-secondary float-right">{{ $inboxCount }}</span>
        </a>
        <a wire:click.prevent="selectScreen('readed')" href="#" class="list-group-item {{ $screen == 'readed' ? 'active' : '' }} border-0">
            <i class="la la-paper-plane-o mr-1"></i> Read <span class="badge badge-secondary float-right">{{ $readedCount }}</span>
        </a>
        <a wire:click.prevent="selectScreen('answered')" href="#" class="list-group-item {{ $screen == 'answered' ? 'active' : '' }} border-0">
            <i class="ft-file mr-1"></i> Answered <span class="badge badge-secondary float-right">{{ $answeredCount }}</span>
        </a>
        <a wire:click.prevent="selectScreen('trashed')" href="#" class="list-group-item {{ $screen == 'trashed' ? 'active' : '' }} border-0">
            <i class="ft-trash-2 mr-1"></i> Trash <span class="badge badge-secondary float-right">{{ $trashedCount }}</span>
        </a>
    </div>
</div>
