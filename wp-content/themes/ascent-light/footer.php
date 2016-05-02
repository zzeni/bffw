
        <footer class="full-width-container primary-footer" id="primary-footer">

            <div class="container">
                <?php if ( get_theme_mod( 'footer-logo') ) : ?>
                    <div class="footer-logo">
                        <a href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo( 'name' ); ?>" rel="<?php _e( 'home', 'ascent-light' ) ?>"><img style="width:<?php echo esc_html( get_theme_mod( 'footer-logo-width', 180 ) ); ?>px;" src="<?php echo esc_html( get_theme_mod( 'footer-logo' ) )?>" class="footer-logo-uploaded" alt="<?php echo get_bloginfo( 'name' ); ?>" /></a>
                    </div>
                <?php endif; ?>

                <?php if( is_active_sidebar( 'footer-widget-top' ) ) { ?>
                    <div class="footer-top">
                        <?php dynamic_sidebar( 'Footer Top Widget' );  ?>
                    </div>
                <?php } ?>
                
                <?php if( is_active_sidebar( 'footer-widget-middle' ) ) { ?>
                    <div class="footer-middle">
                        <?php dynamic_sidebar( 'Footer Middle Widget' );  ?>
                    </div>
                <?php } ?>

                <?php if( is_active_sidebar( 'footer-widget-bottom' ) ) { ?>
                    <div class="footer-bottom">
                        <?php dynamic_sidebar( 'Footer Bottom Widget' );  ?>
                    </div>
                <?php } ?>

                <?php if ( has_nav_menu( 'social_menu' ) ) : ?>        
                    <nav id="social-navigation" class="social-navigation">
                        <?php
                            // Social links navigation menu.
                            wp_nav_menu( array(
                                'theme_location' => 'social_menu',
                                'depth'          => 1,
                                'link_before'    => '<span class="screen-reader-text">',
                                'link_after'     => '</span>',
                            ) );
                        ?>
                    </nav><!-- .social-navigation -->
                <?php endif; ?>

                <?php if( is_active_sidebar( 'footer-widget-terms' ) ) { ?>
                    <div class="footer-last">
                        <?php dynamic_sidebar( 'Footer Terms Widget' );  ?>
                    </div>
                <?php } ?>
                    
                <p class='theme-info'>
                    <?php echo '&copy; '.date("Y").'. WordPress Theme - ' . 'Ascent' . ' by <a href="http://themeora.com">Themeora</a>'; ?>
                </p>

            </div><!-- end container -->
        </footer><!-- end full-width-container -->

    </div><!-- #sb-site -->
    
    <div class="sb-slidebar sb-right">
        <!-- primary nav -->
        <?php 
            if ( has_nav_menu('primary_menu') ) {
                wp_nav_menu(array(
                'container' =>false,
                'theme_location' => 'primary_menu',
                'menu_class' => '',
                'echo' => true,
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'depth' => 0,
                'walker' => new Ascent_Light_Walker_Nav_Menu()
                )); 
            }
        ?>
    </div>

    <?php wp_footer(); ?>

</body>
</html>