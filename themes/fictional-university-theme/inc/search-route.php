<?php 
  add_action('rest_api_init', 'universityRegisterSearch');

  function universityRegisterSearch() {
    /* following code builds the api into the following url that is appended to the localhost url: '/wp-json/university/v1/search' */
    register_rest_route('university/v1', 'search', array(
      'methods' => WP_REST_SERVER::READABLE,
      'callback' => 'universitySearchResults'
    ));
  }

  function universitySearchResults() {
    return 'Custom REST API route created successfully';
  }
?>