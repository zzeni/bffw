<?php
    /*
    * Template Name: Portfolio Item
    */
    get_header();

?>

<div class="full-width-container single-portfolio main-content-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- page content -->
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php if ( has_post_thumbnail( $post->ID ) ) : ?>
                            <div class="featured-image single-portfolio-featured-image">
                                <?php echo get_the_post_thumbnail( $post->ID, 'thumbnail-span-10' ); ?>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="post-content">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                        
                    <?php endwhile; ?>
                    
                    <?php ascent_light_portfolio_prev_next(); ?>
                    
                <?php endif; //have-posts ?>
            </div>

        </div><!-- end row -->
    </div><!-- end Container -->
</div><!-- end full-width-container -->


<?php get_footer(); ?>