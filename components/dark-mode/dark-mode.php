<?php
/**
 * Dark Mode Toggle Component
 *
 * Можно вызывать в любом месте темы через функцию wp_start_dark_mode_toggle()
 */

function wp_start_dark_mode_toggle()
{
  echo '<button            
            class="cursor-pointer dark-mode-toggle flex items-center justify-center w-12 h-12 p-2  text-gray-900 dark:text-gray-100 transition-colors duration-300"
            aria-label="Toggle Dark Mode"
            data-light-icon="🌙"
            data-dark-icon="☀️"
          >
            🌙
          </button>';
}
?>