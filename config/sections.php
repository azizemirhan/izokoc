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
    'services-mega-list' => [
        'name' => 'Hizmetler Mega Liste (Kartlı)',
        'view' => 'frontend.sections._services-mega-list',
        'data_handler' => null,
        'fields' => [
            ['name' => 'background_color', 'label' => 'Arkaplan Rengi', 'type' => 'select', 'options' => [
                'light' => 'Açık',
                'dark' => 'Koyu',
                'gradient' => 'Gradyan'
            ], 'default' => 'light'],
            [
                'name' => 'service_categories',
                'label' => 'Hizmet Kategorileri',
                'type' => 'repeater',
                'fields' => [
                    ['name' => 'category_icon', 'label' => 'Kategori İkonu (Font Awesome)', 'type' => 'text', 'default' => 'fas fa-layer-group'],
                    ['name' => 'category_color', 'label' => 'Kategori Rengi (hex)', 'type' => 'text', 'default' => '#2563eb'],
                    ['name' => 'category_title', 'label' => 'Kategori Başlığı', 'type' => 'text', 'translatable' => true],
                    ['name' => 'category_description', 'label' => 'Kategori Açıklaması', 'type' => 'textarea', 'translatable' => true],
                    [
                        'name' => 'services',
                        'label' => 'Hizmetler',
                        'type' => 'repeater',
                        'fields' => [
                            ['name' => 'service_title', 'label' => 'Hizmet Adı', 'type' => 'text', 'translatable' => true],
                            ['name' => 'service_description', 'label' => 'Kısa Açıklama', 'type' => 'textarea', 'translatable' => true],
                            ['name' => 'service_icon', 'label' => 'Hizmet İkonu', 'type' => 'text', 'default' => 'fas fa-check-circle'],
                            ['name' => 'service_link', 'label' => 'Detay Linki', 'type' => 'text'],
                            ['name' => 'service_image', 'label' => 'Hizmet Görseli (opsiyonel)', 'type' => 'file'],
                        ]
                    ],
                ]
            ],
        ],
    ],
    // SON
];
