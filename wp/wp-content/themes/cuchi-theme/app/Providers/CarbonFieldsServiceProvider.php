<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

class CarbonFieldsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        add_action('after_setup_theme', function () {
            Carbon_Fields::boot();
        });

        add_action('carbon_fields_register_fields', function () {
            Container::make('theme_options', __('Theme Settings'))
                ->add_fields([
                    Field::make('text', 'test_field', __('Test Field')),
                ]);
        });
    }
}
