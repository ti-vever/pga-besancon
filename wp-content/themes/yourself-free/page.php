<?php get_header(); ?>

<?php include 'includes/heading-tagline.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="clearfix">
		
	<!-- BEGIN #blog-posts -->
	<div id="blog-posts">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
			<!-- BEGIN .post -->
			<div <?php post_class('clearfix'); ?> id="post-<?php the_ID(); ?>">
				
				<?php $video = get_post_meta( get_the_ID(), 'post-fields', true ); ?>
				
				<!-- BEGIN .post-content -->
				<div class="post-content clearfix">
						
					<?php if( isset($video['vimeo-youtube']) && $video['vimeo-youtube'] != '' ) : ?>
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
					<div class="headclear"></div>
					<div class="entry-content clearfix">
						<?php the_content(); ?>
					</div>
				<!-- END .post-content -->	
				</div>
					
			<!-- END .post -->
			</div>
				
			<?php endwhile; ?>
				
			<!-- BEGIN comments -->
			<?php comments_template('', true); ?>
			<!-- END comments -->
				
		<?php else : ?>
			<div <?php post_class(); ?> id="post-0">

				<h2 class="entry-title"><?php pi_translate_text("Error 404 - Not Found", "_404_title", "directly"); ?></h2>
				<!--BEGIN .entry-content-->
				<div class="entry-content">
					<p><?php pi_translate_text("Sorry, but you are looking for something that isn't here.", "_404_message", "directly"); ?></p>
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