@extends('admin.layouts.master')

@section('title', 'Sayfa Düzenle: ' . $page->getTranslation('title', 'tr'))

@push('styles')
    {{-- Quill Editor CSS --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <style>
        .draggable-item {
            cursor: grab;
        }

        .sortable-handle {
            cursor: move;
        }

        #page-canvas .placeholder {
            border: 2px dashed #0d6efd;
            background: #f0f8ff;
            min-height: 100px;
            margin-bottom: 1rem;
            border-radius: .375rem;
        }

        .ui-draggable-dragging {
            z-index: 1050;
            width: 350px !important;
            opacity: 0.9;
        }

        #page-canvas:empty {
            min-height: 150px;
            border: 2px dashed #ced4da;
            background-color: #f8f9fa;
            border-radius: .375rem;
            display: flex;
            align-items: center;
            justify-content: center;
            float: left;
            width: 100%;
        }

        #page-canvas:empty::before {
            content: "Kullanılabilir Alanları Buraya Sürükleyin";
            color: #6c757d;
            font-style: italic;
        }

        /* Repeater Stil Ayarları */
        .repeater-item {
            border: 1px solid #e0e6ed;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #f1f2f3;
        }

        .repeater-item .btn-danger {
            float: right;
        }

        /* Quill Editor Yükseklik Ayarı */
        .ql-editor {
            min-height: 150px;
        }


        #page-canvas {
            min-height: 150px;
            position: relative;
        }

        /* Canvas boşken gösterilecek mesaj */
        #page-canvas:empty {
            border: 2px dashed #ced4da;
            background-color: #f8f9fa;
            border-radius: .375rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #page-canvas:empty::before {
            content: "Kullanılabilir Alanları Buraya Sürükleyin";
            color: #6c757d;
            font-style: italic;
            pointer-events: none; /* Bu satır önemli - metni tıklanamaz yapar */
        }

        /* Sürükleme sırasında gösterilecek placeholder */
        #page-canvas .placeholder {
            border: 2px dashed #0d6efd;
            background: #f0f8ff;
            min-height: 100px;
            margin-bottom: 1rem;
            border-radius: .375rem;
        }

        /* Repeater Sortable Stilleri */
        .repeater-drag-handle {
            cursor: move !important;
        }

        .repeater-placeholder {
            border: 2px dashed #0d6efd;
            background: #f0f8ff;
            min-height: 80px;
            margin-bottom: 1rem;
            border-radius: .375rem;
            visibility: visible !important;
        }

        .sortable-repeater .repeater-item {
            transition: all 0.3s ease;
        }

        .sortable-repeater .ui-sortable-helper {
            opacity: 0.8;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Repeater Accordion Stilleri */
        .repeater-item-accordion {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            background: #fff;
            transition: all 0.2s ease;
        }

        .repeater-item-accordion:hover {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .repeater-item-header {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            gap: 0.5rem;
        }

        .repeater-drag-handle {
            color: #6c757d;
            font-size: 1.2rem;
            cursor: move;
            flex-shrink: 0;
        }

        .repeater-toggle-btn {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: none;
            border: none;
            padding: 0;
            text-align: left;
            cursor: pointer;
            color: #212529;
            font-weight: 500;
        }

        .repeater-toggle-btn:hover {
            color: #0d6efd;
        }

        .collapse-icon {
            transition: transform 0.3s ease;
            font-size: 0.875rem;
        }

        .repeater-toggle-btn[aria-expanded="true"] .collapse-icon {
            transform: rotate(180deg);
        }

        .repeater-title {
            font-size: 0.95rem;
        }

        .btn-close-repeater {
            width: 1.5rem;
            height: 1.5rem;
            padding: 0;
            background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
            border: 0;
            opacity: 0.5;
            cursor: pointer;
            flex-shrink: 0;
        }

        .btn-close-repeater:hover {
            opacity: 1;
        }

        .repeater-item-body {
            padding: 1rem;
        }

        /* Sortable için placeholder */
        .repeater-placeholder {
            border: 2px dashed #0d6efd;
            background: #f0f8ff;
            min-height: 60px;
            margin-bottom: 0.5rem;
            border-radius: 0.375rem;
            visibility: visible !important;
        }

        .sortable-repeater .ui-sortable-helper {
            opacity: 0.9;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <form id="page-form" action="{{ route('admin.pages.update', $page) }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Üst Bar --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h3 mb-0 text-gray-800">Sayfa Düzenle</h1>
                <div>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Vazgeç</a>
                    <button type="submit" class="btn btn-primary">Sayfayı Kaydet</button>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                {{-- SOL KOLON: Kullanılabilir Alanlar --}}
                <div class="col-12 col-lg-4">
                    <div class="card mb-3">
                        <div class="card-header"><h5 class="mb-0">Kullanılabilir Alanlar</h5></div>
                        <div class="list-group list-group-flush" id="available-sections">
                            @foreach($availableSections as $key => $section)
                                <div class="list-group-item draggable-item" data-section-key="{{ $key }}">
                                    <i class="bi bi-grip-vertical me-2"></i> {{ $section['name'] }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- SAĞ KOLON: Sayfa Yapısı --}}
                <div class="col-12 col-lg-8">
                    {{-- Sayfa Ayarları Kartı (Bu kısım aynı kalıyor) --}}
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="mb-0">Sayfa Ayarları</h5>
                        </div>
                        <div class="card-body">
                            @php
                                // View Composer'dan gelmiyorsa veya bir sorun olursa diye varsayılan dilleri belirleyelim.
                                if (!isset($activeLanguages)) {
                                    $activeLanguages = collect(config('languages.supported'))->only(['tr', 'en']);
                                }
                            @endphp

                            {{-- Sayfa Başlığı (Dinamik) --}}
                            <div class="mb-3">
                                <label class="form-label">Sayfa Başlığı <span class="text-danger">*</span></label>
                                <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                                    @foreach($activeLanguages as $code => $lang)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                    data-bs-toggle="tab" data-bs-target="#edit-title-{{ $code }}"
                                                    type="button">{{ strtoupper($code) }}</button>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content mt-2">
                                    @foreach($activeLanguages as $code => $lang)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                             id="edit-title-{{ $code }}" role="tabpanel">
                                            <input type="text" name="title[{{ $code }}]" class="form-control"
                                                   value="{{ old('title.'.$code, $page->getTranslation('title', $code)) }}"
                                                {{-- Sadece ilk dilin zorunlu olmasını sağlıyoruz --}}
                                                {{ $loop->first ? 'required' : '' }}>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <h5 class="mb-3">Sayfa Banner Ayarları</h5>

                            {{-- Banner Başlığı (Dinamik) --}}
                            <div class="mb-3">
                                <label class="form-label">Banner Başlığı</label>
                                <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                                    @foreach($activeLanguages as $code => $lang)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                    data-bs-toggle="tab" data-bs-target="#edit-banner-title-{{ $code }}"
                                                    type="button">{{ strtoupper($code) }}</button>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content mt-2">
                                    @foreach($activeLanguages as $code => $lang)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                             id="edit-banner-title-{{ $code }}" role="tabpanel">
                                            <input type="text" name="banner_title[{{ $code }}]" class="form-control"
                                                   placeholder="Banner'da görünecek {{ $lang['native'] }} başlık"
                                                   value="{{ old('banner_title.'.$code, $page->getTranslation('banner_title', $code)) }}">
                                        </div>
                                    @endforeach
                                </div>
                                <small class="text-muted">Bu alanı boş bırakırsanız, sayfa başlığı kullanılır.</small>
                            </div>

                            {{-- Banner Alt Başlığı (Dinamik) --}}
                            <div class="mb-3">
                                <label class="form-label">Banner Alt Başlığı</label>
                                <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                                    @foreach($activeLanguages as $code => $lang)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#edit-banner-subtitle-{{ $code }}"
                                                    type="button">{{ strtoupper($code) }}</button>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content mt-2">
                                    @foreach($activeLanguages as $code => $lang)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                             id="edit-banner-subtitle-{{ $code }}" role="tabpanel">
                                            <input type="text" name="banner_subtitle[{{ $code }}]" class="form-control"
                                                   placeholder="Banner'da görünecek {{ $lang['native'] }} alt başlık"
                                                   value="{{ old('banner_subtitle.'.$code, $page->getTranslation('banner_subtitle', $code)) }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- SEO Alanları için Accordion --}}
                            <div class="accordion" id="seoAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSeo">
                                            Gelişmiş SEO Ayarları
                                        </button>
                                    </h2>
                                    <div id="collapseSeo" class="accordion-collapse collapse"
                                         data-bs-parent="#seoAccordion">
                                        <div class="accordion-body">
                                            <div class="row">
                                                {{-- Temel SEO Alanları (Dinamik) --}}
                                                <div class="col-12 col-md-6">
                                                    {{-- SEO Başlık --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">SEO Başlık</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <input type="text" name="seo_title[{{ $code }}]"
                                                                   class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                   placeholder="{{ $lang['native'] }} SEO Başlık"
                                                                   value="{{ old('seo_title.'.$code, $page->getTranslation('seo_title', $code)) }}">
                                                        @endforeach
                                                    </div>
                                                    {{-- Meta Açıklaması --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Meta Açıklaması</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <textarea name="meta_description[{{ $code }}]"
                                                                      class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                      rows="3"
                                                                      placeholder="{{ $lang['native'] }} Meta Açıklaması">{{ old('meta_description.'.$code, $page->getTranslation('meta_description', $code)) }}</textarea>
                                                        @endforeach
                                                    </div>
                                                    {{-- Anahtar Kelimeler --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Anahtar Kelimeler (Virgülle
                                                            ayırın)</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <input type="text" name="keywords[{{ $code }}]"
                                                                   class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                   placeholder="{{ $lang['native'] }} Anahtar Kelimeler"
                                                                   value="{{ old('keywords.'.$code, $page->getTranslation('keywords', $code)) }}">
                                                        @endforeach
                                                    </div>
                                                </div>

                                                {{-- Gelişmiş SEO Alanları (Tek Dilli - Değişiklik Yok) --}}
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="index_status" class="form-label">Arama Motoru
                                                            Görünürlüğü</label>
                                                        <select name="index_status" id="index_status"
                                                                class="form-select">
                                                            <option
                                                                value="index" @selected(old('index_status', $page->index_status) == 'index')>
                                                                Sayfa indexlensin
                                                            </option>
                                                            <option
                                                                value="noindex" @selected(old('index_status', $page->index_status) == 'noindex')>
                                                                Sayfa indexlenmesin
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="follow_status" class="form-label">Link
                                                            Takibi</label>
                                                        <select name="follow_status" id="follow_status"
                                                                class="form-select">
                                                            <option
                                                                value="follow" @selected(old('follow_status', $page->follow_status) == 'follow')>
                                                                Sayfadaki linkler takip edilsin
                                                            </option>
                                                            <option
                                                                value="nofollow" @selected(old('follow_status', $page->follow_status) == 'nofollow')>
                                                                Sayfadaki linkler takip edilmesin
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="canonical_url" class="form-label">Canonical
                                                            URL</label>
                                                        <input type="url" name="canonical_url" id="canonical_url"
                                                               class="form-control" placeholder="https://..."
                                                               value="{{ old('canonical_url', $page->canonical_url) }}">
                                                        <small class="text-muted">Bu sayfanın kopya olduğu orijinal
                                                            sayfanın linki. Genellikle boş bırakılır.</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            <h6 class="mt-4 px-3">Sosyal Medya Paylaşım (Open Graph) Ayarları</h6>
                                            <div class="row p-3">
                                                <div class="col-12">
                                                    {{-- OG Başlık (Dinamik) --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">OG Başlık</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <input type="text" name="og_title[{{ $code }}]"
                                                                   class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                   placeholder="Facebook, LinkedIn'de görünecek {{ $lang['native'] }} başlık"
                                                                   value="{{ old('og_title.'.$code, $page->getTranslation('og_title', $code)) }}">
                                                        @endforeach
                                                    </div>
                                                    {{-- OG Açıklama (Dinamik) --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">OG Açıklama</label>
                                                        @foreach($activeLanguages as $code => $lang)
                                                            <textarea name="og_description[{{ $code }}]"
                                                                      class="form-control {{ !$loop->first ? 'mt-2' : '' }}"
                                                                      rows="2"
                                                                      placeholder="{{ $lang['native'] }} OG Açıklaması">{{ old('og_description.'.$code, $page->getTranslation('og_description', $code)) }}</textarea>
                                                        @endforeach
                                                    </div>
                                                    {{-- OG Resim (Tek Dilli - Değişiklik Yok) --}}
                                                    <div class="mb-3">
                                                        <label for="og_image" class="form-label">OG Resim</label>
                                                        <input type="text" name="og_image" id="og_image"
                                                               class="form-control"
                                                               placeholder="Paylaşımda görünecek resmin tam URL'si"
                                                               value="{{ old('og_image', $page->og_image) }}">
                                                        <small class="text-muted">Bu alanı boş bırakırsanız, sayfanın
                                                            öne çıkan görseli kullanılır.</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Slug ve Durum Alanları (Değişiklik Yok) --}}
                            <div class="row mt-3">
                                <div class="col-md-6 mb-3">
                                    <label for="slug" class="form-label">URL Uzantısı (Slug) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                           value="{{ old('slug', $page->slug) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Durum</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="draft" @selected(old('status', $page->status) == 'draft')>
                                            Taslak
                                        </option>
                                        <option
                                            value="published" @selected(old('status', $page->status) == 'published')>
                                            Yayınlandı
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Sayfa İçeriği Kartı --}}
                    <div class="card">
                        <div class="card-header"><h5 class="mb-0">Sayfa İçeriği (Alanları buraya sürükleyin)</h5></div>
                        <div class="card-body">
                            <div class="accordion" id="page-canvas">
                                {{-- Mevcut Section'lar buraya render edilecek --}}
                                @foreach($page->sections as $section)
                                    @php $sectionConfig = $availableSections[$section->section_key] ?? null; @endphp
                                    @if($sectionConfig)
                                        <div class="accordion-item canvas-item" data-id="{{ $section->id }}"
                                             data-section-key="{{ $section->section_key }}">
                                            <h2 class="accordion-header d-flex align-items-center">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-{{ $section->id }}">
                                                    <i class="bi bi-arrows-move me-2 sortable-handle"></i>
                                                    {{ $sectionConfig['name'] }}
                                                </button>
                                                <div class="d-flex align-items-center ms-auto pe-3">
                                                    <div class="form-check form-switch me-3">
                                                        <input class="form-check-input status-toggle" type="checkbox"
                                                               role="switch" @checked($section->is_active)>
                                                    </div>
                                                    <button type="button" class="btn-close remove-item"></button>
                                                </div>
                                            </h2>
                                            <div id="collapse-{{ $section->id }}" class="accordion-collapse collapse"
                                                 data-bs-parent="#page-canvas">
                                                <div class="accordion-body">
                                                    @include('admin.pages.partials._section_fields', ['fields' => $sectionConfig['fields'], 'section' => $section])
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Repeater Item Template (JS için gizli) --}}
    <template id="repeater-item-template">
        <div class="repeater-item">
            <button type="button" class="btn btn-danger btn-sm remove-repeater-item">&times;</button>
            {{-- Alanlar buraya eklenecek --}}
        </div>
    </template>
@endsection
@push('scripts')
    {{-- Quill Editor JS --}}
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        $(function () {
            const allSectionsConfig = @json($availableSections);
            const activeLanguages = @json($activeLanguages->keys());
            const activeLanguageData = @json($activeLanguages);
            const pageCanvas = $("#page-canvas");
            let quillInstances = new Map();

            function initializeQuill(selector) {
                document.querySelectorAll(selector).forEach(el => {
                    if (el && !el.classList.contains('quill-initialized')) {
                        const quill = new Quill(el, {
                            theme: 'snow',
                            modules: {
                                toolbar: [
                                    [{'header': [1, 2, 3, false]}],
                                    ['bold', 'italic', 'underline'],
                                    [{'list': 'ordered'}, {'list': 'bullet'}],
                                    ['link'],
                                    ['clean']
                                ]
                            }
                        });
                        el.classList.add('quill-initialized');
                        quillInstances.set(el, quill);
                    }
                });
            }

            initializeQuill('#page-canvas .quill-editor');

            $("#available-sections .draggable-item").draggable({
                helper: 'clone',
                connectToSortable: "#page-canvas",
                revert: 'invalid'
            });

            pageCanvas.sortable({
                placeholder: "placeholder",
                handle: ".sortable-handle",
                tolerance: "pointer",
                forcePlaceholderSize: true,
                receive: function (event, ui) {
                    const sectionKey = $(ui.item).data('section-key');
                    const newItemHtml = createSectionHtml(sectionKey, allSectionsConfig[sectionKey]);
                    const newItem = $(newItemHtml);

                    $(this).removeClass('empty-canvas');
                    $(this).find('.draggable-item').replaceWith(newItem);
                    initializeQuill(`#collapse-${newItem.data('unique-id')} .quill-editor`);
                    initializeNestedRepeaterSortable(newItem);
                    new bootstrap.Collapse(newItem.find('.accordion-collapse'));
                },
                start: function (event, ui) {
                    if ($(this).children().length === 0) {
                        $(this).addClass('ready-for-drop');
                    }
                },
                stop: function (event, ui) {
                    $(this).removeClass('ready-for-drop');
                }
            });

            function checkCanvasEmpty() {
                if (pageCanvas.children().length === 0) {
                    pageCanvas.addClass('empty-canvas');
                } else {
                    pageCanvas.removeClass('empty-canvas');
                }
            }

            checkCanvasEmpty();

            pageCanvas.on('click', '.remove-item', function () {
                $(this).closest('.canvas-item').remove();
                checkCanvasEmpty();
            });

            pageCanvas.on('click', '.remove-repeater-item, .btn-close-repeater', function (e) {
                e.preventDefault();
                e.stopPropagation();

                const repeaterItem = $(this).closest('.repeater-item-accordion');

                if (confirm('Bu öğeyi silmek istediğinizden emin misiniz?')) {
                    repeaterItem.fadeOut(300, function () {
                        $(this).remove();
                    });
                }
            });

            function initializeRepeaterSortable() {
                $('.sortable-repeater').each(function () {
                    if (!$(this).hasClass('ui-sortable')) {
                        $(this).sortable({
                            handle: '.repeater-drag-handle',
                            placeholder: 'repeater-placeholder',
                            forcePlaceholderSize: true,
                            tolerance: 'pointer',
                            items: '.repeater-item-accordion',
                            update: function (event, ui) {
                                console.log('Repeater items reordered');
                            }
                        });
                    }
                });
            }

            // YENİ: Nested repeater'lar için sortable başlatma
            function initializeNestedRepeaterSortable(container) {
                container.find('.sortable-repeater').each(function () {
                    if (!$(this).hasClass('ui-sortable')) {
                        $(this).sortable({
                            handle: '.repeater-drag-handle',
                            placeholder: 'repeater-placeholder',
                            forcePlaceholderSize: true,
                            tolerance: 'pointer',
                            items: '.repeater-item-accordion',
                        });
                    }
                });
            }

            initializeRepeaterSortable();

            // YENİ: Nested repeater için add button handler
            pageCanvas.on('click', '.add-repeater-item', function () {
                const $button = $(this);
                const container = $button.prev('.repeater-items-container');
                const repeaterName = container.data('repeater-name');
                const canvasItem = $button.closest('.canvas-item');
                const sectionKey = canvasItem.data('section-key');

                // Parent repeater item olup olmadığını kontrol et
                const parentRepeaterItem = $button.closest('.repeater-item-accordion');

                let repeaterField;

                if (parentRepeaterItem.length > 0) {
                    // Nested repeater - parent repeater config'ini bul
                    const parentContainer = parentRepeaterItem.closest('.repeater-items-container');
                    const parentRepeaterName = parentContainer.data('repeater-name');
                    const parentRepeaterConfig = allSectionsConfig[sectionKey].fields.find(f => f.name === parentRepeaterName);

                    // Nested repeater field'ını bul
                    repeaterField = parentRepeaterConfig.fields.find(f => f.name === repeaterName && f.type === 'repeater');
                } else {
                    // Normal repeater
                    repeaterField = allSectionsConfig[sectionKey].fields.find(f => f.name === repeaterName);
                }

                if (repeaterField) {
                    const itemIndex = container.children('.repeater-item-accordion').length;
                    const uniqueId = `${sectionKey}-${repeaterName}-${itemIndex}-${Date.now()}`;
                    const newItemHtml = createRepeaterItemHtml(repeaterField.fields, uniqueId, repeaterField);
                    const newItem = $(newItemHtml);
                    container.append(newItem);
                    initializeQuill(`#${uniqueId} .quill-editor`);

                    // Nested repeater için sortable başlat
                    initializeNestedRepeaterSortable(newItem);

                    // Ana sortable'ı yenile
                    if (container.hasClass('ui-sortable')) {
                        container.sortable('refresh');
                    } else {
                        initializeRepeaterSortable();
                    }
                }
            });

            $('#page-form').on('submit', function (e) {
                e.preventDefault();

                const form = this;
                const formData = new FormData(form);

                $(form).find('.section-meta-input').remove();

                quillInstances.forEach((quill, element) => {
                    const hiddenInput = $(element).next('input[type="hidden"]');
                    if (hiddenInput.length) {
                        hiddenInput.val(quill.root.innerHTML);
                    }
                });

                $('#page-canvas .canvas-item').each(function (sectionIndex) {
                    const sectionItem = $(this);
                    const sectionKey = sectionItem.data('section-key');
                    const sectionId = sectionItem.data('id');

                    formData.append(`sections[${sectionIndex}][section_key]`, sectionKey);
                    formData.append(`sections[${sectionIndex}][is_active]`, sectionItem.find('.status-toggle').is(':checked') ? 1 : 0);
                    if (sectionId) {
                        formData.append(`sections[${sectionIndex}][id]`, sectionId);
                    }

                    // Normal alanlar
                    sectionItem.find('> .accordion-collapse > .accordion-body > .field-wrapper').not('.repeater-items-container').find('input, select, textarea').each(function () {
                        const input = $(this);
                        const originalName = input.attr('data-name');
                        const lang = input.attr('data-lang');
                        const value = input.val();

                        if (input.attr('type') === 'file') {
                            const files = input[0].files;
                            if (files && files.length > 0) {
                                formData.append(`sections[${sectionIndex}][files][${originalName}]`, files[0]);
                            }
                        } else if (lang) {
                            formData.append(`sections[${sectionIndex}][content][${originalName}][${lang}]`, value || '');
                        } else if (originalName) {
                            formData.append(`sections[${sectionIndex}][content][${originalName}]`, value || '');
                        }
                    });

                    // Repeater alanlarını işle (nested dahil)
                    processRepeaterFields(sectionItem, formData, sectionIndex, '');
                });

                $.ajax({
                    url: $(form).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorHtml = '<div class="alert alert-danger"><ul class="mb-0">';
                            Object.values(errors).forEach(error => {
                                errorHtml += `<li>${error[0]}</li>`;
                            });
                            errorHtml += '</ul></div>';

                            $('.container-fluid').prepend(errorHtml);
                            $('html, body').animate({scrollTop: 0}, 'slow');
                        } else {
                            alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                        }
                    }
                });

                return false;
            });

            // YENİ: Nested repeater'ları işlemek için recursive fonksiyon
            function processRepeaterFields(container, formData, sectionIndex, pathPrefix) {
                container.find('> .accordion-collapse > .accordion-body > .repeater-items-container, > .repeater-item-body > .repeater-items-container').each(function () {
                    const repeaterContainer = $(this);
                    const repeaterName = repeaterContainer.data('repeater-name');
                    const fullPath = pathPrefix ? `${pathPrefix}[${repeaterName}]` : repeaterName;

                    repeaterContainer.children('.repeater-item-accordion').each(function (itemIndex) {
                        const repeaterItem = $(this);
                        const currentPath = `${fullPath}[${itemIndex}]`;

                        // Bu item'daki direkt input'ları işle
                        repeaterItem.find('> .collapse > .repeater-item-body > .field-wrapper > input, > .collapse > .repeater-item-body > .field-wrapper > select, > .collapse > .repeater-item-body > .field-wrapper > textarea').each(function () {
                            const input = $(this);
                            const originalName = input.attr('data-name');
                            const lang = input.attr('data-lang');
                            const value = input.val();

                            if (input.attr('type') === 'file') {
                                const files = input[0].files;
                                if (files && files.length > 0) {
                                    formData.append(`sections[${sectionIndex}][content][${currentPath}][files][${originalName}]`, files[0]);
                                }
                            } else if (lang) {
                                formData.append(`sections[${sectionIndex}][content][${currentPath}][${originalName}][${lang}]`, value || '');
                            } else if (originalName) {
                                formData.append(`sections[${sectionIndex}][content][${currentPath}][${originalName}]`, value || '');
                            }
                        });

                        // Nested repeater'ları işle (recursive)
                        const nestedRepeaters = repeaterItem.find('> .collapse > .repeater-item-body > .repeater-items-container');
                        if (nestedRepeaters.length > 0) {
                            nestedRepeaters.each(function () {
                                const nestedContainer = $(this);
                                const nestedRepeaterName = nestedContainer.data('repeater-name');
                                const nestedPath = `${currentPath}[${nestedRepeaterName}]`;

                                nestedContainer.children('.repeater-item-accordion').each(function (nestedIndex) {
                                    const nestedItem = $(this);
                                    const nestedCurrentPath = `${nestedPath}[${nestedIndex}]`;

                                    nestedItem.find('> .collapse > .repeater-item-body input, > .collapse > .repeater-item-body select, > .collapse > .repeater-item-body textarea').each(function () {
                                        const input = $(this);
                                        const originalName = input.attr('data-name');
                                        const lang = input.attr('data-lang');
                                        const value = input.val();

                                        if (input.attr('type') === 'file') {
                                            const files = input[0].files;
                                            if (files && files.length > 0) {
                                                formData.append(`sections[${sectionIndex}][content][${nestedCurrentPath}][files][${originalName}]`, files[0]);
                                            }
                                        } else if (lang) {
                                            formData.append(`sections[${sectionIndex}][content][${nestedCurrentPath}][${originalName}][${lang}]`, value || '');
                                        } else if (originalName) {
                                            formData.append(`sections[${sectionIndex}][content][${nestedCurrentPath}][${originalName}]`, value || '');
                                        }
                                    });
                                });
                            });
                        }
                    });
                });
            }

            function createSectionHtml(key, config) {
                const uniqueId = key + '-' + Date.now();
                let fieldsHtml = config.fields && config.fields.length > 0
                    ? config.fields.map(field => createFieldHtml(field, uniqueId)).join('')
                    : '<p class="text-muted">Bu alanın özel bir ayarı yoktur.</p>';

                return `<div class="accordion-item canvas-item" data-unique-id="${uniqueId}" data-section-key="${key}">
                        <h2 class="accordion-header d-flex align-items-center">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-${uniqueId}">
                                <i class="bi bi-arrows-move me-2 sortable-handle"></i> ${config.name}
                            </button>
                            <div class="d-flex align-items-center ms-auto pe-3">
                                <div class="form-check form-switch me-3">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch" checked>
                                </div>
                                <button type="button" class="btn-close remove-item"></button>
                            </div>
                        </h2>
                        <div id="collapse-${uniqueId}" class="accordion-collapse collapse" data-bs-parent="#page-canvas">
                            <div class="accordion-body">${fieldsHtml}</div>
                        </div>
                    </div>`;
            }

            function createFieldHtml(field, uniqueId) {
                let fieldHtml = `<div class="mb-3 field-wrapper">`;

                if (field.type === 'repeater') {
                    fieldHtml += `<label class="form-label fw-bold">${field.label}</label>
                              <div class="repeater-items-container sortable-repeater" data-repeater-name="${field.name}"></div>
                              <button type="button" class="btn btn-success btn-sm add-repeater-item">+ Ekle</button>`;
                } else if (field.translatable) {
                    const tabId = `${uniqueId}-${field.name}`;
                    fieldHtml += `<label class="form-label">${field.label}</label>
                              <ul class="nav nav-tabs nav-tabs-sm">`;

                    activeLanguages.forEach((code, index) => {
                        const isActive = index === 0 ? 'active' : '';
                        fieldHtml += `<li class="nav-item"><button class="nav-link ${isActive}" data-bs-toggle="tab" data-bs-target="#${tabId}-${code}" type="button">${code.toUpperCase()}</button></li>`;
                    });

                    fieldHtml += `</ul><div class="tab-content mt-2">`;

                    activeLanguages.forEach((code, index) => {
                        const isActive = index === 0 ? 'show active' : '';
                        fieldHtml += `<div class="tab-pane fade ${isActive}" id="${tabId}-${code}">${createInputElement(field, code)}</div>`;
                    });

                    fieldHtml += `</div>`;
                } else {
                    fieldHtml += `<label class="form-label">${field.label}</label>${createInputElement(field)}`;
                }
                return fieldHtml + `</div>`;
            }

            function createRepeaterItemHtml(fields, uniqueId, parentField) {
                let itemFieldsHtml = fields.map(field => {
                    let fieldHtml = `<div class="mb-3 field-wrapper">`;

                    // Nested repeater kontrolü
                    if (field.type === 'repeater') {
                        fieldHtml += `<label class="form-label fw-bold">${field.label}</label>
                                  <div class="repeater-items-container sortable-repeater" data-repeater-name="${field.name}"></div>
                                  <button type="button" class="btn btn-success btn-sm add-repeater-item">+ Ekle</button>`;
                    } else if (field.translatable) {
                        const tabId = `${uniqueId}-${field.name}`;
                        fieldHtml += `<label class="form-label">${field.label}</label>
                      <ul class="nav nav-tabs nav-tabs-sm">`;

                        activeLanguages.forEach((code, index) => {
                            const isActive = index === 0 ? 'active' : '';
                            fieldHtml += `<li class="nav-item"><button class="nav-link ${isActive}" data-bs-toggle="tab" data-bs-target="#${tabId}-${code}" type="button">${code.toUpperCase()}</button></li>`;
                        });

                        fieldHtml += `</ul><div class="tab-content mt-2">`;

                        activeLanguages.forEach((code, index) => {
                            const isActive = index === 0 ? 'show active' : '';
                            fieldHtml += `<div class="tab-pane fade ${isActive}" id="${tabId}-${code}">${createInputElement(field, code)}</div>`;
                        });

                        fieldHtml += `</div>`;
                    } else {
                        fieldHtml += `<label class="form-label">${field.label}</label>${createInputElement(field)}`;
                    }
                    return fieldHtml + `</div>`;
                }).join('');

                return `<div class="repeater-item-accordion mb-2">
                <div class="repeater-item-header">
                    <i class="bi bi-grip-vertical repeater-drag-handle" style="cursor: move;"></i>
                    <button class="repeater-toggle-btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#${uniqueId}-collapse">
                        <i class="bi bi-chevron-down collapse-icon"></i>
                        <span class="repeater-title">Yeni Öğe</span>
                    </button>
                    <button type="button" class="btn-close-repeater remove-repeater-item"></button>
                </div>

                <div class="collapse show" id="${uniqueId}-collapse">
                    <div class="repeater-item-body">
                        ${itemFieldsHtml}
                    </div>
                </div>
            </div>`;
            }

            function createInputElement(field, lang = null) {
                const dataAttrs = `data-name="${field.name}" ${lang ? `data-lang="${lang}"` : ''}`;

                if (field.type === 'textarea') {
                    return `<div class="quill-editor-wrapper"><div class="quill-editor"></div><input type="hidden" ${dataAttrs}></div>`;
                } else if (field.type === 'file') {
                    return `<input type="file" class="form-control" ${dataAttrs}>`;
                } else if (field.type === 'select' && field.options) {
                    const options = Object.entries(field.options).map(([val, label]) => `<option value="${val}">${label}</option>`).join('');
                    return `<select class="form-select" ${dataAttrs}>${options}</select>`;
                } else {
                    return `<input type="${field.type}" class="form-control" ${dataAttrs} value="">`;
                }
            }
        });
    </script>
@endpush
