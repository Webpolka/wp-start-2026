<?php
// ---------------------------------------------------
// Подключение JS и CSS через Vite / Manifest
// ---------------------------------------------------
function theme_assets() {

    // DEV режим
    if (WP_ENV === 'dev') {
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

