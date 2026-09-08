@extends('layout.adminapp')

@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Content</span> / Blogs
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
                        <table class="table table-bordered align-middle">
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
                            <tbody>
                                @forelse ($blogs as $blog)
                                    <tr>
                                        <td>
                                            @if ($blog->image)
                                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}"
                                                    width="60" height="45" style="object-fit: cover; border-radius: 6px;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $blog->title }}</div>
                                            <small class="text-muted">{{ $blog->slug }}</small>
                                        </td>
                                        <td>{{ $blog->author ?: 'Admin' }}</td>
                                        <td>
                                            @if ($blog->status)
                                                <span class="badge bg-primary">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $blog->published_at?->format('M d, Y') ?? 'Not set' }}</td>
                                        <td>
                                            <a href="{{ route('admin.blog.edit', $blog->id) }}" class="text-primary me-2"
                                                title="Edit">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>
                                            <a href="javascript:;" onclick="deleteBlog({{ $blog->id }})"
                                                class="text-danger" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">No blogs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteBlog(id) {
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
                            location.reload();
                        },
                        error: function() {
                            Swal.fire("Error!", "Something went wrong.", "error");
                        }
                    });
                }
            });
        }
    </script>
@endsection
