<?php
/******************************************/
//			FEATURED POST WIDGET
/******************************************/
class Pi_Featured_Post_Widget extends WP_Widget {
	
	/**************************************/
	//		Featured Post Widget
	/**************************************/
	function Pi_Featured_Post_Widget() {

		$widget_ops = array( 'classname' => 'pi_featured_post_widget' ,'description' => __('A widget that displays a featured post.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_featured_post_widget', __('Yourself: Featured Post', 'theme_textdomain'), $widget_ops );
	}
	
	/**************************************/
	//			Widget
	/**************************************/
	function widget( $args, $instance ) {
	
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title'] );
		$post_id = $instance['post_id'];
				
		echo $before_widget;
	
		if ( $title ) echo $before_title . $title . $after_title; 		
		$custom_post = get_post($post_id); 
		if( !empty($custom_post) ){ ?>
		
			<!-- BEGIN .post-content -->
			<div class="post-content clearfix">
				<h4 class="featured-entry-title"><a href="<?php $custom_post->guid; ?>" rel="bookmark" title="<?php echo $custom_post->post_title; ?>"><?php echo $custom_post->post_title; ?></a></h4>
				<div class="featured-entry-content">
					<p><?php echo $custom_post->post_excerpt; ?></p>
					<p><?php the_time( get_option('date_format') ); ?> // <?php _e('By', 'theme_textdomain'); ?> : <a href="<?php echo get_author_posts_url($custom_post->post_author); ?>" title="author"><?php echo get_the_author_meta( 'display_name', $custom_post->post_author ); ?></a></p>
				</div>				
			<!-- END .post-content -->
			</div>
			
		<?php }
		
		echo $after_widget; ?>			
				
	<?php }
	
    /**************************************/
    //			Update
    /**************************************/
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['post_id'] = absint($new_instance['post_id']);

		return $instance;
	}
	
    /**************************************/
    //			Form
    /**************************************/
	function form( $instance ) {

		$defaults = array( 'title' => '', 'post_id' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php _e('Post ID', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'post_id' ); ?>" name="<?php echo $this->get_field_name( 'post_id' ); ?>" value="<?php echo $instance['post_id']; ?>" />
		</p>
		<?php
	
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_featured_post_widget() {
	register_widget('Pi_Featured_Post_Widget');
}
add_action('widgets_init', 'register_pi_featured_post_widget', 1);

?>