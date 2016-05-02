<?php
/*
 * This is the template for easy digital downloads archives
*/

get_header();

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>

<div class="full-width-container">
    <div class="container text-center">
        <?php ascent_light_downloads_loop(); ?>
    </div><!-- container -->

</div><!-- end full-with-container -->

<?php get_footer(); ?>