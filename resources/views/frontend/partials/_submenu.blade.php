@if ($item->children->isNotEmpty())
    {{-- Eğer alt menüsü varsa, temanızın beklediği class'ı ekler: "menu-item-has-children" --}}
    {{-- Not: Aktif menü öğesi için (current-menu-item) sınıfını Menu modelinizde veya bir View Composer'da eklemeniz gerekebilir --}}
    <li class="menu-item-has-children">
        <a href="{{ $item->url }}">
            {{ $item->getTranslation('label', app()->getLocale()) }}
        </a>
        {{-- Alt menü için temanızın beklediği ul class'ı: "sub_menu" (alt çizgiye dikkat) --}}
        <ul class="sub_menu">
            @foreach($item->children as $child)
                {{-- Her bir alt öğe için kendini tekrar çağırarak (recursive) iç içe yapıyı kurar --}}
                @include('frontend.partials._submenu', ['item' => $child])
            @endforeach
        </ul>
    </li>
@else
    {{-- Eğer alt menüsü yoksa, normal bir <li> oluşturur --}}
    <li>
        <a href="{{ $item->url }}">{{ $item->getTranslation('label', app()->getLocale()) }}</a>
    </li>
@endif