@extends('dashboard.layouts.master')
@section('title')
    {{ __('dashboard.users_table') }}
@endsection

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.users_table') }}</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.home') }}">{{ __('dashboard.dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">
                                {{ __('dashboard.users') }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-md-11">
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">
                            {{ __('dashboard.users') }}
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            {{-- create coupon modal --}}
                            <button type="button" class="btn btn-outline-success mb-1" data-toggle="modal"
                                data-target="#createUserModal">
                                {{ __('dashboard.users_create') }}
                            </button>

                            {{-- include livewire address dropdown dependon --}}
                            @include('dashboard.pages.users.create')

                            <p class="card-text">{{ __('dashboard.table_yajra_paragraph') }}.</p>
                            <table id="yajra_table" class="table table-striped table-bordered language-file">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('dashboard.name') }}</th>
                                        <th>{{ __('dashboard.email') }}</th>
                                        <th>{{ __('dashboard.email_verified_at') }}</th>
                                        <th>{{ __('dashboard.status') }}</th>
                                        <th>{{ __('dashboard.country') }}</th>
                                        <th>{{ __('dashboard.governorate') }}</th>
                                        <th>{{ __('dashboard.city') }}</th>
                                        <th>{{ __('dashboard.num_of_orders') }}</th>
                                        <th>{{ __('dashboard.created_at') }}</th>
                                        <th>{{ __('dashboard.actions') }}</th>
                                    </tr>
                                </thead>

                                <body>
                                    {{-- empty --}}
                                </body>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var lang = "{{ app()->getLocale() }}";
        $('#yajra_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: true,
            colReorder: true,
            rowReorder: {
                update: false,
                selector: "td:not(:first-child):not(:nth-child(4))",
            },
            // scroller: true,
            // scrollY: 900,
            select: true,
            responsive: {
                details: {
                    display: DataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details for Coupon : ' + data['code'];
                        }
                    }),
                    renderer: DataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
            ajax: "{{ route('dashboard.users.all') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'email_verified_at',
                    name: 'email_verified_at',

                },
                {
                    data: 'status',
                    name: 'status',

                },
                {
                    data: 'country',
                    name: 'country'

                },
                {
                    data: 'governorate',
                    name: 'governorate'

                },
                {
                    data: 'city',
                    name: 'city'

                },
                {
                    data: 'num_of_orders',
                    name: 'num_of_orders'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    searchable: false,
                    orderable: false,
                },

            ],
            layout: {
                topStart: {
                    buttons: ['colvis', 'copy', 'print', 'excel', 'pdf']
                }
            },

            language: lang === 'ar' ? {
                url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/ar.json',
            } : {},

        });

        // Create User Using Ajax
        $(document).on('submit', '#CreateUserForm', function(e) {
            e.preventDefault();
            var currentPage = $('#yajra_table').DataTable().page(); // get the current page number
            $.ajax({
                url: "{{ route('dashboard.users.store') }}",
                method: 'POST',
                data: new FormData(this),
                processData: false,

                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        $('#CreateUserForm')[0].reset();
                        $('#yajra_table').DataTable().page(currentPage).draw(false);
                        $('#createUserModal').modal('hide');
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            position: "top-center",
                            icon: "error",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                },
                error: function(data) {
                    if (data.responseJSON.errors) {
                        $('#error_list').empty();
                        $('#error_div').hide();
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('#error_list').append('<li>' + value[0] + '</li>');
                            $('#error_div').show();
                        });
                    }
                }
            });
        });

        // delete User
        $(document).on('click', '.delete_confirm_btn', function(e) {
            e.preventDefault();
            var currentPage = $('#yajra_table').DataTable().page(); // get the current page number

            var userId = $(this).attr('user-id');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('dashboard.users.destroy', 'id') }}".replace('id', userId),
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                Swal.fire({
                                    title: response.status,
                                    text: response.message,
                                    icon: "success"
                                });
                                $('#yajra_table').DataTable().page(currentPage).draw(false);
                            } else {
                                Swal.fire({
                                    title: response.status,
                                    text: response.message,
                                    icon: "error"
                                });
                            }
                        }
                    });

                }
            });

        });

        // manage User status
        $(document).on('click', '.manage_user_status', function(e) {
            e.preventDefault();
            var currentPage = $('#yajra_table').DataTable().page(); // get the current page number

            var userId = $(this).attr('user-id');

            $.ajax({
                url: "{{ route('dashboard.users.update-status') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: userId,
                },

                success: function(data) {
                    if (data.status == 'success') {
                        $('#yajra_table').DataTable().page(currentPage).draw(false);
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            position: "top-center",
                            icon: "erorr",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                }
            });
        });
    </script>
@endpush
