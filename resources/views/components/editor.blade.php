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
    fontNames: @json(config('summernote.font_names')),
    fontNamesIgnoreCheck: @json(config('summernote.font_names_ignore_check')),
    fontSizes: @json(config('summernote.font_sizes')),
    toolbar: @json(config('summernote.toolbar')),
});
});
</script>