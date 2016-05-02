<?php get_header(); ?>

<div class="full-width-container blog-section">
    <div class="container">
        <?php get_search_form(); ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php if ( have_posts() ) : ?>
                    <div id="posts-wrapper">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('post-teaser'); ?>>
                                <?php ascent_light_post_media( $post->ID, 'ascent-light-thumbnail-span-8' ); ?>
                                <div class="content">
                                    <h2 class="title"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php ascent_light_entry_meta(); ?>
                                    <p><a href="<?php the_permalink(); ?>"><?php _e('Read more', 'ascent-light'); ?></a></p>
                                </div>
                            </article><!-- end post-teaser -->
                        <?php endwhile; ?>
                    </div><!-- #posts-wrapper -->
                
                    <?php ascent_light_paging(); ?>                    
                <?php else: ?>
                    <h4 class="text-center"><?php _e('Sorry, nothing was found. Please try again.', 'ascent-light'); ?></h4>
                <?php endif; ?>
    			
            </div><!-- end span8 -->
        </div><!-- end row -->
    </div> <!-- end container -->
</div><!-- end full-width-container blog-section -->

<?php get_footer(); ?>