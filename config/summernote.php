<?php
return [
    'height' => 300,

    'placeholder' => 'Write text...',
    'dialogs_in_body' => true,
    'dialogs_fade' => true,

    'disable_drag_and_drop' => true,
    'shortcuts' => true,
    'tab_disable' => true,

    'add_default_fonts' => true,

    'font_size_units' => ['px', 'pt'],

    'line_heights' => [
        '1.0', '1.2', '1.4', '1.5', '1.6', '1.8', '2.0', '2.5', '3.0'
    ],

    'style_tags' => [
        'p',
        'blockquote',
        'pre',
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
    ],

    'codeview_filter' => true,
    'codeview_iframe_filter' => true,

    'toolbar' => [
        ['style', ['style']],
        ['font', [
            'fontname',
            'fontsize',
            'fontsizeunit',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'superscript',
            'subscript',
            'clear'
        ]],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video', 'hr']],
        ['misc', ['undo', 'redo']],
        ['view', ['codeview', 'help']],
    ],

    'font_names' => [
        'Gilroy',
        'Arial',
        'Verdana',
        'Tahoma',
        'Times New Roman',
    ],

    'font_names_ignore_check' => [
        'Gilroy',
    ],

    'font_sizes' => [
        '8', '9', '10', '11', '12', '13', '14', '15', '16',
        '18', '20', '22', '24', '26', '28', '30',
        '32', '36', '40', '44', '48', '52', '56', '60', '64', '72',
    ],
];