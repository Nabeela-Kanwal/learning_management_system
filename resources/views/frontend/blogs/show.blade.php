@extends('layout.frontapp')
@section('content')
    <style>
        .blog-detail-page {
            padding: 32px 16px 64px;
            background: #f5f7fc;
            color: #233d63;
        }

        .blog-detail-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(280px, 360px);
            gap: 28px;
            align-items: start;
        }

        .blog-detail-article {
            min-width: 0;
            overflow: hidden;
            background: #fff;
            border-radius: 0 16px 16px 0;
            box-shadow: 0 8px 30px rgba(35, 61, 99, .06);
        }

        .blog-detail-body {
            padding: clamp(20px, 3vw, 48px);
            overflow-wrap: anywhere;
        }

        .blog-detail-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px 24px;
            color: #526580;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .blog-detail-meta i {
            color: #ec5252;
        }

        .blog-detail-title {
            color: #233d63;
            font-size: clamp(28px, 3vw, 44px);
            line-height: 1.2;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .blog-detail-summary {
            padding: 16px 20px;
            border-left: 4px solid #ec5252;
            background: #fff5f5;
            color: #233d63;
            font-size: 18px;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .blog-detail-image {
            overflow: hidden;
            background-color: #f5f7fc;
        }

        .blog-detail-image img {
            width: 100%;
            display: block;
            height: auto;
            max-height: 560px;
            object-fit: cover;
        }

        .blog-detail-content {
            color: #435570;
            font-size: 17px;
            line-height: 1.9;
        }

        .blog-detail-recent {
            min-width: 0;
            padding: 28px 24px;
            background: #fff;
            border-top: 4px solid #ec5252;
            border-radius: 14px 0 0 14px;
            box-shadow: 0 8px 30px rgba(35, 61, 99, .06);
        }

        .blog-detail-recent h2 {
            color: #233d63;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .blog-recent-link {
            display: flex;
            align-items: start;
            gap: 14px;
            padding: 20px 0;
            border-bottom: 1px solid #edf0f5;
            color: #233d63;
            overflow-wrap: anywhere;
        }

        .blog-recent-link:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .blog-recent-link img {
            width: 80px;
            height: 80px;
            flex-shrink: 0;
            object-fit: cover;
            border-radius: 10px;
        }

        .blog-recent-link strong {
            display: block;
            font-size: 15px;
            line-height: 1.5;
        }

        .blog-recent-link time {
            display: block;
            margin-top: 8px;
            color: #526580;
            font-size: 13px;
        }

        .blog-recent-link:hover,
        .blog-recent-link:focus-visible {
            color: #ec5252;
        }

        @media (max-width: 991px) {
            .blog-detail-layout {
                grid-template-columns: minmax(0, 1fr);
                gap: 24px;
            }

            .blog-detail-page {
                padding-top: 0;
                padding-bottom: 32px;
            }

            .blog-detail-article,
            .blog-detail-recent {
                border-radius: 0;
            }
        }
    </style>

    <section class="blog-detail-page">
        <div class="container-fluid px-0">
            <div class="blog-detail-layout">
                <article class="blog-detail-article">
                    @php
                        $image = $blog->image ?: 'frontend/images/img8.jpg';
                    @endphp
                    <div class="blog-detail-image">
                        <img src="{{ asset($image) }}" alt="{{ $blog->title }}">
                    </div>
                    <div class="blog-detail-body">
                        <div class="blog-detail-meta">
                            <span><i class="la la-user mr-1"></i>{{ $blog->author ?: 'Admin' }}</span>
                            <span><i class="la la-calendar mr-1"></i>{{ $blog->published_at?->format('M d, Y') ?? $blog->created_at->format('M d, Y') }}</span>
                        </div>
                        <h1 class="blog-detail-title">{{ $blog->title }}</h1>
                        @if ($blog->short_description)
                            <p class="blog-detail-summary">{{ $blog->short_description }}</p>
                        @endif
                        <div class="blog-detail-content">
                            {!! nl2br(e($blog->description)) !!}
                        </div>
                    </div>
                </article>

                <aside class="blog-detail-recent" aria-labelledby="recent-blogs-title">
                    <h2 id="recent-blogs-title">Recent Blogs</h2>
                    @forelse ($recentBlogs as $recentBlog)
                        <a href="{{ route('blog.show', $recentBlog->slug) }}" class="blog-recent-link">
                            <img src="{{ asset($recentBlog->image ?: 'frontend/images/small-img.jpg') }}"
                                alt="" loading="lazy">
                            <span>
                                <strong>{{ $recentBlog->title }}</strong>
                                <time datetime="{{ ($recentBlog->published_at ?? $recentBlog->created_at)->toDateString() }}">{{ ($recentBlog->published_at ?? $recentBlog->created_at)->format('M d, Y') }}</time>
                            </span>
                        </a>
                    @empty
                        <p class="card-text">No other blogs yet.</p>
                    @endforelse
                </aside>
            </div>
        </div>
    </section>
@endsection
