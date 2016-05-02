<?php get_header(); ?>

<div class="full-width-container blog-section blog-single-post">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if ( have_posts() ) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="post">
                            <?php ascent_light_entry_meta(); ?>
                            <?php ascent_light_post_media( $post->ID, 'ascent-light-thumbnail-span-8' ); ?>
                            <?php the_content(); ?>
                        </article>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ascent-light' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'ascent-light' ) . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
                ) ); ?>
                <!-- begin comments -->
                <div class="blog-comments mobile-stack">
                    <?php comments_template(); ?>
                </div>
                <!-- end comments -->
            </div><!-- end col-md-8 -->
            
            <?php get_sidebar(); ?>
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end full-width-container -->

<?php get_footer(); ?>