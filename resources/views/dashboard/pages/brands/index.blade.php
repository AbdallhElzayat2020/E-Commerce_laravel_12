@extends('dashboard.layouts.master')
@section('title', __('dashboard.brands'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    {{-- create brand modal --}}
                    <button type="button" class="btn btn-outline-success " data-toggle="modal" data-target="#exampleModal">
                        {{ __('dashboard.create_brand') }}
                    </button>
                    {{-- Modal For Create --}}
                    @include('dashboard.pages.brands.create')
                    {{-- create brand modal --}}
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table id="yajra_datatable" class="table table-striped table-bordered language-file">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('dashboard.name') }}</th>
                                    <th>{{ __('dashboard.logo') }}</th>
                                    <th>{{ __('dashboard.status') }}</th>
                                    <th>{{ __('dashboard.products_count') }}</th>
                                    <th>{{ __('dashboard.created_at') }}</th>
                                    <th>{{ __('dashboard.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#</td>
                                    <td>Logo</td>
                                    <td>name</td>
                                    <td>status</td>
                                    <td>Products Count</td>
                                    <td>created_at</td>
                                    <td>actions</td>
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
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#exampleModal').modal('show');
            });
        </script>
    @endif

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
                ajax: "{{ route('dashboard.brands.all') }}",
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
                        data: 'logo',
                        name: 'logo',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'products_count',
                        name: 'products_count',
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
        });
    </script>
@endpush
