@props(['courses'])

<div class="catalog-grid">
    @forelse($courses as $course)
        @php
            $title = $course->course_title ?: $course->course_name;
            $price = $course->discount_price !== null && $course->discount_price !== '' ? (float) $course->discount_price : (float) $course->selling_price;
            $originalPrice = (float) $course->selling_price;
        @endphp
        <article class="card card-item catalog-card">
            <div class="catalog-card-image">
                <img src="{{ asset($course->course_image ?: 'frontend/images/img8.jpg') }}" alt="{{ $title }}" loading="lazy" width="600" height="360">
                @if($course->best_seller)<span class="catalog-badge">Bestseller</span>@elseif($course->featured)<span class="catalog-badge catalog-badge-featured">Featured</span>@endif
                <span class="catalog-level">{{ $course->label ?: 'All Levels' }}</span>
            </div>
            <div class="card-body catalog-card-body">
                <span class="catalog-card-category">{{ $course->category?->name ?: 'Explore & learn' }}</span>
                <h3 class="card-title">{{ $title }}</h3>
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
