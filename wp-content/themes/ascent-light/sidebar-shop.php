<?php 
/* This is the default sidebar used for shop pages */
?>
<!-- start sidebar -->
<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
    <aside class="col-md-3 col-md-offset-1 blog-sidebar">
        <?php dynamic_sidebar( 'Shop Sidebar' );  ?>
    </aside>
<?php } ?>
<!-- end blog-sidebar -->