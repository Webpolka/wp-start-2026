<?php
function wp_start_mobile_menu($menu_location = 'primary') {
    if (has_nav_menu($menu_location)) {
        wp_nav_menu([
            'theme_location' => $menu_location,
            'menu_class' => 'flex flex-col space-y-1',
            'container' => false,
            'walker' => new Mobile_Accordion_Walker(),
        ]);
    }
}


class Mobile_Accordion_Walker extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        // подменю скрыто через hidden
        $output .= "\n$indent<ul class=\"submenu flex flex-col space-y-1 hidden transition-all duration-300 ease-in-out\">\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $has_children = in_array('menu-item-has-children', (array) $item->classes);
        $indent = str_repeat("\t", $depth);
        $output .= $indent . '<li class="' . esc_attr(implode(' ', (array)$item->classes)) . '">';

        $attributes = !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="flex justify-between items-center py-2 px-3 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors"';

        $title = esc_html(apply_filters('the_title', $item->title, $item->ID));
        $output .= '<a' . $attributes . '>';
        $output .= '<span>' . $title . '</span>';

        if ($has_children) {
            $output .= '<span class="accordion-toggle transform transition-transform duration-300 ml-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </span>';
        }

        $output .= '</a>';
    }

    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }
}

