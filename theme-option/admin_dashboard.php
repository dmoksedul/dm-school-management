<?php
// Theme Dashboard Functons

function dm_add_theme_menu() {
    add_menu_page(
        'DM Theme Option', // Page title
        'DM Theme Option',    // Menu title
        'manage_options',     // Capability required to access
        'dm_theme_settings', // Menu slug
        'dm_theme_page', // Callback function to display the page
        get_template_directory_uri().'/img/admin-logo.png',
        99 // Position in the menu (you can adjust this)
    );
    add_submenu_page( 'dm_theme_settings', 'Theme Customize', 'Customize', 'manage_options', 'dm_theme_settings', 'dm_theme_customize_page' );

}

add_action('admin_menu', 'dm_add_theme_menu');

function dm_theme_page() {

}

function dm_theme_customize_page() {
    //General Custom JS Page
    require_once(get_template_directory() . '/theme-option/theme_customize_page.php');
}

?>