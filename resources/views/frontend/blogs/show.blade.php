@extends('layout.frontapp')

@section('content')
    <style>
        .blog-detail-image {
            max-height: 460px;
            overflow: hidden;
            border-radius: 8px;
            background-color: #f5f7fc;
        }

        .blog-detail-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-detail-content {
            font-size: 16px;
            line-height: 1.8;
        }
    </style>

    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">{{ $blog->title }}</h2>
                    <p class="section__desc text-white pt-2">
                        {{ $blog->published_at?->format('M d, Y') ?? $blog->created_at->format('M d, Y') }}
                    </p>
                </div>
                <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('blog.index') }}">Blogs</a></li>
                    <li>Details</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="blog-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @php
                        $image = $blog->image ?: 'frontend/images/img8.jpg';
                    @endphp
                    <div class="blog-detail-image mb-4">
                        <img src="{{ asset($image) }}" alt="{{ $blog->title }}">
                    </div>
                    <div class="d-flex align-items-center pb-3 fs-15">
                        <span><i class="la la-user mr-1"></i>{{ $blog->author ?: 'Admin' }}</span>
                        <span class="mx-2">|</span>
                        <span><i class="la la-calendar mr-1"></i>{{ $blog->published_at?->format('M d, Y') ?? $blog->created_at->format('M d, Y') }}</span>
                    </div>
                    <h2 class="section__title fs-32 pb-3">{{ $blog->title }}</h2>
                    @if ($blog->short_description)
                        <p class="section__desc text-black pb-3">{{ $blog->short_description }}</p>
                    @endif
                    <div class="blog-detail-content">
                        {!! nl2br(e($blog->description)) !!}
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar mb-0">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="fs-20 font-weight-semi-bold pb-3">Recent Blogs</h3>
                                @forelse ($recentBlogs as $recentBlog)
                                    <div class="media media-card mb-3">
                                        <a href="{{ route('blog.show', $recentBlog->slug) }}" class="media-img">
                                            <img src="{{ asset($recentBlog->image ?: 'frontend/images/small-img.jpg') }}"
                                                alt="{{ $recentBlog->title }}">
                                        </a>
                                        <div class="media-body">
                                            <h5 class="fs-15">
                                                <a href="{{ route('blog.show', $recentBlog->slug) }}">
                                                    {{ \Illuminate\Support\Str::limit($recentBlog->title, 58) }}
                                                </a>
                                            </h5>
                                            <span class="d-block fs-13">{{ $recentBlog->published_at?->format('M d, Y') ?? $recentBlog->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <p class="card-text">No other blogs yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
