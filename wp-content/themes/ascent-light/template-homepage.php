<?php
/*
 * Template Name: Homepage
 * This is the index page for Easy Digital Downloads items.
 * It uses the same layout settings from the portfolio section of the customiser.
*/

get_header();
?>

<div class="full-width-container">
    <div class="container text-center">
        <?php if ( have_posts() ) : ?>  
            <div class="homepage-content">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        
        <?php ascent_light_downloads_loop(); ?>
    </div><!-- container -->
</div><!-- end full-with-container -->

<?php get_footer(); ?>