<?php 
/* This is the sidebar used on the default page template */
?>
<!-- start sidebar -->
<?php if ( is_active_sidebar( 'page-sidebar' ) ) { ?>
<aside class="col-md-3 col-md-offset-1 blog-sidebar">
    <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('page-sidebar') ) ?>
</aside>
<?php } ?>
<!-- end blog-sidebar -->