<div class="sidebar">

	<?php if ( of_get_option("hidden_sidead")) { ?>
		
	
	  <?php } else { ?>
			
		<div class="sidebar-ads">
			<a href="<?php echo stripslashes(of_get_option('sidead_oneurl')); ?>"><img src="<?php echo of_get_option('sidead_oneimage'); ?>" alt="" /></a>
			<a href="<?php echo stripslashes(of_get_option('sidead_twourl')); ?>"><img src="<?php echo of_get_option('sidead_twoimage'); ?>" alt="" /></a>
			<a href="<?php echo stripslashes(of_get_option('sidead_threeurl')); ?>"><img src="<?php echo of_get_option('sidead_threeimage'); ?>" alt="" /></a>
			<a href="<?php echo stripslashes(of_get_option('sidead_foururl')); ?>"><img src="<?php echo of_get_option('sidead_fourimage'); ?>" alt="" /></a>
		</div>
			
	<?php } ?>
	
	
	
	<div class="sidebar-about">
	
			<h2>About Author</h2>
	<div style="clear:both;"></div>
		<?php
		$avmail = get_the_author_meta(‘user_email’);
		echo get_avatar($avmail, 96);
		?>
		
		
		<p>
			
			
			<?php the_author_meta('description'); ?>
		
			
		</p>
	</div>
	
	<div class="widget">
		<h2>Recent Posts</h2>
		
		<ul>
		<?php
		global $post;
		$myposts = get_posts(array('numberposts' => 5, 'offset' => 0,'post_status'=>'publish'));
		foreach($myposts as $post) :
		setup_postdata($post);
		?>
		<li>
		<?php the_post_thumbnail('post-thumbnail'); ?>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</li>
		<?php endforeach; ?>
		<?php wp_reset_query(); ?>
		</ul>
		
		
			
			<div style="clear:both;"></div>
	</div>

</div>
