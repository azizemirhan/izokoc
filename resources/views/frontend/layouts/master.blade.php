<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @hasSection ('page_meta')
        @yield('page_meta')
    @else
        {{-- Bu blok, genellikle $page değişkeni olmayan anasayfa gibi yerlerde hata verebilir. --}}
        {{-- Daha güvenli hale getirmek için bir kontrol ekleyelim. --}}
        @isset($page)
            <title>{{ $page->getTranslation('seo_title', app()->getLocale()) ?: $page->getTranslation('title', app()->getLocale()) }}</title>
            <meta name="description" content="{{ $page->getTranslation('meta_description', app()->getLocale()) }}">
            <meta name="keywords" content="{{ $page->getTranslation('keywords', app()->getLocale()) }}">
            <meta name="robots" content="{{ $page->index_status }},{{ $page->follow_status }}">
            <link rel="canonical" href="{{ $page->canonical_url ?: url()->current() }}"/>
            <meta property="og:title"
                  content="{{ $page->getTranslation('og_title', app()->getLocale()) ?: $page->getTranslation('seo_title', app()->getLocale()) }}"/>
            <meta property="og:description"
                  content="{{ $page->getTranslation('og_description', app()->getLocale()) ?: $page->getTranslation('meta_description', app()->getLocale()) }}"/>
            @if($page->og_image)
                <meta property="og:image" content="{{ asset($page->og_image) }}"/>
            @endif
        @else
            {{-- Eğer $page değişkeni yoksa (anasayfa gibi), genel ayarlardan SEO bilgisi çekilebilir --}}
            <title>{{ $settings['site_title']->value[app()->getLocale()] ?? config('app.name') }}</title>
            <meta name="description" content="{{ $settings['site_description']->value[app()->getLocale()] ?? '' }}">
        @endif
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="{{ url()->current() }}"/>
    @endif

    @if(!empty($settings['google_site_verification']->value))
        <meta name="google-site-verification" content="{{ $settings['google_site_verification']->value }}"/>
    @endif
    {{-- Bing Webmaster Tools --}}
    @if(!empty($settings['bing_site_verification']->value))
        <meta name="msvalidate.01" content="{{ $settings['bing_site_verification']->value }}"/>
    @endif
    {{-- Yandex Webmaster --}}
    @if(!empty($settings['yandex_site_verification']->value))
        <meta name="yandex-verification" content="{{ $settings['yandex_site_verification']->value }}"/>
    @endif
    <link rel="icon"
          href="{{ isset($settings['site_favicon']) ? asset($settings['site_favicon']->value) : '/favicon.ico' }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/fontawesome-all.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/line-awesome.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/icofont.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/owl.theme.default.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/animate.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/magnific-popup.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/preset.css') }}"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/settings.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/navigation.css') }}"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/theme.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/responsive.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('site/css/presets/color1.css') }}" id="colorChange"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('site/header.css') }}"/>

    @stack('styles')
</head>
<body>
@include('frontend.layouts._header')
@if (!Route::is('frontend.home', 'frontend.services.show', 'blog.index', 'blog.show', 'blog.category'))
    <x-page-banner :title="$pageTitle ?? 'Kurumsal'" :subtitle="$pageSubtitle ?? ''"/>
@endif
@yield('content')
@include('frontend.layouts._footer')
@auth('admin')
    @include('admin.bar')
@endauth
@include('frontend.layouts.modal')

<script src="{{ asset('site/js/jquery.js') }}"></script>
<script src="{{ asset('site/js/jquery-ui.js') }}"></script>
<script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('site/js/jquery.appear.js') }}"></script>
<script src="{{ asset('site/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('site/js/slick.min.js') }}"></script>
<script src="{{ asset('site/js/jquery.shuffle.min.js') }}"></script>
<script src="{{ asset('site/js/jquery.magnific-popup.min.js') }}"></script>

<script src="{{ asset('site/js/modernizr.custom.js') }}"></script>
<script src="{{ asset('site/js/dlmenu.js') }}"></script>
<script src="{{ asset('site/js/jquery.easing.1.3.js') }}"></script>

<script src="{{ asset('site/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('site/js/jquery.themepunch.revolution.min.js') }}"></script>

<script src="{{ asset('site/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('site/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('site/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('site/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('site/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('site/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('site/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('site/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('site/js/extensions/revolution.extension.video.min.js') }}"></script>

<script src="{{ asset('site/js/theme.js') }}"></script>
<script src="{{ asset('site/header.js') }}"></script>

@stack('scripts')
</body>
</html>
