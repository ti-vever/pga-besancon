<?php

/*******************************************************************/
//						SIDEBARS
/*******************************************************************/

if (function_exists('register_sidebar')){
	$sidebars = of_get_option('sidebar_generator');
	register_sidebar(array(
		'name' => __('Default Sidebar', "theme_textdomain"),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => __('Footer Widget Area: First', "theme_textdomain"),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => __('Footer Widget Area: Second', "theme_textdomain"),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => __('Footer Widget Area: Third', "theme_textdomain"),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => __('Footer Widget Area: Fourth', "theme_textdomain"),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	if( isset( $sidebars ) && !empty( $sidebars ) ){
		foreach($sidebars as $sidebar){
			register_sidebar(array(
				'name' => $sidebar,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title">',
				'after_title' => '</h4>',
			));	
		}
	}
}

/*******************************************************************/
//						WP 3.0+ MENUS
/*******************************************************************/

function pi_register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu', 'theme_textdomain' ),
			'secondary-menu' => __( 'Secondary Menu', 'theme_textdomain' )
		)
	);
}
add_action('init', 'pi_register_my_menus');

/*******************************************************************/
//						PRIMARY MENU
/*******************************************************************/

class pi_custom_nav_walker extends Walker_Nav_Menu{
	function start_el(&$output, $item, $depth, $args){
		global $wp_query;
        $indent = ( $depth ) ? str_repeat( "", $depth ) : '';
	    $class_names = $value = '';
	    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
	    $class_names = ' class="'. esc_attr( $class_names ) . '"';
	    $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	    $prepend = '';
	    $append = '';
 	    $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
	    if($depth != 0){
	    	$description = $append = $prepend = "";
	    }
	    $item_output = $args->before;
	    $item_output .= '<a'. $attributes .'><span>';
	    $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
	    $item_output .= '</span></a>';
 	    $item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/*******************************************************************/
//						PORTFOLIO CATEGORIES
/*******************************************************************/

class filterable_portfolio_walker extends Walker_Nav_Menu{
   function start_el(&$output, $category, $depth, $args) {
      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
      $link = '<a href="#" ';
      if ( $use_desc_for_title == 0 || empty($category->description) )
         $link .= 'title="' . sprintf(__( 'View all posts filed under %s', 'theme_textdomain' ), $cat_name) . '"';
      else
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '>'. $cat_name .'</a>';
      $output .= '<li class="cat-item '.strtolower(preg_replace('/\s+/', '-', $cat_name)). '">' .$link;
   }
}

/*******************************************************************/
//						BODY LAYOUT
/*******************************************************************/

function pi_get_custom_layout($body_classes=false){
	$layout = "";
	if( get_post_meta( get_the_ID(), 'post-fields', true ) )
		$post_fields = get_post_meta( get_the_ID(), 'post-fields', true);
	if( (is_home() && is_front_page()) || (is_home() && !is_front_page()) ){
		$layout = of_get_option('blog_layout');
	}elseif( !is_home() && is_front_page() ){
		$layout = of_get_option('homepage_layout');
	}elseif( !empty($post_fields['layout']) && ( is_page() || is_single() ) ){
		$layout = $post_fields['layout'];
	}elseif( is_404() ){
		$layout = 'layout-1col-fixed';
	}else{
		$layout = of_get_option('default_layout');
	}
	return $layout;
}

/*******************************************************************/
//						SOCIAL PROFILES
/*******************************************************************/

function pi_get_social_profiles(){
	$social_using = array();
	
	$social_profiles = array("delicious" => "Delicious", "deviantart" => "DeviantART", "digg" => "Digg", "dribbble" => "Dribbble", "email" => "Email", "facebook" => "Facebook", "formspring" => "Formspring", "flickr" => "Flickr", "foursquare" => "Foursquare", "forrst" => "Forrst", "github" => "GitHub", "google" => "Google", "grooveshark" => "Grooveshark", "instagram" => "Instagram", "linkedin" => "Linkedin", "reddit" => "Reddit", "rss" => "RSS", "skype" => "Skype", "tumblr" => "Tumblr", "twitter" => "Twitter", "vimeo" => "Vimeo", "wordpress" => "WordPress", "youtube" => "YouTube");
	
	foreach($social_profiles as $k => $v){
		if( of_get_option($k) != "" ){
			$social_using[] = $k;
		}		
	}
	
	return $social_using;
}

/*******************************************************************/
//						FOOTER COLUMNS NUMBER
/*******************************************************************/

function pi_get_footer_columns_number(){
	$number = 0;
	$layout = of_get_option('footer_layout');
	switch($layout){
		case "layout-1col-fixed":
			$number = 1;
			break;
		case "layout-2col-fixed":
		case "layout-2c-r-fixed":
		case "layout-2c-l-fixed":
			$number = 2;
			break;
		case "layout-3col-fixed":
		case "layout-3c-r-fixed":
		case "layout-3c-l-fixed":
		case "layout-3cm-fixed":
			$number = 3;
			break;
		case "layout-4col-fixed":
			$number = 4;
			break;
	}
	return $number;
}

/************************************************************/
//						WP 2.9+ THUMBNAILS
/************************************************************/

if ( function_exists( 'add_theme_support' ) ) { // WP 2.9+
	add_theme_support( 'post-thumbnails' );
}

/************************************************************/
//						MAX WIDTH
/************************************************************/

if ( ! isset( $content_width ) ) $content_width = 1240;

/************************************************************/
//						IMAGES CUSTOM SIZE
/************************************************************/

function pi_get_blog_img_size(){
	$size = array();
	$size['height'] = of_get_option('img_size_blog');
	$layout = of_get_option('blog_layout');
	if($layout == "layout-1col-fixed"){
		$size['width'] = "1240";
	}else{
		$size['width'] = "920";
	}
	return $size;
}

function pi_get_portfolio_img_size(){
	$post_fields = get_post_meta( get_the_ID(), 'post-fields', true );
	$template = get_post_meta( get_the_ID(), '_wp_page_template', true );
	if( $post_fields['layout'] == "layout-1col-fixed"  ){
		switch( $template ){
			case 'template-portfolio-one-column.php':
				return array("width" => 1240 , "height" => of_get_option('portfolio_one_height') );
			break;
			case 'template-portfolio-two-columns.php':
				return array("width" => 610 , "height" => of_get_option('portfolio_two_height') );
			break;
			case 'template-portfolio-three-columns.php':
				return array("width" => 390, "height" => of_get_option('portfolio_three_height') );
			break;
			case 'template-portfolio-four-columns.php':
				return array("width" => 285, "height" => of_get_option('portfolio_four_height') );
			break;
		}
	}else{
		switch( $template ){
			case 'template-portfolio-one-column.php':
				return array("width" => 900, "height" => of_get_option('portfolio_one_height_w_sidebar') );
			break;
			case 'template-portfolio-two-columns.php':
				return array("width" => 438, "height" => of_get_option('portfolio_two_height_w_sidebar') );
			break;
			case 'template-portfolio-three-columns.php':
				return array("width" => 282, "height" => of_get_option('portfolio_three_height_w_sidebar') );
			break;
			case 'template-portfolio-four-columns.php':
				return array("width" => 205, "height" => of_get_option('portfolio_four_height_w_sidebar') );
			break;
		}	
	}
}

function pi_get_blog_image_width(){
	$post_fields = get_post_meta( get_the_ID(), 'post-fields', true );
	if( $post_fields['layout'] == "layout-1col-fixed" ){
		return "1240";
	}
	else{
		return "920";
	}
}

function pi_get_widget_thumbs_width($sidebar_name){
	$footer_layout = of_get_option('footer_layout'); 
	switch($sidebar_name){
		case 'Footer Widget Area: First':
			switch($footer_layout){
				case 'layout-1col-fixed':
					return 1220; // 960
					break;
				case 'layout-2col-fixed':
					return 595; // 450
					break;
				case 'layout-3col-fixed':
					return 386; // 300
					break;
				case 'layout-4col-fixed':
					return 282; // 210
					break;
				case 'layout-2c-r-fixed':
					return 800; // 600
					break;
				case 'layout-2c-l-fixed':
					return 390; // 300 
					break;
				case 'layout-3c-r-fixed':
					return 580; // 450
					break;
				case 'layout-3c-l-fixed':
					return 290; // 210
					break;
				case 'layout-3cm-fixed':
					return 290; // 210
					break;
			}
			break;
		case 'Footer Widget Area: Second':
			switch($footer_layout){
				case 'layout-2col-fixed':
					return 595; // 450
					break;
				case 'layout-3col-fixed':
					return 386; // 300
					break; 
				case 'layout-4col-fixed':
					return 282; // 210
					break;
				case 'layout-2c-r-fixed':
					return 390; // 300
					break;
				case 'layout-2c-l-fixed':
					return 800; // 600
					break;
				case 'layout-3c-r-fixed':
					return 290; // 210
					break;
				case 'layout-3c-l-fixed':
					return 290; // 210
					break;
				case 'layout-3cm-fixed':
					return 580; // 450
					break;
			}
			break;
		case 'Footer Widget Area: Third':
			switch($footer_layout){
				case 'layout-3col-fixed':
					return 386; // 300
					break;
				case 'layout-4col-fixed':
					return 290; // 210
					break;
				case 'layout-3c-r-fixed':
					return 290; // 210
					break;
				case 'layout-3c-l-fixed':
					return 595; // 450
					break;
				case 'layout-3cm-fixed':
					return 290; // 210
					break;
			}
			break;
		case 'Footer Widget Area: Fourth':
			return 290; // 210
			break;
		default:
			return 300;
			break;
	}
}

/*******************************************************************/
//						READ MORE LINK
/*******************************************************************/

function pi_more_link( $more_link, $more_link_text ) {
	$more_link = '<a href="' . get_permalink() . '" class="btn grey right more-link"><span>' . $more_link_text . '</span></a>';
	return $more_link;
}
add_filter( 'the_content_more_link', 'pi_more_link', 10, 2 );

/*******************************************************************/
//						GET THUMBNAILS URL
/*******************************************************************/

function pi_get_thumbnail_url(){
	$image_id = get_post_thumbnail_id();  
	$image_url = wp_get_attachment_image_src($image_id,'large');  
	return $image_url[0];
}

/*******************************************************************/
//						EXCERPT LENGTH
/*******************************************************************/

function pi_change_excerpt_length($length) {
	return of_get_option('excerpt_length'); 
}
add_filter('excerpt_length', 'pi_change_excerpt_length');

/*******************************************************************/
//						LENGTH BY WORDS
/*******************************************************************/

function pi_length_by_words( $string, $limit ) {
    $array_of_words = explode(' ', $string, ($limit + 1));
    if( count($array_of_words) > $limit ){
		array_pop($array_of_words);
    }
    return implode(' ', $array_of_words);
}

/*******************************************************************/
//						EMAIL ENCODE
/*******************************************************************/

function pi_mail_utf8($to, $subject = '(No subject)', $message = '', $header = '') {
  $header_ = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8' . "\r\n";
  mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $header_ . $header);
}

/*******************************************************************/
//						CUSTOM COMMENTS
/*******************************************************************/

function pi_custom_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrap">
			<div class="comment-author vcard">
		         <?php echo get_avatar($comment,$size='60'); ?>
		    </div>
			<div class="comment-content">
				<?php if ($comment->comment_approved == '0') : ?>
					<span class="required-message"><?php pi_translate_text('Your comment is awaiting moderation.', '_comments_moderation', 'directly'); ?></span>
				<?php endif; ?>
			    <div class="comment-meta commentmetadata">
			    	<p>
				    	<?php printf('<cite class="fn">%s</cite> <span class="says"> ' . pi_translate_text('says', '_comment_says', 'argument') . ':</span>' , get_comment_author_link()) ?>
				    	<span class="date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_date(); ?> <?php pi_translate_text('at', '_comment_at', 'directly'); ?> <?php comment_time(); ?></a><?php edit_comment_link(__('(Edit)', 'theme_textdomain'),'  ','') ?></span> // <?php comment_reply_link(array_merge( $args, array('reply_text' => pi_translate_text('Reply', '_comment_reply', 'argument'), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				    </p>
			    </div>
			    <div class="comment-body">
			    	<?php comment_text() ?>
			    </div>
	      	</div>	
		</div>
<?php
}

/************************************************************/
//						TRANSLATION
/************************************************************/

function pi_translate_text($text, $id, $type = 'argument'){
	$translation_type = of_get_option('translation_type');
	if($translation_type == "mo_files"){
		if( $type == 'argument' )
			return __($text, "theme_textdomain");
		elseif( $type == 'directly' )
			return _e($text, "theme_textdomain"); 
	}else{
		if( $type == 'argument' )
			return stripslashes( of_get_option('translation' . $id) );
		elseif( $type == 'directly' )
			echo stripslashes( of_get_option('translation' . $id) );
	}
}

load_theme_textdomain ( 'theme_textdomain', TEMPLATEPATH . '/lang' );

/*******************************************************************/
//						REGISTER & LOAD COMMON JS
/*******************************************************************/

/* register js & load default scripts */
function pi_register_my_javascript(){
	/* post fields - admin */
	wp_register_script('post-fields', get_template_directory_uri() . '/admin/js/post-fields.js', 'jquery');
	
	if(!is_admin()){
		
		/* register */
		wp_register_script('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js');
		wp_register_script('validation', 'http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js', 'jquery');
		wp_register_script('pretty-photo', get_template_directory_uri() . '/resources/js/jquery.pretty.photo.js', 'jquery');
		wp_register_script('flex-slider', get_template_directory_uri() . '/resources/js/jquery.flexslider.js', 'jquery');
		wp_register_script('nivo-slider', get_template_directory_uri() . '/resources/js/jquery.nivo.slider.js', 'jquery');
		wp_register_script('superfish', get_template_directory_uri() . '/resources/js/jquery.superfish.js', 'jquery');
		wp_register_script('easing', get_template_directory_uri() . '/resources/js/jquery.easing.js', 'jquery');
		wp_register_script('selectivizr', get_template_directory_uri() . '/resources/js/selectivizr.js', 'jquery');
		wp_register_script('quicksand', get_template_directory_uri() . '/resources/js/jquery.quicksand.js', 'jquery');
		wp_register_script('fitvids', get_template_directory_uri() . '/resources/js/jquery.fitvids.js', 'jquery');
		wp_register_script('custom', get_template_directory_uri() . '/resources/js/custom.js', 'jquery');
		
		/* enqueue */
		wp_enqueue_script('jquery');
		wp_enqueue_script('superfish');
		wp_enqueue_script('pretty-photo');
		wp_enqueue_script('fitvids');
		//wp_enqueue_script('custom');
	}
}
add_action('init', 'pi_register_my_javascript');

/* post fields */
function pi_load_post_fields_scripts(){
	wp_enqueue_script('post-fields');
}
add_action('admin_print_scripts-post.php', 'pi_load_post_fields_scripts');
add_action('admin_print_scripts-post-new.php', 'pi_load_post_fields_scripts');

/* contact template */
function pi_contact_scripts() {
	if (is_page_template('template-contact.php')){ 
		wp_enqueue_script('validation');
	}
}
add_action('wp_print_scripts', 'pi_contact_scripts');

/* validation plugin - contact template */
function pi_contact_validate() {
	if (is_page_template('template-contact.php')) { ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("#contactForm").validate();
			});
		</script>
	<?php }
}
add_action('wp_head', 'pi_contact_validate');

/* portfolio templates */
function pi_portfolio_scripts(){
	if( is_page_template('template-portfolio-one-column.php') || is_page_template('template-portfolio-two-columns.php') || is_page_template('template-portfolio-three-columns.php') || is_page_template('template-portfolio-four-columns.php') ){
		wp_enqueue_script('easing');
		wp_enqueue_script('quicksand');
	}
}
add_action('wp_print_scripts', 'pi_portfolio_scripts');

/* Load Flex Slder - if is single-portfolio */
function pi_load_flex_portfolio(){
	$imgs = get_post_meta( get_the_ID(), 'portfolio_imgs', true );
	if( is_single() && get_post_type() == 'portfolio' && ( $imgs['image-1'] !='' || $imgs['image-2'] !='' || $imgs['image-3'] !='' || $imgs['image-4'] !='' || $imgs['image-5'] !='' || $imgs['image-6'] !='' ) ){
		wp_enqueue_script('flex-slider');
	}
}
add_action('wp_print_scripts', 'pi_load_flex_portfolio');

/* Load Flex Slider - Blog */
function pi_load_flex_blog(){
	if( ( ( is_home() && is_front_page() ) || ( is_home() && !is_front_page() ) ) && ( of_get_option('enable_blog_slider') ) ){
		wp_enqueue_script('flex-slider');
	}
}
add_action('wp_print_scripts', 'pi_load_flex_blog');

/* Flex Slider - Blog */
function pi_flex_blog(){ 
	if( ( ( is_home() && is_front_page() ) || ( is_home() && !is_front_page() ) ) && ( of_get_option('enable_blog_slider') ) ){ ?>
		<script type="text/javascript">		
		jQuery(document).ready(function(){
		  jQuery('#carousel').flexslider({
		    animation: "slide",
		    controlNav: false,
		    animationLoop: false,
		    slideshow: false,
		    itemWidth: 210,
		    itemMargin: 5,
		    asNavFor: '#slider'
		  });
		  
		  jQuery('#slider').flexslider({
		    animation: "slide",
		    controlNav: false,
		    animationLoop: false,
		    slideshow: false,
		    sync: "#carousel"
		  });
		});
		</script>	
<?php } //endif
} //endfunction
add_action('wp_footer', 'pi_flex_blog');

/* Flex Slider - Single Portfolio */
function pi_portfolio_flex(){
	$imgs = get_post_meta( get_the_ID(), 'portfolio_imgs', true ); 
	if( is_single() && get_post_type() == 'portfolio' && ( $imgs['image-1'] !='' || $imgs['image-2'] !='' || $imgs['image-3'] !='' || $imgs['image-4'] !='' ) ){ ?>
		<script type="text/javascript">
		jQuery(document).ready(function(){
		  jQuery('#carousel').flexslider({
		    animation: "slide",
		    controlNav: false,
		    animationLoop: false,
		    slideshow: false,
		    itemWidth: 210,
		    itemMargin: 5,
		    asNavFor: '#slider'
		  });
		  
		  jQuery('#slider').flexslider({
		    animation: "slide",
		    controlNav: false,
		    animationLoop: false,
		    slideshow: false,
		    sync: "#carousel"
		  });
		});
		</script>	
<?php } 
}
add_action('wp_footer', 'pi_portfolio_flex');


/*******************************************************************/
//					CONTACT FORM VALIDATION
/*******************************************************************/

function pi_contact_form_validation(){
	if( !empty($_POST['pi_contact_form']) ) :
	    if(isset($_POST['submitted'])) {
	    	global $nameError, $emailError, $commentError, $emailSent;
	    	if(trim($_POST['cName']) === '') {
	    		$hasError = true;			
	    		$nameError = true;
	    	} else {
	    		$name = trim($_POST['cName']);
	    	}
	    		
	    	if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['cEmail']))) {
	    		$hasError = true;
	    		$emailError = true;
	    	} else {
	    		$email = trim($_POST['cEmail']);
	    	}
	    			
	    	if(trim($_POST['cComment']) === '') {
	    		$hasError = true;
	    		$commentError = true;
	    	} else {
	    		if(function_exists('stripslashes')) {
	    			$comments = stripslashes(trim($_POST['cComment']));
	    		} else {
	    			$comments = trim($_POST['cComment']);
	    		}
	    	}
	    			
	    	if(!isset($hasError)) {
	    		if( of_get_option('contact_email') != "" ){
	    			$emailTo = of_get_option('contact_email');
	    		}else{
	    			$emailTo = get_option('admin_email');
	    		}
	    		$subject = get_bloginfo( 'name' ) . ' contact form: '.$name;
	    		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
	    		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
	    		pi_mail_utf8($emailTo, $subject, $body, $headers);
	    		$emailSent = true;
	    	}	
	    } 
	endif;
}
add_action('init', 'pi_contact_form_validation');

/*******************************************************************/
//					CUSTOM CODE - FOOTER AND HEADER
/*******************************************************************/

function pi_add_header_code(){
	$code = of_get_option('code_header');
	if( !is_admin() && $code != '' ){
		echo stripslashes($code)."\n";
	}
}
add_action('wp_head', 'pi_add_header_code');

function pi_add_footer_code(){
	$code = of_get_option('code_footer');
	if( !is_admin() && $code != '' ){
		echo stripslashes($code)."\n";
	}
}
add_action('wp_footer', 'pi_add_footer_code');

/*******************************************************************/
//						SHORTCODE EDITOR
/*******************************************************************/

if( is_admin() ){
	include TEMPLATEPATH . '/lib/functions/tinymce/tinymce.php';
}

/*******************************************************************/
//						CSS3 SELECTORS FOR IE 
/*******************************************************************/

function pi_load_ie_scripts() {
	global $is_IE;
	if($is_IE) wp_enqueue_script('selectivizr');
}
add_action('wp_print_scripts', 'pi_load_ie_scripts');

/*******************************************************************/
//						REGISTER & LOAD STYLES
/*******************************************************************/

// register post styles
function pi_register_styles(){
	wp_register_style('post-fields', get_template_directory_uri() . '/admin/css/post-fields.css');
	if(!is_admin()){
		wp_register_style('pagenavi', get_template_directory_uri() . '/resources/css/pagenavi.css');
		wp_register_style('pretty-photo', get_template_directory_uri() . '/resources/css/pretty-photo.css');
		wp_enqueue_style('pretty-photo');
	}
}
add_action('init', 'pi_register_styles');

function pi_load_pagenavi_style(){
	if( function_exists('wp_pagenavi') ){
		wp_enqueue_style('pagenavi');
	}
}
add_action('wp_print_styles', 'pi_load_pagenavi_style');

function pi_load_post_fields_styles(){
	wp_enqueue_style('post-fields');
}
add_action('admin_print_styles-post.php', 'pi_load_post_fields_styles');
add_action('admin_print_styles-post-new.php', 'pi_load_post_fields_styles');

function pi_load_custom_layout_width(){
	if( of_get_option('layout_width') != 1280 ){
		$custom_layout_width = of_get_option('layout_width');
		echo '<style type="text/css">#container{max-width:'. $custom_layout_width .'px;}</style>';
	}
}
add_action('wp_print_styles', 'pi_load_custom_layout_width');

/*******************************************************************/
//						UPGRADE OPTIONS
/*******************************************************************/


function pi_upgrade_cta($feature){
	$desc = "";
	if( get_bloginfo("language") == "es-ES" || get_bloginfo("language") == "es-PE" ){ $lan = "es"; }
	switch($feature){
		case 'skins':
			if( $lan == "es" ){
				$desc = "Esta opción no está disponible en la versión Gratuita (la que usted está usando). Comprando una de las versiones de pago puede cambiar el diseño de su Página Web con sólo un par de clicks. En caso de trabajar como Freelance o en un estudio de diseño esta opción le permite crear un diseño a medida para cada cliente y no perder tiempo si un cliente quiere cambios en el diseño: color de los enlaces, tamaño y tipo de letra, formularios, menús y cualquier aspecto de diseño que imagine. Puede ver las diferentes opciones de diseño disponibles justo debajo de estas líneas (desplegando cada opción haciendo click en los triangulitos de la derecha). Estas opciones convierten una Plantilla de WordPress en Miles de Páginas Web diferentes. Las opciones son ilimitadas, cualquier diseño es posible. <a href=\"http://es.themeyourself.com/upgrade/?src=free\">Haga Click para descubrir todos los beneficios que le aporta una versión de pago</a>.";
			}
			else{
				$desc = "Change the design of your web page with a few clicks. Purchase Personal or Developer version to design your Web however you like and enjoys this and other advantages. You can create thousands of different Web Sites designs just with a WordPess Theme. <a href=\"http://themeyourself.com/upgrade/?src=free\">Click to discover everything you can do right now</a>.";
			}
		break;
		case 'sidebars':
			if( $lan == "es" ){
				$desc = "Esta opción no está disponible en la versión Gratuita (la que usted está usando). Si quiere crear diferentes barras laterales de navegación para organizar mejor el contenido de su Página Web puede hacerlo comprando una versión de pago. Además, podrá disfrutar de éste y otros beneficios: cambiar el diseño de su página Web con un par de clicks, recibir ayuda en caso de dudas, actualizaciones de la Plantilla, etc. <a href=\"http://es.themeyourself.com/upgrade/?src=free\">Haga Click para descubrir todos los beneficios que le aporta una versión de pago</a>.";
			}
			else{
				$desc = "If you want to create different sidebars to organize the content of your web, you still have time. Download a Premium version to benefit from this and other advantages. Like changing the design on your web, get help if you have doubts, and so on. <a href=\"http://themeyourself.com/upgrade/?src=free\">Click to discover everything you can do with this Theme</a>";
			}
		break;
		case 'sidebar':
			if( $lan == "es" ){
				$desc = "Esta opción no está disponible en la versión Gratuita (la que usted está usando). Si quiere crear diferentes barras laterales de navegación para organizar mejor el contenido de su página Web puede hacerlo comprando una versión de pago. <a href=\"http://es.themeyourself.com/upgrade/?src=free\">Haga Click para descubrir todos los beneficios que le aporta una versión de pago</a>.";
			}
			else{
				$desc = "If you want to create as many sidebars as you want and assign to any page or post to organize your content, you can do it upgrading to Premium version. <a href=\"http://themeyourself.com/upgrade/?src=free\">Read more about Premium Version and how to upgrade it</a>.";
			}
		break;
		case 'widgets':
			if( $lan == "es" ){
				$desc = "Puede usar este Widget y otras opciones actualizando su Plantilla de WordPress a una versión de pago. <a href=\"http://es.themeyourself.com/upgrade/?src=free\">Haga Click para descubrir todos los beneficios que le aporta una versión de pago</a>.";
			}
			else{
				$desc = "You can use this widget and other cool Premium features upgrading your theme. <a href=\"http://themeyourself.com/upgrade/?src=free\">Read more about Premium Versions and how to upgrade it</a>.";
			}
		break;
		case 'shortcodes':
			if( $lan == "es" ){
				$desc = "Ahorre tiempo y dinero utilizando los shortcodes Premium.<a href=\"http://es.themeyourself.com/upgrade/?src=free\" target=\"_blank\">Haga Click para descubrir todas las ventajas que obtiene al comprar una versión de pago de esta Plantilla de WordPress</a>.";
			}
			else{
				$desc = "You can use Premium shortcodes and other premium features upgrading your theme. <a href=\"http://themeyourself.com/upgrade/?src=free\" target=\"_blank\">Read more about Premium Versions and how to upgrade it</a>.";
			}
		break;
	}
	return $desc;	
}

/*******************************************************************/
//						PRESSTRENDS THEME API
/*******************************************************************/
function yourself_presstrends() {
			
		// PressTrends Account API Key
		$api_key = 'zccpwgf9edkdb6tbkh3zeg2xo1i8cb5p5sn7';
		$auth = 'gijwdj0z1ljtex04thj7r7vb34trn5m4e';

		// Start of Metrics
		global $wpdb;
		$data = get_transient( 'presstrends_theme_cache_data' );
		if ( !$data || $data == '' ) {
			$api_base = 'http://api.presstrends.io/index.php/api/sites/add/auth/';
			$url      = $api_base . $auth . '/api/' . $api_key . '/';

			$count_posts    = wp_count_posts();
			$count_pages    = wp_count_posts( 'page' );
			$comments_count = wp_count_comments();

			// wp_get_theme was introduced in 3.4, for compatibility with older versions.
			if ( function_exists( 'wp_get_theme' ) ) {
				$theme_data    = wp_get_theme();
				$theme_name    = urlencode( $theme_data->Name );
				$theme_version = $theme_data->Version;
			} else {
				$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
				$theme_name = $theme_data['Name'];
				$theme_versino = $theme_data['Version'];
			}

			$plugin_name = '&';
			foreach ( get_plugins() as $plugin_info ) {
				$plugin_name .= $plugin_info['Name'] . '&';
			}
			$posts_with_comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='post' AND comment_count > 0" );
			$data                = array(
				'url'             => stripslashes( str_replace( array( 'http://', '/', ':' ), '', site_url() ) ),
				'posts'           => $count_posts->publish,
				'pages'           => $count_pages->publish,
				'comments'        => $comments_count->total_comments,
				'approved'        => $comments_count->approved,
				'spam'            => $comments_count->spam,
				'pingbacks'       => $wpdb->get_var( "SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_type = 'pingback'" ),
				'post_conversion' => ( $count_posts->publish > 0 && $posts_with_comments > 0 ) ? number_format( ( $posts_with_comments / $count_posts->publish ) * 100, 0, '.', '' ) : 0,
				'theme_version'   => $theme_version,
				'theme_name'      => $theme_name,
				'site_name'       => str_replace( ' ', '', get_bloginfo( 'name' ) ),
				'plugins'         => count( get_option( 'active_plugins' ) ),
				'plugin'          => urlencode( $plugin_name ),
				'wpversion'       => get_bloginfo( 'version' ),
				'api_version'	  => '2.4',
			);

			foreach ( $data as $k => $v ) {
				$url .= $k . '/' . $v . '/';
			}
			wp_remote_get( $url );
			set_transient( 'presstrends_theme_cache_data', $data, 60 * 60 * 24 );
		}
}

if( of_get_option('enable_yourself_presstrends') == 'enable' ){
	add_action('admin_init', 'yourself_presstrends');
}


?>