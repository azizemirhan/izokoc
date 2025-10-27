@php
    $isMobile = isset($type) && $type === 'mobile';
    $currentUrl = url()->current();
    $itemUrl = $item->url ?? '#';
    $isActive = $itemUrl === $currentUrl || ($itemUrl !== '#' && request()->is(trim($itemUrl, '/') . '/*'));

    // Alt menü var mı kontrol et
    $hasChildren = $item->children && $item->children->isNotEmpty();
@endphp

@if ($hasChildren)
    {{-- Desktop için alt menüsü olan öğe --}}
    @if(!$isMobile)
        <li class="izokoc_menu_item izokoc_has_submenu {{ $isActive ? 'izokoc_active' : '' }}">
            <a href="{{ $itemUrl }}">
                {{ $item->getTranslation('label', app()->getLocale()) }}
            </a>
            <ul class="izokoc_submenu">
                @foreach($item->children as $child)
                    @include('frontend.partials._submenu', ['item' => $child, 'type' => 'desktop'])
                @endforeach
            </ul>
        </li>
    @else
        {{-- Mobile için alt menüsü olan öğe --}}
        <li class="izokoc_mobile_item izokoc_has_child {{ $isActive ? 'izokoc_active' : '' }}">
            <a href="{{ $itemUrl }}">
                {{ $item->getTranslation('label', app()->getLocale()) }}
            </a>
            <button class="izokoc_submenu_toggle" type="button">
                <i class="fas fa-chevron-down"></i>
            </button>
            <ul class="izokoc_mobile_submenu">
                @foreach($item->children as $child)
                    @include('frontend.partials._submenu', ['item' => $child, 'type' => 'mobile'])
                @endforeach
            </ul>
        </li>
    @endif
@else
    {{-- Desktop için normal menü öğesi --}}
    @if(!$isMobile)
        <li class="izokoc_menu_item {{ $isActive ? 'izokoc_active' : '' }}">
            <a href="{{ $itemUrl }}">
                {{ $item->getTranslation('label', app()->getLocale()) }}
            </a>
        </li>
    @else
        {{-- Mobile için normal menü öğesi --}}
        <li class="izokoc_mobile_item {{ $isActive ? 'izokoc_active' : '' }}">
            <a href="{{ $itemUrl }}">
                {{ $item->getTranslation('label', app()->getLocale()) }}
            </a>
        </li>
    @endif
@endif