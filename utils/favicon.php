<?php

// ---------------------------------------------------
// Убираем Site Icon из кастомайзера
// ---------------------------------------------------
add_action('customize_register', function ($wp_customize) {
    $wp_customize->remove_setting('site_icon');
    $wp_customize->remove_control('site_icon');
});

// ---------------------------------------------------
// Полное отключение favicon WordPress
// ---------------------------------------------------
add_action('init', function () {

    // убираем вывод WP favicon
    remove_action('wp_head', 'wp_site_icon', 99);
    remove_action('admin_head', 'wp_site_icon');
    remove_action('login_head', 'wp_site_icon');

    // убираем поддержку theme favicon
    remove_theme_support('site-icon');

    // удаляем из базы если вдруг осталась
    if (get_option('site_icon')) {
        delete_option('site_icon');
    }
});

// ---------------------------------------------------
// Кастомная favicon для админки и логина
// ---------------------------------------------------
add_action('admin_head', 'theme_custom_favicon');
add_action('login_head', 'theme_custom_favicon');

function theme_custom_favicon() {
    $uri = get_template_directory_uri() . '/assets/src/favicons/';
    ?>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $uri; ?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $uri; ?>favicon-16x16.png">
    <?php
}
