<div class="social-icons">
		
		<?php if ( of_get_option("hidden_email")) { ?>
				<a href="<?php echo stripslashes(of_get_option('email_add')); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social/email.png" alt="" /></a>
			  <?php } else { ?>	
		<?php } ?>
		
		<?php if ( of_get_option("hidden_fb")) { ?>
				<a href="<?php echo stripslashes(of_get_option('fb_link')); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social/facebook.png" alt="" /></a>
			  <?php } else { ?>	
		<?php } ?>
		
		<?php if ( of_get_option("hidden_twitter")) { ?>
				<a href="<?php echo stripslashes(of_get_option('twitter_link')); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social/twitter.png" alt="" /></a>
			  <?php } else { ?>	
		<?php } ?>
		
		<?php if ( of_get_option("hidden_google")) { ?>
				<a href="<?php echo stripslashes(of_get_option('google_link')); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social/google.png" alt="" /></a>
			  <?php } else { ?>	
		<?php } ?>
		
		<?php if ( of_get_option("hidden_pin")) { ?>
				<a href="<?php echo stripslashes(of_get_option('pin_link')); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social/pinterest.png" alt="" /></a>
			  <?php } else { ?>	
		<?php } ?>
		
		<?php if ( of_get_option("hidden_skype")) { ?>
				<a href="<?php echo stripslashes(of_get_option('skype_link')); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social/skype.png" alt="" /></a>
			  <?php } else { ?>	
		<?php } ?>
		
		<?php if ( of_get_option("hidden_youtube")) { ?>
				<a href="<?php echo stripslashes(of_get_option('youtube_link')); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social/youtube.png" alt="" /></a>
			  <?php } else { ?>	
		<?php } ?>
		
		<?php if ( of_get_option("hidden_feed")) { ?>
				<a href="<?php echo stripslashes(of_get_option('feed_link')); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/social/rss.png" alt="" /></a>
			  <?php } else { ?>	
		<?php } ?>
		
</div>