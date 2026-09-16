@extends('layout.frontapp')

@section('content')
    <style>
        .blog-banner {
            position: relative;
            display: flex;
            align-items: center;

            background-size: cover;
            background-position: center;
        }

        .blog-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(255, 255, 255, .96) 0%, rgba(255, 255, 255, .88) 35%, rgba(255, 255, 255, .35) 65%, transparent 100%);
            pointer-events: none;
        }

        .blog-banner .section-heading {
            width: 100%;
            max-width: 620px;
            text-align: left;
            border-left: 4px solid #ec5252;
            padding-left: 24px;
            overflow-wrap: anywhere;
        }

        .blog-banner .section__title {
            color: #233d63;
            font-size: clamp(28px, 3vw, 42px);
            line-height: 1.2;
        }

        .blog-banner .section__desc {
            color: #233d63;
            font-size: 17px;
            line-height: 1.8;
            margin: 0;
            white-space: pre-line;
        }

        @media (max-width: 767px) {
            .blog-banner {

            }

            .blog-banner::before {
                background: rgba(255, 255, 255, .88);
            }

            .blog-banner .section-heading {
                padding-left: 16px;
            }
        }

        .blog-list-image {
            aspect-ratio: 4 / 3;
            overflow: hidden;
            border-radius: 8px 8px 0 0;
            background-color: #f5f7fc;
        }

        .blog-list-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-card {
            height: 100%;
        }

        .blog-card .card-body {
            display: flex;
            flex-direction: column;
        }
    </style>

    <section class="breadcrumb-area page-banner blog-banner img-bg-2"
        @if ($banner?->image) style="background-image: url('{{ asset($banner->image) }}')" @endif>
        <div class="container-fluid px-3 px-lg-4">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-start text-left">
                <div class="section-heading text-left">
                    <h2 class="section__title">{{ $banner?->title ?: 'Blogs' }}</h2>
                    <p class="section__desc pt-3">{{ $banner?->description ?: 'Read the latest learning tips and platform updates.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-area section--padding">
        <div class="container-fluid px-3 px-lg-4">
            <div class="row">
                @forelse ($blogs as $blog)
                    @php
                        $image = $blog->image ?: 'frontend/images/img8.jpg';
                        $summary =
                            $blog->short_description ?:
                            \Illuminate\Support\Str::limit(strip_tags($blog->description), 140);
                    @endphp
                    <div class="col-lg-3 col-md-6 responsive-column-half">
                        <div class="card card-item blog-card">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="blog-list-image d-block">
                                <img src="{{ asset($image) }}" alt="{{ $blog->title }}">
                            </a>
                            <div class="card-body">
                                <div class="d-flex align-items-center pb-2 fs-14">
                                    <span><i class="la la-user mr-1"></i>{{ $blog->author ?: 'Admin' }}</span>
                                    <span class="mx-2">|</span>
                                    <span><i
                                            class="la la-calendar mr-1"></i>{{ $blog->published_at?->format('M d, Y') ?? $blog->created_at->format('M d, Y') }}</span>
                                </div>
                                <h5 class="card-title">
                                    <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                </h5>
                                <p class="card-text">{{ $summary }}</p>
                                <a href="{{ route('blog.show', $blog->slug) }}"
                                    class="btn theme-btn theme-btn-sm theme-btn-white mt-auto">
                                    Read More <i class="la la-arrow-right icon ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-8 mx-auto">
                        <div class="card card-item text-center">
                            <div class="card-body py-5">
                                <span class="icon-element icon-element-lg mx-auto mb-3">
                                    <i class="la la-newspaper"></i>
                                </span>
                                <h3 class="fs-24 font-weight-semi-bold pb-2">No blogs available yet</h3>
                                <p class="section__desc">Published blog posts will appear here soon.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
