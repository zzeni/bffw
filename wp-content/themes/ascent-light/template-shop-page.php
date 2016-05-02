<?php
/*
 * Template Name: Shop page with sidebar
 * This template loads the sidebar-shop.php file to be used as the sidebar so you can have a specific sidebar for shop pages
*/

get_header();
?>

<div class="full-width-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
                
                <?php ascent_light_downloads_loop( 2, 6 ); ?>
            </div>
            <?php get_sidebar('shop'); ?>
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end main-content-area -->

<?php get_footer(); ?>