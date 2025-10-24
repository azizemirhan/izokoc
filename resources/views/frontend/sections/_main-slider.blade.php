@php
    // SlidersListHandler'dan gelen dinamik veriyi alıyoruz.
    // Eğer veri gelmezse veya boşsa, boş bir koleksiyon oluşturuyoruz.
    $sliders = $dynamicData ?? collect();
@endphp

{{-- Eğer slider mevcutsa section'ı oluştur --}}
@if($sliders->isNotEmpty())
    <section class="slider_01">
        <div class="rev_slider_wrapper">
            <div id="rev_slider_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.1">
                <ul>
                    {{-- Her bir slider öğesi için döngü --}}
                    @foreach($sliders as $key => $slider)
                        <li data-index="rs-{{ $key + 3045 }}" {{-- Benzersiz index --}}
                        data-transition="random"
                            data-slotamount="default"
                            data-hideafterloop="0"
                            data-hideslideonmobile="off"
                            data-easein="Power4.easeInOut"
                            data-easeout="Power4.easeInOut"
                            data-masterspeed="2000"
                            {{-- data-thumb="images/slider/t_1.jpg" --}} {{-- Thumb gerekirse buraya eklenebilir --}}
                            data-rotate="0"
                            data-fstransition="fade"
                            data-fsmasterspeed="1500"
                            data-fsslotamount="7"
                            data-saveperformance="off"
                            data-title="{{ $slider->getTranslation('title', app()->getLocale()) }}"
                            {{-- Slide başlığı --}}
                            data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6=""
                            data-param7="" data-param8="" data-param9="" data-param10=""
                            data-description="{{ $slider->getTranslation('description', app()->getLocale()) ?: $slider->getTranslation('subtitle', app()->getLocale()) }}"> {{-- Açıklama --}}

                            {{-- Arka Plan Resmi --}}
                            <img src="{{ asset($slider->image_path) }}" alt="Slider Image {{ $key + 1 }}"
                                 data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                 data-bgparallax="10" class="rev-slidebg" data-no-retina>

                            {{-- Katman 1: Küçük Üst Başlık (Subtitle varsayalım) --}}
                            @if($slider->getTranslation('subtitle', app()->getLocale()))
                                <div class="tp-caption tp-resizeme"
                                     data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']"
                                     data-y="['top','middle','middle','middle']"
                                     data-voffset="['13', '-140', '-110', '-110']"
                                     data-fontsize="['16','16','16','15']" data-fontweight="500"
                                     data-lineheight="['16','16','16','16']"
                                     data-width="none" data-height="none" data-whitespace="nowrap" data-color="['#FFF']"
                                     data-type="text" data-responsive_offset="on"
                                     data-frames='[{"delay":1200,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                     data-textAlign="['left','center','center','center']"
                                     style="z-index: 5; white-space: nowrap; text-transform: uppercase;">
                                    {{ $slider->getTranslation('subtitle', app()->getLocale()) }}
                                </div>
                            @endif

                            {{-- Katman 2: Ana Başlık (Title) --}}
                            @if($slider->getTranslation('title', app()->getLocale()))
                                <div class="tp-caption barlow tp-resizeme rs-parallaxlevel-3 elemnt_3"
                                     data-x="['left', 'left', 'left', 'left']" data-hoffset="['0', '0', '0', '0']"
                                     data-y="['top','middle','middle','middle']" data-voffset="['41','-40','-50','-50']"
                                     data-fontsize="['100','90','60','50']" data-lineheight="['110','90','60','50']"
                                     data-fontweight="600" data-letterspacing="['-3', '-3', '-2', '-1']"
                                     data-width="['700','100%','100%','100%']" data-height="['auto']"
                                     data-whitesapce="['normal', 'normal', 'normal', 'normal']" data-color="['#FFF']"
                                     data-type="text" data-responsive_offset="on"
                                     data-frames='[{"delay":1500,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                     data-textAlign="['left','center','center','center']"
                                     style="z-index: 8; white-space: normal;">
                                    {{ $slider->getTranslation('title', app()->getLocale()) }}
                                </div>
                            @endif

                            {{-- Katman 3: Açıklama Metni (Description veya Subtitle) --}}
                            @php
                                $description = $slider->getTranslation('description', app()->getLocale()) ?: $slider->getTranslation('subtitle', app()->getLocale());
                            @endphp
                            @if($description)
                                <div class="tp-caption tp-resizeme textRes"
                                     data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['55','80','30','30']"
                                     data-fontsize="['18','18','18','15']" data-fontweight="400"
                                     data-lineheight="['22','22','22','22']"
                                     data-width="['auto', '100%', '100%', '100%']" data-height="['auto']"
                                     data-whitesapce="['normal', 'normal', 'normal', 'normal']" data-color="['#FFF']"
                                     data-type="text" data-responsive_offset="on"
                                     data-frames='[{"delay":1800,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                     data-textAlign="['left','center','center','center']"
                                     style="z-index: 5; white-space: normal; text-transform: none;">
                                    {{-- Br tag'ını korumak için nl2br kullanabiliriz veya description'ı buna göre kaydederiz --}}
                                    {!! nl2br(e($description)) !!}
                                </div>
                            @endif

                            {{-- Katman 4: Buton --}}
                            @if($slider->button_url && $slider->getTranslation('button_text', app()->getLocale()))
                                <div class="tp-caption tp-resizeme"
                                     data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']"
                                     data-y="['middle','middle','middle','middle']"
                                     data-voffset="['135','140','100','100']"
                                     data-width="auto" data-height="none" data-whitespace="nowrap"
                                     data-type="text" data-responsive_offset="on"
                                     data-frames='[{"delay":2100,"speed":2000,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},
                                                {"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                     data-textAlign="['center','center','center','center']"
                                     style="z-index: 5; white-space: nowrap; text-transform: none;">
                                    <a href="{{ url($slider->button_url) }}"
                                       class="ind_btn"><span>{{ $slider->getTranslation('button_text', app()->getLocale()) }}</span></a>
                                </div>
                            @endif

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endif