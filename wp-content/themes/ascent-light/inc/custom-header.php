<?php
/**
* Add custom header with front-end styles and admin preview.
* @package Themeora
* @since Themeora 1.0
*/

add_theme_support( 'custom-header', apply_filters( 'ascent_light_custom_header_args', array(
    'default-text-color'     => 'fff',
    'width'                  => 1200,
    'height'                 => 650,
    'header-text'            => false,
    'wp-head-callback'       => '',
    'admin-head-callback'    => '',
    'admin-preview-callback' => '',
) ) );