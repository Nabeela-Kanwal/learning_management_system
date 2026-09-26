@extends('layout.adminapp')

@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">

            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Manage Testimonials</span> / Testimonials
            </h4>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Testimonials</h5>

                    <a href="{{ route('admin.testimonial.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus"></i> Add Testimonial
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="testimonialTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Quote</th>
                                    <th>Rating</th>
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

            let testimonialTable = $('#testimonialTable').DataTable({
                processing: true,
                serverSide: true,

                ajax: '{{ route('admin.testimonial.yajra') }}',

                columns: [{
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'quote',
                        name: 'quote'
                    },
                    {
                        data: 'rating',
                        name: 'rating'
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

            // Delete testimonial
            window.deletetestimonial = function(itSelf, id) {

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
                            url: "{{ route('admin.testimonial.destroy') }}",
                            method: "DELETE",

                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },

                            success: function(response) {

                                testimonialTable.ajax.reload(null, false);

                                Swal.fire(
                                    "Deleted!",
                                    "Testimonial has been deleted.",
                                    "success"
                                );
                            },

                            error: function() {

                                Swal.fire(
                                    "Error!",
                                    "Something went wrong.",
                                    "error"
                                );
                            }
                        });

                    }
                });
            }

        });
    </script>
@endsection
