<?php
/* Set content width
----------------------------------------------------------------------------- */
if ( ! isset( $content_width ) ) $content_width = 1140;

/* Load framework
----------------------------------------------------------------------------- */

if ( file_exists( get_template_directory(). '/inc/themeora-framework-init.php') ) {
    include_once ( get_template_directory(). '/inc/themeora-framework-init.php' );
}

/* General theme setup options
----------------------------------------------------------------------------- */

if ( ! function_exists( 'ascent_light_theme_setup' ) ) :

    function ascent_light_theme_setup() {
        
        /* Register Navigation 
        ------------------------------------------------------------------------------*/
        register_nav_menus( array(
            'primary_menu' => __( 'Primary Menu', 'ascent-light' ),
            'social_menu' => __( 'Social Menu', 'ascent-light' )
        ));
        
        /* Load editor style
        ------------------------------------------------------------------------------*/
        add_editor_style( 'custom-editor-style.css' );

        /* Load text domain
        ------------------------------------------------------------------------------*/
        load_theme_textdomain('ascent-light', get_template_directory_uri() . "/languages/");

        /* Add various theme support options
        ----------------------------------------------------------------------------- */
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
        add_post_type_support( 'page', 'excerpt' );
        add_theme_support( "title-tag" );
        
        /* Setup the post thumbnail size for the theme.
        ------------------------------------------------------------------------------ */
        set_post_thumbnail_size( 1140, 700, true ); //this is wide enough for 12 cols of the bootstrap grid system
        /* add custom image sizes */
        add_image_size( 'ascent-light-thumbnail-span-3', 260, 210, true ); //spans 3 cols of the bootstrap grid
        add_image_size( 'ascent-light-thumbnail-span-4', 360, 290, true ); //spans 4 cols of the bootstrap grid
        add_image_size( 'ascent-light-thumbnail-span-5', 455, 366, true ); //spans 5 cols of the bootstrap grid
        add_image_size( 'ascent-light-thumbnail-span-6', 550, 442, true ); //spans 6 cols of the bootstrap grid
        add_image_size( 'ascent-light-thumbnail-span-7', 650, 523, true ); //spans 7 cols of the bootstrap grid
        add_image_size( 'ascent-light-thumbnail-span-8', 750, 603, true ); //spans 8 cols of the bootstrap grid
        add_image_size( 'ascent-light-thumbnail-span-9', 850, 683, true ); //spans 9 cols of the bootstrap grid
        
    }

endif; //ascent_light_theme_setup

add_action('after_setup_theme', 'ascent_light_theme_setup');


/* The function to register / enqueue theme scripts
------------------------------------------------------------------------------- */

if ( ! function_exists( 'ascent_light_enqueue_scripts' ) ) :

    function ascent_light_enqueue_scripts() {
        /* Load Default Google fonts */
        wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,300,500,700|Open+Sans:400,700' );
        
        /* load styles */
        wp_enqueue_style( 'ascent-light-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
        wp_enqueue_style( 'ascent-light-fontAwesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
        wp_enqueue_style( 'ascent-light-edd', get_template_directory_uri() . '/inc/edd/edd.css' );
        wp_enqueue_style( 'ascent-light-slidebars', get_template_directory_uri() . '/css/slidebars.css' );
        wp_enqueue_style( 'ascent-light-base-style', get_stylesheet_uri() );
        
        // Add styling options from customizer
        $ascent_light_user_css = ascent_light_customizer_css();        
        wp_add_inline_style( 'ascent-light-base-style', $ascent_light_user_css );
        
        /* Scripts */
        if ( !is_admin() ){ //add support for threaded comments
            if ( is_singular() AND comments_open() AND ( 1 == get_option('thread_comments') ))
            wp_enqueue_script( 'comment-reply' );
        }
        
        //load modernizer
        wp_enqueue_script( 'ascent-light-modernizer', get_template_directory_uri() . '/js/modernizr.custom.js', null, null, true );
        
        //load imagesloaded.js
        wp_enqueue_script( 'ascent-light-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', 'jquery', null, true );
        
        //load retina.js
        wp_enqueue_script( 'ascent-light-retina', get_template_directory_uri() . '/js/retina.js', null, null, true );
        
        //slidebars menu
        wp_enqueue_script( 'ascent-light-slidebars', get_template_directory_uri() . '/js/slidebars.js', null, null, true );
        
        //register the main js file
        wp_enqueue_script( 'ascent-light-custom', get_template_directory_uri() . '/js/custom.js', 'jquery', null, true );
    }
endif; //ascent_light_enqueue_scripts

add_action( 'wp_enqueue_scripts', 'ascent_light_enqueue_scripts' );


/* Load Default Google fonts for admin
 ------------------------------------------------------------------------------- */
function ascent_light_admin_fonts( $hook_suffix ) {
    wp_enqueue_style( 'ascent-light-google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,300,500,700|Open+Sans:400,700' );
    wp_enqueue_style( 'ascent-light-fontAwesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
}
add_action( 'admin_enqueue_scripts', 'ascent_light_admin_fonts' );


/* Load respond.js and html5shiv
------------------------------------------------------------------------------- */
function ascent_light_head_js() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . get_template_directory_uri() . '/js/html5shiv.js' . '"></script>' . "\n";
    echo '<script src="' . get_template_directory_uri() . '/js/respond.js' . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'ascent_light_head_js' );

/* The function to register sidebars & widgets
    ------------------------------------------------------------------------------- */

if ( ! function_exists( 'ascent_light_widgets_init' ) ) :

    function ascent_light_widgets_init() {
        
        /* Register widget areas
        --------------------------------------------------------------------------*/

        register_sidebar( array(
            'name' => __( 'Blog Sidebar', 'ascent-light' ),
            'id' => 'blog-sidebar',
            'description' => __( 'Default blog sidebar stuff', 'ascent-light' ),
            'before_widget' => '<div id="%1$s" class="styled-box widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="">',
            'after_title' => '</h3>',
        ));

        register_sidebar( array(
            'name' => __( 'Page Sidebar', 'ascent-light' ),
            'id' => 'page-sidebar',
            'description' => __( 'Default page sidebar stuff', 'ascent-light' ),
            'before_widget' => '<div id="%1$s" class="styled-box widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="">',
            'after_title' => '</h3>',
        ));
        
        register_sidebar( array(
            'name' => __( 'Shop Sidebar', 'ascent-light' ),
            'id' => 'shop-sidebar',
            'description' => __( 'Sidebar for the single EDD shop', 'ascent-light' ),
            'before_widget' => '<div id="%1$s" class="styled-box widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="">',
            'after_title' => '</h3>',
        ));
        
        register_sidebar( array(
            'name' => __( 'Checkout Sidebar', 'ascent-light' ),
            'id' => 'checkout-sidebar',
            'description' => __( 'Sidebar for the EDD checkout', 'ascent-light' ),
            'before_widget' => '<div id="%1$s" class="styled-box widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="">',
            'after_title' => '</h3>',
        ));
        
        register_sidebar( array(
            'name' => __( 'Footer Top Widget', 'ascent-light' ),
            'id' => 'footer-widget-top',
            'description' => __( 'Footer Top Widget', 'ascent-light' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="">',
            'after_title' => '</h3>',
        ));
        
        register_sidebar( array(
            'name' => __( 'Footer Middle Widget', 'ascent-light' ),
            'id' => 'footer-widget-middle',
            'description' => __( 'Footer Middle Widget', 'ascent-light' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="">',
            'after_title' => '</h3>',
        ));
        
        register_sidebar( array(
            'name' => __( 'Footer bottom Widget', 'ascent-light' ),
            'id' => 'footer-widget-bottom',
            'description' => __( 'Footer Bottom Widget', 'ascent-light' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="">',
            'after_title' => '</h3>',
        ));
        
        register_sidebar( array(
            'name' => __( 'Footer Terms Widget', 'ascent-light' ),
            'id' => 'footer-widget-terms',
            'description' => __( 'Footer Terms Widget', 'ascent-light' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="">',
            'after_title' => '</h3>',
        ));

    }

endif; //ascent_light_widgets_init

add_action( 'widgets_init', 'ascent_light_widgets_init' );


/* Load theme functions
------------------------------------------------------------------------------ */

require 'inc/functions-utility.php'; // Helper functions
require 'inc/functions-templates.php'; // Template functions
require 'inc/edd/functions.php'; // Custom functions for EDD