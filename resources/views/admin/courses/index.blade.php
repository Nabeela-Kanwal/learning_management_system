@extends('layout.adminapp')
@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Manage Courses</span> / Courses
            </h4>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Courses</h5>
                    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus"></i> Add Course
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="courseTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Instructor</th>
                                    <th>Category</th>
                                    <th>Selling Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('#courseTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.courses.yajra') }}',
                order: [
                    [1, 'asc']
                ],
                columns: [{
                        data: 'course_image',
                        name: 'course_image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'course_title',
                        name: 'course_title'
                    },
                    {
                        data: 'instructor_name',
                        name: 'instructor.name'
                    },
                    {
                        data: 'category_name',
                        name: 'category.name'
                    },
                    {
                        data: 'selling_price',
                        name: 'selling_price',
                        orderable: false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                responsive: true,
                language: {
                    searchPlaceholder: 'Search...',
                    search: '',
                    emptyTable: 'No courses available.'
                }
            });
        });
    </script>
@endsection
