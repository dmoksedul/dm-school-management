<?php
// Theme functions
// function dm_customizer_register($wp_customize){
//     // header area
//     $wp_customize->add_section('dm_header_area', array(
//         'title' =>__('Header Area', 'dmoksedul'),
//         'description' => 'Cusomize your header area.'
//     ));
//     $wp_customize->add_setting('dm_logo', array(
//         'default' => get_bloginfo('template_directory'). '/img/logo.png',
//     ));
//     $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'dm_logo', array(
//         'label' => 'Banner Upload',
//         'description' => 'If you are interested change your log you can do it.',
//         'setting' => 'dm_logo',
//         'section' => 'dm_header_area',
//     )));

// }
// add_action('customize_register', 'dm_customizer_register');


function dm_theme_color_cus(){
  ?>
  <style>
    body{background: <?php echo get_option('dm_bg_color', '#fff'); ?>}
    :root{ 
        --dm_top_header_color:<?php echo get_option('dm_top_header_color', '#056839'); ?>;
        --dm_banner_color:<?php echo get_option('dm_banner_color', '#003517'); ?>;
        --dm_primary_color:<?php print get_option('dm_primary_color', '#056839'); ?>;
        --dm_secondary_color:<?php echo get_option('dm_secondary_color', '#012330'); ?>;
        --dm_menu_color:<?php echo get_option('dm_menu_color', '#ffffff'); ?>;
        --dm_menu_bg_color:<?php echo get_option('dm_menu_bg_color', '#056839'); ?>;
        --dm_heading_color:<?php echo get_option('dm_heading_color', '#000000'); ?>;
        --dm_text_color:<?php echo get_option('dm_text_color', '#000000'); ?>;
        --dm_link_color:<?php echo get_option('dm_link_color', '#056839'); ?>;
        --dm_link_hover_color:<?php echo get_option('dm_link_hover_color', '#ff0000'); ?>;
        --dm_button_color:<?php echo get_option('dm_button_color', '#ffffff'); ?>;
        --dm_button_hover_color:<?php echo get_option('dm_button_hover_color', '#ffffff'); ?>;
        --dm_button_bg_color:<?php echo get_option('dm_button_bg_color', '#056839'); ?>;
        --dm_button_bg_hover_color:<?php echo get_option('dm_button_bg_hover_color', '#ff0000'); ?>;
        --dm_white_color:<?php echo get_option('dm_white_color', '#ffffff'); ?>;
    
    }
  </style>
  <?php 
}
add_action('wp_head', 'dm_theme_color_cus');

