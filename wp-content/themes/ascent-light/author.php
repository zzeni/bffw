<?php get_header(); ?>

<div class="full-width-container blog-section">
    <div class="container">
	<div class="row">
            <div class="col-md-8">
                <?php
                /* Only show the author description if we are on page 1 to avoid duplicate content.
                 * First we check if we are paging or not
                 */
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                ?>

                <?php if ( get_the_author_meta( 'description' ) && 1 === $paged ) : ?>
                    <div class="post-author">
                        <?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
                        <p><?php the_author_meta('description'); ?></p>
                    </div>
                <?php endif; ?>
                
                <?php if ( have_posts() ) : ?>
                    <div id="posts-wrapper">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'content', get_post_format() ); ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                
                <?php ascent_light_pagination(); ?>
            </div><!-- end 8 cols -->

            <?php get_sidebar(); ?>
        </div><!-- end row -->
    </div><!-- end Container -->
</div><!-- end full-width-container -->

<?php get_footer(); ?>