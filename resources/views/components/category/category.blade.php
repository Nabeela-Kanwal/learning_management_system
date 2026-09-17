@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('frontend/css/category-cards.css') }}">
    @endpush
@endonce

<div class="subject-grid">
    @foreach ($categories as $category)
        <article class="subject-card" id="category-{{ $category->id }}">
            <div class="subject-card__image">
                @if ($category->image)
                    <img src="{{ asset($category->image) }}" alt="" loading="lazy" decoding="async">
                @else
                    <i class="la la-book-open subject-card__placeholder" aria-hidden="true"></i>
                @endif
                <span class="subject-card__label">Discover &amp; learn</span>
            </div>
            <div class="subject-card__body">
                <div>
                    <span class="subject-card__eyebrow">EXPLORE YOUR INTERESTS</span>
                    <h3>{{ $category->name }}</h3>
                </div>
                @if (!request()->routeIs('category.index'))
                    <a href="{{ route('category.index') }}#category-{{ $category->id }}"
                        class="subject-card__link" aria-label="Explore {{ $category->name }}">
                        <i class="la la-arrow-up" aria-hidden="true"></i>
                    </a>
                @endif
            </div>
        </article>
    @endforeach
</div>
