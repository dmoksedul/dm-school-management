<?php 
// Theme Title
add_theme_support('title-tag');
add_theme_support('post-thumbnails', array('page', 'post', 'message',));
add_theme_support('post-thumbnails',);
add_image_size( 'post_thumbnail', 970, 350, true );
// Enqueue scripts and styles
function enqueue_media_uploader() {
    if (is_admin()) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'enqueue_media_uploader');

?>