<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php 
    page_banner(array(
        'title' => 'Hello there this is the title',
        'subtitle' => 'This is the subtitle',
        'photo' => 'https://images.unsplash.com/photo-1439405326854-014607f694d7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80'
    )); 
?>

<div class="container container--narrow page-section">

    <?php $parentID = wp_get_post_parent_id(); ?>

    <?php if($parentID != 0) { ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_permalink($parentID); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($parentID); ?></a> <span class="metabox__main"><?php the_title(); ?></span>
            </p>
            </div>
    <?php } ?>
        
    <?php 
        $isParent = get_pages(array(
            'child_of' => get_the_id()
        ));

        if($parentID or $isParent) { 
    ?>
        <div class="page-links">
            <h2 class="page-links__title"><a href="<?php echo get_permalink($parentID); ?>"><?php echo get_the_title($parentID); ?></a></h2>
            <ul class="min-list">
                <?php 
                if ($parentID != 0) {
                    $findChildrenOf = $parentID;
                } else {
                    $findChildrenOf = get_the_ID();
                }
                wp_list_pages(array(
                    'title_li' => NULL,
                    'child_of' => $findChildrenOf
                )); 
                ?>
            </ul>
        </div>
    <?php } ?>

    <div class="generic-content">
        <?php the_content(); ?>
    </div>
</div>
    
<?php endwhile; endif; ?>

<?php get_footer(); ?>