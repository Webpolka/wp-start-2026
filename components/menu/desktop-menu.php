<?php
function wp_start_desktop_menu($menu_location = 'primary')
{
    if (has_nav_menu($menu_location)) {
        wp_nav_menu([
            'theme_location' => $menu_location,
            'menu_class' => 'flex flex-col md:flex-row md:space-x-6',
            'container' => false,
            'walker' => new Tailwind_Desktop_Navwalker(),
        ]);
    }
}

class Tailwind_Desktop_Navwalker extends Walker_Nav_Menu
{

    // Начало уровня   
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);

        // первый dropdown (из хедера)
        if ($depth === 0) {
            $submenu_classes = '
    absolute left-0 top-full mt-2
    bg-white shadow-lg rounded min-w-[220px] z-50
    opacity-0 invisible pointer-events-none
    transition-all duration-200
    ';
        }

        // вложенные уровни
        else {
            $submenu_classes = '
    absolute top-0 left-full ml-0
    bg-white shadow-lg rounded min-w-[220px] z-50
    opacity-0 invisible pointer-events-none
    transition-all duration-200
    ';
        }

        $output .= "\n$indent<ul class=\"$submenu_classes\">\n";
    }

    // Конец уровня
    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    // Начало элемента
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $has_children = in_array('menu-item-has-children', $item->classes);
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = implode(' ', $item->classes);

        //  ВАЖНО: разные group уровни
        if ($has_children) {
            if ($depth === 0) {
                $classes .= ' group/menu relative';
            } else {
                $classes .= ' group/sub relative';
            }
        }

        if ($depth === 0) {
            $li_classes = 'px-2 py-2';
        } else {
            $li_classes = 'relative';
        }

        $output .= $indent . '<li class="' . esc_attr($classes . ' ' . $li_classes) . '">';

        $attributes = '';
        if (!empty($item->url)) {
            $attributes .= ' href="' . esc_attr($item->url) . '"';
        }

        if ($depth === 0) {
            $link_classes = 'block text-white hover:text-white/80 transition-colors duration-200';
        } else {
            $link_classes = 'block text-black hover:bg-gray-100 px-4 py-2 rounded transition-colors duration-150 whitespace-nowrap';
        }

        $attributes .= ' class="' . $link_classes . '"';

        $title = apply_filters('the_title', $item->title, $item->ID);

        $output .= '<a' . $attributes . '>' . $title . '</a>';
    }


    // Конец элемента
    function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= "</li>\n";
    }
}
?>