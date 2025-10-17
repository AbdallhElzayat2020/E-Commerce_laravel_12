@extends('dashboard.layouts.master')
@section('title', __('dashboard.attributes'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    {{-- create coupon modal --}}
                    <button type="button" class="btn btn-outline-success " data-toggle="modal" data-target="#AttributeModal">
                        {{ __('dashboard.create_attribute') }}
                    </button>
                    {{-- Modal For Create --}}
                    @include('dashboard.pages.products.attributes.create')
                    {{-- create coupon modal --}}
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table id="yajra_datatable" class="table table-striped table-bordered language-file">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('dashboard.attribute_name') }}</th>
                                <th>{{ __('dashboard.attribute_values') }}</th>
                                <th>{{ __('dashboard.created_at') }}</th>
                                <th>{{ __('dashboard.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

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

        $(document).ready(function () {
            $('#yajra_datatable').DataTable({
                rowReorder: true,
                processing: true,
                serverSide: true,
                colReorder: {
                    update: false,
                },
                fixedHeader: true,
                // scroller: true,
                // scrollY: 400,
                // select: true,
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
                ajax: "{{ route('dashboard.attributes.all') }}",
                columns: [{
                    name: 'id',
                    data: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'attributeValues',
                        name: 'attributeValues',
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

            // create coupon
            $('#createCoupon').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('dashboard.coupons.store') }}",
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,

                    success: function (data) {
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

                    error: function (data) {

                        if (data.responseJSON && data.responseJSON.errors) {

                            $('#error_list').empty();

                            $.each(data.responseJSON.errors, function (key, value) {

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
            $(document).on('click', '.edit_coupon', function (e) {
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
            $('#updateCoupon').on('submit', function (e) {
                e.preventDefault();
                let currentPage = $('#yajra_datatable').DataTable().page(); // get the current page number
                let coupon_id = $('#coupon_id').val();
                $.ajax({
                    url: "{{ route('dashboard.coupons.update', 'id') }}".replace('id', coupon_id),
                    method: 'post',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (data) {
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
                    error: function (data) {
                        if (data.responseJSON && data.responseJSON.errors) {
                            $('#error_list_edit').empty();
                            $.each(data.responseJSON.errors, function (key, value) {
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


            // delete coupon
            $(document).on('click', '.delete_confirm_btn', function (e) {
                e.preventDefault();

                let coupon_id = $(this).attr('coupon-id');

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
                            'url': "{{ route('dashboard.coupons.destroy', 'id') }}".replace('id', coupon_id),
                            type: 'DELETE',
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
                                    $('#yajra_datatable').DataTable().ajax.reload();
                                } else {
                                    Swal.fire({
                                        title: response.status,
                                        text: response.message,
                                        icon: "error"
                                    });
                                }
                            },
                        });
                    }
                });
            });
        });


        // add new values to attribute in case create
        $(document).ready(function () {
            let valueIndex = 2;
            $('.add_more').on('click', function (e) {
                e.preventDefault();
                let newRow = `
                    <div class="row attribute_values_row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="value_ar_">{{ __('dashboard.attribute_value_ar') }}</label>
                                <input type="text" name="value[${valueIndex}][ar]" class="form-control" id="value_ar_${valueIndex}"
                                    placeholder="{{ __('dashboard.attribute_value_ar') }}">
                                <strong class="text-danger"></strong>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="value_en_">{{ __('dashboard.attribute_value_en') }}</label>
                                <input type="text" name="value[${valueIndex}][en]" class="form-control" id="value_en_${valueIndex}"
                                    placeholder="{{ __('dashboard.attribute_value_en') }}">
                                <strong class="text-danger"></strong>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2">
                                <button type="button" class="btn btn-danger remove" ><i class="ft-x"></i></button>
                        </div>
                    </div>`;

                // Append the new row to the form
                $('.attribute_values_row:last').after(newRow);

                valueIndex++; // Increment the counter for the next row
            });
        });

        // ########### Delete Attribute Value Input Field ###########
        $(document).on('click', '.remove', function () {
            $(this).closest('.attribute_values_row').remove();
            $(this).closest('.attributeValuesContainer').remove();
        });

        // launch modal when error
        $(document).on('click', '#AttributeModal', function () {
            $('#error_modal').modal('show');
        })
    </script>
@endpush
