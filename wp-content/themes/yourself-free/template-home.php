<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

<!-- BEGIN #featured-home -->
<div id="featured-home">
	<?php if( of_get_option('enable_featured_homepage') ) : ?>
		<?php switch(of_get_option('hompepage_featured_type')) {
			case 'slider':
				$slider_name = of_get_option('homepage_slider');
				echo pi_get_slider( $slider_name );
				break;
			case 'video':
				echo pi_get_video(of_get_option('homepage_video'));
				break;
			case 'image': 
				$image = vt_resize( '', of_get_option('homepage_img') , 1280, of_get_option('homepage_height'), true );
				echo '<img src="'. $image['url'] .'" alt="featured image" />';		
		  		break;
		} ?>
<?php endif; ?>	
<!-- #featured-home -->
</div>

<!-- BEGIN call-to-action -->
<?php if( of_get_option('enable_call_to_action') ): ?>
	<div class="call-to-action clearfix">
		<?php if( of_get_option('call_to_action_title') != '' ) ?>
			<h2 class="impact-header"><?php echo of_get_option('call_to_action_title');  ?></h2>
		<?php if( of_get_option('call_to_action_description') != '' ) ?>
			<p><?php echo of_get_option('call_to_action_description'); ?></p>
		<?php if( of_get_option('call_to_action_url') != '' && of_get_option('call_to_action_button') != '' ) ?>
			<a class="btn grey" href="<?php echo of_get_option('call_to_action_url'); ?>" title="<?php of_get_option('call_to_action_button'); ?>"><span><?php echo of_get_option('call_to_action_button'); ?></span></a>
	</div>
<?php endif; ?>
<!-- END call-to-action -->

<!-- BEGIN #content -->
<div id="content" class="clearfix">
		
	<!-- BEGIN #blog-posts -->
		<div id="blog-posts">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
				<!-- BEGIN .post -->
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					
					<?php $video = get_post_meta( get_the_ID(), 'post-fields', true ); ?>
					
					<!-- BEGIN .post-content -->
					<div class="post-content clearfix">
							
						<?php if( $video['vimeo-youtube'] != '' ) : ?>
							<div class="post-video">
								<?php pi_embed_video(get_the_ID(),'', pi_get_blog_image_width(), stripslashes(of_get_option('img_size_single_post')), 'post-fields'); ?>
							</div>
						<?php elseif( has_post_thumbnail() ) : ?>
							<div class="post-thumb">
								<?php pi_resize_img("width=" . pi_get_blog_image_width() . "&height=" . stripslashes( of_get_option('img_size_single_post') ) ); ?>
							</div>
						<?php endif; ?>
						<?php if( current_user_can('edit_post', $post->ID) ): ?>
							<div class="edit-message">
								<?php edit_post_link( __('Edit this', 'theme_textdomain') ); ?>
							</div>
						<?php endif; ?>
						<div class="entry-content clearfix">
							<?php the_content(); ?>
						</div>
					<!-- END .post-content -->	
					</div>
					
				<!-- END .post -->
				</div>
					
				<?php endwhile; ?>
					
			<?php else : ?>
				<div <?php post_class(); ?> id="post-0">
	
					<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'theme_textdomain') ?></h2>
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "theme_textdomain") ?></p>
					<!--END .entry-content-->
					</div>
						
				</div>
			<?php endif; ?>
		<!-- END #blog-posts -->
		</div>
			
		<?php if( pi_get_custom_layout() != "layout-1col-fixed" ) get_sidebar(); ?>

<!-- END #content -->
</div>
  
<?php get_footer(); ?>