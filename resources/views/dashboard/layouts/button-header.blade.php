{{--   Dropdown   --}}
<div class="content-header-right col-md-6 col-12">
    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
        <button type="button" class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2"
            id="btnGroupDrop3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="la la-cog"></i> {{ __('dashboard_admins.table.actions') }}
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop3">
            <a style="color: #000!important;" class="dropdown-item" href="{{ route('dashboard.admins.create') }}">
                <i class="la la-plus"></i> @yield('btn_title')
            </a>
        </div>
    </div>
</div>
{{--   Dropdown   --}}
