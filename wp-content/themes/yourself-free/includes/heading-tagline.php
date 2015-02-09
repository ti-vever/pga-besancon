<?php
/* Get Secondary Menu */
if (has_nav_menu('secondary-menu')) :
	$submenu = wp_nav_menu(
		array(
			'theme_location'=>'secondary-menu',
			'depth'=>4,
			'menu_class' => 'sf-menu menu-secondary',
			'container_class' => 'menu-secondary-container',
			'walker' => new pi_custom_nav_walker(),
			'echo' => 0 ));
endif;

/* Get Author */
if(get_query_var('author_name')) :
	$auth = get_userdatabylogin(get_query_var('author_name'));
else :
	$auth = get_userdata(get_query_var('author'));
endif;


/* Conditional Tags */
if( ( is_home() && is_front_page() ) || ( is_home() && ! is_front_page() ) ){
		
	if( of_get_option('enable_submenu') && has_nav_menu('secondary-menu') ){ ?>
		
		<!-- BEGIN .tagline -->
		<div id="secondary-nav" class="clearfix">
			<div class="menu-toggle-wrap">
				<h3 id="secondary-menu-toggle">Submenu</h3>
			</div>
			<?php echo $submenu; ?>
		<!-- END .tagline -->
		</div>	
		
	<?php } ?>
	
<?php }elseif( of_get_option('enable_submenu') && has_nav_menu('secondary-menu') && ( ( is_single() && get_post_type() != 'portfolio' ) || is_category() || is_tag() || is_search() || is_day() || is_month() || is_year() || is_archive() ) ){ ?>
	
	<!-- BEGIN .tagline -->
	<div id="secondary-nav" class="clearfix">
		<div class="menu-toggle-wrap">
			<h3 id="secondary-menu-toggle">Submenu</h3>
		</div>
		<?php echo $submenu; ?>
	<!-- END .tagline -->
	</div>
	
<?php }elseif( is_page_template('template-portfolio-one-column.php') || is_page_template('template-portfolio-two-columns.php') || is_page_template('template-portfolio-three-columns.php') || is_page_template('template-portfolio-four-columns.php') ){ ?>

	<?php $data = get_post_meta( get_the_ID(), 'post-fields', true ); ?>
	<!-- BEGIN .center-wrap -->
	<div id="portfolio-tagline" class="clearfix">
	 	<?php echo ( $data[ 'heading' ] != '' ) ? '<h1 class="portfolio-title">'.$data[ 'heading' ].'</h1>' : the_title('<h1 class="portfolio-title">','</h1>',false); ?>
	 	<!-- BEGIN #portfolio-nav -->
	 	<div id="portfolio-nav" >
		 	<!-- BEGIN .filter-list -->
		 	<ul class="filter-list filter">
		 		<li class="active all-projects" ><a href="#" title="All categories"><?php pi_translate_text('All', '_portfolio_all', 'directly'); ?></a></li>
		 		<?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'portfolio-category', 'walker' => new filterable_portfolio_walker())); ?>
		 		<li class="hidden">Item</li>
		 	<!-- END .filter-list -->
		 	</ul>
		 <!-- END #portfolio-nav -->
		 </div>
	<!-- END .center-wrap -->
	</div>
		
<?php }else{ ?>
		
	<!-- BEGIN .tagline -->
	<div id="tagline" class="clearfix">
	
	<?php if( is_author() ){ ?>
		<h1 class="header-title"><?php pi_translate_text('You are viewing the author archive for:', '_archive_author', 'directly'); echo ' ' . ucfirst( $auth->display_name ); ?></h1>
	<?php }elseif( is_category() ){ ?>	 
		<h1 class="header-title"><?php pi_translate_text('Category:', '_archive_category', 'directly'); ?><?php echo ' ' . single_cat_title('',false); ?></h1>
	<?php }elseif( is_tag() ){ ?>	 
		<h1 class="header-title"><?php pi_translate_text('Tag:', '_archive_tag', 'directly'); ?><?php echo ' ' . single_tag_title('',false); ?></h1>
	<?php }elseif( is_archive() ){ ?>	 
		<h1 class="header-title"><?php pi_translate_text('Archive', '_archive_title', 'directly'); ?></h1>
	<?php }elseif( is_search() ){ ?>
		<h1 class="header-title"><?php pi_translate_text('Search result for:', '_search_result', 'directly'); ?><?php echo ' ' . $s; ?></h1>
	<?php }elseif( is_single() ){ ?>
		<h1 class="header-title"><?php echo get_the_title( get_the_ID() ); ?></h1>
	<?php }elseif( is_page() || get_post_type() == 'portfolio' ){
	
		if (have_posts()) : while (have_posts()) : the_post();
			$data = get_post_meta( get_the_ID(), 'post-fields', true );
			if( get_post_type() == 'portfolio' ) :
				echo ( $data[ 'heading' ] != '' ) ? '<h1 class="header-title">Portfolio: '.$data[ 'heading' ].'</h1>' : the_title('<h1 class="header-title">Portfolio: ','</h1>',false);
			else :
				echo ( isset($data[ 'heading' ]) && $data[ 'heading' ] != '' ) ? '<h1 class="header-title">'.$data[ 'heading' ].'</h1>' : the_title('<h1 class="header-title">','</h1>',false);
			endif;
		endwhile; endif; ?>	
	
	<?php } ?>
	
	<!-- END .tagline -->
	</div>
	
<?php } ?>