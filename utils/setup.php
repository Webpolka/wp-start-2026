<?php
/**
 * Starter theme functions and definitions – minimal, modern.
 *
 * @package wp_start_2026
 *
 * Theme setup.
 */
function wp_start_2026_setup()
{
    // Локализация
    load_theme_textdomain('wp_start_2026', get_template_directory() . '/languages');

    // WP управляет <title>
    add_theme_support('title-tag');

    // Миниатюры постов
    add_theme_support('post-thumbnails');

    // Меню
    add_theme_support('menus');

    // HTML5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Меню
    register_nav_menus([
        'primary' => __('Primary Menu', 'wp_start_2026'),
        'footer' => __('Footer Menu', 'wp_start_2026'),
        'mobile' => __('Mobile Menu', 'wp_start_2026'),
    ]);


    // Custom logo
    add_theme_support('custom-logo', [
        'width' => 150,
        'height' => 50,        
        'flex-width' => true,
        'flex-height' => true,
    ]);

    // Selective refresh для виджетов
    add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'wp_start_2026_setup');

/**
 * Content width
 */
function wp_start_2026_content_width()
{
    $GLOBALS['content_width'] = apply_filters('wp_start_2026_content_width', 1440);
}
add_action('after_setup_theme', 'wp_start_2026_content_width', 0);

/**
 * Register sidebar
 */
function wp_start_2026_widgets_init()
{
    register_sidebar([
        'name' => esc_html__('Sidebar', 'wp_start_2026'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'wp_start_2026'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ]);
}
add_action('widgets_init', 'wp_start_2026_widgets_init');