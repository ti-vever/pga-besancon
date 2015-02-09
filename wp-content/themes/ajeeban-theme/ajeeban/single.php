<?php get_header(); ?>



<!-- put all of your normal <body> stuff here -->


<div align="center" style="width:100%; height:100% ">

<div class="main-wrapper">


	
	<div class="wrap960">
			
			<?php include (TEMPLATEPATH . "/logo.php"); ?>
			
			<?php include (TEMPLATEPATH . "/menu.php"); ?>
			
			<div style="clear:both;"></div>
			
			
			<!--Single Post-->
			
				<div class="front-blog">
					
					<div class="single-blog-post-wrap">
					
					<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post();?>
					
						<div class="single-blog-post">
							<h2><?php the_title(); ?></h2>
						
								<div style="clear:both;"></div>
								
								<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail();
							} else { ?>
														<?php } ?>
						
								<div class="front-blog-meta">
									<?php the_category(', ') ?>  &nbsp&nbsp/&nbsp&nbsp <a href="<?php the_permalink(); ?>#comments-anchor"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></a>
										
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
						
								<div style="clear:both;"></div>
						
									<?php the_content();  ?>
																					
								<div style="clear:both;"></div>
						
						</div>
						
						
						<!--Sidebar-->
						
							<?php include (TEMPLATEPATH . "/sidebar.php"); ?>
						<!--Sidebar-->
						
						
						<div style="clear:both;"></div>
						
						<?php endwhile; else: ?>
								<p>Sorry, no posts matched your criteria.</p>
						<?php endif; ?>	
						
						<!--Comments-->
							
							<div class="comment_template">
								<?php comments_template(); ?>
							</div>
						
						<!--Comments-->
						
					
					</div>
					
				</div>
				
				
			<!--Single Post-->
			
			
				
		<div style="clear:both;"></div>
		
			
			<?php include (TEMPLATEPATH . "/bottom-posts.php"); ?>
			
			<?php include (TEMPLATEPATH . "/footer.php"); ?>
		
	</div>
	<!--End 960 Div-->
	




</div>
</div>

</body>
</html>
