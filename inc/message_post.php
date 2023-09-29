<?php

function dm_message() {
  register_post_type('message',
    array(
      'labels' => array(
        'name' => __('DM Messages'),
        'singular_name' => __('Message'),
        'add_new' => __('Add New Message'),
        'add_new_item' => __('Add New Message'),
        'edit_item' => __('Edit Message'),
        'new_item' => __('New Message'),
        'view_item' => __('View Message'),
        'not_found' => __('Sorry, no messages found.'),
      ),
      'menu_icon' => 'dashicons-buddicons-pm',
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => true,
      'menu_position' => 5,
      'has_archive' => true,
      'hierarchical' => true,
      'show_ui' => true,
      'capability_type' => 'post',
      'rewrite' => array('slug' => 'message'),
      'supports' => array('title', 'thumbnail', 'editor'),
    )
  );

  // Add custom taxonomy 'designation' to the custom post type 'message'
  register_taxonomy('designation', 'message', array(
    'label' => __('Designation'),
    'rewrite' => array('slug' => 'designation'),
    'hierarchical' => true,
    'show_admin_column' => true,
  ));

  add_theme_support('post-thumbnails');
}

add_action('init', 'dm_message');

// Register custom image size
function custom_theme_image_sizes() {
  add_image_size('large-thumbnail', 400, 400, true);
}

add_action('after_setup_theme', 'custom_theme_image_sizes');

// Shortcode function to display messages
function custom_message_shortcode($atts) {
  // Default shortcode attributes
  $atts = shortcode_atts(array(
      'length' => 100,           // Default description length
      'limit' => -1,             // Default to display all messages
      'designation' => '',       // Default to show messages from all designations
      'designation_output' => true,  // Default to true, meaning it will show the designation
  ), $atts);

  // Query parameters
  $args = array(
      'post_type' => 'message',
      'posts_per_page' => $atts['limit'],
      'tax_query' => array(),
  );

  if (!empty($atts['designation'])) {
      $args['tax_query'][] = array(
          'taxonomy' => 'designation',
          'field' => 'slug',
          'terms' => $atts['designation'],
      );
  }

  $messages = new WP_Query($args);
  $post_count = 0; // Initialize post counter

  ob_start();

  if ($messages->have_posts()) :
      while ($messages->have_posts()) : $messages->the_post();
          $post_count++; // Increment post counter
          ?>
          <div class="dm_message_box">
              <?php if (has_post_thumbnail()) : ?>
                  <div class="message-thumbnail">
                      <?php the_post_thumbnail('large-thumbnail'); ?>
                  </div>
              <?php endif; ?>
              <h2><?php the_title(); ?></h2>
              <p><?php echo wp_trim_words(get_the_content(), $atts['length']); ?><a href="<?php the_permalink(); ?>" class="read-more">আরো পড়ুন </a></p>
              <!-- <?php
              if ($atts['designation_output']) {
                  $terms = get_the_terms(get_the_ID(), 'designation');
                  if ($terms && !is_wp_error($terms)) {
                      echo '<div class="designation">';
                      foreach ($terms as $term) {
                          echo '<span class="designation-term">' . esc_html($term->name) . '</span>';
                      }
                      echo '</div>';
                  }
              }
              ?> -->
          </div>
          <style>
.dm_message_box {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 4px;
    box-shadow: 0 0 10px #00000038;
}
			.message-thumbnail {
    width: 100%;
    padding: 20px;
    border-radius: 12px;
    overflow: hidden;
}.message-thumbnail img {
    width: 100% !important;
    border-radius: 5px;
}
.dm_message_box h2 {
    font-size: 25px;
    color: #056839;
}
.dm_message_box p {
    padding: 0px 15px;
}
.dm_message_box a.read-more {
    font-weight: 500;
}
</style>
          <?php
      endwhile;
  else :
      echo 'No messages found.';
  endif;

  wp_reset_postdata();

  return ob_get_clean();
}

add_shortcode('custom_message', 'custom_message_shortcode');
