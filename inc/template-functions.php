<?php
/**
 * template-functions.php
 *
 * Все полезные функции для темы WP 2026
 *
 * @package wp_start_2026
 */

/*---------------------------------------------------
| 1. Body Classes
---------------------------------------------------*/
function wp_start_body_classes( $classes ) {
    if ( is_admin_bar_showing() ) {
        $classes[] = 'has-admin-bar';
    }
    if ( is_404() ) {
        $classes[] = 'page-404';
    }
    return $classes;
}
add_filter( 'body_class', 'wp_start_body_classes' );

/*---------------------------------------------------
| 2. Disable WP Emojis
---------------------------------------------------*/
function wp_start_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'wp_start_disable_emojis' );

/*---------------------------------------------------
| 3. Remove WP version
---------------------------------------------------*/
function wp_start_remove_wp_version() {
    remove_action( 'wp_head', 'wp_generator' );
}
add_action( 'init', 'wp_start_remove_wp_version' );

/*---------------------------------------------------
| 4. Async / Defer JS Loader
---------------------------------------------------*/
function wp_start_script_loader_tag( $tag, $handle, $src ) {
    $deferable = array( 'main-js', 'vendor-js' );
    if ( in_array($handle, $deferable) ) {
        return '<script src="' . esc_url($src) . '" defer></script>' . "\n";
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'wp_start_script_loader_tag', 10, 3 );

/*---------------------------------------------------
| 5. Lazy-load YouTube iframe
---------------------------------------------------*/
add_filter('embed_oembed_html', function($html) {
    return str_replace('<iframe', '<iframe loading="lazy"', $html);
});

/*---------------------------------------------------
| 6. Enable SVG Upload
---------------------------------------------------*/
add_filter('upload_mimes', function($mimes){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

/*---------------------------------------------------
| 7. Disable REST API if не используется
---------------------------------------------------*/
add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');
remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');

/*---------------------------------------------------
| 8. Remove jQuery Migrate
---------------------------------------------------*/
add_action( 'wp_default_scripts', function( $scripts ) {
    if ( ! is_admin() && isset($scripts->registered['jquery']) ) {
        $scripts->registered['jquery']->deps = array_diff(
            $scripts->registered['jquery']->deps,
            ['jquery-migrate']
        );
    }
});

/*---------------------------------------------------
| 9. Disable WP Embeds
---------------------------------------------------*/
remove_action('wp_head', 'wp_oembed_add_host_js');
