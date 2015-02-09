<?php get_header(); ?>

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
					
						<div class="single-blog-post page-page">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						
								<div style="clear:both;"></div>
						
								<div class="front-blog-meta">
									<?php the_author() ?>
										
								</div>
						
								<div style="clear:both;"></div>
						
									<?php the_content();  ?>
																					
								<div style="clear:both;"></div>
						
						</div>
						
						
						
						<div style="clear:both;"></div>
						
						<?php endwhile; else: ?>
								<p>Sorry, no posts matched your criteria.</p>
						<?php endif; ?>	
						
					
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
