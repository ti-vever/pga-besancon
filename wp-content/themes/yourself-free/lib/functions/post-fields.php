<?php
/*******************************************************************/
//						POST CUSTOM FIELDS
/*******************************************************************/

// Create a header option
$key = "post-fields";
$featured_key = "_featured_post";
$imagepath = get_template_directory_uri() . '/admin/images/layout/';
$layout = array( 'layout-1col-fixed' => $imagepath . '1col.png', 'layout-2c-r-fixed' => $imagepath . '2cr.png', 'layout-2c-l-fixed' => $imagepath . '2cl.png');
$sidebars['default'] = "Default Sidebar";

$page_meta_boxes = array(
	array(
		"name" => "layout",
		"title" => __('Layout', 'theme_textdomain'),
		"desc" => __('Individually define the structure of each page and post for your website. You can choose between different structures: full width, right-sided navigation and left-sided navigation.', 'theme_textdomain'), 
		"type" => "images",
		"options" => $layout,
	),
	array(
		"name" => "sidebar",
		"id" => "sidebars",
		"title" => __('Sidebar', 'theme_textdomain'),
		"desc" => pi_upgrade_cta("sidebar"),
		"type" => "select",
		"options" => $sidebars,
	),
	array(
		"name" => "heading",
		"title" => __('Heading', 'theme_textdomain'),
		"desc" => __('Define an alternative title to the site name which will be displayed at the top of it.', 'theme_textdomain'),
		"type" => "text",
	),
	array(
		"name" => "vimeo-youtube",
		"title" => __('Video', 'theme_textdomain'),
		"desc" => __('Insert Vimeo or YouTube URLs to show the corresponding video.', 'theme_textdomain'),
		"type" => "text",
	)
);

$post_meta_boxes = array(
	array(
		"name" => "layout",
		"title" => __('Layout', 'theme_textdomain'),
		"desc" => __('Individually define the structure of each page and post for your website. You can choose between different structures: full width, right-sided navigation and left-sided navigation.', 'theme_textdomain'),
		"type" => "images",
		"options" => $layout,
	),
	array(
		"name" => "sidebar",
		"id" => "sidebars",
		"title" => __('Sidebar', 'theme_textdomain'),
		"desc" => pi_upgrade_cta("sidebar"),
		"type" => "select",
		"options" => $sidebars,
	),
	array(
		"name" => "vimeo-youtube",
		"title" => __('Video', 'theme_textdomain'),
		"desc" => __('Insert Vimeo or YouTube URLs to show the corresponding video.', 'theme_textdomain'),
		"type" => "text",
	)
);

$featured_meta_box = array(
	"name" => "featured",
	"title" => __('Featured', 'theme_textdomain'),
	"desc" => __('This option is only available for posts and lets you add it to the featured posts slider. To enable the use of a slider choose Theme Options - Blog - Enable Blog Slider.', 'theme_textdomain'),
	"type" => "select",
	"options" => array('no' => __('No', 'theme_textdomain'), "yes" => __('Yes', 'theme_textdomain') ),
);

// Enable the meta boxes
function pi_create_meta_box() {
	if( function_exists( 'add_meta_box' ) ) {
		add_meta_box( 'custom-page-meta-boxes', __('Options', 'theme_textdomain'), 'pi_display_page_meta_box', 'page', 'normal', 'high' );
		add_meta_box( 'custom-post-meta-boxes', __('Options', 'theme_textdomain'), 'pi_display_post_meta_box', 'post', 'normal', 'high' );
		add_meta_box( 'custom-post-featured-meta-box', __('Featured Post', 'theme_textdomain'), 'pi_display_featured_post_meta_box', 'post', 'normal', 'high' );
	}
}

// Create page boxes
function pi_display_featured_post_meta_box() {
	global $post, $featured_meta_box, $featured_key; ?>
	<div class="post-meta-boxes">
		<?php wp_nonce_field( plugin_basename( __FILE__ ), $featured_key . '_wpnonce', false, true );
		$data[ $featured_meta_box['name'] ] = get_post_meta($post->ID, $featured_key, true);
		pi_display_custom_fields($featured_meta_box, $data); ?>
	</div>
<?php
}

// Create page boxes
function pi_display_page_meta_box() {
	global $post, $page_meta_boxes, $key; ?>
	<div class="post-meta-boxes">
		<?php wp_nonce_field( plugin_basename( __FILE__ ), $key . '_wpnonce', false, true );
		$data = get_post_meta($post->ID, $key, true);
		foreach($page_meta_boxes as $meta_box) {
			pi_display_custom_fields($meta_box, $data);
		} ?>
	</div>
<?php
}

// Create post boxes
function pi_display_post_meta_box() {
	global $post, $post_meta_boxes, $key; ?>
	<div class="post-meta-boxes">
		<?php wp_nonce_field( plugin_basename( __FILE__ ), $key . '_wpnonce', false, true );
		$data = get_post_meta($post->ID, $key, true);
		foreach($post_meta_boxes as $meta_box) {
			pi_display_custom_fields($meta_box, $data);
		} ?>
	</div>
<?php
}

function pi_display_custom_fields($meta_box, $data){ ?>
	<div <?php if( isset( $meta_box['id'] ) ){ echo 'id="'. $meta_box['id'] .'_section"'; } ?> class="section section-<?php echo $meta_box['type']; ?>">
		<h4 class="heading"><?php echo $meta_box['title']; ?>:</h4>
		<div class="option">
			<div class="controls">
				<?php switch($meta_box['type']){
					case "text": ?>
						<input type="text" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php if( isset( $data[ $meta_box[ 'name' ] ] ) ){ echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); } ?>" />
					<?php break; ?>
					<?php case "select": ?>
						<select class="widefat" name="<?php echo $meta_box[ 'name' ]; ?>">
							<?php foreach( $meta_box[ 'options' ] as $k => $v ){ 
								$selected = '';
								if( ( $k == $data[ $meta_box[ 'name' ] ] ) || ( $k == "default" && empty( $data[ $meta_box[ 'name' ] ] ) ) ){ $selected = ' selected="selected"';} ?>
								<option<?php echo $selected; ?> value="<?php echo $k; ?>"><?php echo $v ?></option> 
							<?php } ?>
						</select>
					<?php break; ?>	
					<?php case "images": ?>
						<?php $default_layout = of_get_option('default_layout'); ?>
						<?php foreach( $meta_box[ 'options' ] as $k => $v ){
							$selected = '';
							$checked = '';
							if( isset( $data[ $meta_box[ 'name' ] ] ) ){
								if( $data[ $meta_box[ 'name' ] ] == $k ){
									$selected = ' of-radio-img-selected';
									$checked = ' checked="checked"';
								}
							}elseif( $default_layout == $k ){
								$selected = ' of-radio-img-selected';
								$checked = ' checked="checked"';
							} ?>
							<input type="radio" class="of-radio-img-radio" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo $k; ?>" <?php echo $checked; ?> />
							<div class="of-radio-img-label"><?php echo $k ?></div>
							<img src="<?php echo $v ?>" alt="<?php echo $k ?>" class="of-radio-img-img<?php echo $selected ?>" />
					<?php } ?>
					<?php break; ?>
					<?php case "upload": ?>
						<input type="text" class="upload_field" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php if( isset( $data[ $meta_box[ 'name' ] ] ) ){ echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); } ?>" id="upload_<?php echo $meta_box[ 'id' ]; ?>" />
						<input type="button" class="upload_button" id="upload_button_<?php echo $meta_box[ 'id' ]; ?>" name="upload_<?php echo $meta_box[ 'name' ]; ?>" value="Browse" />
					<?php break; ?>		
				<?php } ?>
			</div>
			<div class="explain"><p><?php echo $meta_box['desc']; ?></p></div>
			<div class="clear"></div>
		</div>
	</div>
<?php }

//Save custom fields
function pi_save_meta_box( $post_id ) {
	global $post, $page_meta_boxes, $post_meta_boxes, $key;
	
	if( $post->post_type == "post" ){
		foreach( $post_meta_boxes as $meta_box ) {
			$meta_value = isset( $_POST[ $meta_box[ 'name' ] ] ) ? $_POST[ $meta_box[ 'name' ] ] : '';
			$data[ $meta_box[ 'name' ] ] = $meta_value;
		}
	}else{
		foreach( $page_meta_boxes as $meta_box ) {
			$meta_value = isset( $_POST[ $meta_box[ 'name' ] ] ) ? $_POST[ $meta_box[ 'name' ] ] : '';
			$data[ $meta_box[ 'name' ] ] = $meta_value;
		}
	}
	
	$key_wpnonce = isset( $_POST[ $key . '_wpnonce' ] ) ? $_POST[ $key . '_wpnonce' ] : null;
	if ( !wp_verify_nonce( $key_wpnonce, plugin_basename(__FILE__) ) )
		return $post_id;
	
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	
	update_post_meta( $post_id, $key, $data );
}

//Save custom fields
function pi_save_featured_meta_box( $post_id ) {
	global $post, $featured_meta_box, $featured_key;
	
	$key_wpnonce = isset( $_POST[ $featured_key . '_wpnonce' ] ) ? $_POST[ $featured_key . '_wpnonce' ] : null;
	if ( !wp_verify_nonce( $key_wpnonce, plugin_basename(__FILE__) ) )
		return $post_id;
	
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	
	
	$data = isset( $_POST[ $featured_meta_box[ 'name' ] ] ) ? $_POST[ $featured_meta_box[ 'name' ] ] : '';
	update_post_meta( $post_id, $featured_key, $data );
}

add_action( 'admin_menu', 'pi_create_meta_box' );
add_action( 'save_post', 'pi_save_meta_box' );
add_action( 'save_post', 'pi_save_featured_meta_box' );
?>