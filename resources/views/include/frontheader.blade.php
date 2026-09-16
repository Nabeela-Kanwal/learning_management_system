@php
    $categories = getCategories();
    $headerLinks = [
        ['home', 'Home'],
        ['course.index', 'Courses'],
        ['teacher.index', 'Instructors'],
        ['blog.index', 'Blog'],
        ['contact', 'Contact'],
    ];
@endphp
<header class="lms-header">
    <div class="lms-header-top">
        <div class="lms-header-container lms-header-top-inner">
            <span><i class="la la-graduation-cap" aria-hidden="true"></i> A little curiosity. A world of possibilities.</span>
            <div class="lms-header-portals">
                <details class="lms-header-student">
                    <summary><i class="la la-user" aria-hidden="true"></i> Student portal <i class="la la-angle-down" aria-hidden="true"></i></summary>
                    <div class="lms-header-dropdown">
                        <span class="lms-header-label">STUDENT PORTAL</span>
                        @include('include.student-header-links')
                    </div>
                </details>
                <a href="{{ route('instructor.login') }}">Instructor portal <i class="la la-arrow-right" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <div class="lms-header-container lms-header-main">
        <a class="lms-header-logo" href="{{ route('home') }}" aria-label="LMS home">
            <img src="{{ asset('frontend/images/logo.png') }}" alt="LMS">
        </a>
        <nav class="lms-header-nav" aria-label="Main navigation">
            @foreach ($headerLinks as [$routeName, $label])
                <a href="{{ route($routeName) }}" @if (request()->routeIs($routeName) || ($routeName === 'blog.index' && request()->routeIs('blog.*'))) aria-current="page" @endif>{{ $label }}</a>
                @if ($loop->first)
                    <details class="lms-header-explore">
                        <summary>Explore <i class="la la-angle-down lms-header-chevron" aria-hidden="true"></i></summary>
                        <div class="lms-header-dropdown">
                            <span class="lms-header-label">FIND YOUR NEXT SKILL</span>
                            <a href="{{ route('course.index') }}">All courses <i class="la la-arrow-right" aria-hidden="true"></i></a>
                            @foreach ($categories as $category)
                                <a href="{{ route('category.index') }}#category-{{ $category->id }}">{{ $category->name }} <i class="la la-angle-right" aria-hidden="true"></i></a>
                            @endforeach
                            <a class="lms-header-all" href="{{ route('category.index') }}">View all categories</a>
                        </div>
                    </details>
                @endif
            @endforeach
        </nav>
        <a class="lms-header-cta" href="{{ route('course.index') }}">Start learning <i class="la la-arrow-right" aria-hidden="true"></i></a>
        <details class="lms-header-mobile">
            <summary aria-label="Toggle navigation"><i class="la la-bars" aria-hidden="true"></i><span>Menu</span></summary>
            <nav class="lms-header-mobile-panel" aria-label="Mobile navigation">
                <span class="lms-header-label">YOUR NEXT CHAPTER STARTS HERE</span>
                @foreach ($headerLinks as [$routeName, $label])
                    <a href="{{ route($routeName) }}" @if (request()->routeIs($routeName) || ($routeName === 'blog.index' && request()->routeIs('blog.*'))) aria-current="page" @endif>{{ $label }} <i class="la la-angle-right" aria-hidden="true"></i></a>
                @endforeach
                <a href="{{ route('category.index') }}">All categories <i class="la la-th-large" aria-hidden="true"></i></a>
                <div class="lms-header-mobile-student">
                    <span class="lms-header-label">STUDENT PORTAL</span>
                    @include('include.student-header-links')
                </div>
                <a href="{{ route('instructor.login') }}">Instructor portal <i class="la la-arrow-right" aria-hidden="true"></i></a>
            </nav>
        </details>
    </div>
</header>
