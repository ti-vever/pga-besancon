<?php get_header(); ?>


<div align="center" style="width:100%; height:100% ">

<div class="main-wrapper">


	
	<div class="wrap960">
			
			<?php include (TEMPLATEPATH . "/logo.php"); ?>
			
			<?php include (TEMPLATEPATH . "/menu.php"); ?>
			
			
			<!--Featured Post-->
			
			<?php if ( of_get_option("hidden_slider")) { ?>
				
			
				<div class="featured-wrap">
				
					<div class="featured-nav">
						<ul>
							<li class="current">1</li>
							<li>2</li>
							<li>3</li>
						</ul>
					</div>
					
					
					
					
					<?php 
					
					$slidecat = of_get_option('hidden_slidecat'); 
					
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$posts = query_posts("cat=$slidecat"); if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="featured-post">
							<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail();
							} else { ?>
							<img src="<?php bloginfo('template_directory'); ?>/images/default.jpg" alt="<?php the_title(); ?>" />
							<?php } ?>
								<div class="featured-desc">
									<div class="featured-desc-arrow"></div>
										<h2><a href="<?php the_permalink(); ?>"><?php if (strlen($post->post_title) > 56) {
										echo substr(the_title($before = '', $after = '', FALSE), 0, 56) . '...'; } else {
										the_title();
										} ?></a></h2>
										
										<div class="featured-meta">
											<?php the_time('l, F jS, Y') ?>  /  <a href="<?php the_permalink(); ?>#comments-anchor"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></a>
										</div>
										<p>
											
											<?php if(function_exists('the_content_limit')) { ?>
											
											<?php the_content_limit(130);  ?>
											
											<?php } else { ?>
											
											<p> Activate the limitpost plugin to see the post contents ! </p>
											
											<?php } ?> 
										
										</p>
										<div class="featured-more">
											<a href="<?php the_permalink(); ?>">Read More</a>
										</div>
								</div>
						</div>
						
					<?php endwhile;?>
					<?php endif; ?>
					
			</div>	
			
			<?php } else { ?>
					
					
			<?php } ?>
								
			<!--Featured Post-->
			
			<div style="clear:both;"></div>
			
			<!-- Site Message -->
			
				<?php if ( of_get_option("hidden_messagebox")) { ?>
					<div style="" class="message">
						<?php echo stripslashes(of_get_option('message_box')); ?>
					</div>			
				  <?php } else { ?>
						
						
				<?php } ?>

			<!-- Site Message -->
			
			
			<div style="clear:both;"></div>
			
			
			<!--Latest Blogs-->
			
				<div class="front-blog">
					<div class="front-blog-posts">
					
						<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$slidecat = of_get_option('hidden_slidecat', 'no entry' ); 
						$cat_id = get_cat_ID('.$slidecat.');
						$posts = query_posts("cat=-$slidecat&paged=$paged"); 
						if (have_posts()) : while (have_posts()) : the_post(); ?>
					
							<div class="front-blog-post">
								<?php the_post_thumbnail('post-thumbnail'); ?>
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<div style="clear:both;"></div>
											<div class="front-blog-meta">
												<?php the_category(', ') ?>
													
													
													<?php
													            if ( has_post_format( 'aside' )) {
													            	echo '<img class="post-icon"';
													                echo 'src="';
													                echo bloginfo('template_url');
													                echo '/images/format-aside.png" alt="Aside Post" />';
													            }
													            elseif ( has_post_format( 'image' )) {
													                echo '<img class="post-icon"';
													                echo 'src="';
													                echo bloginfo('template_url');
													                echo '/images/format-image.png" alt="Image Post" />';
													            }
													            elseif ( has_post_format( 'link' )) {
													                echo '<img class="post-icon"';
													                echo 'src="';
													                echo bloginfo('template_url');
													                echo '/images/format-link.png" alt="Link Post" />';
													            }
													            elseif ( has_post_format( 'video' )) {
													                echo '<img class="post-icon"';
													                echo 'src="';
													                echo bloginfo('template_url');
													                echo '/images/format-video.png" alt="Quote Post" />';
													            }
													            else {
													            	echo '<img class="post-icon"';
													                echo 'src="';
													                echo bloginfo('template_url');
													                echo '/images/format-standard.png" alt="Standard Post" />';
													            }
													        ?> 
													
											</div>
											<?php if(function_exists('the_content_limit')) { ?>
											
											<?php the_content_limit(130);  ?>
											
											<?php } else { ?>
											
											<p> Activate the limitpost plugin to see the post contents ! </p>
											
											<?php } ?> 
							</div>
							
						<?php endwhile;?>
						<?php endif; ?>
						
						
						
					</div>
					
					<div style="clear:both;"></div>
					
					<div class="wp-pagenavi">
						<?php next_posts_link(); ?> 
						<?php previous_posts_link(); ?>
					</div>	
					
				</div>
				
				
				
			<!--Latest Blogs-->
			
			
				
		<div style="clear:both;"></div>
		
			
			<?php include (TEMPLATEPATH . "/bottom-posts.php"); ?>
			
			<?php include (TEMPLATEPATH . "/footer.php"); ?>
			
	</div>
	<!--End 960 Div-->
	




</div>
</div>

</body>
</html>
