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

</div>
    
<?php endwhile; endif; ?>

<?php get_footer(); ?>