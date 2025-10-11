@extends('dashboard.layouts.master')
@section('title', __('dashboard.coupons'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    {{-- create coupon modal --}}
                    <button type="button" class="btn btn-outline-success " data-toggle="modal" data-target="#couponModal">
                        {{ __('dashboard.create_coupon') }}
                    </button>
                    {{-- Modal For Create --}}
                    @include('dashboard.pages.coupons.create')
                    {{-- create coupon modal --}}
                    {{-- edit coupon modal --}}
                    @include('dashboard.pages.coupons.edit')
                    {{-- edit coupon modal --}}
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table id="yajra_datatable" class="table table-striped table-bordered language-file">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('dashboard.code') }}</th>
                                    <th>{{ __('dashboard.discount') }}</th>
                                    <th>{{ __('dashboard.limitation') }}</th>
                                    <th>{{ __('dashboard.time_used') }}</th>
                                    <th>{{ __('dashboard.start_date') }}</th>
                                    <th>{{ __('dashboard.end_date') }}</th>
                                    <th>{{ __('dashboard.status') }}</th>
                                    <th>{{ __('dashboard.created_at') }}</th>
                                    <th>{{ __('dashboard.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#</td>
                                    <td>Code</td>
                                    <td>Discount Percentage</td>
                                    <td>Limit</td>
                                    <td>TimeUsed</td>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <td>status</td>
                                    <td>created_at</td>
                                    <td>Actions</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('dashboard_css')
@endpush


@push('js')
    <script>
        var lang = "{{ app()->getLocale() }}";

        $(document).ready(function() {
            $('#yajra_datatable').DataTable({
                rowReorder: true,
                processing: true,
                serverSide: true,
                colReorder: true,
                fixedHeader: true,
                // scroller: true,
                // scrollY: 400,
                // select: true,
                responsive: {
                    details: {
                        display: DataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return 'Details for ' + data[0] + ' ' + data[1];
                            }
                        }),
                        renderer: DataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                },
                ajax: "{{ route('dashboard.coupons.all') }}",
                columns: [{
                        name: 'id',
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'code',
                        name: 'code',
                    },
                    {
                        data: 'discount_percentage',
                        name: 'discount_percentage',
                    },
                    {
                        data: 'limit',
                        name: 'limit',
                    },
                    {
                        data: 'time_used',
                        name: 'time_used',
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                    },
                    {
                        data: 'end_date',
                        name: 'end_date',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
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

                language: lang === 'ar' ? {
                    url: 'https://cdn.datatables.net/plug-ins/2.3.4/i18n/ar.json',
                } : {},
            });

            $('#createCoupon').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('dashboard.coupons.store') }}",
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,

                    success: function(data) {
                        if (data.status === 'success') {
                            $('#createCoupon')[0].reset();
                            $('#yajra_datatable').DataTable().ajax.reload();
                            $('#couponModal').modal('hide');
                            $('#error_div').hide();
                            $('#error_list').empty();


                            Swal.fire({
                                position: "center",
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

                        if (data.responseJSON && data.responseJSON.errors) {

                            $('#error_list').empty();

                            $.each(data.responseJSON.errors, function(key, value) {

                                $('#error_list').append('<li>' + value[0] + '</li>');
                                $('#error_div').show();

                            });

                        } else {
                            $('#error_div').hide();
                            $('#error_list').empty();
                        }
                    }
                });
            })


            // edit coupon modal
            $(document).on('click', '.edit_coupon', function(e) {
                e.preventDefault();

                let couponId = $(this).attr('coupon-id');
                let couponCode = $(this).attr('coupon-code');
                let couponLimit = $(this).attr('coupon-limit');
                let couponDiscount = $(this).attr('coupon-discount');
                let couponStartDate = $(this).attr('coupon-start-date');
                let couponEndDate = $(this).attr('coupon-end-date');
                let couponStatus = $(this).attr('coupon-status');

                $('#coupon_id').val($(this).attr('coupon-id'));
                $('#coupon_code').val($(this).attr('coupon-code'));
                $('#coupon_limit').val($(this).attr('coupon-limit'));
                $('#coupon_discount').val($(this).attr('coupon-discount'));
                $('#coupon_start_date').val($(this).attr('coupon-start-date'));
                $('#coupon_end_date').val($(this).attr('coupon-end-date'));

                var status = $(this).attr('coupon-status');

                if (status == 'active') {
                    $('#active_coupon').prop('checked', true);
                } else {
                    $('#inactive_coupon').prop('checked', true);
                }
                $('#editCouponModal').modal('show');
            });

            // Update Coupon Using Ajax
            $('#updateCoupon').on('submit', function(e) {
                e.preventDefault();
                let currentPage = $('#yajra_datatable').DataTable().page(); // get the current page number
                let coupon_id = $('#coupon_id').val();
                $.ajax({
                    url: "{{ route('dashboard.coupons.update', 'id') }}".replace('id', coupon_id),
                    method: 'post',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.status == 'success') {
                            $('#yajra_datatable').DataTable().page(currentPage).draw(false);
                            $('#editCouponModal').modal('hide');
                            $('#error_div_edit').hide();
                            $('#error_list_edit').empty();
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
                        if (data.responseJSON && data.responseJSON.errors) {
                            $('#error_list_edit').empty();
                            $.each(data.responseJSON.errors, function(key, value) {
                                $('#error_list_edit').append('<li>' + value[0] +
                                    '</li>');
                                $('#error_div_edit').show();
                            });
                        } else {
                            $('#error_div_edit').hide();
                            $('#error_list_edit').empty();
                        }
                    }
                });
            });
        });
    </script>
@endpush
