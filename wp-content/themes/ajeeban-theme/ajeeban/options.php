<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_framework_theme'),
		'two' => __('Two', 'options_framework_theme'),
		'three' => __('Three', 'options_framework_theme'),
		'four' => __('Four', 'options_framework_theme'),
		'five' => __('Five', 'options_framework_theme')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	$of_categories = array();
	$of_categories_obj = get_categories('hide_empty=0');
	foreach ($of_categories_obj as $of_cat) {
	$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
	$categories_tmp = array_unshift($of_categories, "Select a category:"); 
	
	
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('Main Options', 'options_framework_theme'),
		'type' => 'heading');
		
	
	$options[] = array(
		'name' => __('Logo Setting', 'options_framework_theme'),
		'desc' => __('Click here to use image logo. Otherwise it will show default text logo', 'options_framework_theme'),
		'id' => 'hidden_logobox',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Logo Upload', 'options_framework_theme'),
		'desc' => __('Upload the logo image, preferably a PNG file. Please note that the size must be 221px wide and 61px high', 'options_framework_theme'),
		'id' => 'hidden_logo',
		'class' => 'hidden',
		'type' => 'upload');
		
	
	$default = get_stylesheet_directory_uri() . '/images/bg.jpg';
	$background_defaults = array(
    'color' => '',
    'image' => $default,
    'repeat' => 'repeat',
    'position' => 'top left', );
	
	$options[] = array(
    'name' =>  __('Background', 'options_framework_theme'),
    'desc' => __('Add a background.', 'options_framework_theme'),
    'id' => 'background-one',
    'std' => $background_defaults,
    'type' => 'background' );
    
  		
	$options[] = array(
		'name' => __('Slider Setting', 'options_framework_theme'),
		'desc' => __('Click here to enable slider', 'options_framework_theme'),
		'id' => 'hidden_slider',
		'type' => 'checkbox');
		
		
	$options[] = array( "name" => "Select a featured category",
	"desc" => "Select the category you want to fetch posts from in the slider",
	'id' => 'hidden_slidecat',
	"std" => "Select a category:",
	"type" => "select",
	"options" => $options_categories);
	
		
	
	$defined_stylesheets = array(
	    "0" => "Default", // There is no "default" stylesheet to load
	    get_stylesheet_directory_uri() . '/blue.css' => "Blue",
	    get_stylesheet_directory_uri() . '/green.css' => "Green",
	);
	$options[] = array( "name" => "Select a Stylesheet to be Loaded",
	    "desc" => "This is a manually defined list of stylesheets.",
	    "id" => "stylesheet",
	    "std" => "0",
	    "type" => "select",
	    "options" => $defined_stylesheets );
	    
	    
	$options[] = array(
		'name' => __('Site Message Box', 'options_framework_theme'),
		'desc' => __('Click here to enable site message box under the featured post section', 'options_framework_theme'),
		'id' => 'hidden_messagebox',
		'type' => 'checkbox');
	    
	
	$options[] = array(
		'name' => __('Enter HTML code for your site message', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'message_box',
		'std' => '',
		'type' => 'textarea');
		
	    
	$options[] = array(
		'name' => __('About Section Image', 'options_framework_theme'),
		'desc' => __('Upload About Section Image', 'options_framework_theme'),
		'id' => 'about_image',
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('About Section Text', 'options_framework_theme'),
		'desc' => __('Enter About Section Text', 'options_framework_theme'),
		'id' => 'about_text',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Google Analytics', 'options_framework_theme'),
		'desc' => __('Enter your Google Analytics code here', 'options_framework_theme'),
		'id' => 'an_code',
		'std' => '',
		'type' => 'textarea');





$options[] = array(
		'name' => __('Social Buttons', 'options_framework_theme'),
		'type' => 'heading');


	$options[] = array(
		'name' => __('Enable Email Icon', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'hidden_email',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Enter Email Address', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'email_add',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Enable Facebook Icon', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'hidden_fb',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Link to Facebook', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'fb_link',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Enable Twitter Icon', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'hidden_twitter',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Link to Twitter', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'twitter_link',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Enable Google Plus Icon', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'hidden_google',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Link to Google Plus', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'google_link',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Enable Pinterest Icon', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'hidden_pin',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Link to Pinterest', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'pin_link',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Enable Youtube Icon', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'hidden_youtube',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Link to Youtube', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'youtube_link',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Enable Skype Icon', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'hidden_skype',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Link to Skype', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'skype_link',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Enable RSS Icon', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'hidden_feed',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Link to Feed', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'feed_link',
		'std' => '',
		'type' => 'text');
		
		
		



$options[] = array(
		'name' => __('Advertisements', 'options_framework_theme'),
		'type' => 'heading');

	
	
	$options[] = array(
		'name' => __('Enter 1st 125px Image Ad URL', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'sidead_oneurl',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Upload 1st 125px Image', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'sidead_oneimage',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Enter 2nd 125px Image Ad URL', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'sidead_twourl',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Upload 2nd 125px Image', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'sidead_twoimage',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Enter 3rd 125px Image Ad URL', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'sidead_threeurl',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Upload 3rd 125px Image', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'sidead_threeimage',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Enter 4th 125px Image Ad URL', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'sidead_foururl',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Upload 4th 125px Image', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'sidead_fourimage',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Enter your 468x60px Adsense Ad Code', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'id' => 'adsense_ad',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Disable Adsense Ad', 'options_framework_theme'),
		'desc' => __('Click here to disable Adsense Ad.', 'options_framework_theme'),
		'id' => 'hidden_adsensead',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Disable Sidebar Ads', 'options_framework_theme'),
		'desc' => __('Click here to disable Sidebar Ad.', 'options_framework_theme'),
		'id' => 'hidden_sidead',
		'type' => 'checkbox');


		
	
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#hidden_logobox').click(function() {
  		$('#section-hidden_logo').fadeToggle(400);
	});

	if ($('#hidden_logobox:checked').val() !== undefined) {
		$('#section-hidden_logo').show();
	}
	
	$('#hidden_messagebox').click(function() {
  		$('#section-message_box').fadeToggle(400);
	});

	if ($('#hidden_messagebox:checked').val() !== undefined) {
		$('#section-message_box').show();
	}
	
	$('#hidden_slider').click(function() {
  		$('#section-hidden_slidecat').fadeToggle(400);
	});

	if ($('#hidden_slider:checked').val() !== undefined) {
		$('#section-hidden_slidecat').show();
	}
	
});
</script>


<?php
}