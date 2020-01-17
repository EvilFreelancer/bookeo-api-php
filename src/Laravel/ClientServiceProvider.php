<?php

namespace Bookeo\Laravel;

use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../configs/bookeo-api.php' => config_path('bookeo-api.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../configs/bookeo-api.php', 'bookeo-api'
        );

        $this->app->bind(ClientWrapper::class);
    }
}