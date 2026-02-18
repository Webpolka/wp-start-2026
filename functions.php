<?php
// ---------------------------------------------------
// ENV
// ---------------------------------------------------
if (!defined('WP_ENV')) {
    define('WP_ENV', 'dev'); // по умолчанию development
}
if ( ! defined( '_S_VERSION' ) ) {
    define( '_S_VERSION', '1.0.0' );
}
// ---------------------------------------------------
// Отключаем админбар (при желании)
// ---------------------------------------------------
// add_filter('show_admin_bar', fn($show) => false);

// ---------------------------------------------------
// Подключаем кастомные продвинутые фавикон и отключаем дефолтные 
// (убедись что новые сгенерированы в папке assets/src/favicons)
// ---------------------------------------------------
require_once get_template_directory() . '/utils/favicon.php';

// ---------------------------------------------------
// Логика подключения скриптов и стилей для DEV или PROD режимов 
// ---------------------------------------------------
require_once get_template_directory() . '/utils/vite.php';

// ---------------------------------------------------
// Утилита для использования SVG спрайтов в коде
// ---------------------------------------------------
include_once get_template_directory() . '/utils/svg.php';

// ---------------------------------------------------
// Предупреждение ! Если в DEV режиме сервер разрабоотки не запущен
// ---------------------------------------------------
include_once get_template_directory() . '/utils/dev-notice.php';

// ---------------------------------------------------
// Инициализация (локализация, меню, виджеты, тумбнейлы, и др.)
// ---------------------------------------------------
require_once get_template_directory() . '/utils/setup.php';

// ---------------------------------------------------
// Load theme includes.
// ---------------------------------------------------
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/customizer.php';

// ---------------------------------------------------
// Custom components
// ---------------------------------------------------
include_once get_template_directory() . '/components/dark-mode/dark-mode.php';
include_once get_template_directory() . '/components/menu/desktop-menu.php';
include_once get_template_directory() . '/components/menu/mobile-menu.php';
