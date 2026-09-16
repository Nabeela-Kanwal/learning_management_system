@extends('layout.frontapp')

@section('content')
    <style>
        .instructor-banner {
            position: relative;
            display: flex;
            align-items: center;

            background-size: cover;
            background-position: center;
        }

        .instructor-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(255, 255, 255, .96) 0%, rgba(255, 255, 255, .88) 35%, rgba(255, 255, 255, .35) 65%, transparent 100%);
            pointer-events: none;
        }

        .instructor-banner .section-heading {
            width: 100%;
            max-width: 620px;
            text-align: left;
            border-left: 4px solid #ec5252;
            padding-left: 24px;
            overflow-wrap: anywhere;
        }

        .instructor-banner .section__title {
            color: #233d63;
            font-size: clamp(28px, 3vw, 42px);
            line-height: 1.2;
        }

        .instructor-banner .section__desc {
            color: #233d63;
            font-size: 17px;
            line-height: 1.8;
            margin: 0;
            white-space: pre-line;
        }

        @media (max-width: 767px) {
            .instructor-banner {}

            .instructor-banner::before {
                background: rgba(255, 255, 255, .88);
            }

            .instructor-banner .section-heading {
                padding-left: 16px;
            }
        }

        .instructor-directory {
            background: #f7f8fc;
        }

        .instructor-container {
            max-width: 1920px;
        }

        .teacher-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #e7eaf2;
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 8px 28px rgba(22, 39, 78, .04);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .teacher-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 40px rgba(22, 39, 78, .1);
        }

        .teacher-portrait {
            position: relative;
            margin: 12px 12px 0;
            overflow: hidden;
            border-radius: 12px;
            background: #edf0f6;
            aspect-ratio: 4 / 3;
        }

        .teacher-portrait img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 25%;
        }

        .teacher-label {
            position: absolute;
            left: 14px;
            bottom: 14px;
            padding: 5px 12px;
            border-radius: 30px;
            background: #fff;
            color: #172850;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 12px rgba(22, 39, 78, .08);
        }

        .teacher-label i {
            color: #ff007f;
        }

        .teacher-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 24px;
            overflow-wrap: anywhere;
        }

        .teacher-name {
            color: #172850;
            font-size: 21px;
            line-height: 1.35;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .teacher-location {
            color: #718096;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .teacher-bio {
            color: #667085;
            font-size: 14px;
            line-height: 1.75;
            margin-bottom: 22px;
        }

        .teacher-meta {
            display: flex;
            gap: 24px;
            margin-top: auto;
            padding: 16px 0;
            border-top: 1px solid #edf0f5;
        }

        .teacher-meta strong {
            display: block;
            color: #172850;
            font-size: 20px;
            line-height: 1.4;
        }

        .teacher-meta span {
            color: #718096;
            font-size: 12px;
        }

        .teacher-contact {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 4px;
        }

        .teacher-contact a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 10px 14px;
            border: 1px solid #e7eaf2;
            border-radius: 10px;
            color: #233d63;
            font-size: 13px;
            font-weight: 600;
        }

        .teacher-contact a:first-child {
            flex: 1;
            background: #fff0f7;
            border-color: #ffe0ef;
            color: #d60069;
        }

        .teacher-contact a:hover {
            background: #172850;
            border-color: #172850;
            color: #fff;
        }

        .teacher-contact a:focus-visible {
            outline: 3px solid #ff007f;
            outline-offset: 3px;
        }

        @media (prefers-reduced-motion: reduce) {
            .teacher-card {
                transition: none;
            }

            .teacher-card:hover {
                transform: none;
            }
        }

        .teacher-empty-state {
            max-width: 620px;
            margin: 0 auto;
            border: 1px solid rgba(127, 136, 151, 0.18);
            border-radius: 8px;
            padding: 50px 30px;
            background-color: #fff;
            box-shadow: 0 10px 30px rgba(35, 61, 99, 0.06);
        }
    </style>

    <section class="breadcrumb-area page-banner instructor-banner img-bg-2"
        @if ($banner?->image) style="background-image: url('{{ asset($banner->image) }}')" @endif>
        <div class="container-fluid px-3 px-lg-4">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-start text-left">
                <div class="section-heading text-left">
                    <h2 class="section__title">{{ $banner?->title ?: 'Our Instructors' }}</h2>
                    <p class="section__desc pt-3">
                        {{ $banner?->description ?: 'Learn from active teachers across our course catalog.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="team-member-area instructor-directory section--padding">
        <div class="container instructor-container">
            <div class="section-heading text-center">
                <h5 class="ribbon ribbon-lg mb-2">Our Instructors</h5>
                <h2 class="section__title">Learn from People Who Love to Teach</h2>
                <span class="section-divider"></span>
            </div>

            @if ($instructors->count())
                <div class="row pt-40px">
                    @foreach ($instructors as $instructor)
                        @php
                            $fallbackImages = [
                                'frontend/images/team.jpg',
                                'frontend/images/team2.jpg',
                                'frontend/images/team3.jpg',
                                'frontend/images/team4.jpg',
                                'frontend/images/team5.jpg',
                                'frontend/images/team6.jpg',
                            ];
                            $fallbackImage = $fallbackImages[$loop->index % count($fallbackImages)];
                            $image = $instructor->image ?: $fallbackImage;
                            $fullName =
                                trim(($instructor->first_name ?? '') . ' ' . ($instructor->last_name ?? '')) ?:
                                $instructor->name;
                            $location = collect([$instructor->city, $instructor->country])
                                ->filter()
                                ->implode(', ');
                            $bio = $instructor->bio ?: $instructor->experience;
                        @endphp

                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <article class="teacher-card">
                                <div class="teacher-portrait">
                                    <img src="{{ asset($image) }}" alt="{{ $fullName }}" loading="lazy">
                                    <span class="teacher-label"><i class="la la-chalkboard-teacher" aria-hidden="true"></i>
                                        Instructor</span>
                                </div>
                                <div class="teacher-body">
                                    <h3 class="teacher-name">{{ $fullName }}</h3>
                                    @if ($location)
                                        <p class="teacher-location"><i class="la la-map-marker" aria-hidden="true"></i>
                                            {{ $location }}</p>
                                    @endif
                                    <p class="teacher-bio">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($bio ?: 'Dedicated instructor helping learners build practical skills through guided lessons.'), 110) }}
                                    </p>
                                    <div class="teacher-meta">
                                        <div>
                                            <strong>{{ $instructor->courses_count }}</strong>
                                            <span>{{ $instructor->courses_count == 1 ? 'Course' : 'Courses' }}</span>
                                        </div>
                                        <div>
                                            <strong>{{ $instructor->created_at?->format('Y') ?? date('Y') }}</strong>
                                            <span>Joined</span>
                                        </div>
                                    </div>
                                    @if ($instructor->email || $instructor->phone)
                                        <div class="teacher-contact">
                                            @if ($instructor->email)
                                                <a href="mailto:{{ $instructor->email }}"
                                                    aria-label="Email {{ $fullName }}">
                                                    <i class="la la-envelope" aria-hidden="true"></i> Get in touch
                                                </a>
                                            @endif
                                            @if ($instructor->phone)
                                                <a href="tel:{{ $instructor->phone }}"
                                                    aria-label="Call {{ $fullName }}">
                                                    <i class="la la-phone" aria-hidden="true"></i> Call
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="teacher-empty-state text-center mt-5">
                    <span class="icon-element icon-element-lg mx-auto mb-3">
                        <i class="la la-chalkboard-teacher"></i>
                    </span>
                    <h3 class="fs-24 font-weight-semi-bold pb-2">No instructors available yet</h3>
                    <p class="section__desc">Active instructors will appear here after they are added from the admin panel.
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection
