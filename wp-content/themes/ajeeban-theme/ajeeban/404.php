<?php get_header(); ?>

<div align="center" style="width:100%; height:100% ">

<div class="main-wrapper">


	
	<div class="wrap960">
				
						<?php include (TEMPLATEPATH . "/menu.php"); ?>
						
			<div style="clear:both;"></div>
			
			
			
					<?php include (TEMPLATEPATH . "/logo.php"); ?>
			
			
			
			<!--Bio-->
			
				<div class="bio-wrap">
					
					<h2>
					
					  <h2>Nothing Found</h2>
					
					
					</h2>
					
					<div class="tag-cloud">
					
						<?php wp_tag_cloud( 'format=list&orderby=count&order=DESC' ); ?>
					
					</div>
					  
				</div>
				
			<!--Bio-->
			
			
			<div style="clear:both;"></div>
			
			
			<!--Latest Blogs-->
			
				<div class="front-blog">
				
				
				
				
				
					<div class="front-blog-posts">
					
						<?php $count = 1; ?><?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>	
					
							<div class="front-blog-post">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
									<h2><a href="<?php the_permalink(); ?>#post"><?php the_title(); ?></a></h2>
									
											<div class="front-blog-meta">
												<span class="author-icon">hhh</span>16th February 2013
												<span class="category-icon">dsd</span><?php the_category(' , ') ?>
												<span class="comment-icon">dsd</span>10 Comments
											</div>
											<?php global $more; $more = 0; ?>
												<?php if(function_exists('the_content_limit')) { ?>
												
												<?php the_content_limit(260);  ?>
												
												<?php } else { ?>
												
												<p> Activate the limitpost plugin to see the post contents ! </p>
												
												<?php } ?> 
							</div>
							<div class="divider"></div>
							
							<?php endwhile; ?>
							
								<?php else : ?>
							
							        
							
								<?php endif; ?>
							
							
								<div class="wp-pagenavi">
								<?php if (function_exists('wp_pagenavi')) : ?>
								<?php wp_pagenavi(); ?>
								<?php else : ?>
								<?php next_posts_link('&laquo; Older Entries'); ?> 
								<?php previous_posts_link('Newer Entries &raquo;'); ?>
								
								<?php endif; ?>
								</div>	
							
							<div style="clear:both"></div>	
							
					</div>
				</div>
				
				
			<!--Latest Blogs-->
			
			
				
		<div style="clear:both;"></div>
		
		
		<?php include (TEMPLATEPATH . "/footer.php"); ?>			
				
		
	</div>
	<!--End 960 Div-->
	




</div>
</div>


</body>
</html>
