<?php

function custom_history() {
  register_post_type('history',
    array(
      'labels' => array(
        'name' => __('History'),             // Change "Messages" to "History"
        'singular_name' => __('History'),    // Change "Message" to "History"
        'add_new' => __('Add New History'),  // Change "Add New Message" to "Add New History"
        'add_new_item' => __('Add New History'),
        'edit_item' => __('Edit History'),   // Change "Edit Message" to "Edit History"
        'new_item' => __('New History'),     // Change "New Message" to "New History"
        'view_item' => __('View History'),   // Change "View Message" to "View History"
        'not_found' => __('Sorry, no history found.'), // Change "Sorry, no messages found." to "Sorry, no history found."
      ),
      'menu_icon' => 'dashicons-clock', // You can change the menu icon to your preference.
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => true,
      'menu_position' => 5,
      'has_archive' => true,
      'hierarchical' => true,
      'show_ui' => true,
      'capability_type' => 'post',
      'rewrite' => array('slug' => 'history'),
      'supports' => array('title', 'thumbnail', 'editor'),
    )
  );

  // Add custom taxonomy 'designation' to the custom post type 'history'
  register_taxonomy('designation', 'history', array(
    'label' => __('Designation'),
    'rewrite' => array('slug' => 'designation'),
    'hierarchical' => true,
    'show_admin_column' => true,
  ));

  add_theme_support('post-thumbnails');
}

add_action('init', 'custom_history');

  
  
  // Shortcode function to display history posts
  function custom_history_shortcode($atts) {  // Change the function name to custom_history_shortcode
    // Default shortcode attributes
    $atts = shortcode_atts(array(
        'length' => 100,           // Default description length
        'limit' => -1,             // Default to display all history posts
        'designation' => '',       // Default to show history posts from all designations
        'designation_output' => true,  // Default to true, meaning it will show the designation
    ), $atts);
  
    // Query parameters
    $args = array(
        'post_type' => 'history', // Change this to 'history' to display history posts.
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
  
    $history_posts = new WP_Query($args);
    $post_count = 0; // Initialize post counter
  
    ob_start();
  
    if ($history_posts->have_posts()) :
        while ($history_posts->have_posts()) : $history_posts->the_post();
            $post_count++; // Increment post counter
            ?>
            <div class="dm_history_box">  <!-- Change the class name to "dm_history_box" -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="history-thumbnail">  <!-- Change the class name to "history-thumbnail" -->
                        <?php the_post_thumbnail('large-thumbnail'); ?>
                    </div>
                <?php endif; ?>
                <div class="post_info">
  <!-- 				 <h2><?php the_title(); ?></h2> -->
                    <p><?php echo wp_trim_words(get_the_content(), $atts['length']); ?><a href="<?php the_permalink(); ?>" class="read-more">আরো পড়ুন </a></p>
                </div>
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
  .dm_history_box {
      display: grid;
      grid-template-columns: 1fr 1fr;
      justify-content: center;
      align-items: center;
      border-radius: 4px;
      box-shadow: 0 0 10px #00000038;
  }
                @media screen and (max-width:992px){
                    .dm_history_box {
      grid-template-columns: 1fr;
      gap: 20px;
  }
                }
  .history-thumbnail {
      width: 100%;
      border-radius: 2px;
      overflow: hidden;
      height: 250px;
      padding:15px;
      position:relative;
  }
  .history-thumbnail::before {
      content: "";
      height: 80px;
      width: 80px;
      background: #ff000000;
      position: absolute;
      left: 0px;
      top: 0px;
      border-left: 5px solid #056839;
      border-top: 5px solid #056839;
      pointer-events:none;
  }
  .history-thumbnail::after {
      content: "";
      height: 80px;
      width: 80px;
      background: #ff000000;
      position: absolute;
      right: 0px;
      bottom: 0px;
      border-right: 5px solid #056839;
      border-bottom: 5px solid #056839;
      pointer-events:none;
  }
  .history-thumbnail img {
      width: 100% !important;
      border-radius: 2px;
      height:100%;
  }
  .dm_history_box h2 {
      font-size: 25px;
      color: #056839;
  }
  .dm_history_box p {
      padding: 0px 15px;
  }
  .dm_history_box a.read-more {
      font-weight: 500;
  }
  </style>
          <?php
      endwhile;
  else :
      echo 'No history found.'; // Change "No messages found." to "No history found."
  endif;

  wp_reset_postdata();

  return ob_get_clean();
}

add_shortcode('custom_history', 'custom_history_shortcode'); // Change the shortcode name to "custom_history"
