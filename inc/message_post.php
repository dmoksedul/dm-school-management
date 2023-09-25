<?php

function dm_message(){
  register_post_type ('message',
    array(
      'labels' => array(
        'name' => ('messages'),
        'singular_name' => ('message'),
        'add_new' => ('Add New message'),
        'add_new_item' => ('Add New message'),
        'edit_item' => ('Edit message'),
        'new_item' => ('New message'),
        'view_item' => ('View message'),
        'not_found' => ('Sorry, we cound\'n find the message you are looking for.'),
      ),
      'menu_icon' => 'dashicons-networking',
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => true,
      'menu_position' => 5, 
      'has_archive' => true,
      'hierarchial' => true,
      'show_ui' => true,
      'capability_type' => 'post',
      'rewrite' => array('slag' => 'message'),
      'supports' => array('title', 'thumbnail', 'editor', 'excerpt'),
      )
    );
    add_theme_support('post-thumbnails');
}

add_action('init', 'dm_message');
