<!-- Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.create_user') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{-- validations error --}}
                <div class="alert alert-danger" id="error_div" style="display: none;">
                    <ul id="error_list"></ul>
                </div>
                <form method="POST" class="form" id="CreateUserForm">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('dashboard.name') }}</label>
                        <input type="text" name="name" class="form-control"
                            placeholder="{{ __('dashboard.name') }}">
                    </div>


                    <div class="form-group">
                        <label for="email">{{ __('dashboard.email') }}</label>
                        <input type="text" name="email" class="form-control"
                            placeholder="{{ __('dashboard.email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('dashboard.password') }}</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="{{ __('dashboard.password') }}">
                    </div>

                    @livewire('general.address-drop-down-dependent')

                    <div class="form-group">
                        <label>{{ __('dashboard.status') }}</label>
                        <div class="input-group">
                            <div class="d-inline-block custom-control custom-radio mr-1">
                                <input type="radio" value="active" name="status" @checked(old('status') == 'active')
                                    class="custom-control-input" id="active">
                                <label class="custom-control-label" for="active">{{ __('dashboard.active') }}</label>
                            </div>

                            <div class="d-inline-block custom-control custom-radio">
                                <input type="radio" value="inactive" name="status" class="custom-control-input"
                                    @checked(old('status') == 'inactive') id="inactive">
                                <label class="custom-control-label"
                                    for="inactive">{{ __('dashboard.inactive') }}</label>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ft-x"></i>
                            {{ __('dashboard.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i>
                            {{ __('dashboard.save') }}
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
