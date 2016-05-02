<?php get_header(); ?>

<section class="full-width-container main-content-area">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <?php if ( ! have_posts() ) : ?>    
                    <p><?php _e( 'Why not try searching for the page you want?', 'ascent-light' ); ?></p>
                    <?php get_search_form(); ?>
                <?php endif; ?>
            </div><!-- end content -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end full-width-container -->

<?php get_footer(); ?>