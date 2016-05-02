<?php
/**
 * This template adds the Getting Started page, license settings and the theme updater.
 *
 * @package WordPress
 * @subpackage Ascent light
 */


/**
 * Add Getting Started menu item
 */
function ascent_license_menu() {
    add_theme_page( __( 'Getting Started', 'ascent-light' ), __( 'Getting Started', 'ascent-light' ), 'manage_options', 'ascent-getting-started', 'ascent_getting_started_page' );
}
add_action('admin_menu', 'ascent_license_menu');


/**
 * Load Getting Started styles in the admin
 */
function ascent_start_load_admin_scripts() {

    // Load styles only on our page
    global $pagenow;
    if( 'themes.php' != $pagenow )
        return;

    // Getting started script and styles
    wp_register_style( 'getting-started', get_template_directory_uri() . '/inc/admin/getting-started/getting-started.css', false, '1.0.0' );
    wp_enqueue_style( 'getting-started' );

    // Thickbox
    add_thickbox();
}
add_action( 'admin_enqueue_scripts', 'ascent_start_load_admin_scripts' );


/**
 * Create the Getting Started page and settings
 */
function ascent_getting_started_page() {

	// Theme info
	$theme = wp_get_theme( 'ascent-light' );
	// Lowercase theme name for resources links
	$theme_name_lower = get_template();
	?>

	<div class="wrap getting-started">
		<div class="intro-wrap">
                    <img class="theme-image" src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" alt="" />
                    <div class="intro">
                        <h2><?php printf( __( 'Getting started with %1$s', 'ascent-light' ), 'Ascent Light' ); ?></h2>

                        <h3><?php printf( __( 'Thanks for using %1$s! We truly appreciate the support and the chance to share our work with you. Please visit the tabs below to get started setting up your theme!', 'ascent-light' ), 'Ascent Light' ); ?></h3>
                    </div>
		</div>

		<div class="panels">

			<!-- general file panel -->
			<div id="help-panel" class="panel visible clearfix">
				<div class="panel-left">
                                    <h4><?php _e( 'Quick Start Guide', 'ascent-light' ); ?></h4>
                                    
                                    <p><?php _e( 'Head over to <em>Appearance</em> &rarr; <em>Customize</em> and upload your logo if required.', 'ascent-light' ); ?></p>
                                    <p><?php _e( 'Go to <em>Settings</em> &rarr; <em>Reading</em> and select a page to use as your homepage. If you don\'t have one yet, just create a page first.', 'ascent-light' ); ?></p>
                                    <p><?php _e( 'When you have a page that you want to use for the homepage, go to that page and select the <em>Home</em> template under <em>Page Attributes &rarr; Template</em>.', 'ascent-light' ); ?></p>
                                    <p><?php _e( 'Go to <em>Settings</em> &rarr; <em>Reading</em> and select a page to use as your blog. If you don\'t have one yet, just create a page first.', 'ascent-light' ); ?></p>
                                    <p><?php _e( 'Download and active the Easy Digital Downloads plugin. Go to the Easy Digital Downloads settings page and configure your options. See their documentation for more information.', 'ascent-light' ); ?></p>
                                    <p><?php _e( 'Set up your products in Easy Digital Downloads. The product will show on the "Homepage" template and the "Shop page with sidebar" template.', 'ascent-light' ); ?></p>
                                    <p><?php _e( 'Create a page for your checkout. Assign it to the "Checkout" template.', 'ascent-light' ); ?></p>
                                    <p><?php _e( 'To set up your portfolio, create a new page and assign it to the <em>Portfolio</em> page template. Then create an item to be shown on this portfolio by adding a new page and selecting the <em>Portfolio item</em> template as the template. This will then show on the page you have assigned the <em>Portfolio</em> template to. Do the same for all the items you want to add to your portfolio.', 'ascent-light' ); ?></p>

				</div>

				<div class="panel-right">
					
                                    <div class="panel-aside hide-cm">
                                        <h4><?php _e( 'Turbo Charge this Theme!', 'ascent-light' ); ?></h4>
                                        <p><?php _e( 'Ascent Light is the free, simple version of Ascent. To gain access to powerful options and features to help you make more sales and help your store look even more awesome, upgrade today. You\'ll get the ability to change more options in the theme so that your site is truely unique, and you will also get access to premium email support! ', 'ascent-light' ); ?></p>

                                        <a class="button button-primary" href="https://themeora.com/downloads/ascent-premium//?utm_source=ascent-light&utm_medium=wp.org&utm_campaign=getting%20started" target="_blank" title=""><?php _e( 'See Ascent Premium', 'ascent-light' ); ?></a>
                                    </div>

				</div>
			</div><!-- #help-panel -->

		</div><!-- .panels -->
	</div><!-- .getting-started -->

	<?php
}

/**
 * Getting Started notice
 */

function ascent_getting_started_notice() {
    global $current_user;
    $user_id = $current_user->ID;

    // Getting Started URL
    $getting_started_url = admin_url( 'themes.php?page=ascent-getting-started' );

    if ( ! get_user_meta( $user_id, 'ascent_getting_started_ignore_notice' ) ) {
            echo '<div class="updated"><p>';

            printf( __( ' %1$s activated! Visit the <a href="%2$s">Getting Started</a> page to view the help file or ask us a question. ', 'ascent-light' ), wp_get_theme(), esc_url( $getting_started_url ) );

            printf( __( '<a href="%1$s">Hide this notice</a>', 'ascent-light' ), '?ascent_getting_started_nag_ignore=0' );

            echo "</p></div>";
    }
}
add_action( 'admin_notices', 'ascent_getting_started_notice' );


function ascent_getting_started_nag_ignore() {
    global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset( $_GET['ascent_getting_started_nag_ignore'] ) && '0' == $_GET['ascent_getting_started_nag_ignore'] ) {
            add_user_meta( $user_id, 'ascent_getting_started_ignore_notice', 'true', true );
    }
}
add_action( 'admin_init', 'ascent_getting_started_nag_ignore' );