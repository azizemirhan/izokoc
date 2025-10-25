<?php

return [
    'main-slider' => [
        'name' => 'Ana Sayfa Slider',
        'view' => 'frontend.sections._main-slider',
        'data_handler' => \App\PageBuilder\SlidersListHandler::class,
        'fields' => [],
    ],

    // ... Diğer section tanımları ...

    'about-us-video' => [
        'name' => 'Hakkımızda (Video ve İçerik)', // Yönetici panelinde görünecek isim
        'view' => 'frontend.sections._about-us-video', // Kullanılacak Blade dosyasının yolu
        'data_handler' => null, // Dinamik veri çekmeye gerek yok
        'fields' => [
            [
                'name' => 'Ana Resim', // Alanın etiketi
                'key' => 'main_image', // Veritabanında content JSON'da saklanacak anahtar
                'type' => 'image',     // Alan tipi (görsel seçici)
            ],
            [
                'name' => 'Popup Resmi',
                'key' => 'popup_image',
                'type' => 'image',
            ],
            [
                'name' => 'Video URL',
                'key' => 'video_url',
                'type' => 'text', // Alan tipi (metin girişi)
                'default' => 'https://player.vimeo.com/video/78393586', // Varsayılan değer
            ],
            [
                'name' => 'Alt Başlık',
                'key' => 'sub_title',
                'type' => 'text',
                'translatable' => true, // Çevrilebilir alan
                'default' => 'About Us',
            ],
            [
                'name' => 'Ana Başlık',
                'key' => 'title',
                'type' => 'textarea', // Uzun metinler için textarea daha uygun olabilir
                'translatable' => true,
                'default' => 'Concerted Efforts To Build Better.',
            ],
            [
                'name' => 'Giriş Metni',
                'key' => 'lead_text',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Dream big with get more inspiring solutions from here.',
            ],
            [
                'name' => 'Ana Paragraf',
                'key' => 'main_text',
                'type' => 'textarea',
                'translatable' => true,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, do eiusmod temp or incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.',
            ],
            [
                'name' => 'İmza Resmi',
                'key' => 'signature_image',
                'type' => 'image',
            ],
        ],
    ],

    // SON



    'service-cards-promo' => [
        'name' => 'Hizmet Kartları (Ana Sayfa)',
        'view' => 'frontend.sections._service-cards-promo',
        'data_handler' => \App\PageBuilder\ServicesListHandler::class,
        'fields' => [
            ['name' => 'service_count', 'label' => 'Gösterilecek Hizmet Sayısı', 'type' => 'number'],
        ],
    ],
    'about-us-promo' => [
        'name' => 'Hakkımızda (Ana Sayfa)',
        'view' => 'frontend.sections._about-us-promo',
        'fields' => [
            ['name' => 'small_title', 'label' => 'Küçük Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'content', 'label' => 'Paragraf İçeriği', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'image_one', 'label' => 'Büyük Resim (370x500)', 'type' => 'file'],
            ['name' => 'image_two', 'label' => 'Küçük Resim (265x325)', 'type' => 'file'],
        ],
    ],
    'counter-section' => [
        'name' => 'Sayaçlar',
        'view' => 'frontend.sections._counter-section',
        'fields' => [
            [
                'name' => 'sayac',
                'label' => 'Sayaç Değeri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'sayaç', 'label' => 'Sayaç Değeri', 'type' => 'text'],
                    ['name' => 'title', 'label' => 'Sayaç Başlığı', 'type' => 'text'],
                ]
            ],
        ],
    ],
    'projects-slider' => [
        'name' => 'Projeler (Slider)',
        'view' => 'frontend.sections._projects-slider',
        'data_handler' => \App\PageBuilder\ProjectsListHandler::class,
        'fields' => [
            ['name' => 'small_title', 'label' => 'Küçük Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'project_count', 'label' => 'Gösterilecek Proje Sayısı', 'type' => 'number'],
        ],
    ],
    'team-slider' => [
        'name' => 'Ekip (Slider)',
        'view' => 'frontend.sections._team-slider',
        // 'data_handler' => \App\PageBuilder\TeamListHandler::class, // data_handler'ı kaldırıyoruz.
        'fields' => [
            ['name' => 'small_title', 'label' => 'Küçük Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            [
                'name' => 'team_members',
                'label' => 'Ekip Üyeleri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'photo', 'label' => 'Fotoğraf', 'type' => 'file'],
                    ['name' => 'name', 'label' => 'İsim', 'type' => 'text', 'translatable' => true],
                    ['name' => 'position', 'label' => 'Pozisyon', 'type' => 'text', 'translatable' => true],
                    ['name' => 'facebook_url', 'label' => 'Facebook URL', 'type' => 'text'],
                    ['name' => 'twitter_url', 'label' => 'X (Twitter) URL', 'type' => 'text'],
                    ['name' => 'linkedin_url', 'label' => 'LinkedIn URL', 'type' => 'text'],
                ]
            ],
        ],
    ],
    // config/sections.php dosyasındaki 'image-gallery' bölümünü bununla değiştirin

    'image-gallery' => [
        'name' => 'Tüm Resimler Galerisi',
        'view' => 'frontend.sections._image-gallery',
        // Tüm resimleri çekecek olan data_handler'ı belirtiyoruz.
        'data_handler' => \App\PageBuilder\AllMediaListHandler::class,
        'fields' => [
            ['name' => 'main_title', 'label' => 'Galeri Başlığı', 'type' => 'text', 'translatable' => true],
            ['name' => 'description', 'label' => 'Galeri Açıklaması (İsteğe Bağlı)', 'type' => 'textarea', 'translatable' => true],
        ],
    ],

    'core-features' => [
        'name' => 'Öne Çıkan Özellikler (Akordiyon)',
        'view' => 'frontend.sections._core-features',
        'data_handler' => \App\PageBuilder\FeaturesListHandler::class,
        'fields' => [
            ['name' => 'small_title', 'label' => 'Küçük Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'video_url', 'label' => 'Video Linki (YouTube/Vimeo)', 'type' => 'url'],
            ['name' => 'video_image', 'label' => 'Video Kapak Resmi', 'type' => 'file'],
        ],
    ],
    'call-to-action-banner' => [
        'name' => 'Harekete Geçirici Banner',
        'view' => 'frontend.sections._call-to-action-banner',
        'fields' => [
            ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'subtitle', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'content', 'label' => 'İçerik', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'background_image', 'label' => 'Arkaplan Resmi', 'type' => 'file'],
        ],
    ],
    'testimonials-slider' => [
        'name' => 'Müşteri Yorumları (Slider)',
        'view' => 'frontend.sections._testimonials-slider',
        'data_handler' => \App\PageBuilder\TestimonialsListHandler::class,
        'fields' => [
            ['name' => 'small_title', 'label' => 'Küçük Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'image', 'label' => 'Sağ Taraf Resim (620x630)', 'type' => 'file'],
        ],
    ],
    'latest-blog-posts' => [
        'name' => 'Son Blog Yazıları',
        'view' => 'frontend.sections._latest-blog-posts',
        'data_handler' => \App\PageBuilder\LatestPostsHandler::class,
        'fields' => [
            ['name' => 'small_title', 'label' => 'Küçük Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'post_count', 'label' => 'Gösterilecek Yazı Sayısı', 'type' => 'number'],
        ],
    ],
    'tabbed-services' => [
        'name' => 'Hizmetler (Sekmeli)',
        'view' => 'frontend.sections._tabbed-services',
        'data_handler' => \App\PageBuilder\ServicesListHandler::class,
        'fields' => [
            ['name' => 'title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'background_image', 'label' => 'Arkaplan Resmi', 'type' => 'file'],
        ],
    ],

    'service-list-wide' => [
        'name' => 'Geniş Hizmet Listesi',
        'view' => 'frontend.sections._service-list-wide',
        'data_handler' => \App\PageBuilder\ServicesListHandler::class,
        'fields' => [
            ['name' => 'small_title', 'label' => 'Küçük Başlık (örn: What We Provide)', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık (örn: Exclusive services)', 'type' => 'text', 'translatable' => true],
            ['name' => 'service_count', 'label' => 'Gösterilecek Hizmet Sayısı', 'type' => 'number'],
        ],
    ],

    'cta-start-working' => [
        'name' => 'İşe Başlama (CTA)',
        'view' => 'frontend.sections._cta-start-working',
        'fields' => [
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'content', 'label' => 'İçerik Paragrafı', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'button_text', 'label' => 'Buton Yazısı', 'type' => 'text', 'translatable' => true],
            ['name' => 'button_url', 'label' => 'Buton Linki', 'type' => 'url'],
            ['name' => 'image', 'label' => 'Sağ Taraf Resmi', 'type' => 'file'],
        ],
    ],

    // config/sections.php

    'project-grid' => [
        'name' => 'Projeler (Grid/Liste)',
        'view' => 'frontend.sections._project-grid',
        'data_handler' => \App\PageBuilder\ProjectsListHandler::class,
        'fields' => [
            [
                'name' => 'projects_per_page',
                'label' => 'Sayfa Başına Gösterilecek Proje Sayısı',
                'type' => 'number'
            ],
            [
                'name' => 'show_only_featured',
                'label' => 'Sadece Öne Çıkanları Göster',
                'type' => 'select', // Checkbox gibi özel bir alan tipiniz yoksa select kullanabilirsiniz
                'options' => [
                    '0' => 'Hayır',
                    '1' => 'Evet',
                ]
            ],
        ],
    ],

    // config/sections.php
//    'about-detailed' => [
//        'name' => 'Modern İnşaat Hakkımızda',
//        'view' => 'frontend.sections._about-construction',
//        'fields' => [
//            // Ana Başlıklar
//            ['name' => 'main_title', 'label' => 'Ana Başlık (YOUR ULTIMATE)', 'type' => 'text', 'translatable' => true],
//            ['name' => 'main_subtitle', 'label' => 'Alt Başlık (CONSTRUCTION TEAM)', 'type' => 'text', 'translatable' => true],
//
//            // Hero Bölümü
//            ['name' => 'hero_image', 'label' => 'Sol Taraf Ana Görsel', 'type' => 'file'],
//            ['name' => 'years_experience', 'label' => 'Deneyim Yılı (20+)', 'type' => 'text'],
//            ['name' => 'years_label', 'label' => 'Deneyim Etiketi (Years of Experience)', 'type' => 'text', 'translatable' => true],
//
//            // Etiketler
//            ['name' => 'tag1', 'label' => 'Etiket 1', 'type' => 'text', 'translatable' => true],
//            ['name' => 'tag2', 'label' => 'Etiket 2', 'type' => 'text', 'translatable' => true],
//
//            // Menü Öğeleri (Repeater)
//            [
//                'name' => 'menu_items',
//                'label' => 'Menü Listesi (ABOUT US, PAST WORKS vs.)',
//                'type' => 'repeater',
//                'fields' => [
//                    ['name' => 'label', 'label' => 'Menü Etiketi', 'type' => 'text', 'translatable' => true],
//                ]
//            ],
//
//            // Üst Sağ İçerik Kutusu
//            ['name' => 'top_right_content', 'label' => 'Sağ Üst Açıklama Metni', 'type' => 'textarea', 'translatable' => true],
//            ['name' => 'top_right_link_text', 'label' => 'Sağ Üst Link Metni (Read More)', 'type' => 'text', 'translatable' => true],
//
//            // Hizmet Kartları (4 adet)
//            [
//                'name' => 'service_cards',
//                'label' => 'Alt Hizmet Kartları (4 adet)',
//                'type' => 'repeater',
//                'fields' => [
//                    ['name' => 'title', 'label' => 'Kart Başlığı', 'type' => 'text', 'translatable' => true],
//                    ['name' => 'content', 'label' => 'Kart İçeriği', 'type' => 'textarea', 'translatable' => true],
//                    ['name' => 'link_text', 'label' => 'Link Metni', 'type' => 'text', 'translatable' => true],
//                    ['name' => 'image', 'label' => 'Arka Plan Görseli (Opsiyonel - 3. kart için)', 'type' => 'file'],
//                ]
//            ],
//        ],
//    ],

    'about-detailed' => [
        'name' => 'Modern İnşaat Hakkımızda',
        'view' => 'frontend.sections._about-construction',
        'fields' => [
            // Ana Başlıklar
            ['name' => 'main_title', 'label' => 'Ana Başlık (YOUR ULTIMATE)', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_subtitle', 'label' => 'Alt Başlık (CONSTRUCTION TEAM)', 'type' => 'text', 'translatable' => true],

            // Hero Bölümü
            ['name' => 'hero_image', 'label' => 'Sol Taraf Ana Görsel', 'type' => 'file'],
            ['name' => 'years_experience', 'label' => 'Deneyim Yılı (20+)', 'type' => 'text'],
            ['name' => 'years_label', 'label' => 'Deneyim Etiketi (Years of Experience)', 'type' => 'text', 'translatable' => true],

            // Etiketler
            ['name' => 'tag1', 'label' => 'Etiket 1', 'type' => 'text', 'translatable' => true],
            ['name' => 'tag2', 'label' => 'Etiket 2', 'type' => 'text', 'translatable' => true],

            // Menü Öğeleri (Repeater)
            [
                'name' => 'menu_items',
                'label' => 'Menü Listesi (ABOUT US, PAST WORKS vs.)',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'label', 'label' => 'Menü Etiketi', 'type' => 'text', 'translatable' => true],
                    ['name' => 'menu_link', 'label' => 'Link', 'type' => 'text', 'translatable' => true],
                ]
            ],

            // Üst Sağ İçerik Kutusu
            ['name' => 'top_right_content', 'label' => 'Sağ Üst Açıklama Metni', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'top_right_link_text', 'label' => 'Sağ Üst Link Metni (Read More)', 'type' => 'text', 'translatable' => true],

            // Hizmet Kartları (4 adet)
            [
                'name' => 'service_cards',
                'label' => 'Alt Hizmet Kartları (4 adet)',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'title', 'label' => 'Kart Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'content', 'label' => 'Kart İçeriği', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'link_text', 'label' => 'Link Metni', 'type' => 'text', 'translatable' => true],
                    ['name' => 'image', 'label' => 'Arka Plan Görseli (Opsiyonel - 3. kart için)', 'type' => 'file'],
                ]
            ],
        ],
    ],

    // config/sections.php

    'process-steps' => [
        'name' => 'Çalışma Süreci (4 Adım)',
        'view' => 'frontend.sections._process-steps',
        'fields' => [
            ['name' => 'small_title', 'label' => 'Küçük Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'image', 'label' => 'Ana Resim (1300x460)', 'type' => 'file'],
            // 4 Adım için repeater alanı kullanıyoruz
            [
                'name' => 'steps',
                'label' => 'Adımlar (En fazla 4 adet giriniz)',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'step_title', 'label' => 'Adım Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'step_content', 'label' => 'Adım Açıklaması', 'type' => 'textarea', 'translatable' => true],
                ]
            ]
        ],
    ],

    // config/sections.php

    'key-benefits' => [
        'name' => 'Temel Faydalar (Resimli Liste)',
        'view' => 'frontend.sections._key-benefits',
        'fields' => [
            ['name' => 'image', 'label' => 'Sol Taraf Resmi (580x640)', 'type' => 'file'],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            // Maddeler için repeater alanı
            [
                'name' => 'benefits',
                'label' => 'Faydalar',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'benefit_text', 'label' => 'Madde Metni', 'type' => 'textarea', 'translatable' => true],
                ]
            ]
        ],
    ],

    // config/sections.php

    'contact-detailed' => [
        'name' => 'Detaylı İletişim Formu',
        'view' => 'frontend.sections._contact-detailed',
        'fields' => [
            ['name' => 'small_title', 'label' => 'Küçük Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'content', 'label' => 'İçerik Paragrafı', 'type' => 'textarea', 'translatable' => true],
            [
                'name' => 'contact_info',
                'label' => 'İletişim Bilgileri (Adres, Tel, Mail)',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'info_title', 'label' => 'Başlık (örn: Adres)', 'type' => 'text', 'translatable' => true],
                    ['name' => 'info_line1', 'label' => 'Satır 1', 'type' => 'text', 'translatable' => true],
                    ['name' => 'info_line2', 'label' => 'Satır 2 (İsteğe bağlı)', 'type' => 'text', 'translatable' => true],
                ]
            ],
        ],
    ],

    'faq-accordion' => [
        'name' => 'Sıkça Sorulan Sorular (SSS)',
        'view' => 'frontend.sections._faq-accordion',
        'data_handler' => \App\PageBuilder\FaqListHandler::class,
        'fields' => [
            ['name' => 'small_title', 'label' => 'Küçük Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'faq_count', 'label' => 'Gösterilecek Soru Sayısı', 'type' => 'number'],
        ],
    ],

    // config/sections.php

    'location-map' => [
        'name' => 'Konum Haritası',
        'view' => 'frontend.sections._location-map',
        'fields' => [
            ['name' => 'map_embed_url', 'label' => 'Google Harita Gömme (Embed) Linki', 'type' => 'textarea'],
        ],
    ],

    // config/sections.php dosyasının sonuna ekleyin

    'plain-text' => [
        'name' => 'Düz Metin Alanı',
        'view' => 'frontend.sections._plain-text',
        'fields' => [
            ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'content', 'label' => 'İçerik', 'type' => 'textarea', 'translatable' => true],
        ],
    ],

    'contact-form-section' => [
        'name' => 'İletişim Formu',
        'view' => 'frontend.sections._contact-form-section',
        'fields' => [
            ['name' => 'small_title', 'label' => 'Küçük Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
        ],
    ],

    // Mevcut 'about-detailed' section'ından sonra bu yeni section'ları ekleyin:

    'about-us-content' => [
        'name' => 'Hakkımızda İçerik Bölümü',
        'view' => 'frontend.sections._about-us-content',
        'fields' => [
            ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'content', 'label' => 'İçerik', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'image', 'label' => 'Görsel (İsteğe Bağlı)', 'type' => 'file'],
            ['name' => 'features', 'label' => 'Özellikler', 'type' => 'repeater', 'fields' => [
                ['name' => 'feature_title', 'label' => 'Özellik Başlığı', 'type' => 'text', 'translatable' => true],
                ['name' => 'feature_description', 'label' => 'Özellik Açıklaması', 'type' => 'textarea', 'translatable' => true],
            ]],
        ],
    ],

    'past-works-content' => [
        'name' => 'Geçmiş İşler İçerik Bölümü',
        'view' => 'frontend.sections._past-works-content',
        'data_handler' => \App\PageBuilder\ProjectsListHandler::class,
        'fields' => [
            ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'project_count', 'label' => 'Gösterilecek Proje Sayısı', 'type' => 'number'],
        ],
    ],

    'our-team-content' => [
        'name' => 'Ekibimiz İçerik Bölümü',
        'view' => 'frontend.sections._our-team-content',
        // data_handler kaldırıldı - artık repeater kullanıyoruz
        'fields' => [
            ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            [
                'name' => 'team_members',
                'label' => 'Ekip Üyeleri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'photo', 'label' => 'Fotoğraf', 'type' => 'file'],
                    ['name' => 'name', 'label' => 'İsim', 'type' => 'text', 'translatable' => true],
                    ['name' => 'position', 'label' => 'Pozisyon', 'type' => 'text', 'translatable' => true],
                    ['name' => 'facebook_url', 'label' => 'Facebook URL', 'type' => 'url'],
                    ['name' => 'twitter_url', 'label' => 'X (Twitter) URL', 'type' => 'url'],
                    ['name' => 'linkedin_url', 'label' => 'LinkedIn URL', 'type' => 'url'],
                ]
            ],
        ],
    ],

    'services-content' => [
        'name' => 'Hizmetlerimiz İçerik Bölümü',
        'view' => 'frontend.sections._services-content',
        'data_handler' => \App\PageBuilder\ServicesListHandler::class,
        'fields' => [
            ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'service_count', 'label' => 'Gösterilecek Hizmet Sayısı', 'type' => 'number'],
        ],
    ],

    'work-process-content' => [
        'name' => 'Çalışma Prensibimiz İçerik Bölümü',
        'view' => 'frontend.sections._work-process-content',
        'fields' => [
            ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'process_steps', 'label' => 'Süreç Adımları', 'type' => 'repeater', 'fields' => [
                ['name' => 'step_number', 'label' => 'Adım Numarası', 'type' => 'text'],
                ['name' => 'step_title', 'label' => 'Adım Başlığı', 'type' => 'text', 'translatable' => true],
                ['name' => 'step_description', 'label' => 'Adım Açıklaması', 'type' => 'textarea', 'translatable' => true],
                ['name' => 'step_icon', 'label' => 'İkon (Font Awesome class)', 'type' => 'text'],
            ]],
        ],
    ],

    'values-content' => [
        'name' => 'Değerlerimiz İçerik Bölümü',
        'view' => 'frontend.sections._values-content',
        'fields' => [
            ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'values_list', 'label' => 'Değerler Listesi', 'type' => 'repeater', 'fields' => [
                ['name' => 'value_icon', 'label' => 'İkon (Font Awesome)', 'type' => 'text'],
                ['name' => 'value_title', 'label' => 'Değer Başlığı', 'type' => 'text', 'translatable' => true],
                ['name' => 'value_description', 'label' => 'Değer Açıklaması', 'type' => 'textarea', 'translatable' => true],
            ]],
        ],
    ],

];
