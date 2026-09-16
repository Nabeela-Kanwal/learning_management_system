@extends('layout.frontapp')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/contact.css') }}">
@endpush

@section('content')
    <section class="breadcrumb-area page-banner blog-banner contact-banner img-bg-2"
        @if ($banner?->image) style="background-image: url('{{ asset($banner->image) }}')" @endif>
        <div class="container-fluid px-3 px-lg-4">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-start text-left">
                <div class="section-heading text-left">
                    <h1 class="section__title">{{ $banner?->title ?: 'Contact Us' }}</h1>
                    <p class="section__desc pt-3">{{ $banner?->description ?: 'Have a question? We’re here to help you keep learning.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-modern" aria-labelledby="contact-heading">
        <div class="container-fluid px-3 px-lg-4">
            <div class="contact-intro">
                <span class="contact-eyebrow">WE’RE HERE FOR YOU</span>
                <h2 id="contact-heading">A little help. A lot of possibilities.</h2>
                <p>Questions, ideas, or a little guidance. Let’s take the next step together.</p>
            </div>
            <div class="contact-grid">
                <aside class="contact-sidebar" aria-labelledby="contact-support-heading">
                    <div class="contact-support">
                        <span class="contact-support-icon"><i class="la la-comments" aria-hidden="true"></i></span>
                        <span class="contact-eyebrow">LET’S CONNECT</span>
                        <h3 id="contact-support-heading">Your learning journey<br>matters to us.</h3>
                        <p>Tell us what’s on your mind. We’ll reply to the email address you share.</p>
                        <div class="contact-topics">
                            <div class="contact-topic">
                                <i class="la la-book-open" aria-hidden="true"></i>
                                <div><h4>Find your next course</h4><p>Get guidance on courses and learning paths.</p></div>
                            </div>
                            <div class="contact-topic">
                                <i class="la la-user-circle" aria-hidden="true"></i>
                                <div><h4>Get account support</h4><p>Ask for help with access or your account.</p></div>
                            </div>
                            <div class="contact-topic">
                                <i class="la la-lightbulb" aria-hidden="true"></i>
                                <div><h4>Share an idea</h4><p>Help us make learning better for everyone.</p></div>
                            </div>
                        </div>
                        <div class="contact-support-note"><span></span>Real questions. Thoughtful answers.</div>
                    </div>
                    <a class="contact-explore" href="{{ url('/courses') }}">
                        <span><strong>Keep your curiosity going</strong><small>Explore something new while you’re here.</small></span>
                        <i class="la la-arrow-right" aria-hidden="true"></i>
                    </a>
                </aside>
                <div class="contact-form-card">
                    <div class="contact-form-heading">
                        <div><span class="contact-eyebrow">DROP US A NOTE</span><h3>Send us a message</h3></div>
                        <span class="contact-form-icon"><i class="la la-paper-plane" aria-hidden="true"></i></span>
                    </div>
                    <p id="contact-required" class="contact-form-description">A few details will help us point you in the right direction. All fields are required.</p>

                        @if (session('success'))
                            <div id="contact-success" class="alert alert-success" role="status" tabindex="-1" autofocus>
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
                            <button class="btn contact-submit" type="submit">
                                Send message <i class="la la-paper-plane ml-1" aria-hidden="true"></i>
                            </button>
                        </form>
                </div>
            </div>
            <div class="contact-faq" aria-labelledby="contact-faq-heading">
                <div><span class="contact-eyebrow">GOOD TO KNOW</span><h2 id="contact-faq-heading">Before you hit send.</h2><p>A little context helps us help you.</p></div>
                <div class="contact-faq-items">
                    <details><summary>What should I include in my message?</summary><p>Share the course name or account issue, what you were trying to do, and any error message you saw. Please leave out passwords and payment details.</p></details>
                    <details><summary>How will I receive a reply?</summary><p>Our team will respond to the email address you enter in the form. Double-check it before sending so we can reach you.</p></details>
                    <details><summary>Can I share feedback or suggest a course?</summary><p>Absolutely. Tell us what you would like to learn or how we could improve your experience. We welcome your ideas.</p></details>
                </div>
            </div>
        </div>
    </section>
    @if (session('success'))
        <script>
            window.setTimeout(function () {
                document.getElementById('contact-success')?.remove();
            }, 5000);
        </script>
    @endif
@endsection
