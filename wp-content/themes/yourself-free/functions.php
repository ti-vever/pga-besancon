<?php
/*******************************************************************/
//						OPTIONS FRAMEWORK 
/*******************************************************************/

if ( !function_exists( 'optionsframework_init' ) ) {
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
	require_once(dirname( __FILE__ ) . '/admin/options-framework.php');
}

/*******************************************************************/
//						REQUIRE FUNCTIONS
/*******************************************************************/

/* Init */
require_once(TEMPLATEPATH . '/lib/functions/init-functions.php');
/* Resize Images */
require_once(TEMPLATEPATH . '/lib/functions/resize-images.php');
/* Post Fields */
require_once(TEMPLATEPATH . '/lib/functions/post-fields.php');
/* Embed Video */
require_once(TEMPLATEPATH . '/lib/functions/embed-video.php');
/* Portfolio post type */
require_once(TEMPLATEPATH . '/lib/functions/portfolio-posttype.php');
/* Portfolio custom fields */
require_once(TEMPLATEPATH . '/lib/functions/portfolio-fields.php');
/* Custom Widgets */
require_once(TEMPLATEPATH . '/lib/functions/load-widgets.php');
/* Sliders */
require_once(TEMPLATEPATH . '/lib/functions/sliders.php');
/* Fonts */
require_once(TEMPLATEPATH . '/lib/functions/skins.php');
/* Shortcodes */
require_once(TEMPLATEPATH . '/lib/functions/shortcodes.php');
?>