<div class="content">
	<ul class="archive-box post">

		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>	
	
		<li>
			<div class="archive-content">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('archive-post-thumbnail'); ?></a>
				<h2><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			</div>
			<div class="archive-content-meta-vote">
				<?php if(function_exists(getILikeThis)) getILikeThis('get'); ?>
			</div>
			<div class="archive-content-meta-comment">
				<?php comments_popup_link('0', '1', '%'); ?>
			</div>
		</li>
		<?php endwhile; ?>
	</ul>
	
		<?php else : ?>
	
	          <h2>Nothing Found</h2>
	
		<?php endif; ?>
		
		<div class="wp-pagenavi">
			<?php next_posts_link(); ?> 
			<?php previous_posts_link(); ?>
		</div>	
		<div style="clear:both"></div>
</div>