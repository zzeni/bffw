<?php 
/**
 * Admin functions for core framework features.
 * This file is the same contents as all themes using our framework
 *
 *
 * @package WordPress
 * @subpackage Themeora Framework
 * @author Themeora
 * @since Themeora Framework 1.0
 */
 
/* Textarea control
----------------------------------------------------------------------------------------------------*/
class Ascent_Light_Customize_Textarea_Control extends WP_Customize_Control 
{
    public $type = 'textarea'; 
    
    public function render_content() { ?>
        <label><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span></label>
        <textarea rows="4" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
    <?php
    } 
}

/* Info control
----------------------------------------------------------------------------------------------------*/
class Ascent_Light_Controls_Info_Control extends WP_Customize_Control {

    public $type = 'info';

    /**
     * Render the control's content.
     */
    public function render_content() {
        ?>
        <label>
        <?php if (!empty($this->label)) : ?>
        	<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
        <?php endif; ?>
        </label>
                
        <?php if (!empty($this->description)) : ?>
        	<span class="description ascent-light-info-control-description customize-control-description"><?php echo $this->description; ?></span>
        <?php endif; ?>
                
        <?php if (!$this->value()) : ?>
            <?php echo $this->value(); ?>
        <?php endif; ?>
                
        <?php
    }

}
