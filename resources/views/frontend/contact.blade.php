@extends('layout.frontapp')

@section('content')
    <section class="breadcrumb-area py-5 bg-gray">
        <div class="container">
            <nav aria-label="Breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact us</li>
                </ol>
            </nav>
            <h1 class="section__title mb-3">Contact Us</h1>
            <p class="section__desc">Have a question? We’re here to help you keep learning.</p>
        </div>
    </section>

    <section class="contact-area section--padding" aria-labelledby="contact-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <span class="ribbon mb-3">Let’s talk</span>
                    <h2 id="contact-heading" class="fs-30 font-weight-semi-bold mb-3">How can we help?</h2>
                    <p class="mb-4">Send us your question about a course, your account, or your learning experience. Our
                        team will reply to the email address you provide.</p>
                    <div class="d-flex mb-4">
                        <i class="la la-book-open fs-30 mr-3 text-primary" aria-hidden="true"></i>
                        <div>
                            <h3 class="fs-18 font-weight-semi-bold mb-2">Course questions</h3>
                            <p>Include the course name so we can help you find the right information.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <i class="la la-user fs-30 mr-3 text-primary" aria-hidden="true"></i>
                        <div>
                            <h3 class="fs-18 font-weight-semi-bold mb-2">Account support</h3>
                            <p>Tell us what happened and include any error message you saw.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <i class="la la-comment fs-30 mr-3 text-primary" aria-hidden="true"></i>
                        <div>
                            <h3 class="fs-18 font-weight-semi-bold mb-2">Feedback and suggestions</h3>
                            <p>Share your ideas for improving your learning experience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card shadow-sm p-4 p-md-5">
                        <h2 class="fs-24 font-weight-semi-bold mb-2">Send us a message</h2>
                        <p id="contact-required" class="mb-4">All fields are required.</p>

                        @if (session('success'))
                            <div class="alert alert-success" role="status" tabindex="-1" autofocus>
                                <i class="la la-check-circle mr-1" aria-hidden="true"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert" tabindex="-1" autofocus>
                                <p class="font-weight-semi-bold mb-2">Please check the following fields and try again.</p>
                                <ul class="mb-0 pl-3">
                                    @foreach (['name' => 'Name', 'email' => 'Email', 'subject' => 'Subject', 'message' => 'Message'] as $field => $label)
                                        @error($field)
                                            <li><a href="#contact-{{ $field }}" class="text-dark">{{ $message }}</a>
                                            </li>
                                        @enderror
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('contact.store') }}" aria-describedby="contact-required">
                            @csrf
                            <div class="row">
                                @foreach (['name' => 'Name', 'email' => 'Email', 'subject' => 'Subject'] as $field => $label)
                                    <div class="{{ $field === 'subject' ? 'col-12' : 'col-md-6' }}">
                                        <div class="form-group mb-4">
                                            <label for="contact-{{ $field }}"
                                                class="font-weight-semi-bold">{{ $label }}</label>
                                            <input id="contact-{{ $field }}"
                                                type="{{ $field === 'email' ? 'email' : 'text' }}"
                                                name="{{ $field }}" value="{{ old($field) }}"
                                                class="form-control @error($field) is-invalid @enderror"
                                                placeholder="{{ ['name' => 'Your full name', 'email' => 'you@example.com', 'subject' => 'What can we help you with?'][$field] }}"
                                                @if ($field !== 'subject') autocomplete="{{ $field }}" @endif
                                                @error($field) aria-invalid="true" aria-describedby="contact-{{ $field }}-error" @enderror
                                                required
                                                maxlength="{{ ['name' => 100, 'email' => 255, 'subject' => 200][$field] }}">
                                            @error($field)
                                                <div id="contact-{{ $field }}-error" class="invalid-feedback">
                                                    {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group mb-4">
                                <label for="contact-message" class="font-weight-semi-bold">Message</label>
                                <textarea id="contact-message" name="message" rows="7" class="form-control @error('message') is-invalid @enderror"
                                    placeholder="Tell us a little more about your question…"
                                    aria-describedby="contact-message-help @error('message') contact-message-error @enderror"
                                    @error('message') aria-invalid="true" @enderror required maxlength="10000">{{ old('message') }}</textarea>
                                @error('message')
                                    <div id="contact-message-error" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small id="contact-message-help" class="form-text text-muted">Up to 10,000 characters.
                                    Please don’t include passwords or payment details.</small>
                            </div>
                            <button class="btn theme-btn" type="submit">
                                Send message <i class="la la-paper-plane ml-1" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
