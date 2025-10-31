@php
    /* |--------------------------------------------------------------------------
    | Footer Veri Çekme Bloğu - Modern Tasarım
    |--------------------------------------------------------------------------
    | Footer için özel menu render metodları kullanılıyor.
    */

    // Çevrilebilir Ayarlar
    $footerInfoText = data_get($settings, 'footer_info_text.value.' . app()->getLocale(), 'Projelerinizi, uzman mühendislik çözümlerimiz ve yüksek kaliteli yalıtım uygulamalarımızla koruma altına alıyoruz.');
    $footerContactText = data_get($settings, 'footer_contact_text.value.' . app()->getLocale(), 'Uzman Ekibimizle İletişime Geçin');

    $footerServicesTitle = data_get($settings, 'footer_services_title.value.' . app()->getLocale(), 'Hizmetlerimiz');
    $newsletterTitle = data_get($settings, 'newsletter_title.value.' . app()->getLocale(), 'E-Bülten');
    $footerSocialTitle = data_get($settings, 'footer_social_title.value.' . app()->getLocale(), 'Bizi Takip Edin');
    $copyrightText = data_get($settings, 'copyright_text.value.' . app()->getLocale(), 'Tüm Hakları Saklıdır. &copy; ' . date('Y'));

    // Çevrilemez Ayarlar
    $footerLogo = data_get($settings, 'footer_logo.value') ? asset($settings['footer_logo']->value) : asset('images/logo_2.png');
    $footerContactPhone = data_get($settings, 'footer_contact_phone.value', '+90 (555) 123 45 67');
    $socialFacebook = data_get($settings, 'social_facebook.value', '#');
    $socialTwitter = data_get($settings, 'social_twitter.value', '#');
    $socialLinkedin = data_get($settings, 'social_linkedin.value', '#');
    $socialInstagram = data_get($settings, 'social_instagram.value', '#');
    $socialBehance = data_get($settings, 'social_behance.value', '#');
    $socialYoutube = data_get($settings, 'social_youtube.value', '#');

    // Footer Menüleri - YENİ METOD KULLANIMI
    $footerMenu = \App\Models\Menu::renderFooterMenu('footer'); // 'footer' placement'ı ile footer view kullanılacak
    $footerServicesMenu = \App\Models\Menu::renderFooterMenu('footer-services'); // 'footer-services' placement'ı
@endphp

{{-- Modern Footer Ana Container --}}
<div class="izkc-footer-wrapper" id="izkc-footer-main">

    {{-- Üst Gradient Dekoratif Çizgi --}}
    <div class="izkc-footer-gradient-line"></div>

    {{-- Ana Footer İçerik Alanı --}}
    <div class="izkc-footer-content">
        <div class="container">
            <div class="row gy-5">

                {{-- Sol Kolon: Marka & İletişim --}}
                <div class="col-lg-4 col-md-6">
                    <div class="izkc-footer-brand-section">
                        {{-- Logo --}}
                        <a href="{{ route('frontend.home') }}" class="izkc-footer-logo-link">
                            <img src="{{ $footerLogo }}" alt="Footer Logo" class="izkc-footer-logo-img"/>
                        </a>

                        {{-- Açıklama Metni --}}
                        <p class="izkc-footer-description">
                            {{ $footerInfoText }}
                        </p>

                        {{-- İletişim Kartı --}}
                        <div class="izkc-footer-contact-card">
                            <div class="izkc-footer-contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="izkc-footer-contact-info">
                                <span class="izkc-footer-contact-label">{{ $footerContactText }}</span>
                                <a href="tel:{{ str_replace([' ', '(', ')'], '', $footerContactPhone) }}" class="izkc-footer-contact-phone">
                                    {{ $footerContactPhone }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Orta Sol Kolon: Kurumsal Linkler --}}
                <div class="col-lg-2 col-md-6">
                    <div class="izkc-footer-links-section">
                        <h5 class="izkc-footer-section-title">
                            <span class="izkc-footer-title-line"></span>
                            {{ __('institutional') }}
                        </h5>
                        <div class="izkc-footer-menu-wrapper">
                            {{-- Footer için özel render edilen menu --}}
                            @if(!empty($footerMenu))
                                {!! $footerMenu !!}
                            @else
                                <ul class="izkc-footer-menu">
                                    <li class="izkc-footer-menu-item"><a href="#" class="izkc-footer-menu-link">Hakkımızda</a></li>
                                    <li class="izkc-footer-menu-item"><a href="#" class="izkc-footer-menu-link">İletişim</a></li>
                                    <li class="izkc-footer-menu-item"><small class="izkc-footer-menu-notice">(Lütfen 'footer' menüsünü oluşturun)</small></li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Sağ Kolon: Newsletter & Sosyal Medya --}}
                <div class="col-lg-6 col-md-6">
                    <div class="izkc-footer-newsletter-section">
                        <h5 class="izkc-footer-section-title">
                            <span class="izkc-footer-title-line"></span>
                            {{ $newsletterTitle }}
                        </h5>

                        {{-- Newsletter Formu --}}
                        <form method="post" action="{{ route('newsletter.subscribe') }}" class="izkc-newsletter-form" id="izkc-newsletter-form">
                            @csrf
                            <div class="izkc-newsletter-input-group">
                                <input type="email"
                                       name="email"
                                       class="izkc-newsletter-input"
                                       placeholder="{{ __('your-email-address') }}"
                                       required/>
                                <button type="submit"
                                        class="izkc-newsletter-button"
                                        aria-label="Abone Ol">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                            <input type="text" name="website" style="display:none" tabindex="-1">
                        </form>

                        {{-- Flash Mesajları --}}
                        @if(session('success'))
                            <div class="izkc-newsletter-alert izkc-newsletter-alert--success">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="izkc-newsletter-alert izkc-newsletter-alert--error">
                                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            </div>
                        @endif

                        {{-- Sosyal Medya --}}
                        <div class="izkc-footer-social-section">
                            <h6 class="izkc-footer-social-title">{{ __('follow_us') }}</h6>
                            <div class="izkc-social-links-grid">
                                @if($socialFacebook && $socialFacebook != '#')
                                    <a href="{{ $socialFacebook }}" target="_blank" class="izkc-social-link" title="Facebook" aria-label="Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                @endif
                                @if($socialTwitter && $socialTwitter != '#')
                                    <a href="{{ $socialTwitter }}" target="_blank" class="izkc-social-link" title="Twitter" aria-label="Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                @endif
                                @if($socialInstagram && $socialInstagram != '#')
                                    <a href="{{ $socialInstagram }}" target="_blank" class="izkc-social-link" title="Instagram" aria-label="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                @endif
                                @if($socialLinkedin && $socialLinkedin != '#')
                                    <a href="{{ $socialLinkedin }}" target="_blank" class="izkc-social-link" title="LinkedIn" aria-label="LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                @endif
                                @if($socialYoutube && $socialYoutube != '#')
                                    <a href="{{ $socialYoutube }}" target="_blank" class="izkc-social-link" title="YouTube" aria-label="YouTube">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                @endif
                                @if($socialBehance && $socialBehance != '#')
                                    <a href="{{ $socialBehance }}" target="_blank" class="izkc-social-link" title="Behance" aria-label="Behance">
                                        <i class="fab fa-behance"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Alt Copyright Alanı --}}
    <div class="izkc-footer-bottom" id="izkc-footer-copyright">
        <div class="container">
            <div class="izkc-footer-bottom-content">
                <div class="izkc-copyright-text">
                    {!! $copyrightText !!}
                </div>
                <div class="izkc-copyright-logo-wrapper">
                    <img src="{{ asset('backend/beyaz.png') }}" class="izkc-copyright-logo" alt="Logo" width="150px">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Başa Dön Butonu --}}
<a href="#" id="izkc-back-to-top" class="izkc-scroll-top-button" aria-label="Başa Dön">
    <i class="fas fa-arrow-up"></i>
</a>



