@php
    // data_get() helper'ı, ayar bulunamasa bile hata vermeden varsayılan bir değer döndürür.
    // Yeni temadaki varsayılan değerleri buraya girdim.

    // Çevrilebilir Ayarlar
    $footerInfoText = data_get($settings, 'footer_info_text.value.' . app()->getLocale(), 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
    $footerContactText = data_get($settings, 'footer_contact_text.value.' . app()->getLocale(), 'Talk to Our Officers');
    $footerLinksTitle = data_get($settings, 'footer_links_title.value.' . app()->getLocale(), 'Important Links');
    $footerServicesTitle = data_get($settings, 'footer_services_title.value.' . app()->getLocale(), 'Our Services');
    $newsletterTitle = data_get($settings, 'newsletter_title.value.' . app()->getLocale(), 'Subscribe Now');
    $footerSocialTitle = data_get($settings, 'footer_social_title.value.' . app()->getLocale(), 'Get More Here');
    $copyrightText = data_get($settings, 'copyright_text.value.' . app()->getLocale(), 'Copyright By &COPY;<a href="#">ThemeWar</a> - ' . date('Y'));


    // Çevrilemez Ayarlar
    $footerLogo = data_get($settings, 'footer_logo.value') ? asset($settings['footer_logo']->value) : asset('images/logo_2.png');
    $footerContactPhone = data_get($settings, 'footer_contact_phone.value', '+1 001-765-4321');
    $socialFacebook = data_get($settings, 'social_facebook.value', '#');
    $socialTwitter = data_get($settings, 'social_twitter.value', '#');
    $socialLinkedin = data_get($settings, 'social_linkedin.value', '#');
    $socialInstagram = data_get($settings, 'social_instagram.value', '#');
    $socialBehance = data_get($settings, 'social_behance.value', '#');
    $socialYoutube = data_get($settings, 'social_youtube.value', '#');

    // Footer Menüsünü 'footer-menu' slug'ı ile çekiyoruz.
    // Bu metodun <ul><li><a...></li></ul> yapısını döndürdüğünü varsayıyoruz.
    $footerMenu = \App\Models\Menu::renderByPlacement('footer')
@endphp

<footer class="footer_01">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-md-6 col-lg-3 noPaddingRight">
                <aside class="widget">
                    <div class="about_widget">
                        {{-- Dinamik Logo --}}
                        <a href="{{ route('frontend.home') }}"><img src="{{ $footerLogo }}" alt="Footer Logo"/></a>
                        {{-- Dinamik Hakkında Metni --}}
                        <p>
                            {{ $footerInfoText }}
                        </p>
                        <div class="caller">
                            <i class="fal fa-headphones"></i>
                            {{-- Dinamik İletişim Metni --}}
                            <span>{{ $footerContactText }}</span>
                            {{-- Dinamik Telefon Numarası --}}
                            <h3>
                                <a href="tel:{{ str_replace(' ', '', $footerContactPhone) }}">{{ $footerContactPhone }}</a>
                            </h3>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-xl-2 col-md-6 col-lg-2 pdl45 noPaddingRight">
                <aside class="widget">
                    {{-- Dinamik Menü Başlığı --}}
                    <h3 class="widget_title">{{ $footerLinksTitle }}<span>.</span></h3>
                    {{-- Dinamik Footer Menüsü --}}
                    {!! $footerMenu !!}
                </aside>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4 pdl65">
                <aside class="widget">
                    {{-- Dinamik Servisler Başlığı --}}
                    <h3 class="widget_title">{{ $footerServicesTitle }}<span>.</span></h3>

                    {{-- 
                        NOT: Bu "Recent Services" bölümü için orijinal Blade dosyanızda bir dinamik veri
                        (örn: son 3 servis, son 3 blog yazısı) bulunmuyordu. 
                        Bu nedenle statik olarak bırakıldı. 
                        İhtiyacınıza göre burayı dinamikleştirebilirsiniz.
                    --}}
                    <div class="recentServices">
                        <div class="serviceItem clearfix">
                            <img class="float-left" src="{{ asset('images/widget/1.jpg') }}" alt=""/>
                            <h5><a href="#">Lorem ipsum dolor sit am et, consectetur.</a></h5>
                            <span>14 Jnauary, 2019</span>
                        </div>
                        <div class="serviceItem clearfix">
                            <img class="float-left" src="{{ asset('images/widget/2.jpg') }}" alt=""/>
                            <h5><a href="#">Lorem ipsum dolor sit am et, consectetur.</a></h5>
                            <span>19 February, 2019</span>
                        </div>
                        <div class="serviceItem clearfix">
                            <img class="float-left" src="{{ asset('images/widget/3.jpg') }}" alt=""/>
                            <h5><a href="#">Lorem ipsum dolor sit am et, consectetur.</a></h5>
                            <span>14 July, 2018</span>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-3">
                <aside class="widget subscribe_widget">
                    {{-- Dinamik Bülten Başlığı --}}
                    <h3 class="widget_title">{{ $newsletterTitle }}<span>.</span></h3>
                    <div class="subscribForm">
                        {{-- Dinamik Bülten Formu --}}
                        <form method="post" action="{{ route('newsletter.subscribe') }}">
                            @csrf
                            <input type="email" name="email" placeholder="Enter your email" required/>
                            <button type="submit">Submit Now</button>
                            <input type="text" name="website" style="display:none"> {{-- honeypot --}}
                        </form>

                        {{-- Bülten için flash mesajları (isterseniz) --}}
                        @if(session('success'))
                            <div class="alert alert-success mt-2"
                                 style="color: white; font-size: 14px;">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger mt-2"
                                 style="color: #ff5e14; font-size: 14px;">{{ session('error') }}</div>
                        @endif
                    </div>
                </aside>
                <aside class="widget footer_social">
                    {{-- Dinamik Sosyal Medya Başlığı --}}
                    <h3 class="widget_title">{{ $footerSocialTitle }}<span>.</span></h3>
                    <div class="socials">
                        {{-- Dinamik Sosyal Medya İkonları --}}
                        @if($socialFacebook && $socialFacebook != '#')
                            <a href="{{ $socialFacebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($socialTwitter && $socialTwitter != '#')
                            <a href="{{ $socialTwitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if($socialBehance && $socialBehance != '#')
                            <a href="{{ $socialBehance }}" target="_blank"><i class="fab fa-behance"></i></a>
                        @endif
                        @if($socialYoutube && $socialYoutube != '#')
                            <a href="{{ $socialYoutube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                        @endif
                        @if($socialLinkedin && $socialLinkedin != '#')
                            <a href="{{ $socialLinkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                        @endif
                        @if($socialInstagram && $socialInstagram != '#')
                            <a href="{{ $socialInstagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    </div>
</footer>

<section class="copyright_section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="siteinfo">
                    {{-- Dinamik Copyright Metni --}}
                    {!! $copyrightText !!}
                </div>
            </div>
        </div>
    </div>
</section>
<a href="#" id="backtotop"><i class="fal fa-angle-double-up"></i></a>