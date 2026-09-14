@extends('layout.adminapp')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3">Contact Inquiries</h4>
    @include('message')
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.contact.index') }}" class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="search" class="form-label">Search inquiries</label>
                    <input id="search" name="search" class="form-control" value="{{ request('search') }}" maxlength="200" placeholder="Name, email or subject">
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="">All statuses</option>
                        @foreach (\App\Models\Contact::STATUSES as $status)
                            <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 align-self-end"><button class="btn btn-primary">Filter</button> <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-secondary">Reset</a></div>
            </form>
            <div class="table-responsive">
                <table class="table">
                    <thead><tr><th>Sender</th><th>Subject</th><th>Status</th><th>Received</th><th>Action</th></tr></thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}<br><small>{{ $contact->email }}</small></td>
                                <td>{{ $contact->subject }}</td>
                                <td><span class="badge bg-{{ $contact->status === 'new' ? 'primary' : ($contact->status === 'resolved' ? 'success' : 'warning') }}">{{ ucfirst(str_replace('_', ' ', $contact->status)) }}</span></td>
                                <td>{{ $contact->created_at->format('M d, Y H:i') }}</td>
                                <td><a href="{{ route('admin.contact.show', $contact) }}" class="btn btn-sm btn-outline-primary">View</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-4">No inquiries found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $contacts->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
</div>
@endsection
