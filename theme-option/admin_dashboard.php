<?php
// Theme Dashboard Functons

function dm_add_theme_menu() {
    add_menu_page(
        'DM Theme Option', // Page title
        'DM School',    // Menu title
        'manage_options',     // Capability required to access
        'dm_theme_settings', // Menu slug
        'dm_theme_page', // Callback function to display the page
        get_template_directory_uri().'/img/admin-logo.png',
        99 // Position in the menu (you can adjust this)
    );
    add_submenu_page( 'dm_theme_settings', 'Theme Option', 'General', 'manage_options', 'dm_theme_settings', 'dm_theme_general_page' );

    add_submenu_page( 'dm_theme_settings', 'Theme Custom CSS', 'Custom CSS', 'manage_options', 'dm_custom_css', 'dm_theme_custom_css_page' );

    add_submenu_page( 'dm_theme_settings', 'Theme Custom JS', 'Custom JS', 'manage_options', 'dm_custom_js', 'dm_theme_custom_js_page' );
}

add_action('admin_menu', 'dm_add_theme_menu');

function dm_theme_page() {

}

function dm_theme_general_page() {
    //General Theme Page
    require_once(get_template_directory() . '/theme-option/general.php');
}

function dm_theme_custom_css_page() {
    //General Custom CSS Page
    require_once(get_template_directory() . '/theme-option/custom-css.php');
}

function dm_theme_custom_js_page() {
    //General Custom JS Page
    require_once(get_template_directory() . '/theme-option/custom-js.php');
}



?>