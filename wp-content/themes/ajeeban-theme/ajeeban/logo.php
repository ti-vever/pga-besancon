<!--Logo-->

	<div class="logo-wrap">

			
			<?php if ( of_get_option("hidden_logobox")) { ?>
				
				<img src="<?php echo of_get_option('hidden_logo', 'no entry' ); ?>" alt="" />
			
			  <?php } else { ?>
					
				<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					
			<?php } ?>
			
			
	
				
			<div class="top-ad"><?php echo stripslashes(of_get_option('adsense_ad')); ?></div>
				
		
		
		
	</div>
	
	

<!--Logo-->