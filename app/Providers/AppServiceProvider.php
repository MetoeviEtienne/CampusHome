<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Colocation;

class AppServiceProvider extends ServiceProvider
{

    public const HOME = '/dashboard';

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
        Schema::defaultStringLength(191);
        //

        View::composer('*', function ($view) {
            $nbAnnonces = Colocation::count();
            $view->with('nbAnnonces', $nbAnnonces);
        });

    }
}
