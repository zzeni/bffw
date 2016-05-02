<?php
/**
 * Displays the price and buy link for a product
 * @since themeora 1.03
 * @param string class - a css class to add to the container
 * @return string block of html for buttons.
 */
if ( ! function_exists( 'ascent_light_edd_buy_button' ) ) : ?>
<?php function ascent_light_edd_buy_button( $class = null ) { ?>
        <?php if( function_exists('edd_price')) { ?>
           <div class="text-center">
               <div class="product-cta <?php echo $class; ?> <?php edd_has_variable_prices(get_the_ID()) ? print 'product-cta-variable' : print 'product-cta-standard'; ?>">
                   <div class="product-price">
                       <?php 
                       if ( edd_has_variable_prices(get_the_ID()) ) {
                           // if the download has variable prices, show the first one as a starting price
                           echo '<h2>';
                           echo __('Starting at', 'ascent-light') . ' ';
                           echo edd_price(get_the_ID());
                           echo '</h2>';
                           
                           echo edd_get_purchase_link( array( 'id' => get_the_ID() ) );
                       } else {
                           edd_price(get_the_ID()); 
                       }
                       ?>
                   </div><!--end .product-price-->
                   <?php if ( function_exists('edd_price') ) { ?>
                       <div class="product-buttons">
                           <?php if ( !edd_has_variable_prices(get_the_ID()) ) { ?>
                               <?php
                               echo edd_get_purchase_link(
                                   array(
                                       'download_id' => get_the_ID(),
                                       'class' => 'edd-submit btn', // add your new classes here
                                       'price' => 0, // turn the price off
                                       'text' => __('Add to Cart', 'ascent-light')
                                   )
                               );
                               ?>
                           <?php } ?>
                       </div><!--end .product-buttons-->
                   <?php } ?>
               </div>
           </div>
       <?php } ?>
   <?php } ?>
<?php endif; ?>
<?php
// remove the standard button that shows after the download's content
remove_action('edd_after_download_content', 'edd_append_purchase_link');

// our own function to output the button
function ascent_light_edd_append_purchase_link($download_id) {
    if ( !get_post_meta($download_id, '_edd_hide_purchase_link', true)) {
        
        echo edd_get_purchase_link(
            array(
                'download_id' => $download_id,
                'class' => 'edd-submit btn', // add your new classes here
                'price' => 0, // turn the price off
                'text' => __('Buy', 'ascent-light')
            )
        );
    }
}

// rehook/add our function back to the same location as before
add_action('edd_after_download_content', 'ascent_light_edd_append_purchase_link');