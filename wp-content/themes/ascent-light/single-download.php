<?php
/*
 * This is the single page template for edd items. 
*/

get_header();
?>

<div class="full-width-container">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <?php if ( have_posts() ) : ?>
                    <?php 
                    // Only show the first but button if it is not a variable price
                    if ( !edd_has_variable_prices(get_the_ID()) ) {
                        if (function_exists('ascent_light_edd_buy_button') ) { ascent_light_edd_buy_button();  } 
                    }
                    ?>
                
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                    
                    <?php if ( function_exists('ascent_light_edd_buy_button') ) { ascent_light_edd_buy_button( 'product-cta-bottom' ); } ?>
                
                <?php else : ?>
                    <p><?php _e('No posts found' , 'ascent-light') ?></p>
                <?php endif; ?>
            </div><!-- end col-md-10 -->
        </div><!-- end row -->
    </div><!-- .container -->
</div><!-- .full-width-container -->

<?php ascent_light_related_downloads(); ?>

<?php get_footer(); ?>