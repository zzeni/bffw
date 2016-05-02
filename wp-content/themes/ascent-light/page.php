<?php 

get_header();
?>

<div class="full-width-container main-content-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if ( have_posts() ) : ?>
                    
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', 'page' ); ?>
                    <?php endwhile; ?>
                    
                <?php endif; ?>
            </div><!-- col-md-8 -->
            <?php get_sidebar('page'); ?>
        </div><!-- row -->
    </div><!-- container -->
</div>

<?php get_footer(); ?>