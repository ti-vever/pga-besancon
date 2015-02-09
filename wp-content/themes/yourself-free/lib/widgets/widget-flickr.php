<?php
/******************************************/
// 				FLICKR WIDGET
/******************************************/
class Pi_Flickr_Widget extends WP_Widget {
	
	/**************************************/
	//			Flickr
	/**************************************/
	function Pi_Flickr_Widget() {

		$widget_ops = array('classname' =>'pi_flickr_widget', 'description' => __('A widget that displays user/group Flickr photos.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_flickr_widget', 'Yourself: Flickr', $widget_ops );
	}
	
	/**************************************/
	//			Widget
	/**************************************/
	function widget( $args, $instance ) {
		
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];
		$type = $instance['type'];
		$show_number = $instance['show_number'];
		$sorting = $instance['sorting']; ?>
		
			<?php echo $before_widget;
	
			if ( $title ) echo $before_title . $title . $after_title; ?>
			
			<div class="pi-flickr-widget clearfix">
			
				<?php echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$show_number.'&amp;display='.$sorting.'&amp;&amp;layout=x&amp;source='.$type.'&amp;'.$type.'='.$username.'&amp;size=s"></script>'; ?>
				
			</div>
				
			<?php echo $after_widget; ?>
			
	<?php }
	
    /**************************************/
    //			Update
    /**************************************/
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['type'] = $new_instance['type'];
		$instance['show_number'] = $new_instance['show_number'];
		$instance['sorting'] = $new_instance['sorting'];
		
		return $instance;
		
	}
	
    /**************************************/
    //			Form
    /**************************************/
	function form( $instance ) {

		$defaults = array( 'title' => 'Flickr Photos', 'username' => '', 'type' => 'user', 'show_number' => 1, 'sorting' => 'latest');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title','theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Flickr ID','theme_textdomain'); ?></label>
		    <input type="text" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" />
		    <small><?php _e('More info','theme_textdomain'); ?> <a href="http://www.idgettr.com" target="_blank">idGettr</a></small>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Account Type','theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'type' ); ?>">
		        <option value="user" <?php if($instance['type'] == "user"){ echo "selected='selected'";} ?>><?php _e('User','theme_textdomain'); ?></option>
		        <option value="group" <?php if($instance['type'] == "group"){ echo "selected='selected'";} ?>><?php _e('Group','theme_textdomain'); ?></option>            
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_number' ); ?>"><?php _e('No. Photos','theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_number' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_number' ); ?>">
		        <?php for ( $i = 1; $i <= 10; $i += 1) { ?>
		        <option value="<?php echo $i; ?>" <?php if($instance['show_number'] == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
		        <?php } ?>
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'sorting' ); ?>"><?php _e('Display','theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'sorting' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'sorting' ); ?>">
		        <option value="latest" <?php if($instance['sorting'] == "latest"){ echo "selected='selected'";} ?>><?php _e('Latest','theme_textdomain'); ?></option>
		        <option value="random" <?php if($instance['sorting'] == "random"){ echo "selected='selected'";} ?>><?php _e('Random','theme_textdomain'); ?></option>            
		    </select>
		</p>

		<?php
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_flickr_widget() {
	register_widget('Pi_Flickr_Widget');
}
add_action('widgets_init', 'register_pi_flickr_widget', 1);

?>