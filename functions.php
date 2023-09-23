<?php
/*
* Theme functions here
*/

// Theme Title
add_theme_support('title-tag');

// css and js file calling
function dm_css_js_file_calling(){
    // css stylesheet
    wp_enqueue_style( 'dm-style', get_stylesheet_uri());
    wp_register_style( 'bootstrap', get_template_directory_uri(  ).'/css/bootstrap.css', array(), '5.0.2', 'all' );
    wp_enqueue_style('bootstrap');
    wp_register_style( 'custom', get_template_directory_uri(  ).'/css/custom.min.css', array(),'1.0.0', 'all' );
    wp_enqueue_style('custom');
    // js script
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.js', array(), '5.0.2', 'true');
    wp_enqueue_script('main', get_template_directory_uri().'/js/main.js', array(), '1.0.0', 'true');
}

add_action('wp_enqueue_scripts' ,  'dm_css_js_file_calling');

// Google fonts
function dm_google_fonts(){
    wp_enqueue_style( 'dm_google_fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', false );
}
add_action('wp_enqueue_scripts', 'dm_google_fonts');
// Theme functions
function dm_customizer_register($wp_customize){
    $wp_customize->add_section('dm_header_area', array(
        'title' =>__('Header Area', 'dmoksedul'),
        'description' => 'Cusomize your header area.'
    ));
    $wp_customize->add_setting('dm_logo', array(
        'default' => get_bloginfo('template_directory'). '/img/logo.png',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'dm_logo', array(
        'label' => 'Banner Upload',
        'description' => 'If you are interested change your log you can do it.',
        'setting' => 'dm_logo',
        'section' => 'dm_header_area',
    )));

}
add_action('customize_register', 'dm_customizer_register');

// Menu Register
register_nav_menu( 'header_menu',__('Header Menu', 'dmoksedul'));