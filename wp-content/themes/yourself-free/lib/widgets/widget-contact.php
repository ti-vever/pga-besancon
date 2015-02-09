<?php
/******************************************/
//			CONTACT WIDGET
/******************************************/
class Pi_Contact_Form_Widget extends WP_Widget {
	
	/**************************************/
	//			Recent Posts
	/**************************************/
	function Pi_Contact_Form_Widget() {

		$widget_ops = array( 'classname' => 'pi_contact_form_widget' ,'description' => __('A widget to provide users contact form.', 'theme_textdomain') );
		$this->WP_Widget( 'pi_contact_form_widget', __('Yourself: Contact Form [PREMIUM]', 'theme_textdomain'), $widget_ops );
	}
	
	/**************************************/
	//			Widget
	/**************************************/
	function widget( $args, $instance ) {	
				
	}
	
    /**************************************/
    //			Update
    /**************************************/
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);		
		return $instance;
		
	}
	
    /**************************************/
    //			Form
    /**************************************/
	function form( $instance ) {

		$defaults = array( 'title' => 'Contact Form');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<div style="padding: 10px 10px 0px 10px; margin-bottom:10px; font-size: 13px; line-height: 1.6; background-color: #fffbcc; border: 1px solid #e6db55; color: #000; font-weight: bold;">
			<p class="premium-widgets"><?php echo pi_upgrade_cta("widgets"); ?></p>
		</div>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p><?php _e('The emails will been send to ', 'theme_textdomain'); ?><strong><?php echo of_get_option('contact_email') ?></strong><?php _e('You can change this email in:', 'theme_textdomain'); ?><a href="<?php echo admin_url( 'themes.php?page=options-framework' ); ?>">Options Panel</a></p>
		<?php
	
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_contact_form_widget() {
	register_widget('Pi_Contact_Form_Widget');
}
add_action('widgets_init', 'register_pi_contact_form_widget', 1);

?>