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

// link list custom menu
function dm_menu_shortcode($atts) {
    $atts = shortcode_atts(array(
        'name' => '',        // Default menu name is empty.
        'menu_class' => '',  // Custom class for the menu container.
        'ul_class' => 'dm_link_list', // Custom class for the <ul> element.
    ), $atts);

    // Check if a menu name is provided.
    if (empty($atts['name'])) {
        return 'Please specify a menu name.';
    }

    // Get the menu by name.
    $menu = wp_get_nav_menu_object($atts['name']);

    // Check if the menu exists.
    if (!$menu) {
        return 'Menu not found.';
    }

    // Build an array of arguments for wp_nav_menu() with custom classes.
    $menu_args = array(
        'menu' => $menu->term_id,
        'menu_class' => 'menu ' . esc_attr($atts['menu_class']), // Custom class for the menu container.
        'container' => false, // Do not wrap the menu in a container div.
        'items_wrap' => '<ul class="%1$s ' . esc_attr($atts['ul_class']) . '">%3$s</ul>', // Custom class for the <ul> element.
        'walker' => new Link_Menu_Walker(),
    );

    // Generate the menu using wp_nav_menu().
    ob_start();
    wp_nav_menu($menu_args);
    $output = ob_get_clean();
    ?>
    <style>
    .dm_link_list {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: start;
        gap: 5px;
    }
    .dm_link_list li{
    list-style: none;
    }
    .dm_link_list li a{
        color: #000;
        transition: all 0.5s;
        font-weight:500;
    }
    .dm_link_list li a i{
        transition: all 0.5s;
    }
    .dm_link_list li a:hover i{
        margin-right: 5px;
    }
    .dm_link_list li a:hover{
        color: var(--dm_primary_color)
    }
    </style>
    <?php
    return $output;
}
add_shortcode('dm_menu', 'dm_menu_shortcode');

// Define a custom menu walker class to add custom elements and classes.
class Link_Menu_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $output .= '<li>';
        $output .= '<a href="' . esc_url($item->url) . '"><i class="fas fa-caret-right"></i> ' . esc_html($item->title) . '</a>';
    }

    // Add your custom walker functions if needed.
}







?>