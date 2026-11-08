@extends('layout.adminapp')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 d-flex align-items-center gap-2"><i class="bx bx-envelope" aria-hidden="true"></i> Contact Inquiries</h4>
        @include('message')
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.contact.index') }}" class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="search" class="form-label">Search inquiries</label>
                        <input id="search" name="search" class="form-control" value="{{ request('search') }}"
                            maxlength="200" placeholder="Name, email or subject">
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select">
                            <option value="">All statuses</option>
                            @foreach (\App\Models\Contact::STATUSES as $status)
                                <option value="{{ $status }}" @selected(request('status') === $status)>
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 align-self-end d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-1">
                            <i class="bx bx-filter-alt" aria-hidden="true"></i> Filter
                        </button>
                        <a href="{{ route('admin.contact.index') }}"
                            class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
                            <i class="bx bx-reset" aria-hidden="true"></i> Reset
                        </a>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Sender</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Received</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->name }}<br><small class="text-muted">{{ $contact->email }}</small></td>
                                    <td>{{ $contact->subject }}</td>
                                    <td><span
                                            class="badge bg-{{ $contact->status === 'new' ? 'primary' : ($contact->status === 'resolved' ? 'success' : 'warning') }}">{{ ucfirst(str_replace('_', ' ', $contact->status)) }}</span>
                                    </td>
                                    <td>{{ $contact->created_at->format('M d, Y H:i') }}</td>
                                    <td class="text-nowrap"><a href="{{ route('admin.contact.show', $contact) }}"
                                            class="text-primary me-2" title="View inquiry" aria-label="View inquiry">
                                            <i class="bx bx-show" aria-hidden="true"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.contact.destroy', $contact) }}"
                                            class="d-inline" data-contact-delete>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-transparent text-danger p-0"
                                                title="Delete inquiry" aria-label="Delete inquiry">
                                                <i class="bx bx-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">No inquiries found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $contacts->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.contact.delete-script')
@endsection
