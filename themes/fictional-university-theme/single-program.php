<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php page_banner(); ?>

<div class="container container--narrow page-section">
  <div class="metabox metabox--position-up metabox--with-home-link">
    <p>
      <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>">
        <i class="fa fa-home" aria-hidden="true"></i> All Programs
      </a>
      <span class="metabox__main"><?php the_title(); ?></span>
    </p>
  </div>
  <div class="generic-content"><?php the_content(); ?></div>

  <!-- Related Professors -->
  <?php 
    $professors = new WP_Query(array(
      'posts_per_page' => -1,
      'post_type' => 'professor',
      'orderby' => 'title',
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'related_programs',
          'compare' => 'LIKE',
          'value' => '"' . get_the_ID() . '"'
        )
      )
    ));
  ?>

  <?php if($professors->have_posts()) {?>
    <hr class="section-break">
    <h2 class="headline headline--medium"><?php get_the_title(); ?> Professors</h2>
    <ul class="professor-cards">
      <?php if ($professors->have_posts()) : while ($professors->have_posts()) : $professors->the_post(); ?>
        <li class="professor-card__list-item">
          <a class="professor-card" href="<?php the_permalink(); ?>">
            <img class="professor-card__image" src="<?php the_post_thumbnail_url('professor-landscape'); ?>" alt="">
            <span class="professor-card__name"><?php the_title(); ?></span>
          </a>
        </li>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </ul>
  <?php } ?>


  <!-- Related Events -->
  <?php 
    $today = date('Ymd');
    $events = new WP_Query(array(
      'posts_per_page' => 2,
      'post_type' => 'event',
      'meta_key' => 'event_date',
      'orderby' => 'meta_value',
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
        ),
        array(
          'key' => 'related_programs',
          'compare' => 'LIKE',
          'value' => '"' . get_the_ID() . '"'
        )
      )
    ));
  ?>

  <?php if($events->have_posts()) {?>
    <hr class="section-break">
    <h2 class="headline headline--medium">Upcoming <?php get_the_title(); ?> Events</h2>
    <?php if ($events->have_posts()) : while ($events->have_posts()) : $events->the_post(); ?>
      <?php get_template_part('template-parts/content', get_post_type()); ?>
    <?php endwhile; endif; wp_reset_postdata(); ?>
  <?php } ?>
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>