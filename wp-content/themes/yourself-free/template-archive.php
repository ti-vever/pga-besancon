<?php
/*
Template Name: Archive 
*/
?>

<?php get_header(); ?>

<?php include 'includes/heading-tagline.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="clearfix">
		
	<!-- BEGIN #blog-posts -->
	<div id="blog-posts">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
			<!-- BEGIN .post -->
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<!-- BEGIN .post-content -->
				<div class="post-content clearfix">
					<?php if( current_user_can('edit_post', $post->ID) ): ?>
						<div class="edit-message">
							<?php edit_post_link( __('Edit this', 'theme_textdomain') ); ?>
						</div>
					<?php endif; ?>
					<div class="headclear"></div>
					<div class="entry-content">
						<?php the_content(); ?>
						<h3><?php pi_translate_text('Last 10 Posts:', '_archive_10_last_posts', 'directly'); ?></h3>
						<ul class="archivelist">
							<?php $archive = get_posts('numberposts=10');
							foreach($archive as $post) : ?>
								<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
							<?php endforeach; wp_reset_query(); ?>
						</ul>
						<h3><?php pi_translate_text('Archives by Month:', '_archive_by_month', 'directly'); ?></h3>
						<ul class="archivelist">
							<?php wp_get_archives('type=monthly'); ?>
						</ul>
						<h3><?php pi_translate_text('Archives by Category:', '_archive_by_category', 'directly'); ?></h3>
						<ul class="archivelist">
							<?php wp_list_categories( 'title_li=' ); ?>
						</ul>
					</div>
				<!-- END .post-content -->	
				</div>
			<!-- END .post -->
			</div>
				
		<?php endwhile; ?>
				
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