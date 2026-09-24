<div class="container-fluid px-3 px-lg-4">
    <div class="section-heading text-center">
        <h5 class="ribbon ribbon-lg mb-2">Testimonials</h5>
        <h2 id="testimonials-title" class="section__title">What our students say</h2>
        <span class="section-divider"></span>
    </div>
    <div class="testimonial-carousel owl-action-styled">
        @foreach ($testimonials as $testimonial)
            <article class="card card-item testimonial-card">
                <div class="card-body">
                    <div class="review-stars mb-3" role="img" aria-label="{{ $testimonial->rating }} out of 5 stars">
                        @for ($star = 1; $star <= 5; $star++)
                            <span class="la {{ $star <= $testimonial->rating ? 'la-star' : 'la-star-o' }}" aria-hidden="true"></span>
                        @endfor
                    </div>
                    <blockquote class="testimonial-quote">{{ $testimonial->quote }}</blockquote>
                    <div class="media media-card align-items-center mt-auto pt-4">
                        <div class="media-img avatar-md">
                            @if($testimonial->image)
                                <img src="{{ Storage::disk('public')->url($testimonial->image) }}" alt="" class="rounded-full" loading="lazy" width="50" height="50">
                            @else
                                <span class="testimonial-initial" aria-hidden="true">{{ mb_substr($testimonial->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="media-body">
                            <h3 class="fs-16 font-weight-semi-bold">{{ $testimonial->name }}</h3>
                            <p class="fs-14 mt-1">{{ $testimonial->role }}</p>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</div>
