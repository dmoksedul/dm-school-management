<?php 
// Theme Title
add_theme_support('title-tag');
add_theme_support('post-thumbnails');

add_theme_support('post-thumbnails', array('page', 'post', 'message'));
add_theme_support('post-thumbnails',);
add_image_size( 'post-thumbnails', 350, false );
// Enqueue scripts and styles
function enqueue_media_uploader() {
    if (is_admin()) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'enqueue_media_uploader');

// Pagenav Function
function dm_pagenav(){
    global $wp_query, $wp_rewrite;
    $pages ='';
    $max = $wp_query->max_num_pages;
    if(!$current = get_query_var('paged')) $current = 1;
    $args['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
    $args['total'] = $max;
    $args['current'] = $current;
    $total = 1;
    $args['prev_text'] = 'Prev';
    $args['next_text'] = 'Next';
    if ($max > 1) echo '</pre>
      <div class="wp_pagenav">';
        // if ($total == 1 && $max > 1) $pages = '<p class="pages"> Page ' .$current . '<span>of</span>' . $max . '</p>';
        echo $pages . paginate_links($args);
        if ($max > 1 ) echo '</div><pre>';
  }
  // Hide the WordPress admin bar for all users
add_filter('show_admin_bar', '__return_false');
// Hide the admin bar for specific user roles (e.g., subscribers)
function hide_admin_bar_for_subscribers() {
    if (current_user_can('subscriber')) {
        show_admin_bar(false);
    }
}
add_action('wp_loaded', 'hide_admin_bar_for_subscribers');

?>