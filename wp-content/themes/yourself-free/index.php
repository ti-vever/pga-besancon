<?php get_header(); ?>

<?php include 'includes/heading-tagline.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="clearfix">
		
	<?php if( pi_get_custom_layout() == "layout-1col-fixed" ){ $thumb_width = 1240; }else{ $thumb_width = 920; } ?>
		
	<!-- BEGIN #blog-posts -->
	<div id="blog-posts" class="clearfix">
		<?php if( ( (is_home() && is_front_page()) || (is_home() && !is_front_page()) ) && of_get_option('enable_blog_slider') ){
			if( of_get_option("blog_flex_number") == 0 ){ $n_posts = -1; }else{ $n_posts = of_get_option("blog_flex_number"); }
			$args=array('meta_key' => '_featured_post', 'meta_value' => 'yes', 'posts_per_page' => $n_posts ,);
			query_posts($args);
			if(have_posts()): ?>
				<div id="featured-blog-posts">
					<!-- BEGIN #blog-slider -->
					<div id="slider" class="flexslider">
						<ul class="slides">
							<?php while(have_posts()) : the_post();
								if(has_post_thumbnail()){
									$image = vt_resize( get_post_thumbnail_id(),'' , $thumb_width, of_get_option('blog_flex_height'), true ); ?>
									<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image['url']; ?>" alt="<?php the_title(); ?>" /></a><h2 class="flex-caption"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2></li>
								<?php } ?>
							<?php endwhile; ?>
						</ul>
					<!-- END #slider -->
					</div>
					<div id="carousel" class="flexslider">
					  	<ul class="slides">
							<?php while(have_posts()) : the_post();
								if(has_post_thumbnail()){
									$image = vt_resize( get_post_thumbnail_id(),'' , $thumb_width, of_get_option('blog_flex_height'), true ); ?>
									<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image['url']; ?>" alt="<?php the_title(); ?>" /></a></li>
								<?php } ?>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
				<hr />
			<?php endif; wp_reset_query(); ?>
		<?php } ?>
			
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
			<?php $thumb = pi_get_blog_img_size(); ?>
				
			<!-- BEGIN .post -->
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<!-- BEGIN .post-content -->
				<div class="post-content clearfix">
					<?php if(has_post_thumbnail()) : ?>
						<div class="post-thumb">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php pi_resize_img( "width=" . $thumb['width'] . "&height=" . $thumb['height'] ); ?></a>
						</div>
					<?php else: ?>
						<div class="headclear"></div>	
					<?php endif; ?>
					<h2 class="entry-title<?php if( has_post_thumbnail() ) echo " mix-content" ?>"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<div class="entry-meta">
						<span class="post-author"><?php pi_translate_text('By', '_blog_by', 'directly'); ?> : <?php the_author_posts_link(); ?></span>	
						<span class="post-date"><?php the_date(); ?></span>
						<span class="post-categories"><?php the_category(', '); ?></span>
						<?php if( comments_open() ) : ?>
							<span class="post-comments"><a href="<?php comments_link(); ?>"><?php comments_number( pi_translate_text('No Comments', '_no_comments', 'argument'), pi_translate_text('1 Comment', '_1_comment', 'argument'), '% ' . pi_translate_text('Comments', '_comments', 'argument') ); ?></a></span>
						<?php endif; ?>
					</div>
					<div class="entry-content">
						<?php if( of_get_option('overview_excerpt') == "manually" ):
							the_content( pi_translate_text('Read more', '_blog_read_more', 'argument') ); 
						else:
							the_excerpt();
							echo '<p><a href="' . get_permalink() . '" class="btn grey right more-link"><span>' . pi_translate_text('Read more', '_blog_read_more', 'argument') . '</span></a></p>';
						endif; ?>
					</div>
				<!-- END .post-content -->	
				</div>
			<!-- END .post -->
			</div>
				
		<?php endwhile; ?>
				
		<!--BEGIN .page-navigation -->
		<div class="page-navigation clearfix">
			<?php if( function_exists('wp_pagenavi') ) { ?>
				<div class="light">
					<?php wp_pagenavi(); ?>
				</div>
			<?php }else{ ?>
				<div class="left"><?php next_posts_link( pi_translate_text('&larr; Older Entries', '_older_entries', 'argument') ); ?></div>
				<div class="right"><?php previous_posts_link( pi_translate_text('Newer Entries &rarr;', '_newer_entries', 'argument') ); ?></div>
			<?php } ?>
		<!--END .page-navigation -->
		</div>
			
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