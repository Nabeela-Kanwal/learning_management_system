@extends('layout.adminapp')

@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Manage Blogs</span> / Blogs
            </h4>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Blogs</h5>
                    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus"></i> Add Blog
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="blogTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Published</th>
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
            const blogTable = $('#blogTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.blog.yajra') }}',
                columns: [{
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'author',
                        name: 'author'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'published_at',
                        name: 'published_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [],
                responsive: true,
                language: {
                    searchPlaceholder: "Search...",
                    search: "",
                    emptyTable: "No blogs found."
                }
            });

            window.deleteBlog = function(itSelf, id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "This blog will be deleted.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.blog.destroy') }}",
                            method: "DELETE",
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function() {
                                blogTable.ajax.reload(null, false);
                                Swal.fire("Deleted!", "Blog has been deleted.", "success");
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
