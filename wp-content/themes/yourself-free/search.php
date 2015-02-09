<?php get_header(); ?>

<?php include 'includes/heading-tagline.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="clearfix">
				
	<!-- BEGIN #blog-posts -->
	<div id="blog-posts" class="clearfix">
			
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
								
			<!-- BEGIN .post -->
			<div <?php post_class("post"); ?> id="post-<?php the_ID(); ?>">
				
				<!-- BEGIN .post-content -->
				<div class="post-content clearfix">
					<?php $thumb = pi_get_blog_img_size(); ?>
					<?php if(has_post_thumbnail()) : ?>
						<div class="post-thumb">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php pi_resize_img( "width=" . $thumb['width'] . "&height=" . $thumb['height'] ); ?></a>
						</div>
					<?php else: ?>
						<div class="headclear"></div>	
					<?php endif; ?>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
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

				<h2 class="entry-title"><?php pi_translate_text('Search result for:', '_search_result', 'directly'); echo ' ' . $s; ?></h2>
				<!--BEGIN .entry-content-->
				<div class="entry-content">
					<p><?php pi_translate_text('Sorry, but your search did not return any results. Please try using a different search term.', '_search_empty', 'directly'); ?></p>
					<p><?php get_search_form(); ?></p>
				<!--END .entry-content-->
				</div>
				
			</div>
		<?php endif; ?>
	<!-- END #blog-posts -->
	</div>

	<?php if( of_get_option('default_layout') != "layout-1col-fixed" ) get_sidebar(); ?>
	
<!-- END #content -->
</div>
  
<?php get_footer(); ?>