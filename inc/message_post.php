<?php

function dm_message() {
  register_post_type('message',
    array(
      'labels' => array(
        'name' => __('Messages'),
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
      'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
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
