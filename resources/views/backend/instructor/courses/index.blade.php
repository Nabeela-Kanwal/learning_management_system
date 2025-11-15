@extends('layout.instructorapp')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Manage Courses</span> / Courses
            </h4>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Categories</h5>
                    <a href="{{ route('instructor.course.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus"></i> Add Course
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="courseTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Thumbnail</th>
                                    <th>Course Name</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Selling Price</th>
                                    <th>Discount Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody> <!-- Yajra will populate this -->
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('script')
    <script>
        // console.log("Yajra URL:", "{{ route('instructor.course.yajra') }}");
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            let courseTable = $('#courseTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('instructor.course.yajra') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
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
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'subcategory',
                        name: 'subcategory'
                    },
                    {
                        data: 'selling_price',
                        name: 'selling_price'
                    },
                    {
                        data: 'discount_price',
                        name: 'discount_price'
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
                    searchPlaceholder: "Search...",
                    search: "",
                }
            });

            window.deletecourse = function(itSelf, id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "This action cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('instructor.course.destroy') }}",
                            method: "DELETE",
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                courseTable.ajax.reload(null, false);
                                Swal.fire("Deleted!", "Course deleted successfully.",
                                    "success");
                            },
                            error: function() {
                                Swal.fire("Error!", "Something went wrong.", "error");
                            }
                        });
                    }
                });
            };
        });
    </script>
@endsection
