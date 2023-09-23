<?php
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
?>