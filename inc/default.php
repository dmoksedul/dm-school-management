<?php 
// Theme Title

add_theme_support('title-tag');
// Theme Check Support 
add_theme_support( 'automatic-feed-links' );
add_theme_support( "wp-block-styles" );
add_theme_support( "responsive-embeds" );
add_theme_support( 'html5', array(
    // Any or all of these.
    'comment-list', 
    'comment-form',
    'search-form',
    'gallery',
    'caption',
) );

add_theme_support('post-thumbnails', array('page', 'post', 'message',));
add_theme_support('post-thumbnails',);
add_image_size( 'post-thumbnails', 970, false );
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
  $max = $wp_query->max_num_pages;
  if(!$current = get_query_var('paged')) $current = 1;
  $args['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $args['total'] = $max;
  $args['current'] = $current;
  $args['prev_text'] = 'Prev';
  $args['next_text'] = 'Next';

  // Calculate the number of page numbers to show
  $num_pages_to_show = 5;

  echo '<div class="wp_pagenav">';
  
  // Display "Prev" button
  if ($current > 1) {
      echo '<a class="page-numbers prev" href="' . esc_url(get_pagenum_link($current - 1)) . '">' . $args['prev_text'] . '</a>';
  }

  // Calculate the start and end page numbers
  $start_page = max(1, $current - floor($num_pages_to_show / 2));
  $end_page = min($max, $start_page + $num_pages_to_show - 1);

  // Display page numbers within the range
  for ($i = $start_page; $i <= $end_page; $i++) {
      if ($current == $i) {
          echo '<span class="page-numbers current">' . $i . '</span>';
      } else {
          echo '<a class="page-numbers" href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a>';
      }
  }

  // Display "Next" button or the last numbers
  if ($current < $max) {
      if ($max - $current >= $num_pages_to_show) {
          echo '<a class="page-numbers dots">...</a>';
          $start_page = $max - $num_pages_to_show + 1;
          $end_page = $max;
      }
      echo '<a class="page-numbers next" href="' . esc_url(get_pagenum_link($current + 1)) . '">' . $args['next_text'] . '</a>';
  }

  echo '</div>';
}

?>