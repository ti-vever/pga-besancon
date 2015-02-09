<?php
/******************************************/
//		POSTS SLIDER WIDGET
/******************************************/
class Pi_Posts_Slider_Widget extends WP_Widget {
	
	/**************************************/
	//			Posts Slider
	/**************************************/
	function Pi_Posts_Slider_Widget() {

		$widget_ops = array( 'classname' => 'pi_posts_slider_widget' ,'description' => __('A widget that displays recent posts in slider format.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_posts_slider_widget', __('Yourself: Recent Slider [PREMIUM]', 'theme_textdomain'), $widget_ops );
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
		$instance['post_type'] = $new_instance['post_type'];
		$instance['show_number'] = $new_instance['show_number'];
		$instance['height'] = $new_instance['height'];
		
		return $instance;
	}
	
    /**************************************/
    //			Form
    /**************************************/
	function form( $instance ) {

		$defaults = array( 'title' => 'Recent Posts', 'post_type' => 'post', 'show_number' => 4, 'height' => 200 );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$post_type = array('post' => 'Post', 'page' => 'Page', 'portfolio' => 'Portfolio');
		?>
		
		<div style="padding: 10px 10px 0px 10px; margin-bottom:10px; font-size: 13px; line-height: 1.6; background-color: #fffbcc; border: 1px solid #e6db55; color: #000; font-weight: bold;">
			<p class="premium-widgets"><?php echo pi_upgrade_cta("widgets"); ?></p>
		</div>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e('Type', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'post_type' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'post_type' ); ?>">
		        <?php foreach ( $post_type as $k => $v ) { ?>
		        <option value="<?php echo $k; ?>" <?php if($instance['post_type'] == $k){ echo "selected='selected'";} ?>><?php echo $v; ?></option>
		        <?php } ?>
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'show_number' ); ?>"><?php _e('No. Posts', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_number' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_number' ); ?>">
		        <?php for ( $i = 1; $i <= 10; $i += 1) { ?>
		        <option value="<?php echo $i; ?>" <?php if($instance['show_number'] == $i){ echo "selected='selected'";} ?>><?php echo $i; ?></option>
		        <?php } ?>
		    </select>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Images Height', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'height' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>">
		        <?php for ( $i = 50; $i <= 900; $i += 50) { ?>
		        <option value="<?php echo $i; ?>" <?php if($instance['height'] == $i){ echo "selected='selected'";} ?>><?php echo $i . " px"; ?></option>
		        <?php } ?>
		    </select>
		</p>
		<?php
	
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_posts_slider_widget() {
	register_widget('Pi_Posts_Slider_Widget');
}
add_action('widgets_init', 'register_pi_posts_slider_widget', 1);

/* Load Flex Slider */
function pi_load_flex_posts_widget(){
	if( is_active_widget(false, false, 'pi_posts_slider_widget') ) {
		wp_enqueue_script('flex-slider');
	}
}
add_action('wp_print_scripts', 'pi_load_flex_posts_widget');

/* Flex options */
function pi_load_posts_flex($flex_opts){ ?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#<?php echo $flex_opts["slider_id"]; ?>').flexslider({
			controlNav: false,
	    	animation: "slide"      
		 });
	});
	</script>
<?php 
}
add_action('pi_posts_slider_widget', 'pi_load_posts_flex');
?>