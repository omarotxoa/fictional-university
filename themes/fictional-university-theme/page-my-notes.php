<?php 
  if(!is_user_logged_in()) {
    wp_redirect(site_url('/'));
    exit;
  }
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php 
    page_banner(array(
        'title' => 'My Notes',
        'subtitle' => 'Subtitle',
        'photo' => 'https://images.unsplash.com/photo-1439405326854-014607f694d7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80'
    )); 
?>

<div class="container container--narrow page-section">
    <ul class="min-list link-list" id="my-notes">
      <?php
        $userNotes = new WP_Query(array(
          'post_type' => 'note',
          'posts_per_page' => -1,
          'author' => get_current_user_id()
        ));
      ?>

      <?php if ($userNotes->have_posts()) : while($userNotes->have_posts()) : $userNotes->the_post(); ?>
        <li data-id="<?php the_ID(); ?>">
          <input class="note-title-field" value="<?php echo esc_attr(get_the_title()); ?>">
          <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true">Edit</i></span>
          <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true">Delete</i></span>
          <textarea class="note-body-field"><?php echo esc_attr(wp_strip_all_tags(get_the_content())); ?></textarea>
        </li>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </ul>
</div>
    
<?php endwhile; endif; ?>

<?php get_footer(); ?>