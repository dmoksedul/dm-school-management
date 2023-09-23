<?php
// Theme functions
function dm_customizer_register($wp_customize){
    // header area
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

    // footer area
    $wp_customize->add_section('dm_footer_area', array(
        'title' =>__('Footer Area', 'dmoksedul'),
    ));
    $wp_customize->add_setting('dm_copyright', array(
        'default' => '© 2023 | Developed by dmoksedul',
    ));
    $wp_customize->add_control('dm_copyright', array(
        'label' => 'Copyright Text',
        'description' => 'If you are interested change your log you can do it.',
        'setting' => 'dm_copyright',
        'section' => 'dm_footer_area',
    ));

    // Theme Color Area
    $wp_customize->add_section('dm_theme_color', array(
        'title' =>__('Theme Color', 'dmoksedul'),
        'description' =>'If you need to change theme color you can change here.',
    ));
    // bg color area
    $wp_customize->add_setting('dm_bg_color', array(
        'default' => '#fff',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dm_bg_color', array(
        'label' => 'Background Color',
        'section' => 'dm_theme_color',
        'setting' => 'dm_bg_color',
    )));
    // top banner color area
    $wp_customize->add_setting('dm_banner_color', array(
        'default' => '#003517',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dm_banner_color', array(
        'label' => 'Banner Color',
        'section' => 'dm_theme_color',
        'setting' => 'dm_banner_color',
    )));
    // primary color area
    $wp_customize->add_setting('dm_primary_color', array(
        'default' => '#056839',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dm_primary_color', array(
        'label' => 'Primary Color',
        'section' => 'dm_theme_color',
        'setting' => 'dm_primary_color',
    )));
    // secondary color area
    $wp_customize->add_setting('dm_secondary_color', array(
        'default' => '#012330',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dm_secondary_color', array(
        'label' => 'Secondary Color',
        'section' => 'dm_theme_color',
        'setting' => 'dm_secondary_color',
    )));
    // heading color area
    $wp_customize->add_setting('dm_heading_color', array(
        'default' => '#000',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dm_heading_color', array(
        'label' => 'Heading Color (title)',
        'section' => 'dm_theme_color',
        'setting' => 'dm_heading_color',
    )));
    // text color area
    $wp_customize->add_setting('dm_text_color', array(
        'default' => '#0000',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dm_text_color', array(
        'label' => 'Text Color',
        'section' => 'dm_theme_color',
        'setting' => 'dm_text_color',
    )));
    // link color area
    $wp_customize->add_setting('dm_link_color', array(
        'default' => '#39835D',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dm_link_color', array(
        'label' => 'Link Color',
        'section' => 'dm_theme_color',
        'setting' => 'dm_link_color',
    )));
    // link hover color area
    $wp_customize->add_setting('dm_link_hover_color', array(
        'default' => '#ff0000',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dm_link_hover_color', array(
        'label' => 'Link Hover Color',
        'section' => 'dm_theme_color',
        'setting' => 'dm_link_hover_color',
    )));
    // button color area
    $wp_customize->add_setting('dm_button_color', array(
        'default' => '#fff',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dm_button_color', array(
        'label' => 'Button Color',
        'section' => 'dm_theme_color',
        'setting' => 'dm_button_color',
    )));
    // button hover color area
    $wp_customize->add_setting('dm_button_hover_color', array(
        'default' => '#fff',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dm_button_hover_color', array(
        'label' => 'Button Hover Color',
        'section' => 'dm_theme_color',
        'setting' => 'dm_button_hover_color',
    )));
    // button bg color area
    $wp_customize->add_setting('dm_button_bg_color', array(
        'default' => '#39835D',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dm_button_bg_color', array(
        'label' => 'Button BG Color',
        'section' => 'dm_theme_color',
        'setting' => 'dm_button_bg_color',
    )));
    // button hover color area
    $wp_customize->add_setting('dm_button_bg_hover_color', array(
        'default' => '#ff0000',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dm_button_bg_hover_color', array(
        'label' => 'Button BG Hover Color',
        'section' => 'dm_theme_color',
        'setting' => 'dm_button_bg_hover_color',
    )));
    // white color area
    $wp_customize->add_setting('dm_white_color', array(
        'default' => '#fff',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dm_white_color', array(
        'label' => 'White Color',
        'section' => 'dm_theme_color',
        'setting' => 'dm_white_color',
    )));

}
add_action('customize_register', 'dm_customizer_register');


function dm_theme_color_cus(){
  ?>
  <style>
    body{background: <?php echo get_theme_mod('dm_bg_color'); ?>}
    :root{ 
        --dm_banner_color:<?php echo get_theme_mod('dm_banner_color'); ?>;
        --dm_primary_color:<?php echo get_theme_mod('dm_primary_color'); ?>;
        --dm_secondary_color:<?php echo get_theme_mod('dm_secondary_color'); ?>;
        --dm_heading_color:<?php echo get_theme_mod('dm_heading_color'); ?>;
        --dm_text_color:<?php echo get_theme_mod('dm_text_color'); ?>;
        --dm_link_color:<?php echo get_theme_mod('dm_link_color'); ?>;
        --dm_link_hover_color:<?php echo get_theme_mod('dm_link_hover_color'); ?>;
        --dm_button_color:<?php echo get_theme_mod('dm_button_color'); ?>;
        --dm_button_hover_color:<?php echo get_theme_mod('dm_button_hover_color'); ?>;
        --dm_button_bg_color:<?php echo get_theme_mod('dm_button_bg_color'); ?>;
        --dm_button_bg_hover_color:<?php echo get_theme_mod('dm_button_bg_hover_color'); ?>;
        --dm_white_color:<?php echo get_theme_mod('dm_white_color'); ?>;
    
    }
  </style>
  <?php 
}
add_action('wp_head', 'dm_theme_color_cus');

