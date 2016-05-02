<?php 
/* This is the default sidebar used for blog pages */
?>
<!-- start sidebar -->
<?php if ( is_active_sidebar( 'checkout-sidebar' ) ) { ?>
    <aside class="col-md-3 col-md-offset-1 blog-sidebar">
        <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('checkout-sidebar') ) ?>
    </aside>
<?php } ?>
<!-- end blog-sidebar -->