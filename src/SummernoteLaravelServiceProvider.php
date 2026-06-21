<?php

namespace Hsmyv\SummernoteLaravel;

use Illuminate\Support\ServiceProvider;

class SummernoteLaravelServiceProvider extends ServiceProvider
{
    public function register(): void
{
    $this->mergeConfigFrom(
        __DIR__.'/../config/summernote.php',
        'summernote'
    );
}

    public function boot(): void
    {
            $this->loadViewsFrom(__DIR__ . '/../resources/views', 'summernote-laravel');
            $this->publishes([
            __DIR__ . '/../config/summernote.php' => config_path('summernote.php'),
        ], 'summernote-config');
    }
}