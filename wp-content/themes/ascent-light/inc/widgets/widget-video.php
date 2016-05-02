<?php
/**
 * Widget Name: Themeora Video Widget
 * Widget URI: http://themeora.com
 * Description:  A widget that displays your YouTube or Vimeo Video.
 * Author: Themeora
 * Author URI: http://themeora.com
 *   
 * @package WordPress
 * @subpackage Themeora
 * @author Themeora
 * @since Themeora 1.0
 */


add_action( 'widgets_init', 'register_ascent_light_video_widget' ); // function to load my widget  

function register_ascent_light_video_widget() { // function to register my widget  
     register_widget( 'Ascent_light_Video_Widget' );
}

class Ascent_light_Video_Widget extends WP_Widget {
    
    function ascent_light_Video_Widget() {
        $widget_ops = array( 'classname' => 'ascent-light-video', 'description' => __('A simple video widget that makes it easy to add responsive videos ', 'ascent-light') );  
        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ascent-light-video-widget' );  
        parent::__construct( 'ascent-light-video-widget', __('Themeora Video Widget', 'ascent-light'), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title'] );
        $url = $instance['url'];
        
        echo $before_widget;
        
        if ( $title )
            echo $before_title . esc_html( $title ) . $after_title;
        
        if ( $url )
            echo '<div class="embed-container">'. $url . '</div>';
        
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        //Strip tags from title and name to remove HTML 
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['url'] = $new_instance['url'];

        return $instance;
    }

    function form($instance) {
        //Set up some default widget settings.
        $defaults = array('title' => __('', 'ascent-light'), 'url' => __('', ''));
        $instance = wp_parse_args((array) $instance, $defaults);
?>
                
        <p>
            <small><?php _e('Enter a title (if required) and embed URL of a video here:', 'ascent-light'); ?></small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ascent-light'); ?></label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Video Embed Code:', 'ascent-light'); ?></label>
            <input id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo htmlspecialchars($instance['url']); ?>" style="width:100%;" />
        </p>
                
        <?php
    }

}
?>
