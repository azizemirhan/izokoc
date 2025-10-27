{{-- resources/views/admin/pages/partials/_section_fields.blade.php --}}
@foreach($fields as $field)
    @php
        $fieldName = $field['name'];
        $fieldValue = $section->content[$fieldName] ?? null;

        // JSON string ise decode et
        if (is_string($fieldValue) && (str_starts_with($fieldValue, '[') || str_starts_with($fieldValue, '{'))) {
            try {
                $decoded = json_decode($fieldValue, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $fieldValue = $decoded;
                }
            } catch (\Exception $e) {
                // JSON decode başarısız, string olarak devam et
            }
        }
    @endphp

    <div class="mb-3 field-wrapper">
        {{-- REPEATER ALANI --}}
        @if($field['type'] === 'repeater')
            <label class="form-label fw-bold">{{ $field['label'] }}</label>
            <div class="repeater-items-container sortable-repeater" data-repeater-name="{{ $fieldName }}">
                {{-- Mevcut repeater verilerini render et --}}
                @if(is_array($fieldValue) && count($fieldValue) > 0)
                    @foreach($fieldValue as $index => $item)
                        @php
                            // Başlık için kullanılacak alanı bul (name, title, label vb.)
                            $itemTitle = $item['name'][app()->getLocale()] ??
                                        $item['title'][app()->getLocale()] ??
                                        $item['label'][app()->getLocale()] ??
                                        'Öğe #' . ($index + 1);
                        @endphp
                        <div class="repeater-item-accordion mb-2">
                            <div class="repeater-item-header">
                                <i class="bi bi-grip-vertical repeater-drag-handle" style="cursor: move;"></i>
                                <button class="repeater-toggle-btn" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#repeater-{{$section->id}}-{{$fieldName}}-{{$index}}">
                                    <i class="bi bi-chevron-down collapse-icon"></i>
                                    <span class="repeater-title">{{ $itemTitle }}</span>
                                </button>
                                <button type="button" class="btn-close-repeater remove-repeater-item"></button>
                            </div>

                            <div class="collapse" id="repeater-{{$section->id}}-{{$fieldName}}-{{$index}}">
                                <div class="repeater-item-body">
                                    @foreach($field['fields'] as $repeaterField)
                                        @php
                                            $repeaterFieldName = $repeaterField['name'];
                                            $repeaterFieldValue = $item[$repeaterFieldName] ?? null;
                                        @endphp

                                        <div class="mb-3">
                                            {{-- REPEATER İÇİNDE ÇOK DİLLİ ALAN --}}
                                            @if(isset($repeaterField['translatable']) && $repeaterField['translatable'])
                                                <label class="form-label">{{ $repeaterField['label'] }}</label>
                                                <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                                                    @foreach($activeLanguages as $code => $lang)
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#repeater-{{$section->id}}-{{$fieldName}}-{{$index}}-{{$repeaterFieldName}}-{{$code}}"
                                                                    type="button" role="tab">{{ strtoupper($code) }}</button>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="tab-content mt-2">
                                                    @foreach($activeLanguages as $code => $lang)
                                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                             id="repeater-{{$section->id}}-{{$fieldName}}-{{$index}}-{{$repeaterFieldName}}-{{$code}}"
                                                             role="tabpanel">
                                                            @php
                                                                $val = is_array($repeaterFieldValue) ? ($repeaterFieldValue[$code] ?? '') : '';
                                                            @endphp
                                                            @include('admin.pages.partials._input_element', [
                                                                'field' => $repeaterField,
                                                                'lang' => $code,
                                                                'value' => $val
                                                            ])
                                                        </div>
                                                    @endforeach
                                                </div>
                                                {{-- REPEATER İÇİNDE TEK DİLLİ ALAN --}}
                                            @else
                                                <label class="form-label">{{ $repeaterField['label'] }}</label>
                                                @include('admin.pages.partials._input_element', [
                                                    'field' => $repeaterField,
                                                    'lang' => null,
                                                    'value' => $repeaterFieldValue
                                                ])
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" class="btn btn-success btn-sm add-repeater-item">+ Ekle</button>

            {{-- ÇOK DİLLİ ALAN --}}
        @elseif(isset($field['translatable']) && $field['translatable'])
            <label class="form-label">{{ $field['label'] }}</label>
            <ul class="nav nav-tabs nav-tabs-sm" role="tablist">
                @foreach($activeLanguages as $code => $lang)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                data-bs-toggle="tab"
                                data-bs-target="#field-{{$section->id}}-{{$fieldName}}-{{$code}}"
                                type="button" role="tab">{{ strtoupper($code) }}</button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content mt-2">
                @foreach($activeLanguages as $code => $lang)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                         id="field-{{$section->id}}-{{$fieldName}}-{{$code}}"
                         role="tabpanel">
                        @php
                            $val = is_array($fieldValue) ? ($fieldValue[$code] ?? '') : '';
                        @endphp
                        @include('admin.pages.partials._input_element', [
                            'field' => $field,
                            'lang' => $code,
                            'value' => $val
                        ])
                    </div>
                @endforeach
            </div>

            {{-- TEK DİLLİ ALAN --}}
        @else
            <label class="form-label">{{ $field['label'] }}</label>
            @include('admin.pages.partials._input_element', [
                'field' => $field,
                'lang' => null,
                'value' => $fieldValue
            ])
        @endif
    </div>
@endforeach