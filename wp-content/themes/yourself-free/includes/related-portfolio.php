<?php
global $post;
$post_ID = $post->ID; 
$terms = get_the_terms($post_ID, 'portfolio-category');

if( $terms ){ 
	
	foreach($terms as $term) $categories[] = $term->slug; 

	//get related category posts
	$args=array(
		'post_type' => 'portfolio',
		'post__not_in' => array($post_ID),
		'posts_per_page' => of_get_option('related_portfolio_number'),
		'tax_query' => array(
				array(
					'taxonomy' => 'portfolio-category',
					'field' => 'slug',
					'terms' => $categories,
				)
			)
	);
	query_posts($args);
	?>
	
	<?php if(have_posts()): ?>
		<!-- BEGIN #related-portfolio -->	
		<div id="related-portfolio" class="clearfix">
			<h3 class="related-portfolio-title"><?php echo of_get_option('related_portfolio_title'); ?></h3>
			<ul class="clearfix">
			<?php while(have_posts()): the_post(); ?>
				<!-- BEGIN portfolio-item -->
				<li class="portfolio-item clearfix">
					<!-- BEGIN .post -->
					<div <?php post_class('single-portfolio'); ?> id="post-<?php the_ID(); ?>">
						<!-- BEGIN .post-content -->
						<div class="post-content clearfix">
							<div class="post-thumb">
								<?php if(has_post_thumbnail()) { ?>
									<div class="post-thumb">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php pi_resize_img("width=293&height=" . of_get_option('portfolio_related_height') ); ?></a>
									</div>
								<?php } ?>
							</div>
							<h4 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
						<!-- BEGIN .post-content -->
						</div>
					<!-- END .post -->
					</div>
				<!-- END portfolio-item -->	
				</li>
			<?php endwhile; ?>
			</ul>
		<!-- END #related-portfolio -->
		</div>
	<?php endif; wp_reset_query(); ?>

<?php } ?>