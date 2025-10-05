@extends('dashboard.layouts.master')
@section('title', __('dashboard.categories'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Language file</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table id="yajra_datatable" class="table table-striped table-bordered language-file">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    {{--                                <th>Status</th> --}}
                                    {{--                                <th>Created At</th> --}}
                                    {{--                                <th>Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#</td>
                                    <td>name</td>
                                    <td>slug</td>
                                    {{--                                <td>status</td> --}}
                                    {{--                                <td>created_at</td> --}}
                                    {{--                                <td>actions</td> --}}
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
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">
@endpush

@push('js')
    <script src="//cdn.datatables.net/2.3.4/js/dataTables.min.js" type="text/javascript"></script>


    <script>
        $(document).ready(function() {
            $('#yajra_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.categories.all') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                ],
                language: {
                    processing: "loading",
                    search: "البحث:",
                    lengthMenu: "عرض _MENU_ عنصر",
                    info: "عرض _START_ إلى _END_ من _TOTAL_ عنصر",
                    infoEmpty: "عرض 0 إلى 0 من 0 عنصر",
                    infoFiltered: "(مفلتر من _MAX_ إجمالي عناصر)",
                    paginate: {
                        first: "الأول",
                        last: "الأخير",
                        next: "التالي",
                        previous: "السابق"
                    }
                }
            });
        });
    </script>
@endpush
