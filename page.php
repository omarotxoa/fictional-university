<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <p>This is a page not a post</p>
    <h2><?php the_title(); ?></h2>

    <?php the_content(); ?>
<?php endwhile; endif; ?>