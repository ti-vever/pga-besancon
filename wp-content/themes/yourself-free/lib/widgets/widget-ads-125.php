<?php
/******************************************/
// 				125Ads WIDGET
/******************************************/
class Pi_Ads125_Widget extends WP_Widget {
	
	/**************************************/
	//			Ad135*125
	/**************************************/
	function Pi_Ads125_Widget() {

		$widget_ops = array( 'classname' => 'pi_ads125_widget', 'description' => __('A widget that allows the display and configuration of 4 125x125 banners.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_ads125_widget', 'Yourself: 125x125 Ads', $widget_ops );
	}
	
	/**************************************/
	//			Widget
	/**************************************/
	function widget( $args, $instance ) {
	
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title'] );
		$img_1 = $instance['img_1'];
		$link_1 = $instance['link_1'];
		$img_2 = $instance['img_2'];
		$link_2 = $instance['link_2'];
		$img_3 = $instance['img_3'];
		$link_3 = $instance['link_3'];
		$img_4 = $instance['img_4'];
		$link_4 = $instance['link_4'];
		
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title; ?>
				
		<div class="ads-125 clearfix">
		
			<ul>
		
				<?php
				if($img_1 != '' && $link_1 != '')
					echo '<li><a href="'.$link_1.'"><img alt="" src="'.$img_1.'" width="125" height="125" /></a></li>';
					
				if($img_2 != '' && $link_2 != '')
					echo '<li><a href="'.$link_2.'"><img alt="" src="'.$img_2.'" width="125" height="125" /></a></li>';
					
				if($img_3 != '' && $link_3 != '')
					echo '<li><a href="'.$link_3.'"><img alt="" src="'.$img_3.'" width="125" height="125" /></a></li>';	
					
				if($img_4 != '' && $link_4 != '')
					echo '<li><a href="'.$link_4.'"><img alt="" src="'.$img_4.'" width="125" height="125" /></a></li>';
				?>
			
			</ul>
		
		</div>
		
	<?php  echo $after_widget;	
	}
	
    /**************************************/
    //			Update
    /**************************************/
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['img_1'] = strip_tags($new_instance['img_1']);
		$instance['link_1'] = strip_tags($new_instance['link_1']);
		$instance['img_2'] = strip_tags($new_instance['img_2']);
		$instance['link_2'] = strip_tags($new_instance['link_2']);
		$instance['img_3'] = strip_tags($new_instance['img_3']);
		$instance['link_3'] = strip_tags($new_instance['link_3']);
		$instance['img_4'] = strip_tags($new_instance['img_4']);
		$instance['link_4'] = strip_tags($new_instance['link_4']);
		
		return $instance;
		
	}
	
    /**************************************/
    //			Form
    /**************************************/
	function form( $instance ) {

		$defaults = array('title' => 'Our Partners', 'img_1' => '', 'link_1' => '', 'img_2' => '', 'link_2' => '', 'img_3' => '', 'link_3' => '', 'img_4' => '', 'link_4' => '', );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'img_1' ); ?>"><?php _e('Image 1', 'theme_textdomain'); ?></label>
		    <input type="text" name="<?php echo $this->get_field_name( 'img_1' ); ?>" value="<?php echo $instance['img_1']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'img_1' ); ?>" />
		</p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'link_1' ); ?>"><?php _e('Link 1', 'theme_textdomain'); ?></label>
		    <input type="text" name="<?php echo $this->get_field_name( 'link_1' ); ?>" value="<?php echo $instance['link_1']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'link_1' ); ?>" />
		</p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'img_2' ); ?>"><?php _e('Image 2', 'theme_textdomain'); ?></label>
		    <input type="text" name="<?php echo $this->get_field_name( 'img_2' ); ?>" value="<?php echo $instance['img_2']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'img_2' ); ?>" />
		</p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'link_2' ); ?>"><?php _e('Link 2', 'theme_textdomain'); ?></label>
		    <input type="text" name="<?php echo $this->get_field_name( 'link_2' ); ?>" value="<?php echo $instance['link_2']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'link_2' ); ?>" />
		</p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'img_3' ); ?>"><?php _e('Image 3', 'theme_textdomain'); ?></label>
		    <input type="text" name="<?php echo $this->get_field_name( 'img_3' ); ?>" value="<?php echo $instance['img_3']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'img_3' ); ?>" />
		</p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'link_3' ); ?>"><?php _e('Link 3', 'theme_textdomain'); ?></label>
		    <input type="text" name="<?php echo $this->get_field_name( 'link_3' ); ?>" value="<?php echo $instance['link_3']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'link_3' ); ?>" />
		</p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'img_4' ); ?>"><?php _e('Image 4', 'theme_textdomain'); ?></label>
		    <input type="text" name="<?php echo $this->get_field_name( 'img_4' ); ?>" value="<?php echo $instance['img_4']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'img_4' ); ?>" />
		</p>
		<p>	
		    <label for="<?php echo $this->get_field_id( 'link_4' ); ?>"><?php _e('Link 4', 'theme_textdomain'); ?></label>
		    <input type="text" name="<?php echo $this->get_field_name( 'link_4' ); ?>" value="<?php echo $instance['link_4']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'link_4' ); ?>" />
		</p>
		<?php
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_ads125_widget() {
	register_widget('Pi_Ads125_Widget');
}
add_action('widgets_init', 'register_pi_ads125_widget', 1);

?>