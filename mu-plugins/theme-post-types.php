<?php
function theme_post_types() {

  register_post_type('event', array(
    'rewrite' => array('slug' => 'events'),
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event'
    ),
    'menu_icon' => 'dashicons-calendar-alt',
    'has_archive' => true,
    'supports' => array('title', 'editor', 'excerpt')
  ));

  register_post_type('program', array(
    'rewrite' => array('slug' => 'programs'),
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Programs',
      'add_new_item' => 'Add New Program',
      'edit_item' => 'Edit Program',
      'all_items' => 'All Programs',
      'singular_name' => 'Program'
    ),
    'menu_icon' => 'dashicons-awards',
    'has_archive' => true,
    'supports' => array('title', 'editor')
  ));
}
add_action('init', 'theme_post_types');
?>