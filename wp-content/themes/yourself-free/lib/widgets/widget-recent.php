<?php
/******************************************/
//			RECENT POSTS WIDGET
/******************************************/
class Pi_Recent_Posts_Widget extends WP_Widget {
	
	/**************************************/
	//			Recent Posts
	/**************************************/
	function Pi_Recent_Posts_Widget() {

		$widget_ops = array( 'classname' => 'pi_recent_posts_widget' ,'description' => __('A widget that displays your latest posts with image.', 'theme_textdomain') );

		$this->WP_Widget( 'pi_recent_posts_widget', __('Yourself: Recent Posts', 'theme_textdomain'), $widget_ops );
	}
	
	/**************************************/
	//			Widget
	/**************************************/
	function widget( $args, $instance ) {
	
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title'] );
		$show_number = $instance['show_number'];
		$show_img = ( $instance['show_img'] == "yes" ) ? true : false; ?>
				
		<?php echo $before_widget;
	
		if ( $title ) echo $before_title . $title . $after_title; ?>
				
			<div class="recent-posts-widget">
				<ul class="clearfix">
				<?php
					
				$the_query = new WP_Query("showposts=$show_number");
								
				while ($the_query->have_posts()) : $the_query->the_post(); ?>
						
					<li class="clearfix">
						
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) && ($show_img) ) : ?>
							<div class="post-thumb">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php pi_resize_img("width=55&height=55"); ?></a>
							</div>
						<?php endif; ?>
							<div class="detail">
								<h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<span class="entry-meta"><?php the_time(get_option('date_format')); ?> // <a href="<?php comments_link(); ?>"><?php comments_number(__('No Comments', 'theme_textdomain'), __('1 Comment' ,'theme_textdomain'), __('% Comments', 'theme_textdomain')); ?></a></span>
							</div>
							
					</li>				
				<?php endwhile; wp_reset_query(); ?>
				</ul>
			</div>
	
		<?php echo $after_widget; ?>			
				
	<?php }
	
    /**************************************/
    //			Update
    /**************************************/
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_number'] = $new_instance['show_number'];
		$instance['show_img'] = $new_instance['show_img'];
		return $instance;
	}
	
    /**************************************/
    //			Form
    /**************************************/
	function form( $instance ) {

		$defaults = array( 'title' => 'Recent Posts', 'show_number' => 4, 'show_img' => 'yes');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'theme_textdomain'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
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
		    <label for="<?php echo $this->get_field_id( 'show_img' ); ?>"><?php _e('Display Image', 'theme_textdomain'); ?></label>
		    <select name="<?php echo $this->get_field_name( 'show_img' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'show_img' ); ?>">
		        <option value="yes" <?php if($instance['show_img'] == "yes"){ echo "selected='selected'";} ?>><?php _e('Yes', 'theme_textdomain'); ?></option>
		        <option value="no" <?php if($instance['show_img'] == "no"){ echo "selected='selected'";} ?>><?php _e('No', 'theme_textdomain'); ?></option>            
		    </select>
		</p>
		<?php
	
	}
}


/**************************************/
//			Register Widget
/**************************************/

function register_pi_recent_posts_widget() {
	register_widget('Pi_Recent_Posts_Widget');
}
add_action('widgets_init', 'register_pi_recent_posts_widget', 1);

?>