<?php get_header(); ?>








<!-- put all of your normal <body> stuff here -->


<div align="center" style="width:100%; height:100% ">

<div class="main-wrapper">


	
	<div class="wrap960">
			
			<?php include (TEMPLATEPATH . "/logo.php"); ?>
			
			<?php include (TEMPLATEPATH . "/menu.php"); ?>
			
			
						
			
			<div style="clear:both;"></div>
			
			
			<!--Latest Blogs-->
			
				<div class="front-blog">
				
					
						<h2><?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); _e(' &mdash; '); echo $count . ' '; _e('article(s)'); wp_reset_query(); ?></h2>
						
							<div style="clear:both;"></div>
					
					<div class="front-blog-posts">
					
						<?php $count = 1; ?><?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
					
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
							
						<?php endwhile; ?>
						
							<?php else : ?>
						
						          <h2>Nothing Found</h2>
						
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
