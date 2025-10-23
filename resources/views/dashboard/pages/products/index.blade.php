@extends('dashboard.layouts.master')
@section('title')
    {{ __('dashboard.products') }}
@endsection

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.products_table') }}</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.home') }}">{{ __('dashboard.dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">
                                {{ __('dashboard.products') }}</a>
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
                            {{ __('dashboard.products') }}
                        </h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">

                            {{-- create coupon modal --}}
                            <a href="{{ route('dashboard.products.create') }}" class="btn btn-outline-success mb-1">
                                {{ __('dashboard.create_product') }}
                            </a>

                            <table id="yajra_table" class="table table-striped table-bordered language-file">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('dashboard.product_name') }}</th>
                                        <th>{{ __('dashboard.has_variants') }}</th>
                                        <th>{{ __('dashboard.images') }}</th>
                                        <th>{{ __('dashboard.status') }}</th>
                                        <th>{{ __('dashboard.sku') }}</th>
                                        <th>{{ __('dashboard.available_for') }}</th>
                                        <th>{{ __('dashboard.category') }}</th>
                                        <th>{{ __('dashboard.brand') }}</th>
                                        <th>{{ __('dashboard.price') }}</th>
                                        <th>{{ __('dashboard.quantity') }}</th>
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
        // display data
        console.log('Initializing DataTable...');
        let table = $('#yajra_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: true,
            error: function(xhr, error, thrown) {
                console.log('DataTable Error:', error);
                console.log('Response:', xhr.responseText);
                console.log('Status:', xhr.status);
            },

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
            ajax: {
                url: "{{ route('dashboard.products.all') }}",
                type: 'GET',
                dataSrc: function(json) {
                    console.log('DataTable Response:', json);
                    return json.data;
                },
                error: function(xhr, error, thrown) {
                    console.log('AJAX Error:', error);
                    console.log('Response:', xhr.responseText);
                    console.log('Status:', xhr.status);
                }
            },
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
                    data: 'has_variants',
                    name: 'has_variants',
                },
                {
                    data: 'images',
                    name: 'images',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'sku',
                    name: 'sku',
                },
                {
                    data: 'available_for',
                    name: 'available_for',

                },
                {
                    data: 'category',
                    name: 'category',

                },
                {
                    data: 'brand',
                    name: 'brand',
                },
                {
                    data: 'price',
                    name: 'price'

                },

                {
                    data: 'quantity',
                    name: 'quantity',

                },
                {
                    data: 'actions',
                    searchable: false,
                    orderable: false,
                },

            ],

            layout: {
                topStart: {
                    buttons: ['colvis', 'copy', 'print', 'excel', 'pdf']
                }
            },


            language: "{{ app()->getLocale() }}" === 'ar' ? {
                url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/ar.json',
                error: function() {
                    console.log('Failed to load Arabic translation for DataTables');
                }
            } : {},


        });

        // disable the row order when cliking
        $('table').on('mousedown', 'button', function(e) {
            table.rowReorder.disable();
        });
        $('table').on('mouseup', 'button', function(e) {
            table.rowReorder.enable();
        });

        // manage product status
        $(document).on('click', '.status_btn', function(e) {
            e.preventDefault();
            var currentPage = $('#yajra_table').DataTable().page(); // get the current page number

            var product_id = $(this).attr('product-id');

            $.ajax({
                url: "{{ route('dashboard.products.update-status') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: product_id,
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

        // delete Product
        $(document).on('click', '.delete_confirm_btn', function(e) {
            e.preventDefault();
            var product_id = $(this).attr('product-id');

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
                        url: "{{ route('dashboard.products.destroy', ':id') }}".replace(':id',
                            product_id),
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: product_id,
                        },
                        success: function(response) {
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
