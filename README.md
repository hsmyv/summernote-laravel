# Summernote Laravel

A simple Laravel package for integrating the Summernote editor with configurable toolbar, fonts, height, and Base64 image processing.

## Features

* Summernote Blade component
* Configurable editor height
* Configurable toolbar
* Configurable font names and font sizes
* Base64 image processor
* Single language usage
* Multilingual compatible
* Compatible with Astrotomic Laravel Translatable

## Installation

Install the package via Composer:

```bash
composer require hsmyv/summernote-laravel
```

## Publish Config

```bash
php artisan vendor:publish --tag=summernote-config
```

This will publish the config file:

```text
config/summernote.php
```

Example config:

```php
return [
    'height' => 300,

    'font_names' => [
        'Arial',
        'Verdana',
        'Tahoma',
        'Times New Roman',
    ],

    'font_names_ignore_check' => [],

    'font_sizes' => [
        '8', '9', '10', '11', '12', '14', '16', '18',
        '20', '24', '28', '32', '36', '48', '64', '72',
    ],

    'toolbar' => [
        ['style', ['style']],
        ['font', ['fontname', 'fontsize', 'bold', 'italic', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture']],
        ['view', ['codeview']],
    ],
];
```

## Single Language Usage

In your Blade file:

```blade
<form method="POST" action="/posts">
    @csrf

    <x-summernote-laravel::editor
        name="description"
        :height="400"
    />

    <button type="submit">Save</button>
</form>
```

In your controller:

```php
use Hsmyv\SummernoteLaravel\SummernoteImage;

public function store(Request $request)
{
    $description = SummernoteImage::process($request->description);

    Post::create([
        'description' => $description,
    ]);

    return redirect()->back();
}
```

## Multilingual Usage

You can use the component with different field names for each locale:

```blade
@foreach(['en', 'az', 'ru'] as $locale)
    <x-summernote-laravel::editor
        name="description:{{ $locale }}"
        id="description-{{ $locale }}"
        :height="400"
    />
@endforeach
```

In your controller:

```php
use Hsmyv\SummernoteLaravel\SummernoteImage;

foreach (['en', 'az', 'ru'] as $locale) {
    $post->translateOrNew($locale)->description = SummernoteImage::process(
        $request->input("description:$locale")
    );
}

$post->save();
```

## Optional Packages for Multilingual Projects

This package does not require multilingual packages by default.

For multilingual Laravel projects, you may use:

```bash
composer require astrotomic/laravel-translatable
```

Optional localization routing package:

```bash
composer require mcamara/laravel-localization
```

These packages are optional. Summernote Laravel only provides the editor component and image processing.

## Example with Astrotomic Laravel Translatable

Post model:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Post extends Model implements TranslatableContract
{
    use Translatable;

    public array $translatedAttributes = [
        'description',
    ];

    protected $guarded = [];
}
```

PostTranslation model:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    public $timestamps = false;

    protected $guarded = [];
}
```

Controller example:

```php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Hsmyv\SummernoteLaravel\SummernoteImage;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $post = new Post();

        foreach (['en', 'az', 'ru'] as $locale) {
            $description = $request->input("description:$locale");

            $post->translateOrNew($locale)->description = $description
                ? SummernoteImage::process($description)
                : null;
        }

        $post->save();

        return redirect()->back();
    }
}
```

## Editing Existing Content

```blade
@php
    $locales = ['en' => 'EN', 'az' => 'AZ', 'ru' => 'RU'];
@endphp

@foreach($locales as $code => $label)
    @php
        $value = old("description:$code") ?? (isset($post) ? $post->translate($code)?->description : '');
    @endphp

    <x-summernote-laravel::editor
        name="description:{{ $code }}"
        id="description-{{ $code }}"
        :height="400"
        :value="$value"
    />
@endforeach
```

## Base64 Image Processing

Summernote may insert images as Base64:

```html
<img src="data:image/png;base64,...">
```

Use:

```php
$content = SummernoteImage::process($content);
```

The package will save the image into:

```text
public/uploads/editor
```

and replace the image source with:

```html
<img src="/uploads/editor/image.png">
```
For a complete working example, including CRUD operations, multilingual support, Astrotomic Laravel Translatable integration, and Base64 image processing, please see the example project:

https://github.com/hsmyv/summernote-editor-test

## License

The MIT License.
