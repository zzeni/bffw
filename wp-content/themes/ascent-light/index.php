<?php get_header(); ?>

<div class="full-width-container main-content-area">
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
            </div><!-- col-md-8 -->
            <?php get_sidebar(); ?>
        </div><!-- row -->
    </div><!-- container -->
</div>

<?php get_footer(); ?>