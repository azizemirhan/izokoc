{{-- resources/views/admin/pages/partials/_section_fields.blade.php --}}
@foreach($fields as $field)
    @php
        $fieldName = $field['name'];
        $fieldValue = $section->content[$fieldName] ?? null;

        if (is_string($fieldValue) && (str_starts_with($fieldValue, '[') || str_starts_with($fieldValue, '{'))) {
            try {
                $decoded = json_decode($fieldValue, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $fieldValue = $decoded;
                }
            } catch (\Exception $e) {}
        }
    @endphp

    <div class="mb-3 field-wrapper">
        {{-- REPEATER ALANI --}}
        @if($field['type'] === 'repeater')
            <label class="form-label fw-bold">{{ $field['label'] }}</label>
            <div class="repeater-items-container sortable-repeater" data-repeater-name="{{ $fieldName }}">
                @if(is_array($fieldValue) && count($fieldValue) > 0)
                    @foreach($fieldValue as $index => $item)
                        @php
                            $itemTitle = $item['name'][app()->getLocale()] ??
                                        $item['title'][app()->getLocale()] ??
                                        $item['label'][app()->getLocale()] ??
                                        $item['category_title'][app()->getLocale()] ??
                                        'Öğe #' . ($index + 1);
                        @endphp
                        <div class="repeater-item-accordion mb-2">
                            <div class="repeater-item-header">
                                <i class="bi bi-grip-vertical repeater-drag-handle"></i>
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
                                            {{-- NESTED REPEATER --}}
                                            @if($repeaterField['type'] === 'repeater')
                                                <label class="form-label fw-bold">{{ $repeaterField['label'] }}</label>
                                                <div class="repeater-items-container sortable-repeater"
                                                     data-repeater-name="{{ $repeaterFieldName }}">
                                                    @if(is_array($repeaterFieldValue) && count($repeaterFieldValue) > 0)
                                                        @foreach($repeaterFieldValue as $nestedIndex => $nestedItem)
                                                            @php
                                                                $nestedTitle = $nestedItem['name'][app()->getLocale()] ??
                                                                              $nestedItem['title'][app()->getLocale()] ??
                                                                              $nestedItem['service_title'][app()->getLocale()] ??
                                                                              'Alt Öğe #' . ($nestedIndex + 1);
                                                            @endphp
                                                            <div class="repeater-item-accordion mb-2">
                                                                <div class="repeater-item-header">
                                                                    <i class="bi bi-grip-vertical repeater-drag-handle"></i>
                                                                    <button class="repeater-toggle-btn" type="button"
                                                                            data-bs-toggle="collapse"
                                                                            data-bs-target="#nested-{{$section->id}}-{{$fieldName}}-{{$index}}-{{$repeaterFieldName}}-{{$nestedIndex}}">
                                                                        <i class="bi bi-chevron-down collapse-icon"></i>
                                                                        <span class="repeater-title">{{ $nestedTitle }}</span>
                                                                    </button>
                                                                    <button type="button"
                                                                            class="btn-close-repeater remove-repeater-item"></button>
                                                                </div>

                                                                <div class="collapse"
                                                                     id="nested-{{$section->id}}-{{$fieldName}}-{{$index}}-{{$repeaterFieldName}}-{{$nestedIndex}}">
                                                                    <div class="repeater-item-body">
                                                                        @foreach($repeaterField['fields'] as $nestedField)
                                                                            @php
                                                                                $nestedFieldName = $nestedField['name'];
                                                                                $nestedFieldValue = $nestedItem[$nestedFieldName] ?? null;
                                                                            @endphp

                                                                            <div class="mb-3">
                                                                                @if(isset($nestedField['translatable']) && $nestedField['translatable'])
                                                                                    <label class="form-label">{{ $nestedField['label'] }}</label>
                                                                                    <ul class="nav nav-tabs nav-tabs-sm">
                                                                                        @foreach($activeLanguages as $code => $lang)
                                                                                            <li class="nav-item">
                                                                                                <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                                                                        data-bs-toggle="tab"
                                                                                                        data-bs-target="#nested-{{$section->id}}-{{$fieldName}}-{{$index}}-{{$repeaterFieldName}}-{{$nestedIndex}}-{{$nestedFieldName}}-{{$code}}"
                                                                                                        type="button">{{ strtoupper($code) }}</button>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                    <div class="tab-content mt-2">
                                                                                        @foreach($activeLanguages as $code => $lang)
                                                                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                                                                 id="nested-{{$section->id}}-{{$fieldName}}-{{$index}}-{{$repeaterFieldName}}-{{$nestedIndex}}-{{$nestedFieldName}}-{{$code}}">
                                                                                                @php
                                                                                                    $val = is_array($nestedFieldValue) ? ($nestedFieldValue[$code] ?? '') : '';
                                                                                                @endphp
                                                                                                @include('admin.pages.partials._input_element', [
                                                                                                    'field' => $nestedField,
                                                                                                    'lang' => $code,
                                                                                                    'value' => $val
                                                                                                ])
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </div>
                                                                                @else
                                                                                    <label class="form-label">{{ $nestedField['label'] }}</label>
                                                                                    @include('admin.pages.partials._input_element', [
                                                                                        'field' => $nestedField,
                                                                                        'lang' => null,
                                                                                        'value' => $nestedFieldValue
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
                                                <button type="button" class="btn btn-success btn-sm add-repeater-item">+
                                                    Ekle
                                                </button>

                                                {{-- NORMAL REPEATER FIELD (ÇOK DİLLİ) --}}
                                            @elseif(isset($repeaterField['translatable']) && $repeaterField['translatable'])
                                                <label class="form-label">{{ $repeaterField['label'] }}</label>
                                                <ul class="nav nav-tabs nav-tabs-sm">
                                                    @foreach($activeLanguages as $code => $lang)
                                                        <li class="nav-item">
                                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                                    data-bs-toggle="tab"
                                                                    data-bs-target="#repeater-{{$section->id}}-{{$fieldName}}-{{$index}}-{{$repeaterFieldName}}-{{$code}}"
                                                                    type="button">{{ strtoupper($code) }}</button>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="tab-content mt-2">
                                                    @foreach($activeLanguages as $code => $lang)
                                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                                             id="repeater-{{$section->id}}-{{$fieldName}}-{{$index}}-{{$repeaterFieldName}}-{{$code}}">
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

                                                {{-- NORMAL REPEATER FIELD (TEK DİLLİ) --}}
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

            {{-- ÇOK DİLLİ ALAN (NORMAL) --}}
        @elseif(isset($field['translatable']) && $field['translatable'])
            <label class="form-label">{{ $field['label'] }}</label>
            <ul class="nav nav-tabs nav-tabs-sm">
                @foreach($activeLanguages as $code => $lang)
                    <li class="nav-item">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                data-bs-toggle="tab"
                                data-bs-target="#field-{{$section->id}}-{{$fieldName}}-{{$code}}"
                                type="button">{{ strtoupper($code) }}</button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content mt-2">
                @foreach($activeLanguages as $code => $lang)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                         id="field-{{$section->id}}-{{$fieldName}}-{{$code}}">
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

            {{-- TEK DİLLİ ALAN (NORMAL) --}}
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