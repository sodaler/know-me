<?php

namespace App\Providers;

use App\Actions\Uploads\ImageUploadAction;
use App\Contracts\UploadContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UploadContract::class, ImageUploadAction::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
