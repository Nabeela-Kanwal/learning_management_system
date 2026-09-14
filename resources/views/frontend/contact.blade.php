@extends('layout.frontapp')
@section('content')
<section class="contact-area section--padding">
    <div class="container">
        <div class="row justify-content-center"><div class="col-lg-8">
            <h1 class="section__title mb-3">Contact Us</h1>
            <p class="mb-4">Have a question? Send us a message and our team will get back to you.</p>
            @if (session('success'))<div class="alert alert-success" role="status">{{ session('success') }}</div>@endif
            <form method="POST" action="{{ route('contact.store') }}">
                @csrf
                @foreach (['name' => 'Name', 'email' => 'Email', 'subject' => 'Subject'] as $field => $label)
                    <div class="form-group">
                        <label for="{{ $field }}">{{ $label }}</label>
                        <input id="{{ $field }}" type="{{ $field === 'email' ? 'email' : 'text' }}" name="{{ $field }}" value="{{ old($field) }}" class="form-control @error($field) is-invalid @enderror" required maxlength="{{ ['name' => 100, 'email' => 255, 'subject' => 200][$field] }}">
                        @error($field)<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                @endforeach
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="7" class="form-control @error('message') is-invalid @enderror" required maxlength="10000">{{ old('message') }}</textarea>
                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button class="btn theme-btn" type="submit">Send message</button>
            </form>
        </div></div>
    </div>
</section>
@endsection
