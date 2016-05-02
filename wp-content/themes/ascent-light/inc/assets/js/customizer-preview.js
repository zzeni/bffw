/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
 
( function( $ ) {
    //LIVE HTML
    wp.customize( 'blogname', function( value ) {
        value.bind( function( newval ) {
            $( '.logo-text' ).html( newval );
        } );
    } );
	
    wp.customize( 'ascent-light-homepage-banner-image-width', function( value ) {
        value.bind( function( newval ) {
            $( '.homepage-banner-image' ).css('max-width',  newval + 'px' );
        } );
    } );
    
    wp.customize( 'theme_accent_color', function( value ) {
        value.bind( function( newval ) {
            $( '.accent-background' ).css('background-color',  newval );
        } );
    } );
    
    wp.customize( 'ascent-light-img-upload-logo-width', function( value ) {
        value.bind( function( newval ) {
            $( '.logo-uploaded' ).css('width',  newval + 'px' );
        } );
    } );
    
    wp.customize('footer-logo-width', function (value) {
        value.bind(function (newval) {
            $('.footer-logo-uploaded').css('width', newval + 'px');
        });
    });

    wp.customize('type_logo_size', function (value) {
        value.bind(function (newval) {
            $('h1.site-title').css('font-size', newval + 'px');
        });
    });
    
    wp.customize('type_select_logo', function (value) {
        value.bind(function (newval) {
            $('.h1.site-title').css('font-family', newval);
        });
    });

    wp.customize('blogdescription', function (value) {
        value.bind(function (newval) {
            $('.site-description').html(newval);
        });
    });

})(jQuery);
