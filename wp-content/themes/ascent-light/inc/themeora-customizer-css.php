<?php
/**
 * Add Customizer CSS To Header
 */
function ascent_light_customizer_css() { ?>
        <?php
        $hoverColor = ascent_light_hex2rgb( get_theme_mod( 'theme_accent_color', '#1abc9c' ) );
        $rgbaHover = 'rgba(' . $hoverColor[0] . ', ' . $hoverColor[1] . ',' . $hoverColor[2] . ',' . '0.6)';
        
        ob_start();
        ?>
	
            <?php if ( get_header_textcolor() ) : ?>
                .hero-area h1, 
                .hero-area p,
                .hero-area a,
                .hero-area a:hover,
                .hero-area a:focus,
                .hero-area a:active,
                .hero-area a:visited,
                header a.themeora-nav-toggle,
                header a.themeora-nav-toggle:hover, 
                header a.themeora-nav-toggle:focus,
                header a.themeora-nav-toggle:active,
                header a.themeora-nav-toggle:visited,
                h1.site-title a, 
                h1.site-title a:hover, 
                h1.site-title a:visited, 
                h1.site-title a:active, 
                h1.site-title a:focus,
                h2.site-description
                {
                    color: #<?php echo get_header_textcolor(); ?>;
                }
            <?php endif; ?>
            
            <?php if ( get_background_color() ) : ?>
                body, #sb-site, .sb-site-container {
                    background-color: #<?php echo get_background_color(); ?>;
                }
            <?php endif; ?> 

            a,
            a:visited, 
            a:active, 
            a:focus {
                color: <?php echo get_theme_mod( 'theme_accent_color' ); ?>;
            }
            
            a:hover {
                color: <?php echo $rgbaHover; ?>;
            }
            
            .btn, 
            .btn:visited, 
            .btn:active,
            .btn:focus,
            .edd-submit.button, 
            .edd-submit.button:visited,
            .edd-submit.button:active,
            .edd-submit.button:focus,
            .edd-submit,
            .edd_checkout a,
            .edd_checkout a:visited,
            .edd_checkout a:active,
            .edd_checkout a:focus,
            .edd-submit.button,
            .edd-submit.button:active, 
            .edd-submit.button:visited, 
            .edd-submit.button:focus,
            #edd-purchase-button, 
            #edd-purchase-button:visited,
            #edd-purchase-button:active,
            #edd-purchase-button:focus,
            input[type=submit].edd-submit,
            input[type=submit].edd-submit:active,
            input[type=submit].edd-submit:visited,
            input[type=submit].edd-submit:focus
            {
                background-color: <?php echo get_theme_mod( 'theme_accent_color' ); ?>;
            }
            
            .btn:hover, 
            .edd-submit.button:hover, 
            .edd-submit:hover, 
            .edd_checkout a:hover, 
            .edd-submit.button:hover, 
            #edd-purchase-button:hover, 
            input[type=submit].edd-submit:hover
            {
                background-color: <?php echo $rgbaHover ?>;
            }


            <?php if ( get_theme_mod( 'ascent_light_heading_font') != 'default' ) : ?>
                h1, h2, h3, h4, h5, h6 {
                    font-family: '<?php echo get_theme_mod( 'ascent_light_heading_font', 'Montserrat' ); ?>';
                }
            <?php endif; ?>
            <?php if ( get_theme_mod( 'ascent_light_heading_weight') != 'default' ) : ?>
                h1, h2, h3, h4, h5, h6 {
                    font-weight: <?php echo get_theme_mod( 'ascent_light_heading_weight', '600' ); ?>;
                }
            <?php endif; ?>

            <?php if ( !get_theme_mod( 'ascent-light-img-upload-logo' ) ) : ?>
                h1.site-title {
                    font-family: '<?php echo get_theme_mod( 'type_select_logo', 'Montserrat' ); ?>';
                    font-size: <?php echo get_theme_mod( 'type_logo_size', '26' ); ?>px;
                }
            <?php endif; ?>

            <?php if ( get_theme_mod( 'ascent_light_body_font') != 'default' ) : ?>
                body {
                    font-family: <?php echo get_theme_mod( 'ascent_light_body_font', '"open sans", "sans-serif"' ); ?>;
                }
            <?php endif; ?>
            
            <?php if ( get_theme_mod( 'theme_accent_color') ) : ?>
                .accent-background {
                    background-color: <?php echo get_theme_mod( 'theme_accent_color' ); ?>;
                }
            <?php endif; ?>
            
            <?php 
            $output = ob_get_clean();
            return $output;
            ?>
<?php
}
//add_action( 'wp_head', 'ascent_light_customizer_css' );