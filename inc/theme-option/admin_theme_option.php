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
    require_once(get_template_directory() . '/inc/theme-option/theme_customize.php');
}



function dm_add_theme_management_menu() {
    add_menu_page(
        'DM Management', // Page title
        'DM Management',    // Menu title
        'manage_options',     // Capability required to access
        'dm_theme_management', // Menu slug
        'dm_image_slider_settings_page', // Callback function to display the page
        get_template_directory_uri().'/img/admin-logo.png',
        5 // Position in the menu (you can adjust this)
    );
    add_submenu_page( 
        'dm_theme_management',
        'Image Slider',
        'Image Slider',
        'manage_options',
        'dm_theme_management',
        'dm_image_slider_settings_page',
     );
    add_submenu_page( 
        'dm_theme_management',
        'Image Gallery',
        'Image Gallery',
        'manage_options',
        'dm-image-gallery-settings',
        'dm_image_gallery_settings_page',
     );
    add_submenu_page( 
        'dm_theme_management',
        'Notice',
        'Notice',
        'manage_options',
        'dm-notice',
        'dm_notice_page',
     );
    add_submenu_page( 
        'dm_theme_management',
        'Class Routine',
        'Class Routine',
        'manage_options',
        'dm-class-routine',
        'dm_class_routine_page',
     );
    add_submenu_page( 
        'dm_theme_management',
        'Exam Routine',
        'Exam Routine',
        'manage_options',
        'dm-exam-routine',
        'dm_exam_routine_page',
     );
    add_submenu_page( 
        'dm_theme_management',
        'Governing Members',
        'Governing Members',
        'manage_options',
        'dm-governing-members',
        'dm_governing_members_page',
     );
    add_submenu_page( 
        'dm_theme_management',
        'Staff Members',
        'Staff Members',
        'manage_options',
        'dm-staff-members',
        'dm_staff_members_page',
     );
     // Add the "Teachers" menu under "dm_theme_management" submenu
     
    // Remove the "Teachers" menu from the sidebar
    remove_menu_page('edit.php?post_type=dm_teacher');
    add_submenu_page(
        'dm_theme_management',  // Parent menu slug
        'Teachers',            // Page title
        'Teachers',            // Menu title
        'edit_posts',           // Capability (or any appropriate capability)
        'edit.php?post_type=dm_teacher' // Menu slug
    );

    // Remove the "message" menu from the sidebar
    remove_menu_page('edit.php?post_type=message');
    add_submenu_page(
        'dm_theme_management',  // Parent menu slug
        'Message',            // Page title
        'Message',            // Menu title
        'edit_posts',           // Capability (or any appropriate capability)
        'edit.php?post_type=message' // Menu slug
    );
    // Remove the "history" menu from the sidebar
    remove_menu_page('edit.php?post_type=history');
    add_submenu_page(
        'dm_theme_management',  // Parent menu slug
        'History',            // Page title
        'History',            // Menu title
        'edit_posts',           // Capability (or any appropriate capability)
        'edit.php?post_type=history' // Menu slug
    );
    // Remove the "dm-academic-details" menu from the sidebar
    remove_menu_page('edit.php?post_type=dm_academic_detail');
    add_submenu_page(
        'dm_theme_management',  // Parent menu slug
        'Academic Details',            // Page title
        'Academic Details',            // Menu title
        'edit_posts',           // Capability (or any appropriate capability)
        'edit.php?post_type=dm_academic_detail' // Menu slug
    );

}

add_action('admin_menu', 'dm_add_theme_management_menu');


