@extends('layout.adminapp')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Manage SubCategories</span> / SubCategories
            </h4>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">SubCategories</h5>
                    <a href="{{ route('admin.sub-category.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus"></i> Add SubCategory
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="subCategoryTable" class="table table-bordered">
                            <thead>
                                <tr>

                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Created At</th>
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
            let subCategoryTable = $('#subCategoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.sub-category.yajra') }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'category',
                        name: 'category',
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
                    search: ""
                },
            });

            window.deleteSubCategory = function(id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "This will delete the subcategory!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/sub-categories/destroy/" + id,
                            type: "post",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                subCategoryTable.ajax.reload(null, false);
                                Swal.fire("Deleted!", "SubCategory has been deleted.",
                                    "success");
                            },
                            error: function(xhr) {
                                Swal.fire("Error!", xhr.responseText ||
                                    "Something went wrong.", "error");
                            }
                        });
                    }
                });
            }
        });
    </script>
@endsection
