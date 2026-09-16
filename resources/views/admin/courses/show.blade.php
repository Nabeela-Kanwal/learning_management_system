@extends('layout.adminapp')
@section('content')
    <style>
        .course-detail .card { border: 1px solid #eceaf1; box-shadow: 0 2px 8px rgba(67, 53, 88, .04); }
        .course-detail .course-hero { background: linear-gradient(120deg, #fff 55%, #f5efff); }
        .course-detail .course-cover { width: 180px; height: 140px; flex-shrink: 0; background: #fff; border: 1px solid #eceaf1; border-radius: 12px; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .course-detail .course-cover img { width: 100%; height: 100%; object-fit: contain; padding: 12px; }
        .course-detail .course-cover > i { font-size: 48px; }
        .course-detail .course-eyebrow { font-size: 11px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; }
        .course-detail .course-heading { font-size: 26px; line-height: 1.3; }
        .course-detail .course-stat { padding: 16px; border-radius: 8px; background: #f8f7fb; height: 100%; }
        .course-detail .course-stat dt, .course-detail .course-meta dt { font-size: 12px; font-weight: 500; color: #8592a3; margin-bottom: 6px; }
        .course-detail .course-stat dd { font-size: 20px; font-weight: 600; margin: 0; }
        .course-detail .course-meta dd { margin-bottom: 0; overflow-wrap: anywhere; }
        .course-detail .course-prose { white-space: pre-wrap; overflow-wrap: anywhere; line-height: 1.8; }
        .course-detail .instructor-avatar { width: 48px; height: 48px; border-radius: 50%; background: #eee5ff; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 600; flex-shrink: 0; }
        .course-detail .min-width-zero { min-width: 0; }
        @media (max-width: 575.98px) {
            .course-detail .course-hero-content { flex-direction: column; align-items: flex-start !important; }
            .course-detail .course-cover { width: 100%; height: 170px; }
            .course-detail .course-heading { font-size: 22px; }
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y course-detail">
        @include('message')
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <a href="{{ route('admin.courses.index') }}" class="text-muted small"><i class="bx bx-left-arrow-alt" aria-hidden="true"></i> Back to Courses</a>
                <h4 class="fw-bold mb-0 mt-2">Course Details</h4>
            </div>
            <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-primary"><i class="bx bx-edit-alt me-2" aria-hidden="true"></i> Edit Course</a>
        </div>

        <div class="card course-hero mb-4">
            <div class="card-body d-flex align-items-center gap-4 course-hero-content">
                <div class="course-cover text-primary">
                    @if ($course->course_image)
                        <img src="{{ asset($course->course_image) }}" alt="{{ $course->course_title }}">
                    @else
                        <i class="bx bx-book-open" aria-hidden="true"></i>
                    @endif
                </div>
                <div class="min-width-zero">
                    <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                        <span class="course-eyebrow text-muted">Course #{{ $course->id }}</span>
                        <span class="badge {{ $course->status == 1 ? 'bg-label-success' : 'bg-label-danger' }}">{{ $course->status == 1 ? 'Active' : 'Inactive' }}</span>
                        @foreach (['best_seller' => 'Best Seller', 'featured' => 'Featured', 'hightest_rated' => 'Highest Rated'] as $field => $label)
                            @if ($course->$field == 1)<span class="badge bg-label-primary">{{ $label }}</span>@endif
                        @endforeach
                    </div>
                    <h1 class="course-heading fw-bold mb-2 text-break">{{ $course->course_title ?: 'Untitled course' }}</h1>
                    <p class="mb-2 text-break">{{ $course->category?->name ?? 'Category unavailable' }} <span class="text-muted mx-1">/</span> {{ $course->subcategory?->name ?? 'Subcategory unavailable' }}</p>
                    <div class="text-muted small"><i class="bx bx-calendar me-1" aria-hidden="true"></i> Created {{ $course->created_at?->format('M d, Y') ?? 'date unavailable' }}</div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <section class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Course Overview</h5>
                        <dl class="row g-3 course-meta mb-4">
                            @foreach (['course_name' => 'Course Name', 'course_slug' => 'Slug', 'label' => 'Level'] as $field => $label)
                                <div class="col-sm-6"><dt>{{ $label }}</dt><dd>{{ $course->$field ?: 'Not provided' }}</dd></div>
                            @endforeach
                        </dl>
                        <hr class="my-4">
                        <h6>Description</h6>
                        <div class="course-prose">{{ strip_tags($course->course_description ?: 'No description provided.') }}</div>
                        <hr class="my-4">
                        <h6>Prerequisites</h6>
                        <div class="course-prose">{{ strip_tags($course->prerequisites ?: 'No prerequisites provided.') }}</div>
                    </div>
                </section>
                <section class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Learning Materials</h5>
                        <dl class="row g-4 course-meta mb-0">
                            @foreach (['resources' => 'Resources', 'certificate' => 'Certificate'] as $field => $label)
                                <div class="col-sm-6"><dt>{{ $label }}</dt><dd>{{ $course->$field ?: 'Not provided' }}</dd></div>
                            @endforeach
                            <div class="col-12">
                                <dt>Video URL</dt>
                                <dd>
                                    @if ($course->video_url && in_array(strtolower(parse_url($course->video_url, PHP_URL_SCHEME) ?? ''), ['http', 'https']))
                                        <a href="{{ $course->video_url }}" target="_blank" rel="noopener noreferrer">{{ $course->video_url }} <i class="bx bx-link-external" aria-hidden="true"></i><span class="visually-hidden"> (opens in a new tab)</span></a>
                                    @else
                                        {{ $course->video_url ?: 'Not provided' }}
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Pricing</h5>
                        <dl class="row g-3 mb-0">
                            @foreach (['selling_price' => 'Selling Price', 'discount_price' => 'Discount Price'] as $field => $label)
                                <div class="col-6"><div class="course-stat"><dt>{{ $label }}</dt><dd class="text-break {{ $field === 'discount_price' ? 'text-primary' : '' }}">{{ is_numeric($course->$field) ? number_format((float) $course->$field, 2) : 'Not set' }}</dd></div></div>
                            @endforeach
                        </dl>
                    </div>
                </section>
                <section class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Linked Instructor</h5>
                        @if ($course->instructor)
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div class="instructor-avatar text-primary" aria-hidden="true">{{ mb_strtoupper(mb_substr($course->instructor->name, 0, 1)) }}</div>
                                <div class="min-width-zero">
                                    <h6 class="mb-1 text-break">{{ $course->instructor->name }}</h6>
                                    <div class="small text-muted text-break">{{ $course->instructor->email }}</div>
                                </div>
                            </div>
                            <a href="{{ route('admin.instructor.edit', $course->instructor->id) }}" class="btn btn-outline-primary w-100">Manage Instructor <i class="bx bx-right-arrow-alt ms-2" aria-hidden="true"></i></a>
                        @else
                            <p class="text-muted mb-0">Instructor unavailable.</p>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
