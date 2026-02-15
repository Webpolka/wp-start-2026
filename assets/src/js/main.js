// SASS
import '../scss/styles.scss';

// JS
import { initDarkMode } from '../../../components/dark-mode-toggle/dark-toggle';
import { initDesktopMenu } from '../../../components/menu/desktop-menu';
import { initMobileMenu } from '../../../components/menu/mobile-menu';

document.addEventListener('DOMContentLoaded', () => {
    initDarkMode();
    initDesktopMenu();
    initMobileMenu();
});