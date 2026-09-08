<div class="container">
    <div class="section-heading text-center">
        <h5 class="ribbon ribbon-lg mb-2">News & Articles</h5>
        <h2 class="section__title">Latest From The Blog</h2>
        <span class="section-divider"></span>
    </div>

    <div class="blog-post-carousel owl-action-styled half-shape mt-30px">
        @forelse (($blogs ?? collect()) as $blog)
            @php
                $image = $blog->image ?: 'frontend/images/img8.jpg';
                $summary = $blog->short_description ?: \Illuminate\Support\Str::limit(strip_tags($blog->description), 120);
            @endphp
            <div class="card card-item">
                <div class="card-image">
                    <a href="{{ route('blog.show', $blog->slug) }}" class="d-block">
                        <img class="card-img-top lazy" src="{{ asset('frontend/images/img-loading.png') }}"
                            data-src="{{ asset($image) }}" alt="{{ $blog->title }}">
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center pb-2 fs-14">
                        <span><i class="la la-user mr-1"></i>{{ $blog->author ?: 'Admin' }}</span>
                        <span class="mx-2">|</span>
                        <span><i class="la la-calendar mr-1"></i>{{ $blog->published_at?->format('M d, Y') ?? $blog->created_at->format('M d, Y') }}</span>
                    </div>
                    <h5 class="card-title">
                        <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                    </h5>
                    <p class="card-text">{{ $summary }}</p>
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="btn theme-btn theme-btn-sm theme-btn-white">
                            Read More <i class="la la-arrow-right icon ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="card card-item text-center">
                <div class="card-body py-5">
                    <span class="icon-element icon-element-lg mx-auto mb-3">
                        <i class="la la-newspaper"></i>
                    </span>
                    <h5 class="card-title">No Blogs Available</h5>
                    <p class="card-text">Published blogs will appear here soon.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
