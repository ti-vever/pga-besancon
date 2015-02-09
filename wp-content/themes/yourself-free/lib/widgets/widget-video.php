<?php
/******************************************/
// 					VIDEO WIDGET
/******************************************/
class Pi_Video_Widget extends WP_Widget {
	
	/**************************************/
	//			Screenshot
	/**************************************/
	function Pi_Video_Widget() {

		$widget_ops = array( 'classname' => 'pi_video_widget', 'description' => __('A widget that Display YouTube or Vimeo Videos.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_video_widget', 'Yourself: Video [PREMIUM]', $widget_ops );
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
		$instance['desc'] = strip_tags($new_instance['desc']);
		$instance['img'] = strip_tags($new_instance['img']);
		$instance['video'] = strip_tags($new_instance['video']);
		$instance['excerpt'] = strip_tags($new_instance['excerpt']);
		$instance['height'] = $new_instance['height'];
		
		return $instance;
		
	}
	
    /**************************************/
    //			Form
    /**************************************/
	function form( $instance ) {

		$defaults = array('title' => '', 'desc' => '', 'img' => '', 'video' => '', 'height' => 200, 'excerpt' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<div style="padding: 10px 10px 0px 10px; margin-bottom:10px; font-size: 13px; line-height: 1.6; background-color: #fffbcc; border: 1px solid #e6db55; color: #000; font-weight: bold;">
			<p class="premium-widgets"><?php echo pi_upgrade_cta("widgets"); ?></p>
		</div>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Description', 'theme_textdomain'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo $instance['desc']?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'img' ); ?>"><?php _e('Image *optional', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'img' ); ?>" name="<?php echo $this->get_field_name( 'img' ); ?>" value="<?php echo $instance['img']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'video' ); ?>"><?php _e('Vimeo or Youtube URL', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'video' ); ?>" name="<?php echo $this->get_field_name( 'video' ); ?>" value="<?php echo $instance['video']; ?>" />
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Image/Video Height', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'height' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>">
		        <?php for ( $i = 50; $i <= 900; $i += 50) { ?>
		        <option value="<?php echo $i; ?>" <?php if($instance['height'] == $i){ echo "selected='selected'";} ?>><?php echo $i . " px"; ?></option>
		        <?php } ?>
		    </select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt' ); ?>"><?php _e('Excerpt', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'excerpt' ); ?>" name="<?php echo $this->get_field_name( 'excerpt' ); ?>" value="<?php echo $instance['excerpt']; ?>" />
		</p>
		<p><small>*<?php _e('Display video using lightbox effect.', 'theme_textdomain'); ?></small></p>
		<?php
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_video_widget() {
	register_widget('Pi_Video_Widget');
}
add_action('widgets_init', 'register_pi_video_widget', 1);

?>