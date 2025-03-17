<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
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
        Schema::defaultStringLength(191);

        ini_set('memory_limit', '-1');
        ini_set('max_execution_time',   3600);

        // Share category data with all views
        View::composer('learner.layout.sidebar', function ($view) {
            $categories = Category::with('sub_categories.courses')->get();
            $view->with('categories', $categories);
        });
    }

}
