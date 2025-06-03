<?php

namespace App\CarbonFields;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function () {
    Container::make('theme_options', 'Blog Settings')
        ->add_fields([
            Field::make('complex', 'blog_array', 'Blog Array')
                ->set_layout('tabbed-vertical')
                ->add_fields('image_only', [
                    Field::make('image', 'image', 'Image'),
                ])
                ->add_fields('slick', [
                    Field::make('complex', 'slides', 'Slides')
                        ->set_layout('tabbed-horizontal')
                        ->add_fields('slide', [
                            Field::make('image', 'image', 'Image'),
                        ]),
                ])
                ->add_fields('content', [
                    Field::make('text', 'author', 'Author'),
                    Field::make('text', 'date', 'Date'),
                    Field::make('text', 'title', 'Title'),
                    Field::make('checkbox', 'is_big_title', 'Is Big Title'),
                    Field::make('textarea', 'description', 'Description'),
                    Field::make('complex', 'list', 'List')
                        ->set_layout('tabbed-horizontal')
                        ->add_fields('list_item', [
                            Field::make('text', 'key', 'Key'),
                            Field::make('text', 'content', 'Content'),
                        ]),
                ]),
        ]);

    Container::make('theme_options', 'Booking Settings')
        ->add_fields([
            Field::make('complex', 'booking_sections', 'Booking Sections')
                ->set_layout('tabbed-vertical')
                
                // 1. TEXT ONLY
                ->add_fields('text_only', [
                    Field::make('text', 'title', 'Title'),
                    Field::make('textarea', 'description', 'Description'),
                ])
                ->set_header_template('<%- title %> (Text Only)')

                // 2. ROW
                ->add_fields('row', [
                    Field::make('checkbox', 'is_reversed', 'Reversed Layout'),
                    Field::make('text', 'title', 'Title'),

                    Field::make('complex', 'highlight_features', 'Highlight Features')
                        ->add_fields('highlight', [
                            Field::make('text', 'text', 'Text'),
                        ]),

                    Field::make('complex', 'features', 'Features')
                        ->add_fields('feature', [
                            Field::make('text', 'text', 'Text'),
                        ]),

                    Field::make('complex', 'images', 'Images')
                        ->add_fields('image', [
                            Field::make('image', 'src', 'Image'),
                            Field::make('complex', 'features', 'Image Features')
                                ->add_fields('image_feature', [
                                    Field::make('text', 'feature', 'Feature Text'),
                                ]),
                        ]),

                    Field::make('text', 'stock_availability_text', 'Stock Availability Text'),

                    Field::make('complex', 'select', 'Select')
                        ->add_fields('select_item', [
                            Field::make('image', 'icon', 'Icon'),
                            Field::make('text', 'title', 'Title'),
                            Field::make('text', 'from_label', 'From Label'),
                            Field::make('text', 'to_label', 'To Label'),
                            Field::make('text', 'button_text', 'Button Text'),
                        ]),
                ])
                ->set_header_template('<%- title %> (Row)')

                // 3. MIX
                ->add_fields('mix', [
                    Field::make('text', 'title', 'Title'),

                    Field::make('complex', 'highlight_features', 'Highlight Features')
                        ->add_fields('highlight', [
                            Field::make('text', 'text', 'Text'),
                        ]),

                    Field::make('complex', 'features', 'Features')
                        ->add_fields('feature', [
                            Field::make('text', 'text', 'Text'),
                        ]),

                    Field::make('complex', 'select', 'Select')
                        ->add_fields('select_item', [
                            Field::make('image', 'icon', 'Icon'),
                            Field::make('text', 'title', 'Title'),
                            Field::make('text', 'from_label', 'From Label'),
                            Field::make('text', 'to_label', 'To Label'),
                            Field::make('text', 'button_text', 'Button Text'),
                        ]),

                    Field::make('complex', 'images', 'Images')
                        ->add_fields('image', [
                            Field::make('image', 'src', 'Image'),
                            Field::make('complex', 'features', 'Image Features')
                                ->add_fields('image_feature', [
                                    Field::make('text', 'feature', 'Feature Text'),
                                ]),
                        ]),
                ])
                ->set_header_template('<%- title %> (Mix)'),
        ]);


    Container::make('nav_menu_item', 'Menu Icon')
        ->add_fields([
            Field::make('image', 'menu_icon', 'Menu Icon'),
        ]);
});
