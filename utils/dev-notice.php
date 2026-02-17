<?php
// ---------------------------------------------------
// Dev Mode Notice с проверкой Vite
// ---------------------------------------------------
function wp_dev_mode_notice() {
    // Показываем баннер только если development
    if (defined('WP_ENV') && WP_ENV === 'development') {

        // Проверяем: подключён ли уже vite dev скрипт?
        $vite_dev_url = 'http://localhost:5173/@vite/client';
        $vite_running = @file_get_contents($vite_dev_url);

        // Если Vite dev сервер недоступен, показываем баннер
        if ($vite_running === false) {
            ?>
            <script>
                // Сообщение в консоль
                console.log('%c⚠ DEV MODE ACTIVE ⚠', 'background: #ff0; color: #000; font-weight: bold; padding: 2px 6px;');

                // Баннер на странице
                const devBanner = document.createElement('div');
                devBanner.style.position = 'fixed';
                devBanner.style.bottom = '0';
                devBanner.style.left = '0';
                devBanner.style.width = '100%';
                devBanner.style.background = '#ff0';
                devBanner.style.color = '#000';
                devBanner.style.fontWeight = 'bold';
                devBanner.style.textAlign = 'center';
                devBanner.style.padding = '16px 0';
                devBanner.style.zIndex = '9999';
                devBanner.style.fontFamily = 'sans-serif';
                devBanner.textContent = '⚠ DEV MODE: Установите зависимости и запустите `npm run dev` ⚠';
                document.body.appendChild(devBanner);
            </script>
            <?php
        }
    }
}
add_action('wp_footer', 'wp_dev_mode_notice');
