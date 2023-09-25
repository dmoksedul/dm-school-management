<?php
// Menu Register
register_nav_menu( 'header_menu',__('Header Menu', 'dmoksedul'));

?>
<?php
// Custom Walker class
class Custom_Submenu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="sub-menu">';
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $current_menu_class = in_array('current-menu-item', $classes) ? ' current-menu-item' : '';

        if (in_array('menu-item-has-children', $classes)) {
            $output .= '<li id="menu-item-' . $item->ID . '"';
            $output .= ' class="menu-item-has-children' . $current_menu_class . '"';
            $output .= '>';
            $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        } else {
            $output .= '<li id="menu-item-' . $item->ID . '"';
            $output .= ' class="' . $current_menu_class . '"';
            $output .= '>';
            $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        }
        if (in_array('menu-item-has-children', $classes)) {
            $output .= '<i id="dropdownToggler" class="fas fa-angle-down"></i>';
        }
    }
}
?>



