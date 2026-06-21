@props([
    'name',
    'value' => '',
    'id' => null,
    'height' => 300,
])

@php
    $editorId = $id ?? 'summernote-' . str_replace(['[', ']', ':', '.'], '-', $name);
@endphp

<textarea
    id="{{ $editorId }}"
    name="{{ $name }}"
    {{ $attributes->merge(['class' => 'form-control']) }}
>{{ old($name, $value) }}</textarea>

@once
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
@endonce

<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#{{ $editorId }}').summernote({
        height: {{ $height }},
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture']],
            ['view', ['codeview']]
        ]
    });
});
</script>