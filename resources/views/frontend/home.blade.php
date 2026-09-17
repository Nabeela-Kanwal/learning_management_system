@extends('layout.frontapp')
@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/course-catalog.css') }}">
@endpush

@section('content')
    <section class="hero-area" aria-label="Featured learning opportunities">
        <div class="hero-slider owl-action-styled">
            @foreach ($banners->isNotEmpty() ? $banners : [null] as $banner)
                <div class="page-banner blog-banner brand-banner img-bg-2"
                    @if ($banner?->image) style="background-image: url('{{ asset($banner->image) }}')" @endif>
                    <div class="container-fluid px-3 px-lg-4">
                        <div class="section-heading">
                            <span class="brand-banner-eyebrow">YOUR NEXT CHAPTER STARTS HERE</span>
                            <h2 class="section__title">{{ $banner?->title ?: 'Build your skills. Open new doors.' }}</h2>
                            <p class="section__desc pt-3">{{ $banner?->description ?: 'Discover new interests, learn from passionate instructors, and move closer to your goals.' }}</p>
                            <a href="#home-courses" class="btn brand-banner-button mt-4">Explore courses <i class="la la-arrow-right ml-2" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="feature-area pb-90px">
        @include('components.featured.feature-section')
    </section>
    <section class="category-area home-categories pb-90px" aria-labelledby="popular-categories-title">
        <div class="container-fluid px-3 px-lg-4">
            <div class="category-section-heading">
                <div>
                    <span class="category-eyebrow">FIND YOUR NEXT CHAPTER</span>
                    <h2 id="popular-categories-title">Popular Categories</h2>
                    <p>Follow your curiosity. Find a subject that inspires you.</p>
                </div>
                <a href="{{ route('category.index') }}" class="category-browse-link">
                    All categories <i class="la la-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
            @include('components.category.category')
        </div>
    </section>

    <section id="home-courses" class="course-area course-catalog py-5">
        @include('components.courses.course-section')
    </section>

    <section class="course-area pb-90px">
        @include('components.courses.best-courses-section')

    </section>
    <section class="funfact-area text-center overflow-hidden pt-20px pb-80px dot-bg">
        @include('components.funfact.fun-fact-area')
    </section>

    <section class="cat-area pt-80px pb-80px bg-gray position-relative">
        <span class="ring-shape ring-shape-1"></span>
        <span class="ring-shape ring-shape-2"></span>
        <span class="ring-shape ring-shape-3"></span>
        <span class="ring-shape ring-shape-4"></span>
        <span class="ring-shape ring-shape-5"></span>
        <span class="ring-shape ring-shape-6"></span>
        <span class="ring-shape ring-shape-7"></span>
        <div class="container">
            <div class="cta-content-wrap text-center">
                <div class="section-heading">
                    <h5 class="ribbon ribbon-lg mb-2">Start online learning</h5>
                    <h2 class="section__title fs-45 lh-55">Enhance Your Skills with <br> Best Online Courses</h2>
                </div>
                <div class="cat-btn-box mt-28px">
                    <a href="sign-up.html" class="btn theme-btn">Get Started <i class="la la-arrow-right icon ml-1"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonial-area section-padding">
        @include('components.testimonial.testimonial-section')
    </section>

    <div class="section-block"></div>

    <section class="about-area section--padding overflow-hidden">
        @include('components.about.about-us-section')
    </section>

    <div class="section-block"></div>
    <section class="register-area section-padding dot-bg overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="fs-24 font-weight-semi-bold pb-2">Receive Free Courses</h3>
                            <div class="divider"><span></span></div>
                            <form method="post">
                                <div class="input-box">
                                    <label class="label-text">Name</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="name"
                                            placeholder="Your Name">
                                        <span class="la la-user input-icon"></span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label class="label-text">Email</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="email" name="email"
                                            placeholder="Email Address">
                                        <span class="la la-envelope input-icon"></span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label class="label-text">Phone Number</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="phone"
                                            placeholder="Phone Number">
                                        <span class="la la-phone input-icon"></span>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label class="label-text">Subject</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="subject"
                                            placeholder="Subject">
                                        <span class="la la-book input-icon"></span>
                                    </div>
                                </div>
                                <div class="btn-box pt-2">
                                    <button class="btn theme-btn" type="submit">Apply Now <i
                                            class="la la-arrow-right icon ml-1"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ml-auto">
                    <div class="register-content">
                        <div class="section-heading">
                            <h5 class="ribbon ribbon-lg mb-2">Register</h5>
                            <h2 class="section__title">Get ahead with Learning Paths. Stay Sharp.</h2>
                            <span class="section-divider"></span>
                            <p class="section__desc">Education is the process of acquiring the body of knowledge and
                                skills that people are expected have in your society. A education develops a critical
                                thought process in addition to learning. Bimply dummy text of the printing and
                                typesetting istryrem Ipsum has been the industry’s standard dummy text ever since the
                                1500s, when an unknown printer Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Aliquam aliquid architecto aspernatur, facilis perspiciatis rerum saepe vel vitae? Alias
                                culpa dicta facere maiores quam quas, quis sapiente voluptatem? Nulla, voluptatem.</p>
                        </div>
                        <div class="btn-box pt-35px">
                            <a href="sign-up.html" class="btn theme-btn"><i class="la la-user mr-1"></i>Get
                                Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="section-block"></div>
    <section class="client-logo-area section-padding position-relative overflow-hidden text-center">
        @include('components.partner.partner-section')
    </section>

    <section class="blog-area section--padding bg-gray overflow-hidden">
        @include('components.news.news-article')
    </section>

    <section class="get-started-area pt-30px pb-90px position-relative">
        <span class="ring-shape ring-shape-1"></span>
        <span class="ring-shape ring-shape-2"></span>
        <span class="ring-shape ring-shape-3"></span>
        <span class="ring-shape ring-shape-4"></span>
        <span class="ring-shape ring-shape-5"></span>
        <span class="ring-shape ring-shape-6"></span>
        @include('components.featured.learning-section')
    </section>

    <section class="subscriber-area pt-60px pb-60px bg-gray position-relative overflow-hidden">
        <span class="stroke-shape stroke-shape-1"></span>
        <span class="stroke-shape stroke-shape-2"></span>
        <span class="stroke-shape stroke-shape-3"></span>
        <span class="stroke-shape stroke-shape-4"></span>
        <span class="stroke-shape stroke-shape-5"></span>
        <span class="stroke-shape stroke-shape-6"></span>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="section-heading py-4">
                        <h5 class="ribbon ribbon-lg mb-2">Newsletter</h5>
                        <h2 class="section__title mb-1">Subscribe to newsletter</h2>
                        <p class="section__desc">Stay in the know on new free e-book</p>
                    </div>
                    < </div>
                        <div class="col-lg-5 ml-auto">
                            <form method="post" class="subscriber-form">
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control form--control pl-3"
                                        placeholder="Enter email address">
                                    <div class="input-group-append">
                                        <button class="btn theme-btn" type="button">Subscribe <i
                                                class="la la-arrow-right icon ml-1"></i></button>
                                    </div>
                                </div>
                                <p class="fs-14 mt-1">
                                    <i class="la la-lock mr-1"></i>Your information is safe with us! unsubscribe
                                    anytime.
                                </p>
                            </form>
                        </div>
                </div>
            </div>
    </section>
@endsection
