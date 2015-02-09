<?php
/******************************************/
// 				Ad300 WIDGET
/******************************************/
class Pi_Ad300_Widget extends WP_Widget {
	
	/**************************************/
	//			Ad300*250
	/**************************************/
	function Pi_Ad300_Widget() {

		$widget_ops = array( 'classname' => 'pi_ad300_widget', 'description' => __('A widget that allows the display and configuration of a single 300x250 Banner.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_ad300_widget', 'Yourself: 300x250 Ad', $widget_ops );
	}
	
	/**************************************/
	//			Widget
	/**************************************/
	function widget( $args, $instance ) {
		
		extract($args);
	
		$title = apply_filters('widget_title', $instance['title'] );
		$code = $instance['code'];
		$img_url = $instance['img_url'];
		$link_url = $instance['link_url'];
		$alt = $instance['alt'];
		
		echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title; ?>
				
		<div class="ads-300">
		
			<?php
			if($code != '')
					echo $code;
				else
					echo '<a href="'.$link_url.'"><img alt="'.$alt.'" src="'.$img_url.'" width="300" height="250" /></a>';
			?>
		
		</div>
		
	<?php  echo $after_widget;	
	}
	
    /**************************************/
    //			Update
    /**************************************/
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['code'] = $new_instance['code'];
		$instance['img_url'] = strip_tags($new_instance['img_url']);
		$instance['link_url'] = strip_tags($new_instance['link_url']);
		$instance['alt'] = strip_tags($new_instance['alt']);
		
		return $instance;
	}
	
    /**************************************/
    //			Form
    /**************************************/
	function form( $instance ) {

		$defaults = array('title' => 'Our Partners', 'code' => '', 'img_url' => '', 'link_url' => '', 'alt' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'code' ); ?>"><?php _e('Option 1: Paste the Code', 'theme_textdomain'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'code' ); ?>" name="<?php echo $this->get_field_name( 'code' ); ?>"><?php echo $instance['code']?></textarea>
		</p>
		<p><?php _e('Option 2:  Fill in the Fields', 'theme_textdomain'); ?></p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'img_url' ); ?>"><?php _e('Image', 'theme_textdomain'); ?></label>
		    <input type="text" name="<?php echo $this->get_field_name( 'img_url' ); ?>" value="<?php echo $instance['img_url']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'img_url' ); ?>" />
		</p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'link_url' ); ?>"><?php _e('Link', 'theme_textdomain'); ?></label>
		    <input type="text" name="<?php echo $this->get_field_name( 'link_url' ); ?>" value="<?php echo $instance['link_url']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'link_url' ); ?>" />
		</p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'alt' ); ?>"><?php _e('Alt', 'theme_textdomain'); ?></label>
		    <input type="text" name="<?php echo $this->get_field_name( 'alt' ); ?>" value="<?php echo $instance['alt']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'alt' ); ?>" />
		</p>

		<?php
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_ad300_widget() {
	register_widget('Pi_Ad300_Widget');
}
add_action('widgets_init', 'register_pi_ad300_widget', 1);

?>