@extends('layout.adminapp')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-secondary mb-3">Back to inquiries</a>
    @include('message')
    <div class="card mb-4"><div class="card-body">
        <h4>{{ $contact->subject }}</h4>
        <p>From {{ $contact->name }} ({{ $contact->email }})<br><small>Received {{ $contact->created_at->format('M d, Y H:i') }}</small></p>
        <div class="mb-4" style="white-space: pre-wrap; overflow-wrap: anywhere;">{{ $contact->message }}</div>
        <form method="POST" action="{{ route('admin.contact.update', $contact) }}" class="d-flex gap-2 align-items-end flex-wrap">
            @csrf @method('PATCH')
            <div><label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                    @foreach (\App\Models\Contact::STATUSES as $status)
                        <option value="{{ $status }}" @selected(old('status', $contact->status) === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary">Update status</button>
        </form>
        @error('status')<p class="text-danger">{{ $message }}</p>@enderror
    </div></div>
    <div class="card mb-4"><div class="card-body">
        @if ($contact->replied_at)
            <h5>Last reply — {{ $contact->replied_at->format('M d, Y H:i') }}</h5>
            <p style="white-space: pre-wrap; overflow-wrap: anywhere;">{{ $contact->reply }}</p>
        @endif
        <form method="POST" action="{{ route('admin.contact.reply', $contact) }}">
            @csrf
            <label for="reply" class="form-label">Email reply to {{ $contact->email }}</label>
            <textarea id="reply" name="reply" class="form-control mb-2" rows="7" required maxlength="10000">{{ old('reply') }}</textarea>
            @error('reply')<p class="text-danger">{{ $message }}</p>@enderror
            <button class="btn btn-primary">Send reply and resolve</button>
        </form>
    </div></div>
    <form method="POST" action="{{ route('admin.contact.destroy', $contact) }}" onsubmit="return confirm('Permanently delete this inquiry?');">
        @csrf @method('DELETE')
        <button class="btn btn-danger">Delete inquiry</button>
    </form>
</div>
@endsection
