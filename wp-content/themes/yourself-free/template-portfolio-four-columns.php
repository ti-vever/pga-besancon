<?php
/*
Template Name: Portfolio Four Columns
*/
?>

<?php get_header(); ?>

<?php include 'includes/heading-tagline.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="clearfix">
				
	<?php  $query = new WP_Query(); 
		$query->query('post_type=portfolio&posts_per_page=-1&meta_key=_portfolio_page&meta_value='. preg_replace('/\W/', '', strtolower( get_the_title() ) ) ); ?>
								
	<div id="portfolio-content" class="clearfix">
			
		<!-- BEGIN #columns-wrap .four-columns -->
		<ul class="filter-posts four-columns clearfix">
		
		<?php $count = 1; ?>
		<?php $thumb = pi_get_portfolio_img_size(); ?>
		<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
					
			<?php $video = get_post_meta( get_the_ID(), 'portfolio_video', true ); ?>
			<?php $terms = get_the_terms( get_the_ID(), 'portfolio-category' ); ?>
					
			<li data-id="id-<?php echo $count; ?>" data-type="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>" class="project clearfix">
				<!-- BEGIN .post -->
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<!-- BEGIN .post-content -->
					<div class="post-content clearfix">
							
						<?php if( has_post_thumbnail() && of_get_option('enable_lightbox') ) { ?>
							<div class="post-thumb">
							<?php if( $video['vimeo-youtube'] != '' ){ ?>
								<a class="screencast-play" href="<?php echo $video; ?>" rel="prettyPhoto"><img class="opaque" src="<?php echo get_template_directory_uri(); ?>/resources/img/screencast-play.png" alt="screencast play" /></a>
							<?php pi_video_lightbox(get_the_ID(), $thumb['width'], $thumb['height']); ?>
							<?php }else{ ?>
								<a href="<?php echo pi_get_thumbnail_url(); ?>" title="<?php the_title(); ?>" rel="prettyPhoto[gallery]"><?php pi_resize_img("width=" . $thumb['width'] . "&height=" . $thumb['height'] ); ?></a>
							<?php } ?>
								</div>
							<?php }elseif( has_post_thumbnail() ){ ?>
								<div class="post-thumb">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php pi_resize_img("width=" . $thumb['width'] . "&height=" . $thumb['height'] ); ?></a>
								</div>
							<?php } ?>
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								
					<!-- END .post-content -->
					</div>
				<!-- END .post -->
				</div>
			<!--END .portfolio-item -->
			</li>
				
		<?php $count++; ?>	
		<?php endwhile; endif; ?>
		<?php wp_reset_query(); ?>
				
		</ul>
			
		<?php if( pi_get_custom_layout() != "layout-1col-fixed" ) get_sidebar(); ?>
				
	<!-- END #portfolio-content -->	
	</div>

<!-- END #content -->
</div>


<?php get_footer(); ?>