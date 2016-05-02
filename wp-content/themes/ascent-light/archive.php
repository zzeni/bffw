<?php get_header(); ?>

<div class="full-width-container blog-section">
    <div class="container">
	<div class="row">
            <div class="col-md-8">
                <?php if ( have_posts() ) : ?>
                    <div id="posts-wrapper">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'content', get_post_format() ); ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <?php ascent_light_pagination(); ?>
            </div>

            <?php get_sidebar(); ?>
        </div><!-- end row -->
    </div><!-- end Container -->
</div><!-- end full-width-container -->

<?php get_footer(); ?>