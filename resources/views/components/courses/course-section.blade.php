<div class="container-fluid px-3 px-lg-4">
    <div class="section-heading text-center catalog-section-heading">
        <h5 class="ribbon ribbon-lg mb-2">Choose your desired courses</h5>
        <h2 class="section__title">Find your next learning adventure</h2>
        <span class="section-divider"></span>
    </div>
    <nav class="catalog-category-tabs" aria-label="Course categories">
        <a href="{{ route('home') }}#home-courses" class="{{ !$courseCategory ? 'is-active' : '' }}" @if(!$courseCategory) aria-current="true" @endif>All courses</a>
        @foreach ($categories as $category)
            <a href="{{ route('home', ['category' => $category->id]) }}#home-courses" class="{{ $courseCategory == $category->id ? 'is-active' : '' }}" @if($courseCategory == $category->id) aria-current="true" @endif>{{ $category->name }} <span>{{ $category->courses_count }}</span></a>
        @endforeach
    </nav>
    <x-courses.grid :courses="$homeCourses" />
    <div class="text-center mt-4">
        <a class="btn theme-btn" href="{{ route('course.index', $courseCategory ? ['category' => $courseCategory] : []) }}">View all courses <i class="la la-arrow-right ml-1" aria-hidden="true"></i></a>
    </div>
</div>
