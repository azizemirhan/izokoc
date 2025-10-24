
@props([
    'title' => 'Sayfa Başlığı',
    'subtitle' => ''
])

<section class="banner-style-one">
    <div class="parallax" style="background-image: url({{ asset('site/assets/images/pattren-3.png') }});"></div>
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="banner-details">
                {{-- Controller'dan gelen başlığı yazdırıyoruz --}}
                <h2>{{ $title }}</h2>

                {{-- Eğer alt başlık varsa yazdırıyoruz --}}
                @if($subtitle)
                    <p>{{ $subtitle }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="breadcrums">
        <div class="container">
            <div class="row">
                <ul>
                    <li>
                        {{-- Anasayfa linkini route'dan alıyoruz --}}
                        <a href="{{ route('frontend.home') }}">
                            <i class="fa-solid fa-house"></i>
                            <p>{{ __('Homepage')  }}</p>
                        </a>
                    </li>
                    <li class="current">
                        {{-- Mevcut sayfanın başlığını yazdırıyoruz --}}
                        <p>{{ $title }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
