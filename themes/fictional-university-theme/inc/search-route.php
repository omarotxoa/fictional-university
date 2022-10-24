<?php 
  add_action('rest_api_init', 'universityRegisterSearch');

  function universityRegisterSearch() {
    /* following code builds the api into the following url that is appended to the localhost url: '/wp-json/university/v1/search' */
    register_rest_route('university/v1', 'search', array(
      'methods' => WP_REST_SERVER::READABLE,
      'callback' => 'universitySearchResults'
    ));
  }

  function universitySearchResults($data) {
    $mainQuery = new WP_Query(array(
      'post_type' => array('post', 'page', 'professor'),
      's' => $data['term']
    )); 

    $results = array();

    while ($mainQuery->have_posts()) {
      $mainQuery-> the_post();
      array_push($results, array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink()
      ));
    }

    return $results;
  }
?>