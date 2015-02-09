<!-- BEGIN #sidebar -->
<div id="sidebar" class="clearfix">

	<?php
	if( (is_home() && is_front_page()) || (is_home() && !is_front_page()) ){
		$id = get_option('page_for_posts');
	}elseif( !is_home() && is_front_page() ){
		$id = get_option('page_on_front');
	}else{
		$id = get_the_ID();
	} 
	$post_fields = get_post_meta( $id, 'post-fields', true );
	$sidebars = of_get_option('sidebar_generator');
	if( get_option('show_on_front') == 'posts' && is_home() && is_front_page() ){
		$blog_sidebar = of_get_option('blog_sidebar');
		if( $blog_sidebar == 'default' )
			$blog_sidebar = 'Default Sidebar';
		echo "<!-- Widget Area - " . $blog_sidebar . " -->";
		if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( $blog_sidebar ) ){}
	}elseif( empty($post_fields) || ( !is_page() && !is_single() && !( (is_home() && is_front_page()) || (is_home() && !is_front_page()) ) ) ){
		echo "<!-- Widget Area - Default Sidebar -->";
		if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Default Sidebar') ){}
	}elseif( $post_fields['sidebar'] == "default" ){
		echo "<!-- Widget Area - Default Sidebar -->";
		if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Default Sidebar') ){}
	}elseif( !empty( $sidebars ) ){
		if( in_array($post_fields['sidebar'], $sidebars) ){
			$sidebar_name = $sidebars[ $post_fields['sidebar'] ];
			echo "<!-- Widget Area - " . $sidebar_name . " -->";
			if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( $sidebar_name ) ){}
		}else{
			echo '<p>This sidebar has been deleted after been assigned to page.</p>';
		}
	}else{
		echo 'Please assign a sidebar.';
	}
	?>

<!-- END #sidebar -->		
</div>	