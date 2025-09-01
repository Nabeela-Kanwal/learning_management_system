@extends('layout.adminapp')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Manage Banners</span> / Banner
            </h4>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Banner</h5>
                    <a href="{{ route('admin.banner.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus"></i> Add banner
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="bannerTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Tital</th>
                                    <th>Page</th>
                                    <th>Sort Order</th>
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
            let bannerTable = $('#bannerTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.banner.yajra') }}',
                columns: [{
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'page',
                        name: 'page'
                    },
                    {
                        data: 'sort_order',
                        name: 'sort_order'
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

            // Make deletebanner accessible globally
            window.deletebanner = function(itSelf, id) {
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
                            url: "{{ route('admin.banner.destroy') }}",
                            method: "DELETE",
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                bannerTable.ajax.reload(null,
                                    false); // false to keep pagination
                                Swal.fire("Deleted!", "banner has been deleted.",
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
