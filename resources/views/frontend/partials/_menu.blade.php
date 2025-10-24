@if(isset($items) && $items->isNotEmpty())
    {{-- Yeni temadaki mobil menü çubuğu --}}
    <div class="mobileMenuBar">
        <a href="javascript: void(0);"><span>Menu</span><i class="fa fa-bars"></i></a>
    </div>

    {{-- Yeni temadaki ana navigasyon menüsü --}}
    <nav class="mainmenu">
        <ul>
            @foreach($items as $item)
                {{-- Her bir öğe için _submenu.blade.php'yi çağırır --}}
                @include('frontend.partials._submenu', ['item' => $item])
            @endforeach
        </ul>
    </nav>
@endif