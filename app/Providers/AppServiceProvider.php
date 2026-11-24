<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Pagination bawaan Laravel memakai Tailwind, ganti ke Bootstrap 5
        Paginator::useBootstrapFive();
    }
}
