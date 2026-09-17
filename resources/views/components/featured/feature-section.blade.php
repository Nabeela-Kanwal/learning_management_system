@if ($infos->isNotEmpty())
    <style>
        @media (min-width: 992px) {
            .feature-content-wrap > .info-card-column {
                flex: 0 0 20%;
                max-width: 20%;
            }
        }
    </style>
    <div class="container-fluid px-3 px-lg-4">
        <div class="row feature-content-wrap">
            @foreach ($infos as $info)
                <div class="col-12 col-md-6 info-card-column mb-4">
                    <div class="info-box h-100">
                        <div class="info-overlay"></div>
                        <div class="icon-element mx-auto shadow-sm">
                            <i class="la {{ $info->icon }} fs-40" style="color: #e0007b" aria-hidden="true"></i>
                        </div>
                        <h3 class="info__title">{{ $info->title }}</h3>
                        <p class="info__text" style="white-space: pre-line; overflow-wrap: anywhere">
                            {{ $info->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
