<?php

/**
 * Admin functions for Theme Customizer custom fonts
 * This file hooks with the ascent-light-admin-fonts-library.php file, in order to achieve 
 * custom fonts using Google Fonts.
 *
 *
 * @package WordPress
 * @author Themeora
 */

//Create a friendly version of font name
function ascent_light_font_family($font) {
    $family = str_replace(" ", "+", $font);
    return $family;
}

/*  ENQUEUE STANDARD FONTS AND CREATE ARRAY		                							
  --------------------------------------------------------------------- */

function ascent_light_enqueue_fonts() {
    //DEFAULTS
    $default = array(
        'default',
        'Default',
        'arial',
        'Arial',
        'courier',
        'Courier',
        'verdana',
        'Verdana',
        'trebuchet',
        'Trebuchet',
        'georgia',
        'Georgia',
        'times',
        'Times',
        'tahoma',
        'Tahoma',
        'helvetica',
        'Helvetica'
    );

    //ARRAY
    $fonts = array();

    //ADD IN MORE FONTS HERE, IF THE FONT FAMILY CHANGES IN THE CUSTOMIZER
    $type_select_headings = get_theme_mod('type_select_headings');
    $type_select_body = get_theme_mod('type_select_body');
    $type_select_logo = get_theme_mod('type_select_logo');

    if ($type_select_headings != '') {
        $fonts[] = $type_select_headings;
    }
    if ($type_select_body != '') {
        $fonts[] = $type_select_body;
    }
    if ($type_select_logo != '') {
        $fonts[] = $type_select_logo;
    }

    //REMOVE DUPLICATES
    $fonts = array_unique($fonts);

    //CHECK GOOGLE FONTS AGAINST SYSTEM, CALL ENQUE
    foreach ($fonts as $font) {
        //GOOGLE FONTS CHECK
        if (!in_array($font, $default)) {
            ascent_light_enqueue_google_fonts($font);
        } //END if(!in_array($font, $default)) 
    } //END foreach($fonts as $font)
}

//END function ascent_light_enqueue_fonts() 
add_action('wp_enqueue_scripts', 'ascent_light_enqueue_fonts');


/*  Enque the Google fonts	
--------------------------------------------------------------------- */

function ascent_light_enqueue_google_fonts($font) {
    $font = explode(',', $font);
    $font = $font[0];

    //CUSTOM CHECKS FOR CERTAIN FONTS
    if ($font == 'Open Sans') {
        $font = 'Open Sans:400,600';
    } else {
        $font = $font . ':400,500,700';
    }

    //FRIENDLY MOD
    $font = str_replace(" ", "+", $font);

    //CSS ENQUEUE
    wp_enqueue_style("ascent-light-google-$font", "https://fonts.googleapis.com/css?family=$font", false, null, 'all');
}

//END ascent_light_enqueue_google_fonts($font)