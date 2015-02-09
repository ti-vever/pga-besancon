<?php /*
Template Name: Contact
*/ ?>




<?php get_header(); ?>


<div align="center" style="width:100%; height:100% ">

<div class="main-wrapper">


	
	<div class="wrap960">
			
			<?php include (TEMPLATEPATH . "/logo.php"); ?>
			
			<?php include (TEMPLATEPATH . "/menu.php"); ?>
			
			
						
			
			<div style="clear:both;"></div>
			
			
			<!--Latest Blogs-->
			
				<div class="front-blog">
				
					
						<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
						
						<div id="post-<?php the_ID(); ?>" class="post">
						<h2><?php the_title(); ?></h2>
						
							<div style="clear:both;"></div>
						
						<div class="entry">
						<?php the_content(); ?>
						<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
						<?php edit_post_link('Edit', '<p class="edit">', '</p>'); ?>
						</div><!-- entry -->
						
						</div><!-- post -->
						<?php endwhile; ?>
						
						<div id="comments-template">
						<?php include (TEMPLATEPATH . '/contact-comments.php'); ?>
						</div>
						
						<?php endif; ?>		
						
									
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
