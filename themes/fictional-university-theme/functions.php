<?php 
  require get_theme_file_path('/inc/search-route.php');
  
  function university_custom_rest_api() {
    register_rest_field('post', 'authorName', array(
      'get_callback' => function() {return get_the_author(); }
    ));
  }
  add_action('rest_api_init', 'university_custom_rest_api');
  function page_banner($args = NULL) { 
    if (!$args['title']) {
      $args['title'] = get_the_title(); 
    }

    if (!$args['subtitle']) {
      $args['subtitle'] = get_field('page_banner_subtitle'); 
    }

    if (!$args['photo']) {
      if (get_field('page_banner_background_image') AND !is_archive() AND !is_home()) {
        $args['photo'] = get_field('page_banner_background_image')['sizes']['page-banner'];
      } else {
        $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
      }
    }
    
?>    
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>"></div>
      <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">
        <?php 
          echo $args['title'];
        ?>
      </h1>
      <div class="page-banner__intro">
          <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div>
  </div>
<?php } ?>

<?php

  function styles() {
    wp_enqueue_script('main-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('theme_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('theme_extra_styles', get_theme_file_uri('/build/index.css'));

    wp_localize_script('main-js', 'universityData', array(
      'root_url'  => get_site_url()
    ));
  }
  add_action('wp_enqueue_scripts', 'styles'); 

  function university_features() {
    register_nav_menu('header-menu', 'Header Menu Location');
    register_nav_menu('footer-menu-one', 'Footer Location 1');
    register_nav_menu('footer-menu-two', 'Footer Location 2');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professor-landscape', 400, 260, true);
    add_image_size('professor-portrait', 480, 650, true);
    add_image_size('page-banner', 1500, 350, true);
  }
  add_action('after_setup_theme', 'university_features'); 

  /* This function makes adjustments to the default WP_Query. */
  function wp_query_adjustments($query) {
    /* 
      This if check makes sure that the code only applies to the MAIN QUERY on the FRONTEND in the EVENT custom post type.
      The main WP_Query applies to the WHOLE website, even the admin section. So it is important to apply appropriate restrictions. 
    */

    if(is_main_query() && !is_admin() && is_post_type_archive('program')) {
      $query->set('orderby', 'title');
      $query->set('order', 'ASC');
      $query->set('posts_per_page', '-1');
    }

    if(is_main_query() && !is_admin() && is_post_type_archive('event')) {
      $today = date('Ymd');
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