<!--Main Menu-->


<div style="clear:both;"></div>

	<div class="main-menu">
	<h2>MENU</h2>
		
		<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>

		<div class="search-box">
			<div id="search"> 
					 <form method="get" id="searchform" action="<?php bloginfo('home'); ?>" style="padding:0px 0px 0px 0px; margin:0px 0px 0px 0px">
					<input type="text" value="Search Website..." name="s" id="s" onfocus="if (this.value == 'Search Website...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search Website...';}" style="padding:0px 0px 0px 0px; margin:0px 0px 0px 0px" />
					 <input type="image" class="input" src="<?php bloginfo('stylesheet_directory'); ?>/images/zoom-icon.png" value="submit" style="padding:0px 0px 0px 0px; margin:0px px 0px 0px"/>
					 </form>
			</div>	
		</div>
		
		
	</div>
<!--Main Menu End-->