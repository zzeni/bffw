<?php
/*
 * Template Name: Full Width Narrow
*/

get_header();
?>

<div class="full-width-container main-content-area">
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div><!-- container -->
</div>

<?php get_footer(); ?>