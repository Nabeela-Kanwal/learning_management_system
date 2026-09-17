@extends('layout.frontapp')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/course-catalog.css') }}">
@endpush

@section('content')
<main class="course-catalog">
    <section class="catalog-hero">
        <div class="container">
            <nav class="catalog-breadcrumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Home</a><span aria-hidden="true">/</span><span>Courses</span></nav>
            <div class="catalog-hero-grid">
                <div>
                    <span class="catalog-eyebrow"><span></span> A LITTLE CURIOSITY. ENDLESS POSSIBILITIES.</span>
                    <h1>Your next chapter<br>starts with <em>learning.</em></h1>
                    <p>Discover something new. Build skills that matter. Find a course that takes you closer to where you want to be.</p>
                    <form class="catalog-search" action="{{ route('course.index') }}" method="get" role="search">
                        <i class="la la-search" aria-hidden="true"></i>
                        <label class="sr-only" for="course-search">Search courses</label>
                        <input id="course-search" name="q" type="search" maxlength="150" value="{{ $filters['q'] ?? '' }}" placeholder="What do you want to learn?">
                        <button type="submit">Find a course <i class="la la-arrow-right" aria-hidden="true"></i></button>
                    </form>
                    <div class="catalog-hero-notes"><span><i class="la la-check-circle" aria-hidden="true"></i> Explore at your own pace</span><span><i class="la la-compass" aria-hidden="true"></i> Find your next skill</span></div>
                </div>
                <div class="catalog-art" aria-hidden="true">
                    <div class="catalog-art-orbit"></div>
                    <img src="{{ asset('frontend/images/img8.jpg') }}" alt="" class="catalog-art-photo">
                    <div class="catalog-art-label"><span class="catalog-art-icon"><i class="la la-graduation-cap"></i></span><div><strong>Make room for growth.</strong><span>One new skill at a time.</span></div></div>
                    <span class="catalog-art-star">✳</span>
                    <span class="catalog-art-tag"><i class="la la-lightbulb"></i> Stay curious</span>
                </div>
            </div>
            <div class="catalog-highlights">
                <div><strong>{{ number_format($totalCourses) }}<span> courses to explore</span></strong><p>A new opportunity in every lesson</p></div>
                <div><i class="la la-layer-group" aria-hidden="true"></i><div><strong>Something for every interest</strong><p>Explore {{ $categories->count() }} learning categories</p></div></div>
                <div><i class="la la-map-signs" aria-hidden="true"></i><div><strong>Start where you are</strong><p>From first steps to your next big leap</p></div></div>
            </div>
        </div>
    </section>

    <section class="catalog-content" id="browse-courses" aria-labelledby="catalog-heading">
        <div class="container">
            <div class="catalog-section-heading"><div><span class="catalog-eyebrow">INVEST IN YOURSELF</span><h2 id="catalog-heading">Find your next learning adventure</h2></div><span class="catalog-section-note">Small steps. Remarkable progress.</span></div>
            <div class="catalog-category-tabs" aria-label="Course categories">
                <a class="{{ empty($filters['category']) ? 'is-active' : '' }}" href="{{ route('course.index', array_merge($filters, ['category' => null])) }}#browse-courses" @if(empty($filters['category'])) aria-current="true" @endif>All courses <span>{{ $totalCourses }}</span></a>
                @foreach($categories as $category)
                    <a class="{{ ($filters['category'] ?? '') == $category->id ? 'is-active' : '' }}" href="{{ route('course.index', array_merge($filters, ['category' => $category->id])) }}#browse-courses" @if(($filters['category'] ?? '') == $category->id) aria-current="true" @endif>{{ $category->name }} <span>{{ $category->courses_count }}</span></a>
                @endforeach
            </div>
            <form class="catalog-toolbar" action="{{ route('course.index') }}#browse-courses" method="get">
                @if(!empty($filters['q']))<input type="hidden" name="q" value="{{ $filters['q'] }}">@endif
                @if(!empty($filters['category']))<input type="hidden" name="category" value="{{ $filters['category'] }}">@endif
                <p><strong>{{ number_format($courses->total()) }}</strong> courses{{ !empty($filters['q']) ? ' matching “'.$filters['q'].'”' : ' to spark your curiosity' }}</p>
                <div class="catalog-controls">
                    <label for="course-level" class="sr-only">Course level</label>
                    <select id="course-level" name="level"><option value="">Every level</option>@foreach(['Beginner', 'Intermediate', 'Advanced', 'All Levels'] as $level)<option value="{{ $level }}" @selected(($filters['level'] ?? '') === $level)>{{ $level }}</option>@endforeach</select>
                    <label for="course-sort" class="sr-only">Sort courses</label>
                    <select id="course-sort" name="sort">@foreach(['newest' => 'Newest first', 'price-low' => 'Price: low to high', 'price-high' => 'Price: high to low', 'title' => 'Title: A–Z'] as $value => $label)<option value="{{ $value }}" @selected(($filters['sort'] ?? 'newest') === $value)>{{ $label }}</option>@endforeach</select>
                    <button type="submit">Apply <i class="la la-sliders" aria-hidden="true"></i></button>
                    @if(array_filter($filters))<a class="catalog-reset" href="{{ route('course.index') }}#browse-courses">Reset</a>@endif
                </div>
            </form>
            <div class="catalog-grid">
                @forelse($courses as $course)
                    @php
                        $title = $course->course_title ?: $course->course_name;
                        $price = $course->discount_price !== null && $course->discount_price !== '' ? (float) $course->discount_price : (float) $course->selling_price;
                        $originalPrice = (float) $course->selling_price;
                    @endphp
                    <article class="catalog-card">
                        <div class="catalog-card-image">
                            <img src="{{ asset($course->course_image ?: 'frontend/images/img8.jpg') }}" alt="{{ $title }}" loading="lazy" width="600" height="360">
                            @if($course->best_seller)<span class="catalog-badge">Bestseller</span>@elseif($course->featured)<span class="catalog-badge catalog-badge-featured">Featured</span>@endif
                            <span class="catalog-level">{{ $course->label ?: 'All Levels' }}</span>
                        </div>
                        <div class="catalog-card-body">
                            <span class="catalog-card-category">{{ $course->category?->name ?: 'Explore & learn' }}</span>
                            <h3>{{ $title }}</h3>
                            <p class="catalog-card-description">{{ \Illuminate\Support\Str::limit(strip_tags($course->course_description ?? ''), 105) }}</p>
                            <div class="catalog-instructor"><span class="catalog-avatar" aria-hidden="true">{{ mb_substr($course->instructor?->name ?: 'Instructor', 0, 1) }}</span><span>{{ $course->instructor?->name ?: 'Course instructor' }}</span></div>
                            <div class="catalog-card-bottom"><div class="catalog-price">{{ $price > 0 ? '$'.number_format($price, 2) : 'Free' }} @if($originalPrice > $price)<del>${{ number_format($originalPrice, 2) }}</del>@endif</div><span class="catalog-course-type"><i class="la la-play-circle" aria-hidden="true"></i> Online course</span></div>
                            <details class="catalog-details"><summary>Explore course <i class="la la-arrow-right" aria-hidden="true"></i></summary><div><p>{{ strip_tags($course->course_description ?? 'Contact us to learn more about this course.') }}</p>@if($course->prerequisites)<strong>Before you begin</strong><p>{{ strip_tags($course->prerequisites) }}</p>@endif<a href="{{ route('contact') }}">Ask about this course <i class="la la-arrow-right" aria-hidden="true"></i></a></div></details>
                        </div>
                    </article>
                @empty
                    <div class="catalog-empty"><i class="la la-search" aria-hidden="true"></i><h3>No courses found</h3><p>Try another keyword or clear your filters to discover something new.</p><a href="{{ route('course.index') }}">Explore all courses <i class="la la-arrow-right" aria-hidden="true"></i></a></div>
                @endforelse
            </div>
            @if($courses->hasPages())
                <nav class="catalog-pagination" aria-label="Course pagination">
                    @if($courses->onFirstPage())<span aria-disabled="true">← Previous</span>@else<a href="{{ $courses->previousPageUrl() }}#browse-courses">← Previous</a>@endif
                    <p>Page <strong>{{ $courses->currentPage() }}</strong> of {{ $courses->lastPage() }}</p>
                    @if($courses->hasMorePages())<a href="{{ $courses->nextPageUrl() }}#browse-courses">Next →</a>@else<span aria-disabled="true">Next →</span>@endif
                </nav>
            @endif
            <aside class="catalog-cta"><div class="catalog-cta-icon"><i class="la la-compass" aria-hidden="true"></i></div><div><span>YOUR JOURNEY, YOUR DIRECTION</span><h2>A little guidance goes a long way.</h2><p>Not sure where to start? Let’s help you find your next step.</p></div><a href="{{ route('contact') }}">Let’s talk <i class="la la-arrow-right" aria-hidden="true"></i></a></aside>
        </div>
    </section>
</main>
@endsection
