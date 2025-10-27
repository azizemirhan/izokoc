<?php

return [
    'main-slider' => [
        'name' => 'Ana Sayfa Slider',
        'view' => 'frontend.sections._main-slider',
        'data_handler' => \App\PageBuilder\SlidersListHandler::class,
        'fields' => [
            [
                'name' => 'transition_effect',
                'label' => 'Geçiş Efekti',
                'type' => 'select',
                'options' => [
                    'fade' => 'Fade (Soldurma)',
                    'slide' => 'Slide (Kaydırma)',
                    'zoom' => 'Zoom (Yakınlaştırma)',
                    'flip' => 'Flip (Çevirme)',
                    'cube' => 'Cube (Küp)',
                    'carousel' => 'Carousel (Döner)',
                ],
                'default' => 'fade'
            ],
            [
                'name' => 'autoplay_speed',
                'label' => 'Otomatik Geçiş Hızı (milisaniye)',
                'type' => 'number',
                'default' => '5000'
            ],
            [
                'name' => 'transition_speed',
                'label' => 'Geçiş Animasyon Hızı (milisaniye)',
                'type' => 'number',
                'default' => '1000'
            ],
        ],
    ],
    'about-us-video' => [
        'name' => 'Hakkımızda (Video ve İçerik)',
        'view' => 'frontend.sections._about-us-video',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'main_image',
                'label' => 'Ana Resim',
                'type' => 'file',
            ],
            [
                'name' => 'popup_image',
                'label' => 'Popup Resmi',
                'type' => 'file',
            ],
            [
                'name' => 'video_url',
                'label' => 'Video URL',
                'type' => 'text',
                'default' => 'https://player.vimeo.com/video/78393586',
            ],
            [
                'name' => 'sub_title',
                'label' => 'Alt Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'About Us',
            ],
            [
                'name' => 'title',
                'label' => 'Ana Başlık',
                'type' => 'textarea',
                'translatable' => true,
                'default' => 'Concerted Efforts To Build Better.',
            ],
            [
                'name' => 'lead_text',
                'label' => 'Giriş Metni',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Dream big with get more inspiring solutions from here.',
            ],
            [
                'name' => 'main_text',
                'label' => 'Ana Paragraf',
                'type' => 'textarea',
                'translatable' => true,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, do eiusmod temp or incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.',
            ],
            [
                'name' => 'signature_image',
                'label' => 'İmza Resmi',
                'type' => 'file',
            ],
        ],
    ],
    'core-features' => [
        'name' => 'Temel Özellikler (Icon Kutuları)', // Bölümün kendisinin adı (bu değişmedi)
        'view' => 'frontend.sections._core-features',
        'data_handler' => null,
        'fields' => [
            [
                'label' => 'Alt Başlık', // Yönetici panelindeki etiket
                'name' => 'sub_title',   // Form input name'i ve veritabanı JSON anahtarı
                'type' => 'text',
                'translatable' => true,
                'default' => 'Core Features',
            ],
            [
                'label' => 'Ana Başlık İkonu',
                'name' => 'title_icon',
                'type' => 'iconpicker',
                'default' => 'fal fa-user-hard-hat',
            ],
            [
                'label' => 'Ana Başlık Metni',
                'name' => 'title_text',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Doom Features',
            ],
            [
                'label' => 'Özellikler', // Repeater alanının etiketi
                'name' => 'features',    // Repeater'ın form input name'i ve veritabanı JSON anahtarı
                'type' => 'repeater',
                'fields' => [ // Repeater içindeki alanlar
                    [
                        'label' => 'İkon', // İç alanın etiketi
                        'name' => 'icon',  // İç alanın name'i
                        'type' => 'iconpicker',
                        'default' => 'icofont-calculations',
                    ],
                    [
                        'label' => 'Başlık',
                        'name' => 'feature_title',
                        'type' => 'text',
                        'translatable' => true,
                    ],
                    [
                        'label' => 'Açıklama',
                        'name' => 'description',
                        'type' => 'textarea',
                        'translatable' => true,
                    ],
                ]
            ]
        ],
    ],
    'service-cards-grid' => [
        'name' => 'Hizmet Kartları Grid (Filtrelenebilir)',
        'view' => 'frontend.sections._service-cards-grid',
        'data_handler' => null, // Handler'ı kaldırıyoruz
        'fields' => [
            [
                'name' => 'sub_title',
                'label' => 'Üst Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Our Services'
            ],
            [
                'name' => 'main_title',
                'label' => 'Ana Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'What We Offer'
            ],
            [
                'name' => 'show_filters',
                'label' => 'Kategori Filtreleri Göster',
                'type' => 'select',
                'options' => [
                    '0' => 'Hayır',
                    '1' => 'Evet',
                ]
            ],
            [
                'name' => 'service_cards',
                'label' => 'Hizmet Kartları',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'service_image',
                        'label' => 'Hizmet Görseli (370x280)',
                        'type' => 'file'
                    ],
                    [
                        'name' => 'service_title',
                        'label' => 'Hizmet Başlığı',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'service_summary',
                        'label' => 'Hizmet Özeti',
                        'type' => 'textarea',
                        'translatable' => true
                    ],
                    [
                        'name' => 'service_category',
                        'label' => 'Kategori Adı',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'service_link',
                        'label' => 'Hizmet Detay Linki',
                        'type' => 'text'
                    ],
                ]
            ],
        ],
    ],
    'why-choose-us' => [
        'name' => 'Neden Bizi Seçmelisiniz',
        'view' => 'frontend.sections._why-choose-us',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'main_image',
                'label' => 'Sol Taraf Görseli',
                'type' => 'file'
            ],
            [
                'name' => 'sub_title',
                'label' => 'Üst Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'why choose us'
            ],
            [
                'name' => 'main_title',
                'label' => 'Ana Başlık',
                'type' => 'textarea',
                'translatable' => true,
                'default' => 'We Offer A Great Variety Of Products & Services.'
            ],
            [
                'name' => 'content',
                'label' => 'İçerik Metni',
                'type' => 'textarea',
                'translatable' => true
            ],
            [
                'name' => 'button_text',
                'label' => 'Buton Yazısı',
                'type' => 'text',
                'translatable' => true,
                'default' => 'get a quote'
            ],
            [
                'name' => 'button_url',
                'label' => 'Buton Linki',
                'type' => 'text',
                'default' => '#'
            ],
        ],
    ],
    'testimonials-section' => [
        'name' => 'Müşteri Yorumları Bölümü',
        'view' => 'frontend.sections._testimonials-section',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'sub_title',
                'label' => 'Üst Başlık',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Testimonials'
            ],
            [
                'name' => 'main_title',
                'label' => 'Ana Başlık',
                'type' => 'textarea',
                'translatable' => true,
                'default' => 'Happy Clients Says About Us'
            ],
            [
                'name' => 'lead_text',
                'label' => 'Vurgu Metni',
                'type' => 'text',
                'translatable' => true,
                'default' => 'Make your dream with us'
            ],
            [
                'name' => 'description',
                'label' => 'Açıklama Metni',
                'type' => 'textarea',
                'translatable' => true
            ],
            [
                'name' => 'testimonials',
                'label' => 'Müşteri Yorumları',
                'type' => 'repeater',
                'fields' => [
                    [
                        'name' => 'rating',
                        'label' => 'Yıldız Sayısı (1-5)',
                        'type' => 'number',
                        'default' => '5'
                    ],
                    [
                        'name' => 'title',
                        'label' => 'Yorum Başlığı',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'content',
                        'label' => 'Yorum İçeriği',
                        'type' => 'textarea',
                        'translatable' => true
                    ],
                    [
                        'name' => 'author_image',
                        'label' => 'Yazar Fotoğrafı',
                        'type' => 'file'
                    ],
                    [
                        'name' => 'author_name',
                        'label' => 'Yazar Adı',
                        'type' => 'text',
                        'translatable' => true
                    ],
                    [
                        'name' => 'author_position',
                        'label' => 'Yazar Pozisyonu',
                        'type' => 'text',
                        'translatable' => true
                    ],
                ]
            ],
        ],
    ],
    'engineering-approach' => [
        'name' => 'Mühendislik Yaklaşımımız',
        'view' => 'frontend.sections._engineering-approach',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            [
                'name' => 'steps',
                'label' => 'Süreç Adımları',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'step_number', 'label' => 'Adım Numarası', 'type' => 'text'],
                    ['name' => 'step_icon', 'label' => 'İkon (icofont class)', 'type' => 'text'],
                    ['name' => 'step_title', 'label' => 'Adım Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'step_description', 'label' => 'Adım Açıklaması', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
        ],
    ],
    'sectors-we-serve' => [
        'name' => 'Sektörel Uzmanlıklarımız',
        'view' => 'frontend.sections._sectors-we-serve',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            [
                'name' => 'sectors',
                'label' => 'Sektörler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'sector_icon', 'label' => 'Sektör İkonu (icofont class)', 'type' => 'text'],
                    ['name' => 'sector_image', 'label' => 'Sektör Görseli', 'type' => 'file'],
                    ['name' => 'sector_name', 'label' => 'Sektör Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'sector_description', 'label' => 'Sektör Açıklaması', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
        ],
    ],
    'technology-innovation' => [
        'name' => 'Teknoloji ve İnovasyon',
        'view' => 'frontend.sections._technology-innovation',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_image', 'label' => 'Ana Görsel', 'type' => 'file'],
            [
                'name' => 'technologies',
                'label' => 'Teknolojiler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'tech_icon', 'label' => 'Teknoloji İkonu', 'type' => 'text'],
                    ['name' => 'tech_title', 'label' => 'Teknoloji Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'tech_description', 'label' => 'Teknoloji Açıklaması', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
        ],
    ],
    'quality-safety-standards' => [
        'name' => 'Kalite ve Güvenlik Standartları',
        'view' => 'frontend.sections._quality-safety-standards',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            [
                'name' => 'certificates',
                'label' => 'Sertifikalar',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'certificate_logo', 'label' => 'Sertifika Logosu', 'type' => 'file'],
                    ['name' => 'certificate_name', 'label' => 'Sertifika Adı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'certificate_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
            [
                'name' => 'standards',
                'label' => 'Standartlar',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'standard_icon', 'label' => 'İkon', 'type' => 'text'],
                    ['name' => 'standard_title', 'label' => 'Standart Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'standard_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
        ],
    ],

    'sustainability-focus' => [
        'name' => 'Sürdürülebilirlik Odağımız',
        'view' => 'frontend.sections._sustainability-focus',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'main_image', 'label' => 'Ana Görsel', 'type' => 'file'],
            ['name' => 'video_url', 'label' => 'Video URL (YouTube/Vimeo)', 'type' => 'text'],
            [
                'name' => 'sustainability_features',
                'label' => 'Sürdürülebilirlik Özellikleri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'feature_icon', 'label' => 'Özellik İkonu', 'type' => 'text'],
                    ['name' => 'feature_title', 'label' => 'Özellik Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'feature_value', 'label' => 'Değer/İstatistik', 'type' => 'text', 'translatable' => true],
                    ['name' => 'feature_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
            [
                'name' => 'green_initiatives',
                'label' => 'Yeşil Girişimler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'initiative_icon', 'label' => 'İkon', 'type' => 'text'],
                    ['name' => 'initiative_title', 'label' => 'Girişim Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'initiative_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                ]
            ],
        ],
    ],
    'milestones' => [
        'name' => 'Kilometre Taşları',
        'view' => 'frontend.sections._milestones',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'layout_style', 'label' => 'Layout Stili', 'type' => 'select', 'options' => ['vertical' => 'Dikey', 'horizontal' => 'Yatay'], 'default' => 'vertical'],
            [
                'name' => 'milestones',
                'label' => 'Kilometre Taşları',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'year', 'label' => 'Yıl', 'type' => 'text'],
                    ['name' => 'milestone_icon', 'label' => 'İkon', 'type' => 'text'],
                    ['name' => 'milestone_image', 'label' => 'Görsel', 'type' => 'file'],
                    ['name' => 'milestone_title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
                    ['name' => 'milestone_description', 'label' => 'Açıklama', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'highlight', 'label' => 'Öne Çıkar', 'type' => 'checkbox'],
                ]
            ],
        ],
    ],
    'vision-mission' => [
        'name' => 'Vizyon ve Misyon',
        'view' => 'frontend.sections._vision-mission',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Üst Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true],
            ['name' => 'background_image', 'label' => 'Arka Plan Görseli', 'type' => 'file'],

            // Vizyon
            ['name' => 'vision_icon', 'label' => 'Vizyon İkonu', 'type' => 'text', 'default' => 'icofont-eye-alt'],
            ['name' => 'vision_title', 'label' => 'Vizyon Başlığı', 'type' => 'text', 'translatable' => true],
            ['name' => 'vision_content', 'label' => 'Vizyon İçeriği', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'vision_image', 'label' => 'Vizyon Görseli', 'type' => 'file'],

            // Misyon
            ['name' => 'mission_icon', 'label' => 'Misyon İkonu', 'type' => 'text', 'default' => 'icofont-flag-alt-1'],
            ['name' => 'mission_title', 'label' => 'Misyon Başlığı', 'type' => 'text', 'translatable' => true],
            ['name' => 'mission_content', 'label' => 'Misyon İçeriği', 'type' => 'textarea', 'translatable' => true],
            ['name' => 'mission_image', 'label' => 'Misyon Görseli', 'type' => 'file'],

            // Değerler
            [
                'name' => 'values',
                'label' => 'Değerlerimiz',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'value_icon', 'label' => 'Değer İkonu', 'type' => 'text'],
                    ['name' => 'value_title', 'label' => 'Değer Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'value_description', 'label' => 'Değer Açıklaması', 'type' => 'textarea', 'translatable' => true],
                ]
            ],

            // İstatistikler
            [
                'name' => 'statistics',
                'label' => 'İstatistikler',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'stat_icon', 'label' => 'İstatistik İkonu', 'type' => 'text'],
                    ['name' => 'stat_number', 'label' => 'Sayı', 'type' => 'text'],
                    ['name' => 'stat_suffix', 'label' => 'Ek (%, +, vb.)', 'type' => 'text'],
                    ['name' => 'stat_title', 'label' => 'İstatistik Başlığı', 'type' => 'text', 'translatable' => true],
                ]
            ],
        ],
    ],

    'contact-info-boxes' => [
        'name' => 'İletişim Bilgi Kutuları',
        'view' => 'frontend.sections._contact-info-boxes',
        'data_handler' => null,
        'fields' => [
            [
                'name' => 'info_boxes',
                'label' => 'İletişim Bilgi Kutuları',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'icon', 'label' => 'İkon (Font Awesome class)', 'type' => 'text', 'default' => 'fal fa-map-marker-alt'],
                    ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'translatable' => true],
                    ['name' => 'content', 'label' => 'İçerik', 'type' => 'textarea', 'translatable' => true],
                    ['name' => 'link_text', 'label' => 'Link Metni', 'type' => 'text', 'translatable' => true],
                    ['name' => 'link_url', 'label' => 'Link URL', 'type' => 'text'],
                ]
            ],
        ],
    ],
    'contact-form-modern' => [
        'name' => 'Modern İletişim Formu',
        'view' => 'frontend.sections._contact-form-modern',
        'data_handler' => null,
        'fields' => [
            ['name' => 'sub_title', 'label' => 'Alt Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Get In Touch'],
            ['name' => 'main_title', 'label' => 'Ana Başlık', 'type' => 'text', 'translatable' => true, 'default' => 'Contact Form'],
            ['name' => 'form_action', 'label' => 'Form Action URL', 'type' => 'text', 'default' => '#'],
        ],
    ],
    'google-map-section' => [
        'name' => 'Google Harita',
        'view' => 'frontend.sections._google-map-section',
        'data_handler' => null,
        'fields' => [
            ['name' => 'map_location', 'label' => 'Harita Konumu (örn: New York)', 'type' => 'text', 'default' => 'New York'],
            ['name' => 'map_zoom', 'label' => 'Zoom Seviyesi (1-20)', 'type' => 'number', 'default' => '13'],
            ['name' => 'map_height', 'label' => 'Harita Yüksekliği (px)', 'type' => 'number', 'default' => '600'],
            ['name' => 'map_embed_url', 'label' => 'Özel Google Maps Embed URL (opsiyonel)', 'type' => 'textarea'],
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
