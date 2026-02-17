<?php

// ---------------------------------------------------
// ENV
// ---------------------------------------------------
if (!defined('WP_ENV')) {
    define('WP_ENV', 'development'); // по умолчанию development
}

// ---------------------------------------------------
// Отключаем админбар (при желании)
// ---------------------------------------------------
// add_filter('show_admin_bar', fn($show) => false);

// ---------------------------------------------------
// Поддержка темы
// ---------------------------------------------------
add_theme_support('title-tag');       // title
add_theme_support('post-thumbnails'); // миниатюры
add_theme_support('menus');           // меню

// ---------------------------------------------------
// Регистрация местоположений меню
// ---------------------------------------------------
function wp_start_register_menus() {
    register_nav_menus([
        'primary' => __('Primary Menu', 'wp_start_2026'),
        'footer'  => __('Footer Menu', 'wp_start_2026'),
        'mobile'  => __('Mobile Menu', 'wp_start_2026'),
    ]);
}
add_action('after_setup_theme', 'wp_start_register_menus');

// ---------------------------------------------------
// Подключение базового стиля (style.css)
// ---------------------------------------------------
function my_theme_enqueue_styles() {
    wp_enqueue_style('my-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// ---------------------------------------------------
// Подключение JS и CSS через Vite / Manifest
// ---------------------------------------------------
function theme_assets() {

    // DEV режим
    if (WP_ENV === 'development') {
        echo '<script type="module" src="http://localhost:5173/@vite/client"></script>';
        echo '<script type="module" src="http://localhost:5173/assets/src/js/main.js"></script>';
        return;
    }

    // PROD режим
    $manifest_path = get_template_directory() . '/assets/dist/.vite/manifest.json';

    if (!file_exists($manifest_path)) return;

    $manifest = json_decode(file_get_contents($manifest_path), true);

    if (!isset($manifest['assets/src/js/main.js'])) return;

    $entry = $manifest['assets/src/js/main.js'];

    // CSS
    if (isset($entry['css']) && count($entry['css']) > 0) {
        foreach ($entry['css'] as $cssFile) {
            echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/assets/dist/' . $cssFile . '">';
        }
    }

    // JS
    echo '<script type="module" src="' . get_template_directory_uri() . '/assets/dist/' . $entry['file'] . '"></script>';
}
add_action('wp_head', 'theme_assets');



// ---------------------------------------------------
// Load theme includes.
// ---------------------------------------------------

// require_once get_template_directory() . '/inc/helper.php';
// require_once get_template_directory() . '/inc/class-underwind-navwalker.php';
// require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/template-tags.php';
// require_once get_template_directory() . '/inc/customizer.php';
// require_once get_template_directory() . '/inc/custom-header.php';
/*require_once get_template_directory() . '/inc/woocommerce.php';*/ // phpcs:ignore Squiz.PHP.CommentedOutCode.Found
// require_once get_template_directory() . '/inc/vite.php';




// ---------------------------------------------------
// Import utils & components
// ---------------------------------------------------

// Utils
include_once get_template_directory() . '/utils/svg.php';
include_once get_template_directory() . '/utils/dev-notice.php';

// Components
include_once get_template_directory() . '/components/dark-mode/dark-mode.php';
include_once get_template_directory() . '/components/menu/desktop-menu.php';
include_once get_template_directory() . '/components/menu/mobile-menu.php';
