@extends('layout.adminapp')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Manage Info Cards</span> / Info Cards
            </h4>
            @if (session('success'))
                <div class="alert alert-success" role="status">{{ session('success') }}</div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Info Cards</h5>
                    <a href="{{ route('admin.info.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus" aria-hidden="true"></i> Add Info Card
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Icon</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($infos as $info)
                                    <tr>
                                        <td>{{ $info->title }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($info->description, 100) }}</td>
                                        <td>{{ \App\Models\Info::ICONS[$info->icon] ?? $info->icon }}</td>
                                        <td>{{ $info->sort_order }}</td>
                                        <td><span
                                                class="badge {{ $info->status ? 'bg-primary' : 'bg-danger' }}">{{ $info->status ? 'Active' : 'Inactive' }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a class="text-primary me-2" title="Edit" aria-label="Edit info card"
                                                    href="{{ route('admin.info.edit', $info->id) }}">
                                                    <i class="bx bxs-show" aria-hidden="true"></i>
                                                </a>
                                                <form action="{{ route('admin.info.destroy', $info->id) }}" method="POST"
                                                    class="delete-info-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn p-0 border-0 text-danger"
                                                        title="Delete" aria-label="Delete info card">
                                                        <i class="bx bx-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">No info cards yet. Add your first card to
                                            show it on Home.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">{{ $infos->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(function() {
            $('.delete-info-form').on('submit', function(event) {
                event.preventDefault();
                const form = this;

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
