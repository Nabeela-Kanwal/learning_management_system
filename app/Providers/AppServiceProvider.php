<?php

namespace App\Providers;

use App\Models\Course;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('include.frontheader', function ($view) {
            $view->with('course', Course::where('status', 1)->get());
        });
    }
}
