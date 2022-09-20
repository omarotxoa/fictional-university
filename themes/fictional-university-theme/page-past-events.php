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
    <div class="event-summary">
      <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
        <span class="event-summary__month">
          <?php 
            $eventDate = new DateTime(get_field('event_date'));
            echo $eventDate->format('M');
          ?>
        </span>
        <span class="event-summary__day">
          <?php 
            echo $eventDate->format('d');
          ?>
        </span>
      </a>
      <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <?php echo wp_trim_words(get_the_content(), 18); ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
      </div>
    </div>
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