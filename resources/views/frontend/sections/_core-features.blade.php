@php
    // Ana başlık ve alt başlık bilgilerini al
    $subTitle = $section->getTranslation('sub_title', app()->getLocale(), $content, 'Core Features');
    $titleIcon = data_get($content, 'title_icon', 'fal fa-user-hard-hat');
    $titleText = $section->getTranslation('title_text', app()->getLocale(), $content, 'Doom Features');

    // Tekrarlayan özellikler verisini al (varsayılan olarak boş bir dizi)
    $features = data_get($content, 'features', []);
@endphp

<section class="commonSection graySection">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                {{-- Alt Başlık --}}
                <h6 class="sub_title gray_sub_title">{{ $subTitle }}</h6>
                {{-- Ana Başlık (İkon ve Metin) --}}
                <h2 class="sec_title with_bar">
                    <span>
                        @if($titleIcon)<i class="{{ $titleIcon }}"></i>@endif
                        <span>{{ $titleText }}</span>
                    </span>
                </h2>
            </div>
        </div>

        {{-- Eğer özellikler varsa göster --}}
        @if(!empty($features))
            <div class="row">
                {{-- Her bir özellik için döngü --}}
                @foreach($features as $feature)
                    @php
                        // Her bir özelliğin verilerini güvenli bir şekilde al
                        // Not: İkon sınıfları HTML'de 'bigger' ve 'smaller' olarak ayrılmış,
                        //       burada tek bir ikon alanı ('icon') varsayıldı ve ikisine de atandı.
                        //       Gerekirse repeater içinde iki ayrı ikon alanı tanımlanabilir.
                        $featureIcon = data_get($feature, 'icon', 'icofont-calculations');
                        $featureTitle = $section->getRepeaterTranslation('features', $loop->index, 'feature_title', app()->getLocale(), $content);
                        $featureDescription = $section->getRepeaterTranslation('features', $loop->index, 'description', app()->getLocale(), $content);
                    @endphp
                    <div class="col-lg-3 col-md-6">
                        <div class="icon_box_01 text-center">
                            {{-- İkonlar --}}
                            <i class="bigger {{ $featureIcon }}"></i>
                            <i class="smaller {{ $featureIcon }}"></i>
                            <span></span>
                            {{-- Özellik Başlığı (Çevrilebilir) --}}
                            <h3>{!! nl2br(e($featureTitle)) !!}</h3>
                            {{-- Özellik Açıklaması (Çevrilebilir) --}}
                            <p>
                                {!! nl2br(e($featureDescription)) !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
