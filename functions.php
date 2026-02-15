<?php

// add_filter('show_admin_bar', function($show){
//     return false;
// });

// включаем поддержку title
add_theme_support('title-tag');

// поддержка миниатюр
add_theme_support('post-thumbnails');

// меню
add_theme_support('menus');


// Регистрация местоположений меню
function wp_start_register_menus() {
    register_nav_menus([
        'primary'   => __('Primary Menu', 'wp-start-2026'),
        'footer'    => __('Footer Menu', 'wp-start-2026'),
        'mobile'    => __('Mobile Menu', 'wp-start-2026'),
    ]);
}
add_action('after_setup_theme', 'wp_start_register_menus');


// Подключаем стили
function my_theme_enqueue_styles() {
    wp_enqueue_style('my-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');


// Режим разработки или продакшн    

define('DEV', true); // true = разработка | false = прод

function theme_assets() {

    //  DEV режим
    if (DEV) {
        echo '<script type="module" src="http://localhost:5173/@vite/client"></script>';
        echo '<script type="module" src="http://localhost:5173/assets/src/js/main.js"></script>';
        return;
    }

    // PROD режим
    $manifest_path = get_template_directory() . '/assets/dist/manifest.json';

    if (!file_exists($manifest_path)) return;

    $manifest = json_decode(file_get_contents($manifest_path), true);

    $entry = $manifest['assets/src/js/main.js'];

    // CSS
    if (isset($entry['css'][0])) {
        echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/assets/dist/'.$entry['css'][0].'">';
    }

    // JS
    echo '<script type="module" src="'.get_template_directory_uri().'/assets/dist/'.$entry['file'].'"></script>';
}

add_action('wp_head', 'theme_assets');



// Import modules
include_once get_template_directory() . '/components/dark-mode-toggle/dark-toggle.php';
include_once get_template_directory() . '/components/menu/desktop-menu.php';
include_once get_template_directory() . '/components/menu/mobile-menu.php';

