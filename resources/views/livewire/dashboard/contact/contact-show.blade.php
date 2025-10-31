<div>
    <div class="content-wrapper">
        <div class="content-body">
            <div class="card email-app-details d-none d-lg-block">
                <div class="card-content">
                    @if ($msg)
                        <!-- Email Options (Buttons) -->
                        <div class="email-app-options card-body d-flex justify-content-between align-items-center">
                            <!-- Left Side Buttons -->
                            <div class="btn-group">
                                <button type="button" wire:click="replayMsg({{ $msg->id }})"
                                        class="btn btn-primary" data-toggle="tooltip" title="Reply">
                                    <i class="la la-reply"></i>
                                </button>

                                <button type="button" class="btn btn-warning" data-toggle="tooltip" title="Report Spam">
                                    <i class="ft-alert-octagon"></i>
                                </button>

                                <button @if($msg->deleted_at != null ) wire:click="forceDelete({{ $msg->id }})" @else wire:click="deleteMsg({{ $msg->id }})" @endif type="button"
                                        class="btn btn-danger" data-toggle="tooltip" @if($msg->deleted_at != null ) title="Force Delete" @else title="Delete" @endif >
                                    <i class="ft-trash-2"></i>
                                </button>
                            </div>

                            <!-- Right Side More Options -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    More
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" wire:click="markAsUnRead({{ $msg->id }})" href="#">Mark as Unread</a>
                                    <a wire:click="forceDelete({{ $msg->id }})" class="dropdown-item" href="#">Force Delete</a>
                                    @if ($msg->deleted_at != null)
                                        <a wire:click="restoreContact({{ $msg->id }})" class="dropdown-item" href="#">Restore</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Email Title -->
                        <div class="email-app-title card-body">
                            <h3 class="list-group-item-heading">{{ $msg->title }}</h3>
                            <p class="list-group-item-text">
                                <span class="badge badge-primary">Show Message</span>
                                <i class="float-right font-medium-3 ft-star warning"></i>
                            </p>
                        </div>

                        <!-- Message Content -->
                        <div class="media-list">
                            <div id="headingCollapse1" class="card-header p-0">
                                <a data-toggle="collapse" href="#collapse1" aria-expanded="true"
                                   aria-controls="collapse1"
                                   class="collapsed email-app-sender media border-0 bg-blue-grey bg-lighten-5">
                                    <div class="media-left pr-1">
                                        <span class="avatar avatar-md">
                                            <img class="media-object rounded-circle"
                                                 src="{{ asset('assets/dashboard/images/avatar.jpg') }}"
                                                 alt="Generic placeholder image">
                                        </span>
                                    </div>
                                    <div class="media-body w-100">
                                        <h6 class="list-group-item-heading">{{ $msg->name }}</h6>
                                        <p class="list-group-item-text">{{ $msg->subject }}
                                            <span class="float-right text-muted">{{ $msg->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1"
                                 class="card-collapse collapse" aria-expanded="true">
                                <div class="card-content">
                                    <div class="card-body">
                                        <p>{{ $msg->message }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="text-center p-3">
                            <h5>No messages found</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
