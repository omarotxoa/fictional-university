<?php get_header(); ?>

<?php
  page_banner(array(
    'title' => 'Search Results',
    'subtitle' => 'You Searched for &ldquo;' . get_search_query() . '&rdquo;'
  )); 
?>

<div class="container container--narrow page-section">
  <?php if (have_posts()) : while (have_posts()) : the_post();?>

  <?php get_template_part('template-parts/content', get_post_type()); ?>
    
  <?php endwhile; endif; ?>
  <?php echo paginate_links(); ?>

  <?php get_search_form(); ?>
</div>

<?php get_footer(); ?>