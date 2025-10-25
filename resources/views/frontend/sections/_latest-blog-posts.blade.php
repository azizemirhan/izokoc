@php
    // Admin panelinden gelen veriler
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), 'News');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'News Feeds?');

    // DataHandler'dan gelen blog yazıları
    $latestPosts = $dynamicData ?? collect();

    // İlk yazı büyük gösterilecek, diğerleri küçük
    $featuredPost = $latestPosts->first();
    $otherPosts = $latestPosts->skip(1);
@endphp

<section class="commonSection newsSection">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <h6 class="sub_title">Sektörden Haberler</h6>
                <h2 class="sec_title with_bar">
                    <span>{{ $mainTitle }}</span>
                </h2>
            </div>
        </div>
        <div class="row">
            @if($featuredPost)
                {{-- Büyük Blog Kartı (Sol Taraf) --}}
                <div class="col-xl-7 col-md-7">
                    <div class="blogItem">
                        @if($featuredPost->featured_image)
                            <div class="bi_thumb">
                                <img src="{{ asset($featuredPost->featured_image) }}"
                                     alt="{{ $featuredPost->getTranslation('title', app()->getLocale()) }}">
                            </div>
                        @endif
                        <div class="bi_details">
                            <div class="bi_meta">
                                @if($featuredPost->published_at)
                                    <span>
                                        <i class="fal fa-calendar-alt"></i>
                                        <a href="#">{{ \Carbon\Carbon::parse($featuredPost->published_at)->format('d M Y') }}</a>
                                    </span>
                                @endif
                                @if($featuredPost->comments_count ?? false)
                                    <span>
                                        <i class="fal fa-comments"></i>
                                        <a href="#">{{ $featuredPost->comments_count }} {{ __('Comments') }}</a>
                                    </span>
                                @endif
                                @if($featuredPost->author)
                                    <span>
                                        <i class="fal fa-user"></i>{{ __('By') }}
                                        <a href="#">{{ $featuredPost->author->name }}</a>
                                    </span>
                                @endif
                            </div>
                            <h3>
                                <a href="">
                                    {{ $featuredPost->getTranslation('title', app()->getLocale()) }}
                                </a>
                            </h3>
                            @if($featuredPost->getTranslation('summary', app()->getLocale()))
                                <p>{{ Str::limit($featuredPost->getTranslation('summary', app()->getLocale()), 200) }}</p>
                            @endif
                            <a href="" class="read_more">
                                {{ __('Read More') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Küçük Blog Kartları (Sağ Taraf) --}}
            @if($otherPosts->isNotEmpty())
                <div class="col-xl-5 col-md-5">
                    @foreach($otherPosts as $post)
                        <div class="blogItem2">
                            <div class="bi_meta">
                                @if($post->published_at)
                                    <span>
                                        <i class="fal fa-calendar-alt"></i>
                                        <a href="#">{{ \Carbon\Carbon::parse($post->published_at)->format('d M Y') }}</a>
                                    </span>
                                @endif
                                @if($post->comments_count ?? false)
                                    <span>
                                        <i class="fal fa-comments"></i>
                                        <a href="#">{{ $post->comments_count }} {{ __('Comments') }}</a>
                                    </span>
                                @endif
                            </div>
                            <h3>
                                <a href="">
                                    {{ $post->getTranslation('title', app()->getLocale()) }}
                                </a>
                            </h3>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Tüm Blog Yazılarını Görüntüle Butonu --}}
        @if($latestPosts->isNotEmpty())
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="/bloglar" class="ind_btn">
                        <span>{{ __('View All Articles') }}</span>
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>