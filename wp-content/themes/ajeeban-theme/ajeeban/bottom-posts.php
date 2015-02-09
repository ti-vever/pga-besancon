<!--Recent Posts-->

	<div class="recent-posts-wrap">
		<ul>
			<h2>Popular Posts</h2>
			<?php $pc = new WP_Query('orderby=comment_count&posts_per_page=4'); ?>
			<?php while ($pc->have_posts()) : $pc->the_post(); ?>
			
				<li><?php the_post_thumbnail('post-thumbnail'); ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				
				</li>
			<?php endwhile; ?>
			
		</ul>
		
		<ul class="ul-two">
			<h2>About this site</h2>
			
			
				<div class="about-section">
				<img src="<?php echo of_get_option('about_image', 'no entry' ); ?>" alt="" /> 
					<p><?php echo stripslashes(of_get_option('about_text')); ?></p>
					
					<?php include (TEMPLATEPATH . "/social-links.php"); ?>
					
					
					<div class="footer-box">
		 	All rights reserved. <?php bloginfo( 'name' ); ?>
		 	</br>
		 	Theme by: <span><a href="http://www.rshahin.com">Rofikul Islam Shahin - United Arab Emirates</a></span>
	</div>
					
				</div>
				
				
		</ul>
		
	</div>
		

<!---Recent Posts-->