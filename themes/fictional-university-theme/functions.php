<?php 

  function styles() {
    wp_enqueue_script('main-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('theme_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('theme_extra_styles', get_theme_file_uri('/build/index.css'));
  }
  add_action('wp_enqueue_scripts', 'styles'); 

  function university_features() {
    register_nav_menu('header-menu', 'Header Menu Location');
    register_nav_menu('footer-menu-one', 'Footer Location 1');
    register_nav_menu('footer-menu-two', 'Footer Location 2');

    add_theme_support('title-tag');
  }
  add_action('after_setup_theme', 'university_features'); 

  /* This function makes adjustments to the default WP_Query. */
  function wp_query_adjustments($query) {
    /* 
      This if check makes sure that the code only applies to the MAIN QUERY on the FRONTEND in the EVENT custom post type.
      The main WP_Query applies to the WHOLE website, even the admin section. So it is important to apply appropriate restrictions. 
    */
    $today = date('Ymd');
    if($query->is_main_query() && !is_admin() && is_post_type_archive('event')) {
      $query->set('meta_key', 'event_date');
      $query->set('orderby', 'meta_value');
      $query->set('order', 'ASC');
      $query->set('meta_query', array(
        array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
        )
      ));
    }
  }
  add_action('pre_get_posts', 'wp_query_adjustments');
?>