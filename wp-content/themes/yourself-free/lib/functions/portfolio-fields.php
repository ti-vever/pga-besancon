<?php
/*******************************************************************/
//						PORTFOLIO FIELDS
/*******************************************************************/

$img_key = 'portfolio_imgs';
$video_key = 'portfolio_video';
$portfolio_page_key = '_portfolio_page';

$portfolio_pages = array_merge( pi_get_template_pages_list('template-portfolio-one-column.php'), pi_get_template_pages_list('template-portfolio-two-columns.php'), pi_get_template_pages_list('template-portfolio-three-columns.php'), pi_get_template_pages_list('template-portfolio-four-columns.php') ) ;

$page_opts = array();
foreach($portfolio_pages as $page){
	$page_opts[ preg_replace('/\W/', '', strtolower( $page ) ) ] = $page;	
}

function pi_get_template_pages_list($template_name){
	$pages_list = array();
	query_posts(array(
	    'post_type' =>'page',
	    'meta_key'  =>'_wp_page_template',
	    'meta_value'=> $template_name,
	));
	if(have_posts()){
		while(have_posts()) : 
			the_post();
			$pages_list[] = the_title( '', '', '' );
		endwhile; 
	}
	wp_reset_query();
	return $pages_list;
}

$portfolio_page_meta_box = array(
	'name' => 'portfolio-page',
	'title' => __('Select Page', 'theme_textdomain'),
	'desc' => __('Select portfolio page to display this portfolio item. Before this you should created portfolio page and asign a potfolio template available.', 'theme_textdomain'),
	'type' => 'select',
	'options' => $page_opts,
);

$imgs_meta_boxes = array(
				array(
						'name' => 'image-1',
						'id' => 'image_1',
						'title' => __('Image 1', 'theme_textdomain'),
						'desc' => __('Upload slide image for portfolio slider. Note: enable portfolio slider via options panel.','theme_textdomain'),
						'type' => 'upload',
					),
				array(
						'name' => 'image-2',
						'id' => 'image_2',
						'title' => __('Image 2', 'theme_textdomain'),
						'desc' => __('Upload slide image for portfolio slider. Note: enable portfolio slider via options panel.','theme_textdomain'),
						'type' => 'upload',
					),
				array(
						'name' => 'image-3',
						'id' => 'image_3',
						'title' => __('Image 3', 'theme_textdomain'),
						'desc' => __('Upload slide image for portfolio slider. Note: enable portfolio slider via options panel.','theme_textdomain'),
						'type' => 'upload',
					),
				array(
						'name' => 'image-4',
						'id' => 'image_4',
						'title' => __('Image 4', 'theme_textdomain'),
						'desc' => __('Upload slide image for portfolio slider. Note: enable portfolio slider via options panel.','theme_textdomain'),
						'type' => 'upload',
					),
				array(
						'name' => 'image-5',
						'id' => 'image_5',
						'title' => __('Image 5', 'theme_textdomain'),
						'desc' => __('Upload slide image for portfolio slider. Note: enable portfolio slider via options panel.','theme_textdomain'),
						'type' => 'upload',
					),
				array(
						'name' => 'image-6',
						'id' => 'image_6',
						'title' => __('Image 6', 'theme_textdomain'),
						'desc' => __('Upload slide image for portfolio slider. Note: enable portfolio slider via options panel.','theme_textdomain'),
						'type' => 'upload',
					),	
				);
				
$video_meta_boxes = array(
				array(
					'name' => 'vimeo-youtube',
					'title' => __('Video', 'theme_textdomain'),
					'desc' => __('Insert Vimeo or YouTube URLs to show the corresponding video.', 'theme_textdomain'),
					'type' => 'text',
					),
				array(
					'name' => 'embedded-code',
					'title' => __('Embedded Code', 'theme_textdomain'),
					'desc' => __('Use this field to embed code of other video plataforms like blip.', 'theme_textdomain'),
					'type' => 'text',
					),		
				);

// Enable the meta boxes
function pi_create_portfolio_meta_box() {
	if( function_exists( 'add_meta_box' ) ) {
		add_meta_box( 'portfolio-page-box', __('Portfolio Page', 'theme_textdomain'), 'pi_display_portfolio_page_box', 'portfolio', 'normal', 'high' );
		add_meta_box( 'portfolio-imgs-boxes', __('Slider Portfolio Images', 'theme_textdomain'), 'pi_display_portfolio_img_boxes', 'portfolio', 'normal', 'high' );
		add_meta_box( 'portfolio-video-boxes', __('Video Settings', 'theme_textdomain'), 'pi_display_portfolio_video_boxes', 'portfolio', 'normal', 'high' );
	}
}

// Create portfolio page box
function pi_display_portfolio_page_box() {
	global $post, $portfolio_page_meta_box, $portfolio_page_key; ?>
	<div class="post-meta-boxes">
		<?php wp_nonce_field( plugin_basename( __FILE__ ), $portfolio_page_key . '_wpnonce', false, true );
		$data[ $portfolio_page_meta_box['name'] ] = get_post_meta($post->ID, $portfolio_page_key, true);
		pi_display_custom_fields($portfolio_page_meta_box, $data); ?>
	</div>
<?php
}

// Create img boxes
function pi_display_portfolio_img_boxes() {
	global $post, $imgs_meta_boxes, $img_key; ?>
	<div class="post-meta-boxes">
		<?php wp_nonce_field( plugin_basename( __FILE__ ), $img_key . '_wpnonce', false, true );
		$data = get_post_meta($post->ID, $img_key, true);
		foreach($imgs_meta_boxes as $meta_box) {
			pi_display_custom_fields($meta_box, $data);
		} ?>
	</div>
<?php
}

// Create video boxes
function pi_display_portfolio_video_boxes() {
	global $post, $video_meta_boxes, $video_key; ?>
	<div class="post-meta-boxes">
		<?php wp_nonce_field( plugin_basename( __FILE__ ), $video_key . '_wpnonce', false, true );
		$data = get_post_meta($post->ID, $video_key, true);
		foreach($video_meta_boxes as $meta_box) {
			pi_display_custom_fields($meta_box, $data);
		} ?>
	</div>
<?php
}

// Save custom fields
function pi_save_portfolio_meta_box( $post_id ) {
	global $post, $imgs_meta_boxes, $video_meta_boxes, $img_key, $video_key;
	
	// images
	foreach( $imgs_meta_boxes as $meta_box ) {
		$meta_value = isset( $_POST[ $meta_box[ 'name' ] ] ) ? $_POST[ $meta_box[ 'name' ] ] : '';
		$data[ $meta_box[ 'name' ] ] = $meta_value;
	}
	
	$key_wpnonce = isset( $_POST[ $img_key . '_wpnonce' ] ) ? $_POST[ $img_key . '_wpnonce' ] : null;
	if ( !wp_verify_nonce( $key_wpnonce, plugin_basename(__FILE__) ) )
		return $post_id;
	
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	
	update_post_meta( $post_id, $img_key, $data );
	
	// video
	foreach( $video_meta_boxes as $meta_box ) {
		$meta_value = isset( $_POST[ $meta_box[ 'name' ] ] ) ? $_POST[ $meta_box[ 'name' ] ] : '';
		$data[ $meta_box[ 'name' ] ] = $meta_value;
	}
	
	$key_wpnonce = isset( $_POST[ $video_key . '_wpnonce' ] ) ? $_POST[ $video_key . '_wpnonce' ] : null;
	if ( !wp_verify_nonce( $key_wpnonce, plugin_basename(__FILE__) ) )
		return $post_id;
	
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	
	update_post_meta( $post_id, $video_key, $data );
}

//Save portfolio page field
function pi_save_portfolio_page_meta_box( $post_id ) {
	global $post, $portfolio_page_meta_box, $portfolio_page_key;
	
	$key_wpnonce = isset( $_POST[ $portfolio_page_key . '_wpnonce' ] ) ? $_POST[ $portfolio_page_key . '_wpnonce' ] : null;
	if ( !wp_verify_nonce( $key_wpnonce, plugin_basename(__FILE__) ) )
		return $post_id;
	
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	
	$data = isset( $_POST[ $portfolio_page_meta_box[ 'name' ] ] ) ? $_POST[ $portfolio_page_meta_box[ 'name' ] ] : '';
	update_post_meta( $post_id, $portfolio_page_key, $data );
}

add_action( 'admin_menu', 'pi_create_portfolio_meta_box' );
add_action( 'save_post', 'pi_save_portfolio_meta_box' );
add_action( 'save_post', 'pi_save_portfolio_page_meta_box' );
?>