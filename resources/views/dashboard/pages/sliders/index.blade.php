@extends('dashboard.layouts.master')
@section('title')
    {{ __('dashboard.sliders') }}
@endsection

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.sliders_table') }}</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.home') }}">{{ __('dashboard.dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.sliders.index') }}">
                                {{ __('dashboard.sliders') }}</a>
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
                            {{ __('dashboard.sliders') }}
                        </h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            {{-- create slider modal --}}
                            <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                data-target="#createSliderModal">
                                {{ __('dashboard.create_slider') }}
                            </button>

                            {{-- modals --}}
                            @include('dashboard.pages.sliders._create')
                            @include('dashboard.pages.sliders._edit')
                            {{-- end modals --}}

                            <table id="yajra_table" class="table table-striped table-bordered language-file">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('dashboard.image') }}</th>
                                        <th>{{ __('dashboard.note') }}</th>
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

    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#createSliderModal').modal('show');
            });
        </script>
    @endif

    {{--  Data tables  --}}
    <script>
        var lang = "{{ app()->getLocale() }}";


        $('#yajra_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: true,
            colReorder: true,
            select: true,
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
            ajax: "{{ route('dashboard.sliders.all') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'file_name',
                    name: 'file_name',
                },
                {
                    data: 'note',
                    name: 'note',
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


        // edit slider
        $(document).on('click', '.edit_slider_btn', function(e) {
            e.preventDefault();
            var slider_id = $(this).attr('slider-id');

            $.ajax({
                url: "{{ route('dashboard.sliders.edit', 'SLIDER_ID_PLACEHOLDER') }}".replace(
                    'SLIDER_ID_PLACEHOLDER', slider_id),
                type: "GET",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if (response.status == 'success') {
                        // Populate form fields
                        $('#edit_slider_id').val(response.slider.id);
                        $('#edit_note_ar').val(response.slider.note_ar || '');
                        $('#edit_note_en').val(response.slider.note_en || '');

                        // Set form action
                        $('#editSliderForm').attr('action',
                            "{{ route('dashboard.sliders.update', 'SLIDER_ID_PLACEHOLDER') }}"
                            .replace('SLIDER_ID_PLACEHOLDER',
                                slider_id));

                        // Initialize file input with existing image
                        $('#edit-single-image').fileinput('destroy');
                        var fileInputOptions = {
                            theme: 'fa5',
                            language: lang,
                            allowedFileTypes: ['image'],
                            maxFileCount: 1,
                            enableResumableUpload: false,
                            showUpload: false,
                            initialPreviewAsData: true
                        };

                        // Only add initialPreview if file_name exists
                        if (response.slider.file_name) {
                            fileInputOptions.initialPreview = [response.slider.file_name];
                        }

                        $('#edit-single-image').fileinput(fileInputOptions);

                        // Show modal
                        $('#editSliderModal').modal('show');
                    } else {
                        Swal.fire({
                            title: response.status || "Error",
                            text: response.message || "Failed to load slider data",
                            icon: "error"
                        });
                    }
                },
                error: function(xhr) {
                    var errorMessage = "Failed to load slider data";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.status === 404) {
                        errorMessage = "Slider not found";
                    } else if (xhr.status === 500) {
                        errorMessage = "Server error occurred";
                    }
                    Swal.fire({
                        title: "Error",
                        text: errorMessage,
                        icon: "error"
                    });
                }
            });
        });

        // update slider form submission
        $('#editSliderForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var slider_id = $('#edit_slider_id').val();
            var currentPage = $('#yajra_table').DataTable().page();

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    $('#editSliderModal').modal('hide');
                    $('#yajra_table').DataTable().page(currentPage).draw(false);
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: response.message || "{{ __('dashboard.success_msg') }}",
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validation errors
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '\n';
                        });
                        Swal.fire({
                            title: "Validation Error",
                            text: errorMessages,
                            icon: "error"
                        });
                    } else {
                        var errorMsg = xhr.responseJSON && xhr.responseJSON.message ?
                            xhr.responseJSON.message :
                            "{{ __('dashboard.error_msg') }}";
                        Swal.fire({
                            title: "Error",
                            text: errorMsg,
                            icon: "error"
                        });
                    }
                }
            });
        });

        // delete slider
        $(document).on('click', '.delete_confirm_btn', function(e) {
            e.preventDefault();
            var slider_id = $(this).attr('slider-id');

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
                        url: "{{ route('dashboard.sliders.delete', 'SLIDER_ID_PLACEHOLDER') }}"
                            .replace('SLIDER_ID_PLACEHOLDER',
                                slider_id),
                        type: "GET",
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
