<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

if (! function_exists('\Roots\bootloader')) {
    wp_die(
        __('You need to install Acorn to use this theme.', 'sage'),
        '',
        [
            'link_url' => 'https://roots.io/acorn/docs/installation/',
            'link_text' => __('Acorn Docs: Installation', 'sage'),
        ]
    );
}

\Roots\bootloader()->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });


// My custom code for theme support and customization
require_once get_template_directory() . '/app/Custom/MultipleMediaControl.php';
require_once get_template_directory() . '/vendor/autoload.php';
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

add_theme_support('custom-logo', [
  'height'      => 80,
  'width'       => 109,
  'flex-height' => true,
  'flex-width'  => true,
  'header-text' => ['site-title', 'site-description'],
]);

add_action('customize_register', function ($wp_customize) {
    // HERO SECTION
    $wp_customize->add_section('custom_header_section', [
        'title'    => __('Hero Section', 'sage'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('header_image_upload', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_image_upload_control', [
        'label'    => __('Header Image', 'sage'),
        'section'  => 'custom_header_section',
        'settings' => 'header_image_upload',
    ]));

    // FOOTER SECTION
    $wp_customize->add_section('footer_section', [
        'title'    => __('Footer Section', 'sage'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('footer_logo_upload', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo_upload_control', [
        'label'    => __('Footer Image', 'sage'),
        'section'  => 'footer_section',
        'settings' => 'footer_logo_upload',
    ]));
    $wp_customize->add_setting('footer_title', [
        'default'           => 'Disconnect to Reconnect',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('footer_title', [
        'label'   => __('Title', 'sage'),
        'section' => 'footer_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('footer_name', [
        'default'           => 'Downtown Cuchi',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('footer_name', [
        'label'   => __('Name', 'sage'),
        'section' => 'footer_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('footer_phone', [
        'default'           => 'P +84 909 907 113',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('footer_phone', [
        'label'   => __('Phone', 'sage'),
        'section' => 'footer_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('footer_address', [
        'default'           => 'Ap Cay Trac, Pham Van Coi, Cu Chi, HCM City, Vietnam',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('footer_address', [
        'label'   => __('Address', 'sage'),
        'section' => 'footer_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('footer_copyright', [
        'default'           => 'Downtown Cuchi 2025 ',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('footer_copyright', [
        'label'   => __('Copyright', 'sage'),
        'section' => 'footer_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('footer_form_title', [
        'default'           => 'Discover the latest Downtown Cuchi Insights ',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('footer_form_title', [
        'label'   => __('Form Title', 'sage'),
        'section' => 'footer_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('footer_form_field_name', [
        'default'           => 'First Name',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('footer_form_field_name', [
        'label'   => __('Form Field Name', 'sage'),
        'section' => 'footer_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('footer_form_field_email', [
        'default'           => 'Email',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('footer_form_field_email', [
        'label'   => __('Form Field Email', 'sage'),
        'section' => 'footer_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('footer_form_submit', [
        'default'           => 'Submit',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('footer_form_submit', [
        'label'   => __('Submit Button Text', 'sage'),
        'section' => 'footer_section',
        'type'    => 'text',
    ]);


    // HASHTAGS SECTION
    $wp_customize->add_section('hashtags_section', [
        'title'    => __('Hashtags Section', 'sage'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('hero_title', [
        'default'           => 'DOWNTOWN CUCHI',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hashtags_title', [
        'label'   => __('Title', 'sage'),
        'section' => 'hashtags_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('hashtags_tags', [
        'default'           => '#traditionalcuisine #cozyaccommodations #weekendgetaways #relaxation #teambuilding',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hashtags_tags', [
        'label'   => __('Hashtags', 'sage'),
        'section' => 'hashtags_section',
        'type'    => 'text',
    ]);


    // INTRO 1 SECTION
    $wp_customize->add_section('intro-1_section', [
        'title'    => __('Intro 1 Section', 'sage'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('intro_1_title', [
        'default'           => 'What enrich your stay?',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('intro_1_title', [
        'label'   => __('Title', 'sage'),
        'section' => 'intro-1_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('intro_1_description', [
        'default'           => 'At The Downtown Cuchi, there’s never a dull moment. While the serene surroundings invite you to unwind, we also offer a variety of activities to make your stay even more memorable.',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('intro_1_description', [
        'label'   => __('Description', 'sage'),
        'section' => 'intro-1_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('intro_1_button_text', [
        'default'           => 'See More',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('intro_1_button_text', [
        'label'   => __('Button text', 'sage'),
        'section' => 'intro-1_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('intro_1_button_image_upload', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'intro_1_button_image_upload_control', [
        'label'    => __('Image', 'sage'),
        'section'  => 'intro-1_section',
        'settings' => 'intro_1_button_image_upload',
    ]));

    // INTRO 2 SECTION
    $wp_customize->add_section('intro-2_section', [
        'title'    => __('Intro 2 Section', 'sage'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('intro_2_title', [
        'default'           => 'RIDE A BIKE,',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('intro_2_title', [
        'label'   => __('Title', 'sage'),
        'section' => 'intro-2_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('intro_2_subtitle_main', [
        'default'           => 'NOT YOUR',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('intro_2_subtitle_main', [
        'label'   => __('Subtitle', 'sage'),
        'section' => 'intro-2_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('intro_2_subtitle_emphasis', [
        'default'           => 'MOBILE!',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('intro_2_subtitle_emphasis', [
        'label'   => __('Subtitle emphasis', 'sage'),
        'section' => 'intro-2_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('intro_2_description', [
        'default'           => 'Guided by the team at The Downtown Cuchi, your cycling adventure offers an immersive journey through this picturesque countryside, blending scenic landscapes, local traditions, and memorable activities.',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('intro_2_description', [
        'label'   => __('Description', 'sage'),
        'section' => 'intro-2_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('intro_2_button_text', [
        'default'           => 'See More',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('intro_2_button_text', [
        'label'   => __('Button text', 'sage'),
        'section' => 'intro-2_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('intro_2_button_image_upload', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'intro_2_button_image_upload_control', [
        'label'    => __('Image', 'sage'),
        'section'  => 'intro-2_section',
        'settings' => 'intro_2_button_image_upload',
    ]));


    // HIGHLIGHTED MEMORIES SECTION
    $wp_customize->add_section('highlighted_memories_section', [
        'title'    => __('Highlighted Memories Section', 'sage'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('highlighted_memories_title', [
        'default'           => 'HIGHLIGHTED MOMENTS',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('highlighted_memories_title', [
        'label'   => __('Title', 'sage'),
        'section' => 'highlighted_memories_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('video_urls', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control(new Multiple_Media_Control($wp_customize, 'video_urls', [
        'label'   => __('Upload Videos', 'sage'),
        'section' => 'highlighted_memories_section',
    ]));

    // IN ONE TOUR SECTION
    $wp_customize->add_section('in_one_tour_section', [
        'title'    => __('In One Tour Section', 'sage'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('in_one_tour_title', [
        'default'           => 'IN ONE TOUR',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('in_one_tour_title', [
        'label'   => __('Title', 'sage'),
        'section' => 'in_one_tour_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('in_one_tour_description', [
        'default'           => 'Fresh Air, Outdoor Experience and Savoring Cuisine',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('in_one_tour_description', [
        'label'   => __('Description', 'sage'),
        'section' => 'in_one_tour_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('in_one_tour_button_text', [
        'default'           => 'Book Now',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('in_one_tour_button_text', [
        'label'   => __('Button text', 'sage'),
        'section' => 'in_one_tour_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('in_one_tour_button_image_upload', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'in_one_tour_button_image_upload_control', [
        'label'    => __('Image', 'sage'),
        'section'  => 'in_one_tour_section',
        'settings' => 'in_one_tour_button_image_upload',
    ]));

    // OUR INSIGHTS SECTION
    $wp_customize->add_section('our_insights_section', [
        'title'    => __('Our Insights Section', 'sage'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('our_insights_title', [
        'default'           => 'Explore insights',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('our_insights_title', [
        'label'   => __('Title', 'sage'),
        'section' => 'our_insights_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('our_insights_sticky_text', [
        'default'           => 'Disconnect to Reconnect',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('our_insights_sticky_text', [
        'label'   => __('Sticky text', 'sage'),
        'section' => 'our_insights_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('our_insights_image_urls', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control(new Multiple_Media_Control($wp_customize, 'our_insights_image_urls', [
        'label'   => __('Upload Images', 'sage'),
        'section' => 'our_insights_section',
    ]));
    

    // MEMORIES SECTION
    $wp_customize->add_section('memories_section', [
        'title'    => __('Memories Section', 'sage'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('memories_title', [
        'default'           => 'Delightful journey filled with unforgettable memories',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('memories_title', [
        'label'   => __('Title', 'sage'),
        'section' => 'memories_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('memories_description', [
        'default'           => "It's the perfect blend of fun, relaxation, and togetherness that will leave you longing to return.",
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('memories_description', [
        'label'   => __('Description', 'sage'),
        'section' => 'memories_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('image_urls', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control(new Multiple_Media_Control($wp_customize, 'image_urls', [
        'label'   => __('Upload Images', 'sage'),
        'section' => 'memories_section',
    ]));

    // TEAM BUILDING SECTION
    $wp_customize->add_section('teambuilding_section', [
        'title'    => __('Team Building Section', 'sage'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('teambuilding_title', [
        'default'           => 'TEAM BUILDING',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('teambuilding_title', [
        'label'   => __('Title', 'sage'),
        'section' => 'teambuilding_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('teambuilding_subtitle', [
        'default'           => 'Tammy Nguyen and her team',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('teambuilding_subtitle', [
        'label'   => __('Subtitle', 'sage'),
        'section' => 'teambuilding_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('teambuilding_description', [
        'default'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('teambuilding_description', [
        'label'   => __('Description', 'sage'),
        'section' => 'teambuilding_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('teambuilding_image_1', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'teambuilding_image_1_control', [
        'label'    => __('Header Image', 'sage'),
        'section'  => 'teambuilding_section',
        'settings' => 'teambuilding_image_1',
    ]));
    $wp_customize->add_setting('teambuilding_image_2', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'teambuilding_image_2_control', [
        'label'    => __('Header Image', 'sage'),
        'section'  => 'teambuilding_section',
        'settings' => 'teambuilding_image_2',
    ]));
    $wp_customize->add_setting('teambuilding_image_3', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'teambuilding_image_3_control', [
        'label'    => __('Header Image', 'sage'),
        'section'  => 'teambuilding_section',
        'settings' => 'teambuilding_image_3',
    ]));

    // ABOUT US SECTION
    $wp_customize->add_section('aboutus_section', [
        'title'    => __('About Us Section', 'sage'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('aboutus_title', [
        'default'           => 'About Us',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('aboutus_title', [
        'label'   => __('Title', 'sage'),
        'section' => 'aboutus_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('aboutus_subtitle', [
        'default'           => 'A Breath of Fresh Air',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('aboutus_subtitle', [
        'label'   => __('Subtitle', 'sage'),
        'section' => 'aboutus_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('aboutus_description', [
        'default'           => 'Nestled in the tranquil countryside of Củ Chi, The Downtown Cuchi offers an idyllic retreat where lush greenery and open spaces replace the concrete jungle. It’s the perfect destination to disconnect from your daily routine and reconnect with nature. Imagine waking up to the sound of chirping birds, surrounded by breathtaking views of the countryside — a refreshing way to start your day.',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('aboutus_description', [
        'label'   => __('Description', 'sage'),
        'section' => 'aboutus_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('aboutus_image_1', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'aboutus_image_1_control', [
        'label'    => __('Header Image', 'sage'),
        'section'  => 'aboutus_section',
        'settings' => 'aboutus_image_1',
    ]));
    $wp_customize->add_setting('aboutus_image_2', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'aboutus_image_2_control', [
        'label'    => __('Header Image', 'sage'),
        'section'  => 'aboutus_section',
        'settings' => 'aboutus_image_2',
    ]));
    $wp_customize->add_setting('aboutus_image_3', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'aboutus_image_3_control', [
        'label'    => __('Header Image', 'sage'),
        'section'  => 'aboutus_section',
        'settings' => 'aboutus_image_3',
    ]));

    // MEET THE TEAM SECTION
    $wp_customize->add_section('meettheteam_section', [
        'title'    => __('Meet the Team Section', 'sage'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('meettheteam_title', [
        'default'           => 'Meet',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('meettheteam_title', [
        'label'   => __('Title emphasis', 'sage'),
        'section' => 'meettheteam_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('meettheteam_title_emphasis', [
        'default'           => 'THE TEAM',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('meettheteam_title_emphasis', [
        'label'   => __('Title', 'sage'),
        'section' => 'meettheteam_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('meettheteam_subtitle', [
        'default'           => 'Danielle Nguyen',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('meettheteam_subtitle', [
        'label'   => __('Subtitle', 'sage'),
        'section' => 'meettheteam_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('meettheteam_description', [
        'default'           => 'Nestled in the tranquil countryside of Củ Chi, The Downtown Cuchi offers an idyllic retreat where lush greenery and open spaces replace the concrete jungle. It’s the perfect destination to disconnect from your daily routine and reconnect with nature. Imagine waking up to the sound of chirping birds, surrounded by breathtaking views of the countryside — a refreshing way to start your day.',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('meettheteam_description', [
        'label'   => __('Description', 'sage'),
        'section' => 'meettheteam_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('meettheteam_button_text', [
        'default'           => 'Call Us',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('meettheteam_button_text', [
        'label'   => __('Button text', 'sage'),
        'section' => 'meettheteam_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('meettheteam_image_1', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'meettheteam_image_1_control', [
        'label'    => __('Image 1', 'sage'),
        'section'  => 'meettheteam_section',
        'settings' => 'meettheteam_image_1',
    ]));
    $wp_customize->add_setting('meettheteam_image_2', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'meettheteam_image_2_control', [
        'label'    => __('Image 2', 'sage'),
        'section'  => 'meettheteam_section',
        'settings' => 'meettheteam_image_2',
    ]));
    $wp_customize->add_setting('meettheteam_image_3', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'meettheteam_image_3_control', [
        'label'    => __('Image 3', 'sage'),
        'section'  => 'meettheteam_section',
        'settings' => 'meettheteam_image_3',
    ]));


    // CONTACT US FORM SECTION
    $wp_customize->add_section('contactusform_section', [
        'title'    => __('Contact Us Form Section', 'sage'),
        'priority' => 30,
    ]);
    $wp_customize->add_setting('contactusform_title', [
        'default'           => 'Contact Us Form',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('contactusform_title', [
        'label'   => __('Title', 'sage'),
        'section' => 'contactusform_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('contactusform_name_placeholder', [
        'default'           => 'Your Name',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('contactusform_name_placeholder', [
        'label'   => __('Name Placeholder', 'sage'),
        'section' => 'contactusform_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('contactusform_phone_placeholder', [
        'default'           => 'Your Phone Number',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('contactusform_phone_placeholder', [
        'label'   => __('Phone Placeholder', 'sage'),
        'section' => 'contactusform_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('contactusform_email_placeholder', [
        'default'           => 'Your Email',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('contactusform_email_placeholder', [
        'label'   => __('Email Placeholder', 'sage'),
        'section' => 'contactusform_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('contactusform_note_placeholder', [
        'default'           => 'Tell Us ...',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('contactusform_note_placeholder', [
        'label'   => __('Note Placeholder', 'sage'),
        'section' => 'contactusform_section',
        'type'    => 'text',
    ]);
    $wp_customize->add_setting('contactusform_button_text', [
        'default'           => 'Submit',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('contactusform_button_text', [
        'label'   => __('Button text', 'sage'),
        'section' => 'contactusform_section',
        'type'    => 'text',
    ]);

});





