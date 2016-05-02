<?php


if ( ! function_exists( 'ascent_light_add_first_and_last' ) ) :
    /**
    *  Add a first and a last class to the menu 
    */
    function ascent_light_add_first_and_last( $output ) {
        $output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
        $output = substr_replace($output, 'class="last-menu-item menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
        return $output;
    }
    
endif;
add_filter('wp_nav_menu', 'ascent_light_add_first_and_last');


/**
 * Extend the walker to add our own class so we can use bootstrap dropdowns
 */
class Ascent_Light_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"sub-menu dropdown-menu\">\n";
  }
}

/**
 * Convert hex values such as #ffffff to rgba
 */
function ascent_light_hex2rgb( $hex = null ) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

/* Add retina support
------------------------------------------------------------------------------ */

/**
 * Retina images
 * This function is attached to the 'wp_generate_attachment_metadata' filter hook.
 */
function ascent_light_retina_support_attachment_meta( $metadata, $attachment_id ) {
    foreach ( $metadata as $key => $value ) {
        if ( is_array( $value ) ) {
            foreach ( $value as $image => $attr ) {
                if ( is_array( $attr ) )
                    ascent_light_retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
            }
        }
    }
    return $metadata;
}
add_filter( 'wp_generate_attachment_metadata', 'ascent_light_retina_support_attachment_meta', 10, 2 );

/**
 * Create retina-ready images
 * Referenced via retina_support_attachment_meta().
 */
function ascent_light_retina_support_create_images( $file, $width, $height, $crop = false ) {
    if ( $width || $height ) {
        $resized_file = wp_get_image_editor( $file );
        if ( ! is_wp_error( $resized_file ) ) {
            $filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );
 
            $resized_file->resize( $width * 2, $height * 2, $crop );
            $resized_file->save( $filename );
 
            $info = $resized_file->get_size();
 
            return array(
                'file' => wp_basename( $filename ),
                'width' => $info['width'],
                'height' => $info['height'],
            );
        }
    }
    return false;
}

/**
 * Delete retina-ready images
 * This function is attached to the 'delete_attachment' filter hook.
 */
function ascent_light_delete_retina_support_images( $attachment_id ) {
    $meta = wp_get_attachment_metadata( $attachment_id );
    if ( $meta ){
        $upload_dir = wp_upload_dir();
        $path = pathinfo( $meta['file'] );
        foreach ( $meta as $key => $value ) {
            if ( 'sizes' === $key ) {
                foreach ( $value as $sizes => $size ) {
                    $original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
                    $retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
                    if ( file_exists( $retina_filename ) )
                        unlink( $retina_filename );
                }
            }
        }
    }
}
add_filter( 'delete_attachment', 'ascent_light_delete_retina_support_images' );