<?php
function theme_post_types() {

  register_post_type('event', array(
    'capability_type' => 'event',
    'map_meta_cap' => true,
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
    'supports' => array('title')
  ));

  register_post_type('professor', array(
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Professors',
      'add_new_item' => 'Add New Professor',
      'edit_item' => 'Edit Professor',
      'all_items' => 'All Professors',
      'singular_name' => 'Professor'
    ),
    'menu_icon' => 'dashicons-welcome-learn-more',
    'supports' => array('title', 'editor', 'thumbnail')
  ));

  register_post_type('note', array(
    'public' => false,
    'show_ui' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Notes',
      'add_new_item' => 'Add New Note',
      'edit_item' => 'Edit Note',
      'all_items' => 'All Professors',
      'singular_name' => 'Note'
    ),
    'menu_icon' => 'dashicons-welcome-write-blog',
    'supports' => array('title', 'editor')
  ));
}
add_action('init', 'theme_post_types');
?>