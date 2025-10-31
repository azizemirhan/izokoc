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
                            <span class="izokoc_label">{{ __('email') }}</span>
                            <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
                        </div>
                    </div>
                    <div class="izokoc_info_item">
                        <i class="fas fa-phone"></i>
                        <div class="izokoc_info_text">
                            <span class="izokoc_label">{{ __('phone') }}</span>
                            <a href="tel:{{ str_replace(['(', ')', ' '], '', $footerContactPhone) }}">{{ $footerContactPhone }}</a>
                        </div>
                    </div>
                </div>

                <!-- Search, WhatsApp, Language & Menu Toggle -->
                <div class="izokoc_header_actions">
                    <button class="izokoc_search_btn" id="izokocSearchToggle">
                        <i class="fas fa-search"></i>
                    </button>

                    {{-- WHATSAPP İLETİŞİM BUTONU --}}
                    @php
                        $whatsappNumber = data_get($settings, 'whatsapp_number.value', data_get($settings, 'phone', '905xxxxxxxxx'));
                        // Telefon numarasını WhatsApp formatına çevir (sadece rakamlar)
                        $whatsappClean = preg_replace('/[^0-9]/', '', $whatsappNumber);
                        // Eğer 0 ile başlıyorsa, 90 ekle
                        if(substr($whatsappClean, 0, 1) == '0') {
                            $whatsappClean = '90' . substr($whatsappClean, 1);
                        }
                        // Eğer 90 ile başlamıyorsa ve 10 haneli ise başına 90 ekle
                        if(strlen($whatsappClean) == 10) {
                            $whatsappClean = '90' . $whatsappClean;
                        }
                    @endphp
                    <a href="https://wa.me/{{ $whatsappClean }}"
                       target="_blank"
                       class="izokoc_whatsapp_btn"
                       title="WhatsApp'dan İletişime Geç">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                    {{-- CMS DİL SEÇİCİ - YAN YANA BAYRAKLAR --}}
                    @if(isset($activeLanguages) && $activeLanguages->count() > 1)
                        <div class="izokoc_language_flags">
                            @foreach($activeLanguages as $code => $lang)
                                @php
                                    $flagCode = $code == 'en' ? 'gb' : $code;
                                    $isActive = $code == app()->getLocale();
                                @endphp
                                <a href="{{ route('language.swap', $code) }}"
                                   class="izokoc_flag_link {{ $isActive ? 'izokoc_active' : '' }}"
                                   title="{{ $lang['native'] }}">
                                    <img src="{{ asset('flag-icons-main/flags/1x1/'.$flagCode.'.svg') }}"
                                         alt="{{ $lang['native'] }}"
                                         class="izokoc_flag_icon">
                                </a>
                            @endforeach
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
                <form class="izokoc_search_modal_form" method="get" action="{{ route('frontend.search') }}">
                    <div class="izokoc_search_input_wrapper">
                        <i class="fas fa-search izokoc_search_icon"></i>
                        <input
                                type="search"
                                name="s"T
                                placeholder="{{ __('Type in the word you are looking for...') }}"
                                class="izokoc_search_modal_input"
                                autocomplete="off"
                        >
                        <button type="submit" class="izokoc_search_modal_submit">
                            {{ __('search-only') }}
                        </button>
                    </div>
                </form>
                <div class="izokoc_search_suggestions">
                    <p class="izokoc_suggestions_title">{{ __('popular_searches') }}</p>
                    <div class="izokoc_suggestions_tags">
                        <a href="#" class="izokoc_suggestion_tag">{{ __('isolation') }}</a>
                        <a href="#" class="izokoc_suggestion_tag">{{ __('insulation') }}</a>
                        <a href="#" class="izokoc_suggestion_tag">{{ __('roof-insulation') }}</a>
                        <a href="#" class="izokoc_suggestion_tag">{{ __('waterproofing') }}</a>
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
            <h4>{{ __('language_select') }}</h4>
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
        <h4>{{ __('contact') }}</h4>
        <div class="izokoc_mobile_contact_item">
            <i class="fas fa-envelope"></i>
            <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
        </div>
        <div class="izokoc_mobile_contact_item">
            <i class="fas fa-phone"></i>
            <a href="tel:{{ str_replace(['(', ')', ' '], '', $footerContactPhone) }}">{{ $footerContactPhone }}</a>
        </div>
        <div class="izokoc_mobile_contact_item izokoc_whatsapp_item">
            <i class="fab fa-whatsapp"></i>
            <a href="https://wa.me/{{ $whatsappClean }}" target="_blank">{{ __('whatsapp_contact') }}</a>
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