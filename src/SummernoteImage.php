<?php

namespace Hsmyv\SummernoteLaravel;

use DOMDocument;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SummernoteImage
{
    public static function process(?string $content): ?string
    {
        if (empty($content)) {
            return $content;
        }

        $dom = new DOMDocument();

        @$dom->loadHTML(
            mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8')
        );

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $image64 = $img->getAttribute('src');

            if (strpos($image64, 'data:image/') !== 0) {
                continue;
            }

            $extension = explode('/', explode(':', substr($image64, 0, strpos($image64, ';')))[1])[1];

            $replace = substr($image64, 0, strpos($image64, ',') + 1);

            $image = str_replace($replace, '', $image64);
            $image = str_replace(' ', '+', $image);

            $imageName = Str::random(10) . '.' . $extension;

            $filePath = public_path('uploads/editor');

            if (! File::exists($filePath)) {
                File::makeDirectory($filePath, 0755, true);
            }

            file_put_contents($filePath . '/' . $imageName, base64_decode($image));

            $img->removeAttribute('src');
            $img->setAttribute('src', '/uploads/editor/' . $imageName);
        }

        $body = $dom->getElementsByTagName('body')->item(0);

        $html = '';

        foreach ($body->childNodes as $child) {
            $html .= $dom->saveHTML($child);
        }

        return $html;
    }
}