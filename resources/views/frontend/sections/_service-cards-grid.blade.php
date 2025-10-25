@php
    // Admin panelinden gelen veriler
    $subTitle = data_get($content, 'sub_title.' . app()->getLocale(), 'Our Services');
    $mainTitle = data_get($content, 'main_title.' . app()->getLocale(), 'What We Offer');
    $showFilters = data_get($content, 'show_filters', '0') == '1';
    
    // DataHandler'dan gelen hizmetler
    $services = $dynamicData ?? collect();
    
    // Kategorileri topla (eğer filtreleme açıksa)
    $categories = collect();
    if ($showFilters && $services->isNotEmpty()) {
        $categories = $services->pluck('category')->filter()->unique('id');
    }
@endphp

<section class="commonSection casestudysection service-cards-grid-section">
    <div class="container">
        {{-- Başlık Bölümü --}}
        <div class="row">
            <div class="col-xl-12 text-center">
                <h6 class="sub_title">{{ $subTitle }}</h6>
                <h2 class="sec_title with_bar">
                    <span>{{ $mainTitle }}</span>
                </h2>
            </div>
        </div>

        {{-- Kategori Filtreleri --}}
        @if($showFilters && $categories->isNotEmpty())
            <div class="row">
                <div class="col-xl-12">
                    <div class="simplefilter text-center mb-4">
                        <button class="filter-btn active" data-filter="all">
                            {{ __('All Services') }}
                        </button>
                        @foreach($categories as $category)
                            <button class="filter-btn" data-filter="category-{{ $category->id }}">
                                {{ $category->getTranslation('name', app()->getLocale()) }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Hizmet Kartları Grid --}}
        <div class="row shuffle-wrapper" id="serviceGrid">
            @forelse($services as $service)
                @php
                    $categorySlug = $service->category ? 'category-' . $service->category->id : '';
                    $categoryName = $service->category 
                        ? $service->category->getTranslation('name', app()->getLocale()) 
                        : '';
                    
                    // Hizmet resmi
                    $serviceImage = $service->featured_image 
                        ? asset($service->featured_image) 
                        : ($service->cover_image ?? 'https://placehold.co/370x280');
                @endphp

                <div class="col-xl-4 col-md-6 col-lg-4 service-item shuffle-item"
                     data-groups='["all", "{{ $categorySlug }}"]'
                     data-aos="fade-up"
                     data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="singlefolio service-card">
                        <div class="service-image-wrapper">
                            <img src="{{ $serviceImage }}"
                                 alt="{{ $service->getTranslation('title', app()->getLocale()) }}"
                                 loading="lazy">

                            {{-- Kategori Badge --}}
                            @if($service->category)
                                <span class="category-badge">{{ $categoryName }}</span>
                            @endif
                        </div>

                        <div class="folioHover service-overlay">
                            @if($service->category)
                                <p class="service-category">
                                    <a class="cate" href="#">{{ $categoryName }}</a>
                                </p>
                            @endif

                            <h4 class="service-title">
                                <a href="{{ route('frontend.services.show', $service->slug) }}">
                                    {{ $service->getTranslation('title', app()->getLocale()) }}
                                </a>
                            </h4>

                            @if($service->getTranslation('summary', app()->getLocale()))
                                <p class="service-summary">
                                    {{ Str::limit($service->getTranslation('summary', app()->getLocale()), 80) }}
                                </p>
                            @endif

                            <a href="{{ route('frontend.services.show', $service->slug) }}"
                               class="service-link-btn">
                                {{ __('Learn More') }}
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">{{ __('No services found.') }}</p>
                </div>
            @endforelse
        </div>

        {{-- Tüm Hizmetleri Görüntüle Butonu (Opsiyonel) --}}
        @if($services->isNotEmpty())
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ route('frontend.services.index') }}" class="theme-btn">
                        {{ __('View All Services') }}
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

@push('styles')
    <style>
        .service-cards-grid-section {
            padding: 100px 0;
            background: #f8f8f8;
        }

        /* Başlık Stilleri */
        .sub_title {
            font-size: 16px;
            font-weight: 600;
            color: #ffc107;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
            display: block;
        }

        .sec_title {
            font-size: 42px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 50px;
        }

        .sec_title.with_bar span {
            position: relative;
            display: inline-block;
            padding-bottom: 20px;
        }

        .sec_title.with_bar span::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #ffc107, #ffab00);
        }

        /* Filtre Butonları */
        .simplefilter {
            margin-bottom: 50px;
        }

        .filter-btn {
            background: #fff;
            border: 2px solid #e0e0e0;
            color: #666;
            padding: 12px 30px;
            margin: 5px;
            border-radius: 30px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: capitalize;
        }

        .filter-btn:hover {
            background: #f5f5f5;
            border-color: #ffc107;
            color: #1a1a1a;
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            border-color: #16213e;
            color: #fff;
        }

        /* Grid Wrapper */
        .shuffle-wrapper {
            position: relative;
            overflow: hidden;
            transition: height 0.3s ease;
        }

        /* Hizmet Kartları */
        .service-item {
            margin-bottom: 30px;
            opacity: 1;
            transition: all 0.3s ease;
        }

        .service-item.filtered-out {
            opacity: 0;
            pointer-events: none;
            position: absolute;
        }

        .service-card {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            background: #fff;
            transition: all 0.4s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Resim Wrapper */
        .service-image-wrapper {
            position: relative;
            height: 280px;
            overflow: hidden;
        }

        .service-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .service-card:hover .service-image-wrapper img {
            transform: scale(1.1);
        }

        /* Kategori Badge */
        .category-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 193, 7, 0.95);
            color: #1a1a1a;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 2;
            backdrop-filter: blur(10px);
        }

        /* Overlay */
        .service-overlay {
            padding: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .service-category {
            margin-bottom: 10px;
            font-size: 14px;
        }

        .service-category .cate {
            color: #ffc107;
            text-decoration: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: color 0.3s ease;
        }

        .service-category .cate:hover {
            color: #ffab00;
        }

        .service-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .service-title a {
            color: #1a1a1a;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .service-title a:hover {
            color: #ffc107;
        }

        .service-summary {
            color: #666;
            line-height: 1.7;
            margin-bottom: 20px;
            font-size: 15px;
            flex: 1;
        }

        /* Link Butonu */
        .service-link-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #1a1a1a;
            font-weight: 600;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
            align-self: flex-start;
        }

        .service-link-btn:hover {
            color: #ffc107;
            border-bottom-color: #ffc107;
            gap: 15px;
        }

        .service-link-btn i {
            transition: transform 0.3s ease;
        }

        .service-link-btn:hover i {
            transform: translateX(5px);
        }

        /* Theme Button */
        .theme-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: #fff;
            padding: 18px 40px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(26, 26, 46, 0.3);
        }

        .theme-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(26, 26, 46, 0.4);
            gap: 15px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .service-cards-grid-section {
                padding: 60px 0;
            }

            .sec_title {
                font-size: 32px;
            }

            .service-image-wrapper {
                height: 220px;
            }
        }

        @media (max-width: 768px) {
            .sec_title {
                font-size: 28px;
            }

            .filter-btn {
                padding: 10px 20px;
                font-size: 14px;
            }

            .service-title {
                font-size: 20px;
            }

            .service-overlay {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .service-cards-grid-section {
                padding: 40px 0;
            }

            .sec_title {
                font-size: 24px;
                margin-bottom: 30px;
            }

            .simplefilter {
                margin-bottom: 30px;
            }

            .filter-btn {
                display: block;
                width: 100%;
                margin: 5px 0;
            }
        }

        /* Animation Effects */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .service-item {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const serviceItems = document.querySelectorAll('.service-item');

            if (filterButtons.length > 0) {
                filterButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const filterValue = this.getAttribute('data-filter');

                        // Aktif butonu güncelle
                        filterButtons.forEach(btn => btn.classList.remove('active'));
                        this.classList.add('active');

                        // Hizmetleri filtrele
                        serviceItems.forEach(item => {
                            const groups = JSON.parse(item.getAttribute('data-groups'));

                            if (filterValue === 'all' || groups.includes(filterValue)) {
                                item.style.display = 'block';
                                item.classList.remove('filtered-out');

                                // Fade in animasyonu
                                setTimeout(() => {
                                    item.style.opacity = '1';
                                    item.style.transform = 'translateY(0)';
                                }, 10);
                            } else {
                                item.style.opacity = '0';
                                item.style.transform = 'translateY(20px)';
                                item.classList.add('filtered-out');

                                setTimeout(() => {
                                    item.style.display = 'none';
                                }, 300);
                            }
                        });
                    });
                });
            }

            // Lazy loading için Intersection Observer
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.classList.add('loaded');
                            observer.unobserve(img);
                        }
                    });
                });

                document.querySelectorAll('.service-image-wrapper img').forEach(img => {
                    imageObserver.observe(img);
                });
            }
        });
    </script>
@endpush