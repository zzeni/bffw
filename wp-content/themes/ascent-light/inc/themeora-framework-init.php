<?php
/* LOAD FRAMEWORK
/* --------------------------------------------------------------------- */

function ascent_light_load_framework() {
    
    /* Load fonts
    ---------------------------------------------------------------------------------------------------- */
    require_once( get_template_directory() . '/inc/themeora-admin-fonts-library.php' );
    
    /* Load fonts for customiser
    ---------------------------------------------------------------------------------------------------- */
    require_once( get_template_directory() . '/inc/themeora-fonts.php' );
    
    /* Load widgets
    ---------------------------------------------------------------------------------------------------- */
    include( get_template_directory() . '/inc/widgets/widget-video.php' );
    
    /* Theme customizer
    ---------------------------------------------------------------------------------------------------- */
    require( get_template_directory() . '/inc/themeora-customizer.php' );
    require( get_template_directory() . '/inc/themeora-customizer-css.php' );
        
    // Customizer CSS
    function ascent_light_customizer_ui_css() {
        wp_register_style('customizer-ui-css', get_template_directory_uri() . '/inc/assets/css/customizer-ui.css', 'all');
        wp_enqueue_style('customizer-ui-css');
    }

    add_action('customize_controls_print_scripts', 'ascent_light_customizer_ui_css');
    

    /* Custom header
    ---------------------------------------------------------------------------------------------------- */
    include( get_template_directory()  . '/inc/custom-header.php' );

    /* Load custom editor style
    ---------------------------------------------------------------------------------------------------- */

    add_action( 'admin_enqueue_scripts', 'ascent_light_add_editor_styles' );
    function ascent_light_add_editor_styles() 
    {
        add_editor_style( 'custom-editor-style.css' );
    }
    
    /* Load the Getting Started page and Theme Update class
    ---------------------------------------------------------------------------------------------------- */
    if ( is_admin() ) {
        if( file_exists( get_template_directory() . '/inc/admin/getting-started/getting-started.php' ) ) {
            // Load Getting Started page and initialize EDD update class
            require_once( get_template_directory() . '/inc/admin/getting-started/getting-started.php' );
        }
    }
    
}

add_action( 'ascent_light_init', 'ascent_light_load_framework' );

/* Run the init hook */
do_action( 'ascent_light_init' );

/* Run the setup hook */
do_action( 'ascent_light_setup' );


/* Tgm plugin activation
---------------------------------------------------------------------------------------------------- */
$tempdir = get_template_directory();
//tgm plugin activation
require_once($tempdir . '/inc/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'ascent_light_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function ascent_light_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // Recommend jetpack
        array(
            'name'               => 'Jetpack', // The plugin name.
            'slug'               => 'jetpack', // The plugin slug (typically the folder name).
            //'source'             => get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
        // Recommend SiteOrigin layout builder
        array(
            'name'               => 'Easy Digital Downloads', // The plugin name.
            'slug'               => 'easy-digital-downloads', // The plugin slug (typically the folder name).
            //'source'             => get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'ascent-light' ),
            'menu_title'                      => __( 'Install Plugins', 'ascent-light' ),
            'installing'                      => __( 'Installing Plugin: %s', 'ascent-light' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'ascent-light' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'ascent-light' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'ascent-light' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'ascent-light' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'ascent-light' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'ascent-light' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'ascent-light' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'ascent-light' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'ascent-light' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'ascent-light' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'ascent-light' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'ascent-light' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'ascent-light' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'ascent-light' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}

/* end themeora framework */