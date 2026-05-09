<?php

namespace App\Providers;

use App\Models\ServiceCategory;
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
        View::composer('partials.header', function ($view) {
            $menuServiceCategories = ServiceCategory::query()
                ->whereNull('parent_id')
                ->where('is_published', true)
                ->where('show_in_menu', true)
                ->orderBy('sort_order')
                ->with(['allVisibleChildren', 'menuServices'])
                ->get();

            $view->with('menuServiceCategories', $menuServiceCategories);
        });
    }
}
