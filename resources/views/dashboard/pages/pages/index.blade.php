@extends('dashboard.layouts.master')
@section('title',__('dashboard.pages'))

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.pages_table') }}</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.home') }}">
                                {{ __('dashboard.dashboard') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.pages.index') }}">
                                {{ __('dashboard.pages') }}</a>
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
                            {{ __('dashboard.pages') }}
                        </h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            {{-- create slider modal --}}
                            <a href="{{ route('dashboard.pages.create') }}" type="button" class="btn btn-outline-success">
                                {{ __('dashboard.create_page') }}
                            </a>

                            <table id="yajra_table" class="table table-striped table-bordered language-file">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('dashboard.title') }}</th>
                                    <th>{{ __('dashboard.image') }}</th>
                                    <th>{{ __('dashboard.content') }}</th>
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
    {{--  Data tables  --}}
    <script>
        var lang = "{{ app()->getLocale() }}";

        $('#yajra_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: true,
            colReorder: true,
            select: false,
            responsive: {
                details: {
                    display: DataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details for ' + data[0] + ' ' + data[1];
                        }
                    }),
                    renderer: DataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
            ajax: "{{ route('dashboard.pages.all') }}",
            columns: [{
                data: 'DT_RowIndex',
                searchable: false,
                orderable: false,
            },
                {
                    data: 'title',
                    name: 'title',
                },
                {
                    data: 'image',
                    name: 'image',
                },
                {
                    data: 'content',
                    name: 'content',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'action',
                    searchable: false,
                    orderable: false,
                },

            ],
            layout: {
                topStart: {
                    buttons: ['colvis', 'copy']
                }
            },


            language: lang === 'ar' ? {
                url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/ar.json',
            } : {},


        });


        // delete Coupon
        $(document).on('click', '.delete_confirm_btn', function (e) {
            e.preventDefault();
            var page_id = $(this).attr('page-id');

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
                        url: "{{ route('dashboard.pages.destroy', 'id') }}".replace('id',
                            page_id),
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            if (response.status == 'success') {
                                Swal.fire({
                                    title: response.status,
                                    text: response.message,
                                    icon: "success"
                                });
                                $('#yajra_table').DataTable().ajax.reload();
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
    </script>
@endpush
