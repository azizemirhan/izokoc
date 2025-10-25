@php
    // Ayarlardan telefon ve e-posta bilgilerini al, yoksa varsayılanları kullan
    $footerContactPhone = data_get($settings, 'footer_contact_phone.value', '+897 (676) 56 675 7');
    $contactEmail = data_get($settings, 'contact_email.value', 'info@webmail.com');
@endphp

<section class="topbar">
    <div class="header-container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-3 noPadding">
                <div class="logo text-left">
                    <a href="{{ route('frontend.home') }}">
                        {{-- Dinamik Logo --}}
                        <img
                                src="{{ isset($settings['site_logo']) ? asset($settings['site_logo']->value) : asset('images/logo.png') }}"
                                alt="logo">
                    </a>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-9">
                <div class="topbar_right text-right">

                    {{-- Dinamik E-posta Adresi --}}
                    <div class="topbar_element info_element">
                        <i class="fa fa-envelope"></i>
                        <h5>Email Address</h5>
                        <p><a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a></p>
                    </div>

                    {{-- Dinamik Telefon Numarası --}}
                    <div class="topbar_element info_element">
                        <i class="fa fa-phone"></i>
                        <h5>Phone Number</h5>
                        <p>{{ $footerContactPhone }}</p>
                    </div>

                    <div class="topbar_element search_element">
                        <form method="get" action="#">
                            <i class="fa fa-search"></i>
                            <input type="search" name="s" placeholder="Search keyword..."/>
                        </form>
                    </div>

                    <div class="topbar_element settings_bar">
                        <a href="#" class="hamburger" id="open-overlay-nav"><i class="fal fa-bars"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="nav_bar" id="fix_nav">
    <div class="header-container">
        <div class="row">
            <div class="col-xl-8 col-lg-9">
                {{-- Dinamik Menü Buraya Gelecek --}}
                @if(isset($mainMenu))
                    {!! \App\Models\Menu::renderByPlacement('header') !!}
                @else
                    {{-- Menü bulunamazsa varsayılan HTML (isteğe bağlı) --}}
                    <div class="mobileMenuBar">
                        <a href="javascript: void(0);"><span>Menu</span><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="mainmenu">
                        <ul>
                            <li><a href="#">Menü Bulunamadı</a></li>
                        </ul>
                    </nav>
                @endif
            </div>
            <div class="col-xl-4 col-lg-3">
                <div class="top_social text-right">
                    {{-- Sosyal medya ikonları statik veya dinamik olabilir --}}
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-behance"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
    <span class="right_bgs"></span>
</section>