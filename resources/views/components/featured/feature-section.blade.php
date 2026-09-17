@if ($infos->isNotEmpty())
    @once
        @push('styles')
            <link rel="stylesheet" href="{{ asset('frontend/css/info-cards.css') }}">
        @endpush
    @endonce
    <div class="container-fluid px-3 px-lg-4">
        <div class="learning-benefits">
            @foreach ($infos as $info)
                <article class="learning-benefit">
                    <div class="learning-benefit__icon">
                        <i class="la {{ $info->icon }}" aria-hidden="true"></i>
                    </div>
                    <h3 class="learning-benefit__title">{{ $info->title }}</h3>
                    <p class="learning-benefit__text">{{ $info->description }}</p>
                </article>
            @endforeach
        </div>
    </div>
@endif
