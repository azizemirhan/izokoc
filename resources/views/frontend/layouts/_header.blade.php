@php
    // Ayarlardan telefon ve e-posta bilgilerini al, yoksa varsayılanları kullan
    $footerContactPhone = data_get($settings, 'footer_contact_phone.value', data_get($settings, 'phone', '0(212) 211 39 39'));
    $contactEmail = data_get($settings, 'contact_email.value', data_get($settings, 'email', 'info@tuncay-insaat.com'));
    $siteLogo = data_get($settings, 'site_logo.value', 'uploads/settings/1758547383_beyazlogo.png');
@endphp

        <!-- Header Section -->
<header class="izokoc_header">
    <!-- Top Bar -->
    <div class="izokoc_topbar">
        <div class="izokoc_container">
            <div class="izokoc_topbar_content">
                <!-- Contact Info -->
                <div class="izokoc_contact_info">
                    <div class="izokoc_info_item">
                        <i class="fas fa-envelope"></i>
                        <div class="izokoc_info_text">
                            <span class="izokoc_label">Email Address</span>
                            <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
                        </div>
                    </div>
                    <div class="izokoc_info_item">
                        <i class="fas fa-phone"></i>
                        <div class="izokoc_info_text">
                            <span class="izokoc_label">Phone Number</span>
                            <a href="tel:{{ str_replace(['(', ')', ' '], '', $footerContactPhone) }}">{{ $footerContactPhone }}</a>
                        </div>
                    </div>
                </div>

                <!-- Search, Language & Menu Toggle -->
                <div class="izokoc_header_actions">
                    <button class="izokoc_search_btn" id="izokocSearchToggle">
                        <i class="fas fa-search"></i>
                    </button>

                    {{-- CMS DİL SEÇİCİ --}}
                    @if(isset($activeLanguages) && $activeLanguages->count() > 1)
                        <div class="izokoc_language_selector">
                            <button class="izokoc_language_btn" id="izokocLanguageBtn">
                                @php
                                    $currentLocale = app()->getLocale();
                                    $currentFlagCode = $currentLocale == 'en' ? 'gb' : $currentLocale;
                                    $currentLangData = $activeLanguages->get($currentLocale);
                                @endphp
                                <img src="{{ asset('flag-icons-main/flags/1x1/'.$currentFlagCode.'.svg') }}"
                                     alt="{{ $currentLocale }}"
                                     class="izokoc_flag_img">
                                <span class="izokoc_current_lang">{{ $currentLangData['native'] ?? strtoupper($currentLocale) }}</span>
                                <i class="fas fa-chevron-down izokoc_lang_arrow"></i>
                            </button>
                            <div class="izokoc_language_dropdown" id="izokocLanguageDropdown">
                                @foreach($activeLanguages as $code => $lang)
                                    @if($code != app()->getLocale())
                                        <a href="{{ route('language.swap', $code) }}"
                                           class="izokoc_language_item">
                                            @php
                                                $flagCode = $code == 'en' ? 'gb' : $code;
                                            @endphp
                                            <img src="{{ asset('flag-icons-main/flags/1x1/'.$flagCode.'.svg') }}"
                                                 alt="{{ $lang['native'] }}"
                                                 class="izokoc_flag_img">
                                            <span class="izokoc_language_name">{{ $lang['native'] }}</span>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <button class="izokoc_menu_toggle" id="izokocMenuToggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Modal -->
    <div class="izokoc_search_modal" id="izokocSearchModal">
        <div class="izokoc_search_modal_overlay" id="izokocSearchModalOverlay"></div>
        <div class="izokoc_search_modal_content">
            <button class="izokoc_search_modal_close" id="izokocSearchModalClose">
                <i class="fas fa-times"></i>
            </button>
            <div class="izokoc_search_modal_body">
                <h3 class="izokoc_search_modal_title">Arama Yap</h3>
                <form class="izokoc_search_modal_form" method="get" action="{{ route('frontend.search') }}">
                    <div class="izokoc_search_input_wrapper">
                        <i class="fas fa-search izokoc_search_icon"></i>
                        <input
                                type="search"
                                name="s"
                                placeholder="Aradığınız kelimeyi yazın..."
                                class="izokoc_search_modal_input"
                                autocomplete="off"
                        >
                        <button type="submit" class="izokoc_search_modal_submit">
                            Ara
                        </button>
                    </div>
                </form>
                <div class="izokoc_search_suggestions">
                    <p class="izokoc_suggestions_title">Popüler Aramalar:</p>
                    <div class="izokoc_suggestions_tags">
                        <a href="#" class="izokoc_suggestion_tag">İzolasyon</a>
                        <a href="#" class="izokoc_suggestion_tag">Mantolama</a>
                        <a href="#" class="izokoc_suggestion_tag">Çatı Yalıtımı</a>
                        <a href="#" class="izokoc_suggestion_tag">Su Yalıtımı</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="izokoc_navbar">
        <div class="izokoc_container">
            <div class="izokoc_navbar_content">
                <!-- Logo -->
                <div class="izokoc_logo">
                    <a href="{{ route('frontend.home') }}">
                        <img src="{{ asset($siteLogo) }}" alt="{{ config('app.name', 'İzokoç') }} Logo">
                    </a>
                </div>

                <!-- Mobile Get Info Button -->
                <a href="" class="izokoc_mobile_info_btn">
                    <i class="fas fa-envelope"></i>
                    <span>İletişim</span>
                </a>

                <!-- Desktop Menu -->
                @if(isset($mainMenu))
                    {!! \App\Models\Menu::renderByPlacement('header') !!}
                @else
                    <ul class="izokoc_menu">
                        <li class="izokoc_menu_item">
                            <a href="#">Menü Bulunamadı</a>
                        </li>
                    </ul>
                @endif

                <!-- Social Media -->
                <div class="izokoc_social">
                    @if(isset($settings['facebook_url']) && !empty($settings['facebook_url']))
                        <a href="{{ is_object($settings['facebook_url']) ? $settings['facebook_url']->value : $settings['facebook_url'] }}"
                           target="_blank" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif
                    @if(isset($settings['twitter_url']) && !empty($settings['twitter_url']))
                        <a href="{{ is_object($settings['twitter_url']) ? $settings['twitter_url']->value : $settings['twitter_url'] }}"
                           target="_blank" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endif
                    @if(isset($settings['instagram_url']) && !empty($settings['instagram_url']))
                        <a href="{{ is_object($settings['instagram_url']) ? $settings['instagram_url']->value : $settings['instagram_url'] }}"
                           target="_blank" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                    @if(isset($settings['linkedin_url']) && !empty($settings['linkedin_url']))
                        <a href="{{ is_object($settings['linkedin_url']) ? $settings['linkedin_url']->value : $settings['linkedin_url'] }}"
                           target="_blank" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    @endif
                    @if(isset($settings['youtube_url']) && !empty($settings['youtube_url']))
                        <a href="{{ is_object($settings['youtube_url']) ? $settings['youtube_url']->value : $settings['youtube_url'] }}"
                           target="_blank" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Mobile Sidebar Menu -->
<div class="izokoc_mobile_overlay" id="izokocMobileOverlay"></div>
<aside class="izokoc_mobile_sidebar" id="izokocMobileSidebar">
    <div class="izokoc_mobile_header">
        <div class="izokoc_mobile_logo">
            <img src="{{ asset($siteLogo) }}" alt="{{ config('app.name', 'İzokoç') }} Logo">
        </div>
        <button class="izokoc_mobile_close" id="izokocMobileClose">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="izokoc_mobile_nav">
        @if(isset($mainMenu))
            {!! \App\Models\Menu::renderByPlacement('header', 'mobile') !!}
        @else
            <ul class="izokoc_mobile_menu">
                <li class="izokoc_mobile_item">
                    <a href="#">Menü Bulunamadı</a>
                </li>
            </ul>
        @endif
    </nav>

    {{-- MOBİL DİL SEÇİCİ --}}
    @if(isset($activeLanguages) && $activeLanguages->count() > 1)
        <div class="izokoc_mobile_languages">
            <h4>{{ __('Dil Seçin') }}</h4>
            <div class="izokoc_mobile_language_list">
                @foreach($activeLanguages as $code => $lang)
                    <a href="{{ route('language.swap', $code) }}"
                       class="izokoc_mobile_language_item {{ $code == app()->getLocale() ? 'izokoc_active' : '' }}">
                        @php
                            $flagCode = $code == 'en' ? 'gb' : $code;
                        @endphp
                        <img src="{{ asset('flag-icons-main/flags/1x1/'.$flagCode.'.svg') }}"
                             alt="{{ $lang['native'] }}"
                             class="izokoc_flag_img">
                        <span>{{ $lang['native'] }}</span>
                        @if($code == app()->getLocale())
                            <i class="fas fa-check"></i>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <div class="izokoc_mobile_contact">
        <h4>İletişim</h4>
        <div class="izokoc_mobile_contact_item">
            <i class="fas fa-envelope"></i>
            <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
        </div>
        <div class="izokoc_mobile_contact_item">
            <i class="fas fa-phone"></i>
            <a href="tel:{{ str_replace(['(', ')', ' '], '', $footerContactPhone) }}">{{ $footerContactPhone }}</a>
        </div>
    </div>

    <div class="izokoc_mobile_social">
        @if(isset($settings['facebook_url']) && !empty($settings['facebook_url']))
            <a href="{{ is_object($settings['facebook_url']) ? $settings['facebook_url']->value : $settings['facebook_url'] }}"
               target="_blank"><i class="fab fa-facebook-f"></i></a>
        @endif
        @if(isset($settings['twitter_url']) && !empty($settings['twitter_url']))
            <a href="{{ is_object($settings['twitter_url']) ? $settings['twitter_url']->value : $settings['twitter_url'] }}"
               target="_blank"><i class="fab fa-twitter"></i></a>
        @endif
        @if(isset($settings['instagram_url']) && !empty($settings['instagram_url']))
            <a href="{{ is_object($settings['instagram_url']) ? $settings['instagram_url']->value : $settings['instagram_url'] }}"
               target="_blank"><i class="fab fa-instagram"></i></a>
        @endif
        @if(isset($settings['linkedin_url']) && !empty($settings['linkedin_url']))
            <a href="{{ is_object($settings['linkedin_url']) ? $settings['linkedin_url']->value : $settings['linkedin_url'] }}"
               target="_blank"><i class="fab fa-linkedin-in"></i></a>
        @endif
        @if(isset($settings['youtube_url']) && !empty($settings['youtube_url']))
            <a href="{{ is_object($settings['youtube_url']) ? $settings['youtube_url']->value : $settings['youtube_url'] }}"
               target="_blank"><i class="fab fa-youtube"></i></a>
        @endif
    </div>
</aside>