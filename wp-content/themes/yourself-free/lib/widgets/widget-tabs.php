<?php
/******************************************/
//			TABS WIDGET 
/******************************************/
class Pi_Tabs_Widget extends WP_Widget {
	
	/**************************************/
	//			Tabs
	/**************************************/
	function Pi_Tabs_Widget() {

		$widget_ops = array( 'classname' => 'pi_tabs_widget' ,'description' => __('A widget that display popular posts, recent posts, comments and tags.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_tabs_widget', 'Yourself: Tabs [PREMIUM]', $widget_ops );
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
		return $new_instance;
	}
	
    /**************************************/
    //			Form
    /**************************************/
	function form( $instance ) {

		$defaults = array( 'show_popular' => 'yes', 'show_popular_number' => 4, 'show_recent' => 'yes', 'show_recent_number' => 4, 'show_comments' => 'yes', 'show_comments_number' => 4,  'show_tags' => 'yes', 'show_tags_number' => 20 );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		
		<div style="padding: 10px 10px 0px 10px; margin-bottom:10px; font-size: 13px; line-height: 1.6; background-color: #fffbcc; border: 1px solid #e6db55; color: #000; font-weight: bold;">
			<p class="premium-widgets"><?php echo pi_upgrade_cta("widgets"); ?></p>
		</div>
		
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_popular' ); ?>"><?php _e('Popular', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_popular' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_popular' ); ?>">
		        <option value="yes" <?php if($instance['show_popular'] == "yes"){ echo "selected='selected'";} ?>><?php _e('Yes', 'theme_textdomain'); ?></option>
		        <option value="no" <?php if($instance['show_popular'] == "no"){ echo "selected='selected'";} ?>><?php _e('No', 'theme_textdomain'); ?></option>            
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_popular_number' ); ?>"><?php _e('No. Popular', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_popular_number' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_popular_number' ); ?>">
		        <?php for ( $i = 1; $i <= 10; $i += 1) { ?>
		        <option value="<?php echo $i; ?>" <?php if($instance['show_popular_number'] == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
		        <?php } ?>
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_recent' ); ?>"><?php _e('Recent', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_recent' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_recent' ); ?>">
		        <option value="yes" <?php if($instance['show_recent'] == "yes"){ echo "selected='selected'";} ?>><?php _e('Yes', 'theme_textdomain'); ?></option>
		        <option value="no" <?php if($instance['show_recent'] == "no"){ echo "selected='selected'";} ?>><?php _e('No', 'theme_textdomain'); ?></option>            
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_recent_number' ); ?>"><?php _e('No. Recent', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_recent_number' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_recent_number' ); ?>">
		        <?php for ( $i = 1; $i <= 10; $i += 1) { ?>
		        <option value="<?php echo $i; ?>" <?php if($instance['show_recent_number'] == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
		        <?php } ?>
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_comments' ); ?>"><?php _e('Comments', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_comments' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_comments' ); ?>">
		        <option value="yes" <?php if($instance['show_comments'] == "yes"){ echo "selected='selected'";} ?>><?php _e('Yes', 'theme_textdomain'); ?></option>
		        <option value="no" <?php if($instance['show_comments'] == "no"){ echo "selected='selected'";} ?>><?php _e('No', 'theme_textdomain'); ?></option>            
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_comments_number' ); ?>"><?php _e('No. Comments', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_comments_number' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_comments_number' ); ?>">
		        <?php for ( $i = 1; $i <= 10; $i += 1) { ?>
		        <option value="<?php echo $i; ?>" <?php if($instance['show_comments_number'] == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
		        <?php } ?>
		    </select>
		</p>				
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_tags' ); ?>"><?php _e('Tags', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_tags' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_tags' ); ?>">
		        <option value="yes" <?php if($instance['show_tags'] == "yes"){ echo "selected='selected'";} ?>><?php _e('Yes', 'theme_textdomain'); ?></option>
		        <option value="no" <?php if($instance['show_tags'] == "no"){ echo "selected='selected'";} ?>><?php _e('No', 'theme_textdomain'); ?></option>            
		    </select>
		</p>		
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_tags_number' ); ?>"><?php _e('No. Tags', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_tags_number' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_tags_number' ); ?>">
		        <?php for ( $i = 5; $i <= 50; $i += 5) { ?>
		        <option value="<?php echo $i; ?>" <?php if($instance['show_tags_number'] == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
		        <?php } ?>
		    </select>
		</p>		
		<?php
	}
}


/**************************************/
//	Register Widget & equeue JS
/**************************************/

function register_pi_tabs_widget() {
	register_widget('Pi_Tabs_Widget');
}
add_action('widgets_init', 'register_pi_tabs_widget', 1);
?>