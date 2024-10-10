<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Url\Shorteners\Shortener;
use App\Services\Url\Shorteners\TinyUrl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Shortener::class, TinyUrl::class);
    }


    public function provides(): array
    {
        return [Shortener::class];
    }
}
