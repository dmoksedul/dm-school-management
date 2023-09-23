<?php
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
// Fontawesome
function dm_fontawesome_icon(){
    wp_enqueue_style( 'dm_googledm_fontawesome_icon_fonts', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', false );
}
add_action('wp_enqueue_scripts', 'dm_fontawesome_icon');
?>