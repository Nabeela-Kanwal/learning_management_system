@extends('layout.frontapp')

@section('content')
    <style>
        .teacher-card {
            height: 100%;
        }

        .teacher-card .card-body {
            display: flex;
            flex-direction: column;
        }

        .teacher-avatar {
            width: 112px;
            height: 112px;
            border-radius: 50%;
            margin: 0 auto;
            overflow: hidden;
            background: #f5f7fc;
            border: 5px solid #fff;
            box-shadow: 0 10px 30px rgba(35, 61, 99, 0.12);
        }

        .teacher-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .teacher-bio {
            min-height: 72px;
        }

        .teacher-meta {
            border-top: 1px solid rgba(127, 136, 151, 0.18);
            border-bottom: 1px solid rgba(127, 136, 151, 0.18);
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

    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">Our Instructors</h2>
                    <p class="section__desc text-white pt-2">Learn from active teachers across our course catalog.</p>
                </div>
                <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Teachers</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="team-member-area section--padding">
        <div class="container">
            <div class="section-heading text-center">
                <h5 class="ribbon ribbon-lg mb-2">Expert Teachers</h5>
                <h2 class="section__title">Meet Your Instructors</h2>
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
                            $fullName = trim(($instructor->first_name ?? '') . ' ' . ($instructor->last_name ?? '')) ?: $instructor->name;
                            $location = collect([$instructor->city, $instructor->country])->filter()->implode(', ');
                            $bio = $instructor->bio ?: $instructor->experience;
                        @endphp

                        <div class="col-lg-4 col-md-6 responsive-column-half">
                            <div class="card card-item member-card teacher-card text-center">
                                <div class="card-image teacher-avatar">
                                    <img src="{{ asset($image) }}" alt="{{ $fullName }}">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title fs-20 mb-1">{{ $fullName }}</h3>
                                    <p class="card-text mb-2">
                                        <span class="text-color">Instructor</span>
                                        @if ($location)
                                            <span class="d-block fs-14 pt-1">
                                                <i class="la la-map-marker mr-1"></i>{{ $location }}
                                            </span>
                                        @endif
                                    </p>

                                    <p class="card-text teacher-bio">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($bio ?: 'Dedicated instructor helping learners build practical skills through guided lessons.'), 110) }}
                                    </p>

                                    <div class="teacher-meta d-flex justify-content-center my-3 py-3">
                                        <div class="px-3">
                                            <h4 class="fs-20 font-weight-semi-bold">{{ $instructor->courses_count }}</h4>
                                            <span class="fs-14">Courses</span>
                                        </div>
                                        <div class="px-3 border-left border-left-gray">
                                            <h4 class="fs-20 font-weight-semi-bold">{{ $instructor->created_at?->format('Y') ?? date('Y') }}</h4>
                                            <span class="fs-14">Joined</span>
                                        </div>
                                    </div>

                                    <ul class="social-icons social-icons-styled social--icons-styled justify-content-center mt-auto">
                                        @if ($instructor->email)
                                            <li>
                                                <a href="mailto:{{ $instructor->email }}" title="Email">
                                                    <i class="la la-envelope"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($instructor->phone)
                                            <li>
                                                <a href="tel:{{ $instructor->phone }}" title="Phone">
                                                    <i class="la la-phone"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="teacher-empty-state text-center mt-5">
                    <span class="icon-element icon-element-lg mx-auto mb-3">
                        <i class="la la-chalkboard-teacher"></i>
                    </span>
                    <h3 class="fs-24 font-weight-semi-bold pb-2">No instructors available yet</h3>
                    <p class="section__desc">Active instructors will appear here after they are added from the admin panel.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
