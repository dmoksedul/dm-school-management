
<?php

function custom_messages_post_type(){
  register_post_type ('messages',
    array(
      'labels' => array(
        'name' => ('Messages'),
        'singular_name' => ('Message'),
        'add_new' => ('Add New Messages'),
        'add_new_item' => ('Add New Messages'),
        'edit_item' => ('Edit Messages'),
        'new_item' => ('New Messages'),
        'view_item' => ('View Messages'),
        'not_found' => ('Sorry not found any messages.'),
      ),
      'menu_icon' => 'dashicons-buddicons-pm',
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => true,
      'menu_position' => 5, 
      'has_archive' => false,
      'hierarchial' => true,
      'show_ui' => true,
      'capability_type' => 'post',
      'rewrite' => array('slag' => 'messages'),
      'supports' => array('title', 'thumbnail', 'editor',),
      )
    );
    add_theme_support('post-thumbnails');
}

add_action('init', 'custom_messages_post_type');

