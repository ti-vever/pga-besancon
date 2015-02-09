<?php get_header(); ?>

<?php include 'includes/heading-tagline.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="clearfix">
		
	<!-- BEGIN #blog-posts -->
	<div id="blog-posts">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
			<!-- BEGIN .post -->
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					
				<?php $imgs = get_post_meta( get_the_ID(), 'portfolio_imgs', true ); ?>
				<?php $video = get_post_meta( get_the_ID(), 'portfolio_video', true ); ?>
					
				<!-- BEGIN .post-content -->
				<div class="post-content clearfix">
						
					<!-- BEGIN .portfolio-meta -->
					<div id="portfolio-meta" class="clearfix">
								
						<?php if( $imgs['image-1'] !='' || $imgs['image-2'] !='' || $imgs['image-3'] !='' || $imgs['image-4'] !='' || $imgs['image-5'] !='' || $imgs['image-6'] !='' ){ ?>
							
						<div id="portfolio-meta-slider">	
								<div id="slider" class="flexslider">
									<ul class="slides">
										<?php for($i=1; $i<=6; $i++) : ?>
											<?php if($imgs['image-'.$i] !='') : ?>
												<?php $image = vt_resize( '', $imgs['image-'.$i] , 1240, of_get_option('portfolio_flex_height'), true ); ?>
												<li><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="slider image" /></li>
											<?php endif;?>
										<?php endfor; ?>
									</ul>
								</div>
								<div id="carousel" class="flexslider">
									<ul class="slides">
										<?php for($i=1; $i<=6; $i++) : ?>
											<?php if($imgs['image-'.$i] !='') : ?>
												<?php $image = vt_resize( '', $imgs['image-'.$i] , 1240, of_get_option('portfolio_flex_height'), true ); ?>
												<li><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" alt="slider image" /></li>
											<?php endif;?>
										<?php endfor; ?>
									</ul>
								</div>
							</div>
						<?php }elseif( $video['vimeo-youtube'] != '' || $video['embedded-code'] != '' ){ ?>
							
							<div class="post-video">
								<?php if( $video['vimeo-youtube'] != '' ){ ?>
									<?php pi_embed_video(get_the_ID(), '', 1240, of_get_option('portfolio_single_height'), 'portfolio_video'); ?>
								<?php }else{ ?>
										<?php pi_embed_video(get_the_ID(), '', 1240, of_get_option('portfolio_single_height'), 'portfolio_video'); ?>
								<?php } ?>
							</div>
						
						<?php }elseif( has_post_thumbnail() ){ ?>
							<div class="post-thumb"><?php pi_resize_img("width=1240&height=" . of_get_option('portfolio_single_height') ); ?></div>
						<?php } ?>
					<!-- END .portfolio-meta -->	
					</div>
						
					<div id="portfolio-content-single" class="clearfix<?php if( of_get_option('enable_related_portfolio') ) echo " parcial-content" ?>">
						<?php if( current_user_can('edit_post', $post->ID) ): ?>
							<div class="edit-message">
								<?php edit_post_link( __('Edit this', 'theme_textdomain') ); ?>
							</div>
						<?php endif; ?>
						<?php the_content(); ?>
					</div>
						
					<?php if(of_get_option('enable_related_portfolio')) : 
						include 'includes/related-portfolio.php'; 
					endif; ?>
						
				<!-- END .post-content -->	
				</div>
					
			<!-- END .post -->
			</div>
				
			<?php endwhile; ?>
				
			<!-- BEGIN comments -->
			<?php comments_template('', true); ?>
			<!-- END comments -->

		<?php endif; ?>
	<!-- END #blog-posts -->
	</div>

<!-- END #content -->
</div>
  
<?php get_footer(); ?>