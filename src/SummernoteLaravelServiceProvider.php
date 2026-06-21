<?php

namespace Hsmyv\SummernoteLaravel;

use Illuminate\Support\ServiceProvider;

class SummernoteLaravelServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
            $this->loadViewsFrom(__DIR__ . '/../resources/views', 'summernote-laravel');

    }
}