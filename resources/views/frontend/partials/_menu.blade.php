@if(isset($items) && $items->isNotEmpty())
    {{-- Desktop Menu için class yapısı --}}
    @if(!isset($type) || $type !== 'mobile')
        <ul class="izokoc_menu">
            @foreach($items as $item)
                @include('frontend.partials._submenu', ['item' => $item, 'type' => 'desktop'])
            @endforeach
        </ul>
    @else
        {{-- Mobile Menu için class yapısı --}}
        <ul class="izokoc_mobile_menu">
            @foreach($items as $item)
                @include('frontend.partials._submenu', ['item' => $item, 'type' => 'mobile'])
            @endforeach
        </ul>
    @endif
@endif