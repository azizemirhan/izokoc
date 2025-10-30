@props([
    'title' => 'Sayfa Başlığı',
    'subtitle' => ''
])

<section class="page_banner">
    <div class="container">
        <div class="col-xl-12 text-center">
            <h2>{{ $title }}</h2>

            @if($subtitle)
                <p class="page_banner__subtitle" style="color: #fff">{{ $subtitle }}</p>
            @endif

            <div class="breadcrumbs">
                <a href="{{ route('frontend.home') }}">{{ __('Home') }}</a>
                <i>|</i>
                <span>{{ $title }}</span>
            </div>
        </div>
    </div>
</section>

