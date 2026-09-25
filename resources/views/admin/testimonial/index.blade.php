@extends('layout.adminapp')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3">Testimonials</h4>
            @if (session('success'))
                <div class="alert alert-success" role="status">{{ session('success') }}</div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Student feedback</h5>
                    <a href="{{ route('admin.testimonial.create') }}" class="btn btn-primary">Add testimonial</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Feedback</th>
                                <th>Rating</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($testimonials as $testimonial)
                                <tr>
                                    <td>{{ $testimonial->name }}<small
                                            class="d-block text-muted">{{ $testimonial->role }}</small></td>
                                    <td>{{ Str::limit($testimonial->quote, 100) }}</td>
                                    <td>{{ $testimonial->rating }}/5</td>
                                    <td>{{ $testimonial->sort_order }}</td>
                                    <td>{{ $testimonial->status ? 'Published' : 'Draft' }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-primary"
                                            href="{{ route('admin.testimonial.edit', $testimonial) }}">Edit</a>
                                        <form class="d-inline" method="POST"
                                            action="{{ route('admin.testimonial.destroy', $testimonial) }}"
                                            onsubmit="return confirm('Delete this testimonial?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No testimonials yet. Add and publish student
                                        feedback to display it on the homepage.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-body">{{ $testimonials->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>
    </div>
@endsection
