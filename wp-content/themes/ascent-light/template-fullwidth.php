<?php
/*
 * Template Name: Full Width
*/

get_header();
?>

<div class="full-width-container main-content-area">
    <div class="container">    
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div><!-- container -->
</div>

<?php get_footer(); ?>