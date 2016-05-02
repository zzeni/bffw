<?php
/*
 * Template Name: Portfolio
*/

get_header();

// Setup paging for portfolio pagaination
if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}
?>

<?php
/* Load the portfolio
--------------------------------------------------------------------------------------- */

// Get posts assigned to the template-portfolio-item.php template
$args = array(
    'post_type' => 'page',
    'meta_key' => '_wp_page_template',
    'meta_value' => 'template-portfolio-item.php',
    'post_status' => 'publish',
    'posts_per_page' => 9,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'paged' => $paged
);
$wp_query = new WP_Query( $args );

// Set the pagination variable to true if we have more than one page
if ( $wp_query->max_num_pages > 1 ) $pagination = true;
$img_size = 'ascent-light-portfolio-span-4';

if ( $wp_query->have_posts() ) : ?>
    <div class='full-width-container'>
        <div class="container">
            <div class="row portfolio-row">
                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                    <?php
                    // Check if the portfolio has an image. Only load the item if it does
                    if ( has_post_thumbnail( $wp_query->post->ID ) ) {
                    $previewImage = wp_get_attachment_image_src( get_post_thumbnail_id( $wp_query->post->ID ), $img_size );
                    ?>
                        <div class="col-md-4">
                            <div class="portfolio-item">
                                <a href="<?php the_permalink(); ?>" class="portfolio-link" title="<?php the_title() ?>">
                                    <img src="<?php echo $previewImage[0] ?>" class="" alt="<?php the_title(); ?>" />

                                    <div class="portfolio-details">
                                        <div class="details-text">
                                            <h2><?php the_title(); ?></h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div><!-- masonry-item -->
                    <?php } ?>
                <?php endwhile; ?>
            </div><!-- row -->
            <?php ascent_light_paging(); ?>
        </div><!-- container -->
    </div>

<?php
wp_reset_query();
endif;
?>

<?php get_footer(); ?>