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
    echo '<div class="wrap">';
    echo '<h2>DM School Management</h2>';
    bloginfo( 'name' );
    echo '</div>';
}

function dm_theme_custom_css_page() {
    echo '<div class="wrap">';
    echo '<h2>DM Custom CSS</h2>';
    echo '</div>';
}

function dm_theme_custom_js_page() {
    echo '<div class="wrap">';
    echo '<h2>DM Custom JS</h2>';
    echo '</div>';
}



?>