<?php get_header(); ?>

<?php include 'includes/heading-tagline.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="clearfix">
		
	<!-- BEGIN #blog-posts -->
	<div id="blog-posts" class="clearfix">
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
					<?php elseif( of_get_option('enable_featured_image') && has_post_thumbnail() ) : ?>
						<div class="post-thumb">
							<?php pi_resize_img("width=" . pi_get_blog_image_width() . "&height=" . stripslashes( of_get_option('img_size_single_post') ) ); ?>
						</div>
					<?php else: ?>
						<div class="headclear"></div>	
					<?php endif; ?>
					<?php if( current_user_can('edit_post', $post->ID) ): ?>
						<div class="edit-message">
							<?php edit_post_link( __('Edit this', 'theme_textdomain') ); ?>
						</div>
					<?php endif; ?>
					<?php if( of_get_option('enable_submenu') ) : ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php endif; ?>
					<div class="entry-meta">
						<span class="post-author"><?php pi_translate_text('By', '_blog_by', 'directly'); ?> : <?php the_author_posts_link(); ?></span>	
						<span class="post-date"><?php the_date(); ?></span>
						<span class="post-categories"><?php the_category(', '); ?></span>
						<?php if( comments_open() ) : ?>
							<span class="post-comments"><a href="<?php comments_link(); ?>"><?php comments_number( pi_translate_text('No Comments', '_no_comments', 'argument'), pi_translate_text('1 Comment', '_1_comment', 'argument'), '% ' . pi_translate_text('Comments', '_comments', 'argument') ); ?></a></span>
						<?php endif; ?>
					</div>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				<!-- END .post-content -->	
				</div>
					
				<?php if( of_get_option('enable_author_bio') ) : ?>
					<!--BEGIN .author-bio-->
					<div class="author-bio clearfix">
						<div class="author-thumb">
							<?php echo get_avatar( get_the_author_meta('email'), '60' ); ?>
						</div>
						<div class="author-detail">
							<h3><?php pi_translate_text('About the author', '_about_the_author', 'directly'); ?></h3>
							<p><?php the_author_meta("description"); ?></p>
						</div>
					<!--END .author-bio-->
					</div>
				<?php endif; ?>
					
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