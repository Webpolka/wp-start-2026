// SASS
import '../scss/main.scss';

// JS
import { initDarkMode } from '@/components/dark-mode/dark-mode';
import { initDesktopMenu } from '@/components/menu/desktop-menu';
import { initMobileMenu } from '@/components/menu/mobile-menu';

document.addEventListener('DOMContentLoaded', () => {
    initDarkMode();
    initDesktopMenu();
    initMobileMenu();
});