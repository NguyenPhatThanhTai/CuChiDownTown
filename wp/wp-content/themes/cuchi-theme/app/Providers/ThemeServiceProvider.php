<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;

class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        add_theme_support('menus');

         register_nav_menus([
            'primary_navigation' => __('Primary Navigation', 'sage'),
            'mobile_navigation' => __('Mobile Navigation', 'sage'),
        ]);
    }
}
