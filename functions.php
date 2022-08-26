<?php 

  function styles() {
    wp_enqueue_style('theme_styles', get_stylesheet_uri());
  }
  add_action('wp_enqueue_scripts', 'styles'); 
?>