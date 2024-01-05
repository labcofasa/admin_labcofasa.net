<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\UserRole;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind('Spatie\Permission\Models\Role', 'App\Models\UserRole');
    }
}
