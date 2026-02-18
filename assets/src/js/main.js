// SASS
import '../scss/main.scss';
import '../tailwind.css';

// JS
import { WPCustomizer } from './modules/customizer';
import { initDarkMode } from '@/components/dark-mode/dark-mode';
import { initDesktopMenu } from '@/components/menu/desktop-menu';
import { initMobileMenu } from '@/components/menu/mobile-menu';

document.addEventListener('DOMContentLoaded', () => {
    // Подключаем кастомайзер
    if (window.wp && wp.customize) WPCustomizer(jQuery);

    // Скрипты
    initDarkMode();
    initDesktopMenu();
    initMobileMenu();
});