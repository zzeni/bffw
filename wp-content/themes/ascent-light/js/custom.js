
jQuery(document).ready(function($) {
    
    // Set the height of the portfolio when the images have loaded
    jQuery('.portfolio-row').imagesLoaded( function() {
        themeoraPortfolioHover();
        $.slidebars();
    });
    
    themeoraWelcomeScreenEffects();
    themeoraValign();

    
    function themeoraWelcomeScreenEffects(){
        
        if ( $('.hero-area').length ) {
            //load the main bg image when it has finished loading
            var imagePath = $('.hero-area').data('welcome-background');
            var welcomeScreen = $('.hero-area');
            var welcomeContent = $('.hero-area-content');
            var pageWrapper = $('.page-wrapper');
            
            if ( imagePath ){
                var headerImage = new Image();
                headerImage.src = imagePath;

                //check if there is an image to load, if there is, try to load it, it not, just show the content

                headerImage.onload = function() {
                    //set the background of the welcome screen now we know it has loaded
                    $(welcomeScreen).css('background-image', 'url('+ imagePath +')').fadeIn('slow');
                    //fade the welcome screen in now that the image is loaded
                    setTimeout(function() { // Delay the fade in so pace.js has a chance to finish
                        $(welcomeScreen).fadeIn('slow', function(){
                            //now the image is loaded, show the content as well
                            $(welcomeContent).css({opacity: 0, visibility: "visible"}).animate({opacity: 1}, 600);
                            // now do the nav animation if enabled
                            themeoraNavEffects();
                        });
                    }, 1500 );
                };
                headerImage.src = imagePath; // This is required for ie8 to load the image first time

                headerImage.onerror = function () {
                    //if the image fails to load we should still load the content!
                    $(welcomeContent, welcomeScreen).fadeIn('fast'); //show the content
                    $(welcomeContent, welcomeScreen).css({opacity: 0, visibility: "visible"}).animate({opacity: 1}, 600);
                    // now do the nav animation if enabled
                    themeoraNavEffects();
                }
            }
            else {
                //show the content if the image fails for any reason
                $(welcomeContent, welcomeScreen).fadeIn('slow');
                $(welcomeContent, welcomeScreen).css({opacity: 0, visibility: "visible"}).animate({opacity: 1}, 600);
                // now do the nav animation if enabled
                themeoraNavEffects();
            }
        }
        // If there is no 'welcome' image, still animate the nav
        else {
            // now do the nav animation if enabled, with a slight delay
            //setTimeout(function() {
                themeoraNavEffects();
            //}, 1000);
        }
    }
    
       /* Subtle effect which animates the navbar in and out
    ----------------------------------------------- */
    function themeoraNavEffects(){
        // check if the effect is enabled and only do this if it is
        if ( $( 'nav.primary-navigation' ).hasClass('animate-nav') ) {
            // Set the page wrapper top padding to match the height of the nav in order to clear it
            var navHeight = $('nav.primary-navigation').outerHeight();
            $('.page-wrapper').css('padding-top', navHeight + 'px');
            $('nav.primary-navigation').css('min-height', navHeight + 'px');
            
            // If the page has a hero banner do the toggle effect, otherwise delay the effect so we can still see it
            if ( $('header.hero-area').length ) {
                $('nav.primary-navigation').slideToggle(500);
            }
            else {
                setTimeout(function() {
                    $('nav.primary-navigation').slideToggle(500);
                },1000);
            }
        }
    }
    
    /* Menu functions */
    $('.menu-item-has-children').each(function(){
        var dropdownLink = jQuery(this);
        $(dropdownLink).find('a:first').attr('data-toggle', 'dropdown');
        $(dropdownLink).find('a:first').attr('data-hover', 'dropdown');

        $(dropdownLink).find('a:first').append('<b class="caret"></b>').addClass('dropdown-toggle');
        $(dropdownLink).find('a:first').parent('li').addClass('dropdown');
    });
    
   /* Add slideup & fadein animation to dropdown */
   $('.dropdown').on('show.bs.dropdown', function(e){
      var $dropdown = $(this).find('.dropdown-menu');
      var orig_margin_top = parseInt($dropdown.css('margin-top'));
      $dropdown.css({'margin-top': (orig_margin_top + 10) + 'px', opacity: 0}).animate({'margin-top': orig_margin_top + 'px', opacity: 1}, 300, function(){
         $(this).css({'margin-top':''});
      });
   });
   
   /* Add slidedown & fadeout animation to dropdown */
   $('.dropdown').on('hide.bs.dropdown', function(e){
      var $dropdown = $(this).find('.dropdown-menu');
      var orig_margin_top = parseInt($dropdown.css('margin-top'));
      $dropdown.css({'margin-top': orig_margin_top + 'px', opacity: 1, display: 'block'}).animate({'margin-top': (orig_margin_top + 10) + 'px', opacity: 0}, 300, function(){
         $(this).css({'margin-top':'', display:''});
      });
   });
    
    /* Portfolio functions */
    $('.portfolio-item').hover(function(){
        $(this).find('.portfolio-title').fadeIn('fast');
    }, function(){
        $('.portfolio-title').fadeOut('fast');
    });
    
    
    // Search form - prevent submission if no value is entered
    $('#searchform, .search-form').submit(function(e){
        if ($('#s').val() == '') {
            e.preventDefault();
        }
    });
    
    /* Simple helpers to add useful CSS classes to hard to change Wordpress markup */
    $('#commentform #submit').addClass('btn btn-lg');
    $('.post-password-form input[type="submit"]').addClass('btn btn-lg');
    $('.search-form .search-submit').addClass('btn');
    $('.wpcf7-submit').addClass('btn');
    
});

jQuery(window).load(function($){
});

jQuery(window).resize(function($){
    themeoraPortfolioHover();
});

/* Set the height of portfolio items */

/* Apply a hover effect to the portfolio items */
function themeoraPortfolioHover(){
    // Fist, reset any height added
    jQuery( '.masonry-item' ).css('height', '');
    jQuery( '.portfolio-item' ).css('height', '');
    // Now set a height on each portfolio item
    var masonryItem = jQuery('.masonry-item');
    var portfolioItem = jQuery('.portfolio-item');
    
    jQuery( masonryItem ).each( function(){
        var height = jQuery(this).height();
        jQuery( this ).css('height', height + 'px');
        jQuery( this ).find('.portfolio-details').css('height', height + 'px');
    });
    
    jQuery( portfolioItem ).each( function(){
        var height = jQuery(this).height();
        jQuery( this ).css('height', height + 'px');
        jQuery( this ).find('.portfolio-details').css('height', height + 'px');
    });
}


function themeoraValign() {
    jQuery('.product-price span').verticalAlign();
    jQuery('.hero-content').verticalAlign();
}

/* A function to add vertical alignment */
jQuery.fn.verticalAlign = function ()
{
    return this
    .css("margin-top",(jQuery(this).parent().height() - jQuery(this).height())/2 + 'px' )
};