@props([
    'name',
    'value' => '',
    'id' => null,
    'height' => null,
    
])

@php
    $editorId = $id ?? 'summernote-' . str_replace(['[', ']', ':', '.'], '-', $name);
    $editorHeight = $height ?? config('summernote.height', 300);
@endphp

<textarea
    id="{{ $editorId }}"
    name="{{ $name }}"
    {{ $attributes->merge(['class' => 'form-control']) }}
>{{ old($name, $value) }}</textarea>

@once
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
@endonce

<script>
document.addEventListener('DOMContentLoaded', function () {
$('#{{ $editorId }}').summernote({
    height: {{ $editorHeight }},
    placeholder: @json(config('summernote.placeholder')),
    dialogsInBody: @json(config('summernote.dialogs_in_body')),
    dialogsFade: @json(config('summernote.dialogs_fade')),
    disableDragAndDrop: @json(config('summernote.disable_drag_and_drop')),
    shortcuts: @json(config('summernote.shortcuts')),
    tabDisable: @json(config('summernote.tab_disable')),
    addDefaultFonts: @json(config('summernote.add_default_fonts')),
    fontNames: @json(config('summernote.font_names')),
    fontNamesIgnoreCheck: @json(config('summernote.font_names_ignore_check')),
    fontSizes: @json(config('summernote.font_sizes')),
    fontSizeUnits: @json(config('summernote.font_size_units')),
    lineHeights: @json(config('summernote.line_heights')),
    styleTags: @json(config('summernote.style_tags')),
    toolbar: @json(config('summernote.toolbar')),
    codeviewFilter: @json(config('summernote.codeview_filter')),
    codeviewIframeFilter: @json(config('summernote.codeview_iframe_filter')),
});
});
</script>