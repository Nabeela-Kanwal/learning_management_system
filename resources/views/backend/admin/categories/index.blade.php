@extends('layout.adminapp')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Manage Categories</span> / Categories
            </h4>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Categories</h5>
                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus"></i> Add Category
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="categoryTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
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
        $(function() {
            let categoryTable = $('#categoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.category.yajra') }}',
                columns: [{
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
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

            // Make deleteCategory accessible globally
            window.deleteCategory = function(itSelf, id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.category.destroy') }}", // Ensure this route accepts POST or DELETE with id in request
                            method: "DELETE",
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                // Refresh the datatable
                                categoryTable.ajax.reload(null,
                                false); // false to keep pagination
                                Swal.fire("Deleted!", "Category has been deleted.",
                                    "success");
                            },
                            error: function() {
                                Swal.fire("Error!", "Something went wrong.", "error");
                            }
                        });
                    }
                });
            }
        });
    </script>
@endsection
