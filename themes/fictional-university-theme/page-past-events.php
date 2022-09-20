<?php get_header(); ?>

<?php 
  page_banner(array(
    'title' => 'Past Events',
    'subtitle' => 'A recap of ourpast events.'
  )); 
?>

<div class="container container--narrow page-section">
  <?php
  $today = date('Ymd'); 
    $past_events = new WP_Query(array(
      'paged' => get_query_var('paged', 1),
      'posts_per_page' => 3,
      'post_type' => 'event',
      'meta_key' => 'event_date',
      'orderby' => 'meta_value',
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'event_date',
          'compare' => '<',
          'value' => $today,
          'type' => 'numeric'
        )
      )
    ));
  ?>
  <?php if ($past_events->have_posts()) : while ($past_events->have_posts()) : $past_events->the_post(); ?>
    <?php get_template_part('template-parts/content', get_post_type()); ?>
  <?php endwhile; endif; ?>

  <?php 
    // paginate_links() as is only works with default WP_Query
    // We need to customize it for this use case
    echo paginate_links(array(
      'total' => $past_events->max_num_pages
    )); 
  ?>
  
</div>

<?php get_footer(); ?>