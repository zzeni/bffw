<?php

/* Load the live preview js
  ---------------------------------------------------------------------------------------------------- */
add_action('customize_preview_init', 'ascent_light_customizer_live_preview');

function ascent_light_customizer_live_preview() {
    wp_enqueue_script('customizer', get_template_directory_uri() . '/inc/assets/js/customizer-preview.js', 'jquery', '1.0', true);
}

/* General settings
  ---------------------------------------------------------------------------------------------------- */
add_theme_support('custom-background');

add_action('customize_register', 'Ascent_Light_Customize_Register');

function Ascent_Light_Customize_Register($wp_customize) {
    
    // Remove background images
    $wp_customize->remove_control('background_image');
    $wp_customize->remove_section('background_image');
    
    // Load custom controls
    require_once( get_template_directory() . '/inc/themeora-admin-customizer-controls.php' );


    /* Fonts
      ---------------------------------------------------------------------------------------------------- */
    $fonts = '';
    $font_size_range = '';
    $font_lineheight_range = '';
    $font_letterspacing_range = '';
    $font_weight_range = '';
        
    //Load font list
    $fonts = ascent_light_fonts();

    $font_size_range = array(
        'min' => '10',
        'max' => '80',
        'step' => '1',
    );

    $font_lineheight_range = array(
        'min' => '10',
        'max' => '80',
        'step' => '1',
    );

    $font_letterspacing_range = array(
        'min' => '-5',
        'max' => '20',
        'step' => '1',
    );

    $font_weight_range = array(
        'bold' => 'bold',
        'normal' => 'normal',
    );
    
    
    /* Pro options
    ---------------------------------------------------------------------------------------------------- */
    $wp_customize->add_section('pro_options', array(
        'title' => __('Pro Upgrade', 'ascent-light'),
        'priority' => 1,
        )
    );
    
    $wp_customize->add_setting( 'pro_options_text', array(
	'sanitize_callback'    => 'ascent_light_sanitize_text',
    ) );
    $wp_customize->add_control( new Ascent_Light_Controls_Info_Control( $wp_customize, 'pro_options_text', array(
        'type' => 'info',
        'label' => __('Pro upgrade available','ascent-light'),
        'description' => __('<p>Upgrade today for loads more options to make your online store more succesful and unique. Get premium email support and boost your sales with a premium, easy to setup version of Ascent.</p><p><a class="button button-primary" href="https://themeora.com/downloads/ascent-premium/" taget="_blank">Go Pro</a></p>','ascent-light'),
        'section' => 'pro_options',
        'settings'    => 'pro_options_text',
    )) );
    
    /* Accent color
      ---------------------------------------------------------------------------------------------------- */
    $wp_customize->add_setting('theme_accent_color', array(
        'default' => '#17C69B',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'theme_accent_color', array(
        'label' => __('Accent Color', 'ascent-light'),
        'section' => 'colors',
        'settings' => 'theme_accent_color',
        'priority' => 1
    )));
    
        $wp_customize->add_section('image_logo_settings', array(
        'title' => __('Image Logo Settings', 'ascent-light'),
        'priority' => 2,
        )
    );
    
    /* Image logo settings
    ---------------------------------------------------------------------------------------------------- */

    $wp_customize->add_section('image_logo_settings', array(
        'title' => __('Image Logo Settings', 'ascent-light'),
        'priority' => 2,
        )
    );

    $wp_customize->add_setting('ascent-light-img-upload-logo', array(
        'sanitize_callback' => 'esc_url',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ascent-light-img-upload-logo', array(
        'label' => __('Logo', 'ascent-light'),
        'section' => 'image_logo_settings',
        'settings' => 'ascent-light-img-upload-logo',
        'priority' => 1
    )));

    $wp_customize->add_setting('ascent-light-img-upload-logo-width', array(
        'default' => '',
        'sanitize_callback' => 'ascent_light_sanitize_int',
    ));
    $wp_customize->add_control('ascent-light-img-upload-logo-width', array(
        'label' => __('Logo width (px)', 'ascent-light'),
        'section' => 'image_logo_settings',
        'type' => 'text',
        'priority' => 2,
        )
    );

    $wp_customize->add_setting('ascent-light-show-description-header', array(
        'default' => 'No',
        'sanitize_callback' => 'ascent_light_sanitize_text',
    ));
    $wp_customize->add_control('ascent-light-show-description-header', array(
        'type' => 'select',
        'label' => __('Show description in header', 'ascent-light'),
        'section' => 'image_logo_settings',
        'priority' => 3,
        'choices' => array(
            'No' => __('No', 'ascent-light'),
            'Yes' => __('Yes', 'ascent-light'),
        ),
    ));

    $wp_customize->add_setting('footer-logo', array(
        'sanitize_callback' => 'esc_url',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer-logo', array(
        'label' => __('Footer Logo', 'ascent-light'),
        'section' => 'image_logo_settings',
        'settings' => 'footer-logo',
        'priority' => 5
    )));

    $wp_customize->add_setting('footer-logo-width', array(
        'default' => '',
        'sanitize_callback' => 'ascent_light_sanitize_int',
    ));
    $wp_customize->add_control('footer-logo-width', array(
        'label' => __('Footer Logo width (px)', 'ascent-light'),
        'section' => 'image_logo_settings',
        'type' => 'text',
        'priority' => 6,
        )
    );

    /* Typograpgy logo settings
      ---------------------------------------------------------------------------------------------------- */
    $wp_customize->add_section('logo', array(
        'title' => __('Logo Typography', 'ascent-light'),
        'priority' => 3,
        )
    );

    $wp_customize->add_setting('type_select_logo', array(
        'default' => 'Open Sans',
        'sanitize_callback' => 'ascent_light_sanitize_fonts',
    ));
    $wp_customize->add_control('type_select_logo', array(
        'type' => 'select',
        'label' => __('Logo Font', 'ascent-light'),
        'section' => 'logo',
        'priority' => 3,
        'choices' => $fonts
        )
    );

    $wp_customize->add_setting('type_logo_size', array(
        'default' => '26',
        'sanitize_callback' => 'ascent_light_sanitize_int',
    ));
    $wp_customize->add_control('type_logo_size', array(
        'type' => 'text',
        'label' => __('Logo Size', 'ascent-light'),
        'section' => 'logo',
        'settings' => 'type_logo_size',
        'priority' => 4,
    ));


    /* General settings
      ---------------------------------------------------------------------------------------------------- */

    $wp_customize->add_section('general_settings', array(
        'title' => __('General Settings', 'ascent-light'),
        'priority' => 4,
        )
    );
    
    $wp_customize->add_setting('ascent-light-homepage-banner-image', array(
        'sanitize_callback' => 'esc_url',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ascent-light-homepage-banner-image', array(
        'label' => __('Banner image on homepage', 'ascent-light'),
        'section' => 'general_settings',
        'settings' => 'ascent-light-homepage-banner-image',
        'priority' => 5
    )));
    
    $wp_customize->add_setting('ascent-light-homepage-banner-image-width', array(
        'default' => '',
        'sanitize_callback' => 'ascent_light_sanitize_int',
    ));
    $wp_customize->add_control('ascent-light-homepage-banner-image-width', array(
        'label' => __('Banner image max-width (px)', 'ascent-light'),
        'section' => 'general_settings',
        'type' => 'text',
        'priority' => 6,
        )
    );

    /* Background settings
      ---------------------------------------------------------------------------------------------------- */

    $wp_customize->add_section('background', array(
        'title' => __('Background', 'ascent-light'),
        'priority' => 10,
        )
    );


    /* Transport for live previews
      ---------------------------------------------------------------------------------------------------- */

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('ascent-light-img-upload-logo-width')->transport = 'postMessage';
    $wp_customize->get_setting('ascent-light-homepage-banner-image-width')->transport = 'postMessage';
    $wp_customize->get_setting('footer-logo-width')->transport = 'postMessage';
    $wp_customize->get_setting('type_logo_size')->transport = 'postMessage';
    $wp_customize->get_setting('theme_accent_color')->transport = 'postMessage';
}

/* Sanetize callbacks
  ---------------------------------------------------------------------------------------------------- */

function ascent_light_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}

//Integers
function ascent_light_sanitize_int($input) {
    if (is_numeric($input)) {
        return intval($input);
    }
}

//Text
function ascent_light_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}

//Url
function ascent_light_sanitize_url($input) {
    return esc_url($input);
}

function ascent_light_sanitize_text_field($input) {
    return wp_kses_post($input);
}

//Fonts
function ascent_light_sanitize_fonts($input) {
    $valid = ascent_light_fonts();
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}
