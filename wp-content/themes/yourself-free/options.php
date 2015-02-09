<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	if( function_exists('wp_get_theme') ){
		$current_theme = wp_get_theme();
		$themename = $current_theme->Name;
		$themename = preg_replace("/\W/", "", strtolower($themename) );
	}else{
		$themename = get_theme_data(STYLESHEETPATH . '/style.css');
		$themename = $themename['Name'];
		$themename = preg_replace("/\W/", "", strtolower($themename) );
	}
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
		
	// Test data
	$test_array = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
	
	// Multicheck Array
	$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
	
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "1","five" => "1");
	
	// Background Defaults
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'left top','attachment'=>'scroll');
	
	//Slder settings
	$flex_transition_effect = array("slide" => "Slide", "fade" => "Fade");
		
	$nivo_transition_effect = array("sliceDown" => "Down", "sliceDownLeft" => "Down Left", "sliceUp" => "Up", "sliceUpLeft" => "Up Left", "sliceUpDown" => "Up Down", "sliceUpDownLeft" => "Up Down Left", "fold" => "Fold", "fade" => "Fade");
	
	$question = array("yes" => "Yes", "no" => "No");
	
	$social_profiles = array("delicious" => "Delicious", "deviantart" => "DeviantART", "digg" => "Digg", "dribbble" => "Dribbble", "email" => "Email", "facebook" => "Facebook", "formspring" => "Formspring", "flickr" => "Flickr", "foursquare" => "Foursquare", "forrst" => "Forrst", "github" => "GitHub", "google" => "Google", "grooveshark" => "Grooveshark", "instagram" => "Instagram", "linkedin" => "Linkedin", "reddit" => "Reddit", "rss" => "RSS", "skype" => "Skype", "tumblr" => "Tumblr", "twitter" => "Twitter", "vimeo" => "Vimeo", "wordpress" => "WordPress", "youtube" => "YouTube");
	
	$elastic_transition_effect = array('slides' => 'Slides', 'center' => 'Center');
	
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/admin/images/layout/';
	
	$layout = array( 'layout-1col-fixed' => $imagepath . '1col.png', 'layout-2c-r-fixed' => $imagepath . '2cr.png', 'layout-2c-l-fixed' => $imagepath . '2cl.png');
	
	$homepage_type = array( 'image' => 'Image', 'video' => 'Video', 'slider' => 'Slider');
	
	$footer_layout = array( 'layout-1col-fixed' => $imagepath . '1col.png',  'layout-2col-fixed' => $imagepath . '2col.png', 'layout-3col-fixed' => $imagepath . '3col.png', 'layout-4col-fixed' => $imagepath . '4col.png', 'layout-2c-r-fixed' => $imagepath . '2cr.png', 'layout-2c-l-fixed' => $imagepath . '2cl.png', 'layout-3c-r-fixed' => $imagepath . '3cr.png', 'layout-3c-l-fixed' => $imagepath . '3cl.png', 'layout-3cm-fixed' => $imagepath . '3cm.png',);
	
	//Pull all sidebars into array
	$sidebars = of_get_option('sidebar_generator');
	$sidebars['default'] = "Default Sidebar";
	
	//Pull all slider into array - only names
	$slider_names = array();
	$sliders = of_get_option('slider_generator', 'no entry');
	if( $sliders != 'no entry' ){
		foreach($sliders as $name=>$value){
			$slider_names[$name] = $name;	
		}
	}
		
	$options = array();
	
	/* GENERAL SETTINGS */
	
	$options[] = array( "name" => __("Documentation", "theme_textdomain"),
						"type" => "heading");
	
	$options[] = array( "type" => "feed" );
	
	$options[] = array( "name" => __("General Settings", "theme_textdomain"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Logo Settings", "theme_textdomain"),
						"desc" => __("You can choose between uploading your custom logo or displaying your site title.", "theme_textdomain"),
						"id" => "logo_settings",
						"std" => "title",
						"type" => "radio",
						"options" => array(
							"logo" => __("Custom Logo", "theme_textdomain"),
							"title" => __("Site Title", "theme_textdomain") ) );
	
	$options[] = array( "name" => __("Logo", "theme_textdomain" ),
						"desc" => __("Upload a logo for your site, or specify the image address of your online logo. (http://www.example.com/logo.png)", "theme_textdomain"),
						"id" => "logo",
						"class" => "hide",
						"type" => "upload");
	
	$options[] = array( "name" => __("Favicon", "theme_textdomain"),
						"desc" => __("Upload a 16px x 16px Png/Gif image to be displayed as your website favicon.", "theme_textdomain"),
						"id" => "favicon",
						"type" => "upload");
						
	$options[] = array( "name" => __("Icons Style", "theme_textdomain"),
						"desc" => __("Choose the color style of social profile icons.", "theme_textdomain"),
						"id" => "social_color",
						"type" => "select",
						"class" => "conditional-content hide",
						"std" => "grey",
						"options" => array(
							"light" => "Light",
							"grey" => "Grey",
							"dark" => "Dark" ));
						
	$options[] = array( "name" => __("Layout", "theme_textdomain"),
						"desc" => __("Select the default layout for your site. You can customize the layout for every post and page via custom fields.", "theme_textdomain"),
						"id" => "default_layout",
						"std" => "layout-2c-r-fixed",
						"type" => "images",
						"options" => $layout );
						
	$options[] = array( "name" => __("Layout Width (pixels)", "theme_textdomain"),
						"desc" => __("Introduce a value between 1024 and 1280 to change the layout width.", "theme_textdomain"),
						"id" => "layout_width",
						"type" => "number",
						"std" => 1280,
						"min" => 1024,
						"max" => 1280);					
						
	$options[] = array( "name" => __("Contact Form Email", "theme_textdomain"),
						"desc" => __("Enter the email address where you'd like to receive emails from the contact form, or leave blank to use admin email.", "theme_textdomain"),
						"id" => "contact_email",
						"std" => get_option('admin_email'),
						"type" => "text");
	
	$options[] = array( "name" => __("PressTrends", "theme_textdomain"),
						"desc" => __("PressTrends is a simple usage tracker that allows us to see how our users are using Yourself Theme - so that we can help improve them for you. Important: None of your personal data is sent to PressTrends.", "theme_textdomain"),
						"id" => "enable_yourself_presstrends",
						"std" => "enable",
						"type" => "radio",
						"options" => array(
						"enable" => __("Enable (Recommended)", "theme_textdomain"),
						"disable" => __("Disable", "theme_textdomain") ) );
	
						
	$options[] = array( "name" => __("Header Code", "theme_textdomain"),
						"desc" => __("The code pasted here will be included before the tag of each page. You can paste in your tracking codes, script and/or style includes.", "theme_textdomain"),
						"id" => "code_header",
						"type" => "textarea");
						
	$options[] = array( "name" => __("Footor Code", "theme_textdomain"),
						"desc" => __("The code pasted here will be included before the tag of each page. You can paste in your tracking codes, script and/or style includes.", "theme_textdomain"),
						"id" => "code_footer",
						"type" => "textarea");
	
	/* SKINS */
	
	$options[] = array( "name" => __("Skins", "theme_textdomain"),
						"type" => "heading");
											
	$options[] = array( "name" => __("Skin Manager", "theme_textdomain"),
						"desc" => pi_upgrade_cta("skins"),
						"id" => "skin_generator",
						"std" => "skins",
						"type" => "radio",
						"options" => array(
							'skins' => __("Default", "theme_textdomain"),
							'custom' => __("Customize", "theme_textdomain" ) ) );
											
	$options[] = array( "name" => __("Customize your own Skin", "theme_textdomain"),
						"type" => "group");
						
	$options[] = array( "name" => __("Typography", "theme_textdomain"),
						"type" => "toggle");
	
	$options[] = array( "name" => __("Body Font", "theme_textdomain"),
						"id" => "skin_body_font",
						"std" => array('size' => 16,'face' => 'Open Sans','style' => 'normal','color' => '#444444'),
						"type" => "typography",
						"heading" => "h5");
						
	$options[] = array( "name" => __("H1 Font", "theme_textdomain"),
						"id" => "skin_h1",
						"std" => array('size' => 20,'face' => 'Droid Sans','style' => 'bold','color' => '#333333'),
						"type" => "typography",
						"heading" => "h5");
	
	$options[] = array( "name" => __("H2 Font", "theme_textdomain"),
						"id" => "skin_h2",
						"std" => array('size' => 18,'face' => 'Droid Sans','style' => 'bold','color' => '#333333'),
						"type" => "typography",
						"heading" => "h5");
						
	$options[] = array( "name" => __("H3 Font", "theme_textdomain"),
						"id" => "skin_h3",
						"std" => array('size' => 16,'face' => 'Droid Sans','style' => 'bold','color' => '#333333'),
						"type" => "typography",
						"heading" => "h5");
	
	$options[] = array( "name" => __("H4 Font", "theme_textdomain"),
						"id" => "skin_h4",
						"std" => array('size' => 14,'face' => 'Droid Sans','style' => 'bold','color' => '#333333'),
						"type" => "typography",
						"heading" => "h5");
						
	$options[] = array( "name" => __("H5 Font", "theme_textdomain"),
						"id" => "skin_h5",
						"std" => array('size' => 13,'face' => 'Droid Sans','style' => 'bold','color' => '#333333'),
						"type" => "typography",
						"heading" => "h5");
						
	$options[] = array( "name" => __("H6 Font", "theme_textdomain"),
						"id" => "skin_h6",
						"std" => array('size' => 12,'face' => 'Droid Sans','style' => 'bold','color' => '#333333'),
						"type" => "typography",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Link", "theme_textdomain"),
						"id" => "skin_dafault_link",
						"std" => "#333333",
						"type" => "color",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Link Hover", "theme_textdomain"),
						"id" => "skin_dafault_link_hover",
						"std" => '#6e99b9',
						"type" => "color",
						"heading" => "h5");										

	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Body", "theme_textdomain"),
						"type" => "toggle");
						
	$options[] = array( "name" =>  __("Body Background", "theme_textdomain"),
						"id" => "skin_body_background",
						"std" => array('color' => '#f7f7f7', 'image' => '', 'repeat' => 'repeat','position' => 'left top','attachment'=>'scroll'), 
						"type" => "background",
						"heading" => "h5");
						
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Header", "theme_textdomain"),
						"type" => "toggle");
	
	$options[] = array( "name" => __("General", "theme_textdomain"),
						"type" => "toggle");
	
	$options[] = array( "name" =>  __("Header Background", "theme_textdomain"),
						"id" => "skin_header_background",
						"std" => array('color' => '#121314', 'image' => '', 'repeat' => 'repeat','position' => 'left top','attachment'=>'scroll'), 
						"type" => "background",
						"heading" => "h5");					
	
	$options[] = array( "name" => __("Border Bottom", "theme_textdomain"),
						"id" => "skin_header_border_bottom",
						"std" => array('border-style' => 'none', 'size' => 1, 'color' => '#000000'),
						"type" => "border",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Shadow Bottom", "theme_textdomain"),
						"id" => "skin_header_shadow_bottom",
						"std" => array('display' => 'disable', 'h-size' => 1, 'v-size' => 1, 'color' => '#f9f9f9'),
						"type" => "shadow",
						"heading" => "h5");
						
	$options[] = array( "type" => "toggle-close");
						
	$options[] = array( "name" => __("Menu", "theme_textdomain"),
						"type" => "toggle");
	
	$options[] = array( "name" => __("Logo Typography", "theme_textdomain"),
						"id" => "skin_header_logo_font",
						"std" => array('size' => 16,'face' => 'Ubuntu','style' => 'bold','color' => '#333333'),
						"type" => "typography",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Typography", "theme_textdomain"),
						"id" => "skin_header_menu_font",
						"std" => array('size' => 12,'face' => 'Droid Sans','style' => 'bold','color' => '#535353'),
						"type" => "typography",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Typography Shadow", "theme_textdomain"),
						"id" => "skin_header_shadow_font",
						"std" => array('display' => 'enable', 'h-size' => 1, 'v-size' => 2,  'color' => '#111111'),
						"type" => "shadow",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Link Hover", "theme_textdomain"),
						"id" => "skin_header_link_hover",
						"std" => '#ffffff',
						"type" => "color",
						"heading" => "h5");
						
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Dropdown Menu", "theme_textdomain"),
						"type" => "toggle");
						
	$options[] = array( "name" => __("Background", "theme_textdomain"),
						"id" => "skin_header_dropdown_menu_background",
						"std" => array('color' => '#121314', 'image' => '', 'repeat' => 'repeat','position' => 'left top','attachment'=>'scroll'), 
						"type" => "background",
						"heading" => "h5");	
						
	$options[] = array( "name" => __("Border", "theme_textdomain"),
						"id" => "skin_header_dropdown_border",
						"std" => array('border-style' => 'none', 'size' => 1, 'color' => '#1a1a1a'),
						"type" => "border",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Shadow", "theme_textdomain"),
						"id" => "skin_header_dropdown_shadow",
						"std" => array('display' => 'disable', 'h-size' => 1, 'v-size' => 2,  'color' => '#000000'),
						"type" => "shadow",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Delimiters", "theme_textdomain"),
						"id" => "skin_subheader_delimiters",
						"std" => '#1a1a1a',
						"type" => "color",
						"heading" => "h5");
										
	$options[] = array( "type" => "toggle-close");
											
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Subheader", "theme_textdomain"),
						"type" => "toggle");
	
	$options[] = array( "name" => __("Background", "theme_textdomain"),
						"id" => "skin_subheader_background",
						"std" => array('color' => '#ffffff', 'image' => '', 'repeat' => 'repeat','position' => 'left top','attachment'=>'scroll'),
						"type" => "background",
						"heading" => "h5");	
						
	$options[] = array( "name" => __("Border", "theme_textdomain"),
						"id" => "skin_subheader_border",
						"std" => array('border-style' => 'solid', 'size' => 1, 'color' => '#f0f0f0'),
						"type" => "border",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Shadow", "theme_textdomain"),
						"id" => "skin_subheader_shadow",
						"std" => array('display' => 'enable', 'h-size' => 1, 'v-size' => 2, 'color' => '#f7f7f7'),
						"type" => "shadow",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Typography", "theme_textdomain"),
						"id" => "skin_subheader_font",
						"std" => array('size' => 14,'face' => 'Oswald','style' => 'normal','color' => '#333333'),
						"type" => "typography",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Typography Shadow", "theme_textdomain"),
						"id" => "skin_subheader_shadow_font",
						"std" => array('display' => 'disable', 'h-size' => 1, 'v-size' => 1, 'color' => '#f0f0f0'),
						"type" => "shadow",
						"heading" => "h5");
	
	$options[] = array( "name" => __("Link", "theme_textdomain"),
						"id" => "skin_subheader_link",
						"std" => '#333333',
						"type" => "color",
						"heading" => "h5");
											
	$options[] = array( "name" => __("Link Hover", "theme_textdomain"),
						"id" => "skin_subheader_link_hover",
						"std" => '#6e99b9',
						"type" => "color",
						"heading" => "h5");
	
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Main content", "theme_textdomain"),
						"type" => "toggle");
						
	$options[] = array( "name" => __("Background", "theme_textdomain"),
						"id" => "skin_main_background",
						"std" => array('color' => '#ffffff', 'image' => '', 'repeat' => 'repeat', 'position' => 'left top','attachment'=>'scroll'), 
						"type" => "background",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Border", "theme_textdomain"),
						"id" => "skin_main_border",
						"std" => array('border-style' => 'solid', 'size' => 1, 'color' => '#d9d9d9'),
						"type" => "border",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Shadow", "theme_textdomain"),
						"id" => "skin_main_shadow",
						"std" => array('display' => 'disable', 'h-size' => 1, 'v-size' => 2, 'color' => '#f0f0f0'),
						"type" => "shadow",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Typography Shadow", "theme_textdomain"),
						"id" => "skin_main_shadow_font",
						"std" => array('display' => 'disable', 'h-size' => 1, 'v-size' => 1, 'color' => '#f0f0f0'),
						"type" => "shadow",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Delimiters color", "theme_textdomain"),
						"id" => "skin_main_delimiters_color",
						"std" => "#f0f0f0",
						"type" => "color",
						"heading" => "h5");			
						
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Footer", "theme_textdomain"),
						"type" => "toggle");
						
	$options[] = array( "name" => __("Background", "theme_textdomain"),
						"id" => "skin_footer_background",
						"std" => array('color' => '#000000', 'image' => '', 'repeat' => 'repeat', 'position' => 'left top','attachment'=>'scroll'),
						"type" => "background",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Typography", "theme_textdomain"),
						"id" => "skin_footer_font",
						"std" => array('size' => 15,'face' => 'Droid Sans','style' => 'normal','color' => '#aaaaaa'),
						"type" => "typography",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Typography Shadow", "theme_textdomain"),
						"id" => "skin_footer_shadow_font",
						"std" => array('display' => 'enable', 'h-size' => 1, 'v-size' => 1, 'color' => '#000000'),
						"type" => "shadow",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Link", "theme_textdomain"),
						"id" => "skin_footer_link",
						"std" => "#ffffff",
						"type" => "color",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Link Hover", "theme_textdomain"),
						"id" => "skin_footer_link_hover",
						"std" => "#6e99b9",
						"type" => "color",
						"heading" => "h5");		
	
	$options[] = array( "name" => __("Headers Color", "theme_textdomain"),
						"id" => "skin_footer_color_headers",
						"std" => "#ffffff",
						"type" => "color",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Delimiters Color", "theme_textdomain"),
						"id" => "skin_footer_color_delimiters",
						"std" => "#1a1a1a",
						"type" => "color",
						"heading" => "h5");					
						
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Miscellaneous", "theme_textdomain"),
						"type" => "toggle");
	
	$options[] = array( "name" => __("Social Footer", "theme_textdomain"),
						"type" => "toggle");
						
	$options[] = array( "name" => __("Background", "theme_textdomain"),
						"id" => "skin_social_footer_background",
						"std" => array('color' => '#121314', 'image' => '', 'repeat' => 'repeat', 'position' => 'left top','attachment'=>'scroll'), 
						"type" => "background",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Typography Color", "theme_textdomain"),
						"id" => "skin_social_footer_color_font",
						"std" => "#ffffff",
						"type" => "color",
						"heading" => "h5");
						
	$options[] = array( "name" => __("Social Link Hover", "theme_textdomain"),
						"id" => "skin_social_link_hover_color",
						"std" => "#ffffff",
						"type" => "color",
						"heading" => "h5");
	
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Content Forms", "theme_textdomain"),
						"type" => "toggle");
	
	$options[] = array( "name" => __("Borders", "theme_textdomain"),
						"id" => "skin_content_form_borders",
						"std" => array('border-style' => 'solid', 'size' => 1, 'color' => '#f0f0f0'),
						"type" => "border",
						"heading" => "h5");
	
	$options[] = array( "name" => __("Background Color", "theme_textdomain"),
						"id" => "skin_content_form_background_color",
						"std" => "#ffffff",
						"type" => "color",
						"heading" => "h5");
						
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Footer Forms", "theme_textdomain"),
						"type" => "toggle");
	
	$options[] = array( "name" => __("Borders", "theme_textdomain"),
						"id" => "skin_footer_form_borders",
						"std" => array('border-style' => 'solid', 'size' => 1, 'color' => '#1a1a1a'),
						"type" => "border",
						"heading" => "h5");
	
	$options[] = array( "name" => __("Background Color", "theme_textdomain"),
						"id" => "skin_footer_form_background_color",
						"std" => "#111111",
						"type" => "color",
						"heading" => "h5");
						
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "type" => "group-close" );	
	

	/* HOMEPAGE */
						
	$options[] = array( "name" => __("Homepage", "theme_textdomain"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Homepage Layout", "theme_textdomain"),
						"desc" => __("Select the layout for your homepage site.", "theme_textdomain"),
						"id" => "homepage_layout",
						"std" => "layout-1col-fixed",
						"type" => "images",
						"options" => $layout );
	
	$options[] = array( "name" => __("Enable Featured", "theme_textdomain"),
						"desc" => __("Check this to enable a homepage slider, video or image.", "theme_textdomain"),
						"id" => "enable_featured_homepage",
						"std" => "0",
						"class" => "conditional-trigger",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Featured Settings", "theme_textdomain"),
						"class" => "conditional-content hide",
						"type" => "toggle");
	
	$options[] = array( "name" => __("Choose One", "theme_textdomain"),
						"desc" => __("What kind of media do you want to display?", "theme_textdomain"),
						"id" => "hompepage_featured_type",
						"type" => "select",
						"options" => $homepage_type );
	
	$options[] = array( "name" => __("Image", "theme_textdomain"),
						 "desc" => __("Url to the image file for Homepage featured.", "theme_textdomain"),
						 "id" => "homepage_img",
						 "type" => "upload");
						 
	$options[] = array( "name" => __("Video", "theme_textdomain"),
						"desc" => __("Url to Vimeo/YouTube video.", "theme_textdomain"),
						"id" => "homepage_video",
						"type" => "upload");
						
	$options[] = array( "name" => __("Image Height", "theme_textdomain"),
						"desc" => __("Set the height of your image/video/sldier between 5 and 900", "theme_textdomain"),
						"id" => "homepage_height",
						"type" => "number",
						"min" => 5,
						"max" => 900,
						"std" => 450 );	
						
	$options[] = array( "name" => __("Choose slider", "theme_textdomain"),
						"desc" => __("Select a slider created previously using the Slider Manager. If you don't have sliders listed  you must create a new one in order to choose it.", "theme_textdomain"),
						"id" => "homepage_slider",
						"type" => "select",
						"class" => "conditional-content",
						"options" => $slider_names );					
						
	$options[] = array( "type" => "toggle-close");	
											
	$options[] = array( "name" => __("Enable Call To Action", "theme_textdomain"),
						"desc" => __("Check if you want to display call to action option.", "theme_textdomain"),
						"id" => "enable_call_to_action",
						"std" => "0",
						"class" => "conditional-trigger",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Call To Action Settings", "theme_textdomain"),
						"class" => "conditional-content hide",
						"type" => "toggle");
						
	$options[] = array( "name" => __("Title", "theme_textdomain"),
						"desc" => __("Define a title for a call to action.", "theme_textdomain"),
						"id" => "call_to_action_title",
						"type" => "text");					
	
	$options[] = array( "name" => __("Description", "theme_textdomain"),
						"desc" => __("Define a description for a call to action.", "theme_textdomain"),
						"id" => "call_to_action_description",
						"type" => "textarea");
						
	$options[] = array( "name" => __("Button Text", "theme_textdomain"),
						"desc" => __("Define the anchor text for the button.", "theme_textdomain"),
						"id" => "call_to_action_button",
						"type" => "text");
						
	$options[] = array( "name" => __("Button URL", "theme_textdomain"),
						"desc" => __("Define the URL where the user is redirected when clicking the button.", "theme_textdomain"),
						"id" => "call_to_action_url",
						"type" => "text");
	
	$options[] = array( "type" => "toggle-close");
	
	
	/* BLOG */
	
	$options[] = array( "name" => __("Blog", "theme_textdomain"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Blog Layout", "theme_textdomain"),
						"desc" => __("Select the layout for your blog page.", "theme_textdomain"),
						"id" => "blog_layout",
						"std" => "layout-2c-r-fixed",
						"type" => "images",
						"options" => $layout );
						
	$options[] = array( "name" => __("Blog Sidebar", "theme_textdomain"),
						"desc" => __("You can choose as many sidebars as you like, assigning them as needed to each of the pages and posts on your website. Remember you may create as many sidebars as you want using Theme Options - Sidebars.", "theme_textdomain"),
						"id" => "blog_sidebar",
						"type" => "select",
						"options" => $sidebars );
	
	$options[] = array( "name" => __("Enable Submenu ", "theme_textdomain"),
						"desc" => __("Check if you want enable submenu nav. To configure it, go to Appearance - Menus.", "theme_textdomain"),
						"id" => "enable_submenu",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Enable Blog Slider", "theme_textdomain"),
						"desc" => __("Check to enable a blog slider.", "theme_textdomain"),
						"id" => "enable_blog_slider",
						"std" => "0",
						"class" => "conditional-trigger",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Slider Settings", "theme_textdomain"),
						"class" => "conditional-content hide",
						"type" => "toggle");
						
	$options[] = array( "name" => __("No. of Slides", "theme_textdomain"),
						"desc" => __("Select how many slides you want to display. Insert a value between 0 and 50. If you want to display all featured posts set the value to 0.", "theme_textdomain"),
						"id" => "blog_flex_number",
						"type" => "number",
						"min" => 0,
						"max" => 50,
						"std" => 5);
		
	$options[] = array( "name" => __("Image Height", "theme_textdomain"),
						"desc" => __("Set the height of your slider between 5 and 900", "theme_textdomain"),
						"id" => "blog_flex_height",
						"type" => "number",
						"min" => 5,
						"max" => 900,
						"std" => 245 );	
	
	$options[] = array( "type" => "toggle-close");														
	
	$options[] = array( "name" => __("Individual Posts Settings", "theme_textdomain"),
						"desc" => __("The following options apply to individual blog posts.", "theme_textdomain"),
						"type" => "info");
						
	$options[] = array( "name" => __("Enable Featured Image", "theme_textdomain"),
						"desc" => __("Check to display the featured image at the beginning of the post.", "theme_textdomain"),
						"id" => "enable_featured_image",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Enable Author Bio", "theme_textdomain"),
						"desc" => __("Check to display the author bio at the end of the post.", "theme_textdomain"),
						"id" => "enable_author_bio",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Overview excerpt", "theme_textdomain"),
						"desc" => __("Do you want the excerpt on the blog page to end automatically or according to the More Tag or Excerpt field, wich can be set manually by you when you edit a post?", "theme_textdomain"),
						"id" => "overview_excerpt",
						"std" => "auto",
						"type" => "radio",
						"options" => array(
							"auto" => __("Auto excerpt", "theme_textdomain"),
							"manually" => __("Manually insert more tag or excerpt field", "theme_textdomain") ) );
	
	$options[] = array( "name" => __("Excerpt Length", "theme_textdomain"),
						"desc" => __("How many words should the auto excerpt show on the blog page (overview)?", "theme_textdomain"),
						"id" => "excerpt_length",
						"type" => "number",
						"max" => 99999,
						"min" => 0,
						"std" => 55 );						
						
	/* PORTFOLIO */					
						
	$options[] = array( "name" => __("Portfolio", "theme_textdomain"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Enable Lightbox", "theme_textdomain"),
						"desc" => __("Check to enable the lightbox effect for the portfolio items preview.", "theme_textdomain"),
						"id" => "enable_lightbox",
						"std" => "1",
						"type" => "checkbox");					
						
	$options[] = array( "name" => __("Slider Settings", "theme_textdomain"),
						"type" => "toggle");
	
	$options[] = array( "name" => __("Height", "theme_textdomain"),
						"desc" => __("Set the height of your slider between 5 and 900.", "theme_textdomain"),
						"id" => "portfolio_flex_height",
						"type" => "number",
						"min" => 5,
						"max" => 900,
						"std" => 450 );
	
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Enable Related Portfolio", "theme_textdomain"),
						"desc" => __("Enable related projects.", "theme_textdomain"),
						"id" => "enable_related_portfolio",
						"class" => "conditional-trigger",
						"std" => "0",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Related Portfolio Settings", "theme_textdomain"),
						"class" => "conditional-content hide",
						"type" => "toggle");
						
	$options[] = array( "name" => __("Related Portfolio Title", "theme_textdomain"),
						"desc" => __("The title to related portfolio items.", "theme_textdomain"),
						"id" => "related_portfolio_title",
						"type" => "text");
						
	$options[] = array( "name" => __("No. of Related Portfolio Items", "theme_textdomain"),
						"desc" => __("Define how many related portfolio items are displayed in the sidebar. Values can be between 1 and 30.", "theme_textdomain"),
						"id" => "related_portfolio_number",
						"type" => "number",
						"max" => 30,
						"min" => 1,
						"std" => 3 );
						
	$options[] = array( "type" => "toggle-close");
	
	/* SLIDERS */
	
	$options[] = array( "name" => __("Sliders", "theme_textdomain"),
						"type" => "heading");
							
	$options[] = array( "name" => __("Slider Manager", "theme_textdomain"),
						"desc" => __("Create a new slider for your site. Click create a slider and follow the options.", "theme_textdomain"),
						"id" => "slider_generator",
						"class" => "generator",
						"type" => "sliders",
						"options" => array(
							array(
								"name" => __("Flex Slider", "theme_textdomain"),
								"id" => "flex",			
								"settings" => array(
									array(
										"name" => __("Height", "theme_textdomain"),
										"desc" => __("Set the height of your slider between 5 and 900.", "theme_textdomain"),
										"id" => "flex_height",
										"type" => "number",
										"min" => 5,
										"max" => 900,
										"std" => 300
									),
									array(
										"name" => __("Transition Effect", "theme_textdomain"),
										"desc" => __("Choose the transition effect between diferent sliders.", "theme_textdomain"),
										"id" => "flex_transition_effect",
										"type" => "select",
										"options" => $flex_transition_effect
									)
								),
								"slide_settings" => array(
									array(
										"name" => __("Image URL", "theme_textdomain"),
										"desc" => __("Url to the image file for this slide.", "theme_textdomain"),
										"id" => "flex_file-url",
										"type" => "upload"
									),
									array(
										"name" => __("Title", "theme_textdomain"),
										"desc" => __("Optional - Add a title to your slide", "theme_textdomain"),
										"id" => "flex_title",
										"type" => "text"
									),
									array(
										"name" => __("Link", "theme_textdomain"),
										"desc" => __("Optional - Link to an url when your slide is clicked", "theme_textdomain"),
										"id" => "flex_link",
										"type" => "text"
									)
								)
							),
							array(
								"name" => __("Nivo Slider", "theme_textdomain"),
								"id" => "nivo",			
								"settings" => array(
									array(
										"name" => __("Height", "theme_textdomain"),
										"desc" => __("Set the height of your slider between 5 and 900.", "theme_textdomain"),
										"id" => "nivo_height",
										"type" => "number",
										"min" => 5,
										"max" => 900,
										"std" => 300
									),
									array(
										"name" => __("Transition Effect", "theme_textdomain"),
										"desc" => __("Choose the transition effect between diferent sliders.", "theme_textdomain"),
										"id" => "nivo_transition_effect",
										"type" => "select",
										"options" => $nivo_transition_effect
									),
									array(
										"name" => __("Pause Time", "theme_textdomain"),
										"desc" => __("Set the time between slides. Choose a value in milliseconds between 0 and 60000. Remember that 1 second = 1000 milliseconds.", "theme_textdomain"),
										"id" => "nivo_pause_time",
										"type" => "number",
										"max" => 60000,
										"min" => 0,
										"std" => 4000
									)
								),
								"slide_settings" => array(
									array(
										"name" => __("Image URL", "theme_textdomain"),
										"desc" => __("Url to the image file for this slide.", "theme_textdomain"),
										"id" => "nivo_file-url",
										"type" => "upload"
									),
									array(
										"name" => __("Title", "theme_textdomain"),
										"desc" => __("Optional - Add a title to your slide", "theme_textdomain"),
										"id" => "nivo_title",
										"type" => "text"
									),
									array(
										"name" => __("Link", "theme_textdomain"),
										"desc" => __("Optional - Link to an url when your slide is clicked", "theme_textdomain"),
										"id" => "nivo_link",
										"type" => "text"
									)
								)
							)	
						));
		
	
	/* SIDEBARS */
	
	$options[] = array( "name" => __("Sidebars", "theme_textdomain"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Sidebar Manager", "theme_textdomain"),
						"desc" => pi_upgrade_cta("sidebars"),
						"id" => "sidebar_generator",
						"class" => "generator",
						"type" => "sidebars",
						"options" => array() );
						
	/* SOCIAL */
	
	$options[] = array( "name" => __("Social", "theme_textdomain"),
						"type" => "heading");
	
	foreach($social_profiles as $k => $v){
		
		$options[] = array( "name" => $v,
							"type" => "toggle");
		
		$options[] = array( "name" => __("Profile URL", "theme_textdomain"),
							"id" => $k,
							"type" => "text");
							
		$options[] = array( "name" => __("Caption Text", "theme_textdomain"),
							"id" => $k . "_caption",
							"std" => $v,
							"type" => "text");
							
		$options[] = array( "type" => "toggle-close");
		
	}					
						
						
	/* TRANSLATION */					
					
	$options[] = array( "name" => __("Translation", "theme_textdomain"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Translation type", "theme_textdomain"),
						"desc" => __("Check .mo files if you want to use these files for the theme translation. For example en_US for the english version or es_ES to translate to Spanish", "theme_textdomain"),
						"id" => "translation_type",
						"std" => "mo_files",
						"type" => "radio",
						"options" => array(
							"mo_files" => __("Using .mo files", "theme_textdomain"),
							"by_yourself" => __("Do it yourself below", "theme_textdomain") ) );
	
	$options[] = array( "name" => __("Do it yourself", "theme_textdomain"),
						"type" => "group");
						
	$options[] = array( "name" => __("Blog", "theme_textdomain"),
						"type" => "toggle");
	
	$options[] = array( "name" => __("Read more", "theme_textdomain"),
						"id" => "translation_blog_read_more",
						"std" => "Read more",
						"heading" => "h5",
						"type" => "text");
	
	$options[] = array( "name" => __("By", "theme_textdomain"),
						"id" => "translation_blog_by",
						"std" => "By",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("About the author", "theme_textdomain"),
						"id" => "translation_about_the_author",
						"std" => "About the author",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("No Comments", "theme_textdomain"),
						"id" => "translation_no_comments",
						"std" => "No Comments",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("1 Comment", "theme_textdomain"),
						"id" => "translation_1_comment",
						"std" => "1 Comment",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Comments", "theme_textdomain"),
						"id" => "translation_comments",
						"std" => "Comments",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Categories", "theme_textdomain"),
						"id" => "translation_blog_categories_list",
						"std" => "Categories",
						"heading" => "h5",
						"type" => "text");					
						
	$options[] = array( "name" => __("Newer Entries", "theme_textdomain"),
						"id" => "translation_newer_entries",
						"std" => "Newer Entries &rarr;",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Older Entries", "theme_textdomain"),
						"id" => "translation_older_entries",
						"std" => "&larr; Older Entries",
						"heading" => "h5",
						"type" => "text");					
						
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Comments", "theme_textdomain"),
						"type" => "toggle");
						
	$options[] = array( "name" => __("Password Protected", "theme_textdomain"),
						"id" => "translation_password_protected",
						"std" => "This post is password protected. Enter the password to view comments.",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Comments are closed", "theme_textdomain"),
						"id" => "translation_comments_closed",
						"std" => "Comments are closed.",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Trackbacks for this post", "theme_textdomain"),
						"id" => "translation_comments_trackbacks",
						"std" => "Trackbacks for this post",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Leave a Comment", "theme_textdomain"),
						"id" => "translation_leave_a_comment",
						"std" => "Leave a Comment",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Leave a Comment to", "theme_textdomain"),
						"id" => "translation_leave_a_comment_to",
						"std" => "Leave a Comment to",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Says", "theme_textdomain"),
						"id" => "translation_comment_says",
						"std" => "says",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("At", "theme_textdomain"),
						"id" => "translation_comment_at",
						"std" => "at",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Reply", "theme_textdomain"),
						"id" => "translation_comment_reply",
						"std" => "Reply",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Name", "theme_textdomain"),
						"id" => "translation_comments_name",
						"std" => "Name",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Email", "theme_textdomain"),
						"id" => "translation_comments_email",
						"std" => "Email",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Website", "theme_textdomain"),
						"id" => "translation_comments_website",
						"std" => "Website",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Submit Comment", "theme_textdomain"),
						"id" => "translation_submit_comment",
						"std" => "Submit Comment",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Awaiting moderation", "theme_textdomain"),
						"id" => "translation_comments_moderation",
						"std" => "Your comment is awaiting moderation.",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Before commenting", "theme_textdomain"),
						"id" => "translation_comments_before",
						"std" => "Make sure you enter the required information where indicated. Comments are moderated and nofollow is in use. Please no link dropping, no keywords or domains as names, do not spam, and do not advertise!",
						"heading" => "h5",
						"type" => "textarea");
						
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Archive", "theme_textdomain"),
						"type" => "toggle");
						
	$options[] = array( "name" => __("Archive", "theme_textdomain"),
						"id" => "translation_archive_title",
						"std" => "Archive",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Category:", "theme_textdomain"),
						"id" => "translation_archive_category",
						"std" => "Category:",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Tag:", "theme_textdomain"),
						"id" => "translation_archive_tag",
						"std" => "Tag:",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Author", "theme_textdomain"),
						"id" => "translation_archive_author",
						"std" => "You are viewing the author archive for:",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Portfolio: All categories", "theme_textdomain"),
						"id" => "translation_portfolio_all",
						"std" => "All",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Last 10 Posts", "theme_textdomain"),
						"id" => "translation_archive_10_last_posts",
						"std" => "Last 10 Posts:",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Archives by Month:", "theme_textdomain"),
						"id" => "translation_archive_by_month",
						"std" => "Archives by Month:",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Archives by Category:", "theme_textdomain"),
						"id" => "translation_archive_by_category",
						"std" => "Archives by Category:",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Empty Archive", "theme_textdomain"),
						"id" => "translation_archive_empty",
						"std" => "Sorry, but your search did not return any results. Please take a look of our archive:",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Contact", "theme_textdomain"),
						"type" => "toggle");
						
	$options[] = array( "name" => __("Name", "theme_textdomain"),
						"id" => "translation_contact_name",
						"std" => "Name",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Email", "theme_textdomain"),
						"id" => "translation_contact_email",
						"std" => "Email",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Name: Error", "theme_textdomain"),
						"id" => "translation_contact_name_error",
						"std" => "Please enter your name.",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Email: Error", "theme_textdomain"),
						"id" => "translation_contact_email_error",
						"std" => "You entered an invalid email address.",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Message: Error", "theme_textdomain"),
						"id" => "translation_contact_message_error",
						"std" => "Please enter a message.",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Submit Email", "theme_textdomain"),
						"id" => "translation_contact_submit_email",
						"std" => "Submit Email",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Email Sent", "theme_textdomain"),
						"id" => "translation_contact_email_sent",
						"std" => "Thanks, your email was sent successfully.",
						"heading" => "h5",
						"type" => "text");					
						
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Login", "theme_textdomain"),
						"type" => "toggle");
						
	$options[] = array( "name" => __("Register", "theme_textdomain"),
						"id" => "translation_log_register",
						"std" => "Register",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Login", "theme_textdomain"),
						"id" => "translation_log_login",
						"std" => "Login",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("User", "theme_textdomain"),
						"id" => "translation_log_user",
						"std" => "User",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Password", "theme_textdomain"),
						"id" => "translation_log_password",
						"std" => "Password",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Remember me", "theme_textdomain"),
						"id" => "translation_log_remember",
						"std" => "Remember me",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Recover password", "theme_textdomain"),
						"id" => "translation_log_recover",
						"std" => "Recover password",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("You are logged in as", "theme_textdomain"),
						"id" => "translation_log_as",
						"std" => "You are logged in as",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Logout", "theme_textdomain"),
						"id" => "translation_log_out",
						"std" => "Logout &raquo;",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Search", "theme_textdomain"),
						"type" => "toggle");
	
	$options[] = array( "name" => __("Search Text", "theme_textdomain"),
						"id" => "translation_search_text",
						"std" => "Search...",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Search Button", "theme_textdomain"),
						"id" => "translation_search_button",
						"std" => "Search",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Search Results", "theme_textdomain"),
						"id" => "translation_search_result",
						"std" => "Search result for:",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Empty Search", "theme_textdomain"),
						"id" => "translation_search_empty",
						"std" => "Sorry, but your search did not return any results. Please try using a different search term.", "theme_textdomain",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Errors", "theme_textdomain"),
						"type" => "toggle");
						
	$options[] = array( "name" => __("Error 404: Title", "theme_textdomain"),
						"id" => "translation_404_title",
						"std" => "Error 404 - Not Found",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "name" => __("Error 404: Message", "theme_textdomain"),
						"id" => "translation_404_message",
						"std" => "Sorry, but you are looking for something that isn't here.",
						"heading" => "h5",
						"type" => "text");
						
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "type" => "group-close" );
	
	
	/* IMAGE RESIZING */
	
	$options[] = array( "name" => __("Image Resizing", "theme_textdomain"),
						"type" => "heading");
	
	$options[] = array( "name" => __("Define the size of images", "theme_textdomain"),
						"desc" => __("You can define the height of different images between 5 and 1500 px. The image width can not be modified.", "theme_textdomain"),
						"type" => "info");
	
	$options[] = array( "name" => __("Blog Images", "theme_textdomain"),
						"type" => "toggle");
	
	$options[] = array( "name" => __("Blog Posts Excerpt", "theme_textdomain"),
						"desc" => __("px Height - 1240 px Width -OR- 920 px with Sidebar option", "theme_textdomain"),
						"id" => "img_size_blog",
						"class" => "mini",
						"type" => "number",
						"std" => 350,
						"min" => 5,
						"max" => 1500);
						
	$options[] = array( "name" => __("Single Post", "theme_textdomain"),
						"desc" => __("px Height - 1240 px Width -OR- 920 px with Sidebar option", "theme_textdomain"),
						"id" => "img_size_single_post",
						"class" => "mini",
						"type" => "number",
						"std" => 350,
						"min" => 5,
						"max" => 1500);								
	
	$options[] = array( "type" => "toggle-close");
	
	$options[] = array( "name" => __("Portfolio Images", "theme_textdomain"),
						"type" => "toggle");
						
	$options[] = array( "name" => __("One Column Portfolio", "theme_textdomain"),
						"desc" => __("px Height - 920 px Width", "theme_textdomain"),
						"id" => "portfolio_one_height",
						"class" => "mini",
						"type" => "number",
						"std" => 350,
						"min" => 5,
						"max" => 1500);
						
	$options[] = array( "name" => __("One Column Portfolio with Sidebar", "theme_textdomain"),
						"desc" => __("px Height - 600 px Width", "theme_textdomain"),
						"id" => "portfolio_one_height_w_sidebar",
						"class" => "mini",
						"type" => "number",
						"std" => 250,
						"min" => 5,
						"max" => 1500);
						
	$options[] = array( "name" => __("Two Columns Portfolio", "theme_textdomain"),
						"desc" => __("px Height - 450 px Width", "theme_textdomain"),
						"id" => "portfolio_two_height",
						"class" => "mini",
						"type" => "number",
						"std" => 250,
						"min" => 5,
						"max" => 1500);
						
	$options[] = array( "name" => __("Two Columns Portfolio with Sidebar", "theme_textdomain"),
						"desc" => __("px Height - 290 px Width", "theme_textdomain"),
						"id" => "portfolio_two_height_w_sidebar",
						"class" => "mini",
						"type" => "number",
						"std" => 140,
						"min" => 5,
						"max" => 1500);
						
	$options[] = array( "name" => __("Three Columns Portfolio", "theme_textdomain"),
						"desc" => __("px Height - 293 px Width", "theme_textdomain"),
						"id" => "portfolio_three_height",
						"class" => "mini",
						"type" => "number",
						"std" => 150,
						"min" => 5,
						"max" => 1500);
						
	$options[] = array( "name" => __("Three Columns Portfolio with Sidebar", "theme_textdomain"),
						"desc" => __("px Height - 186 px Width", "theme_textdomain"),
						"id" => "portfolio_three_height_w_sidebar",
						"class" => "mini",
						"type" => "number",
						"std" => 140,
						"min" => 5,
						"max" => 1500);						
						
	$options[] = array( "name" => __("Four Columns Portfolio", "theme_textdomain"),
						"desc" => __("px Height - 215 px Width", "theme_textdomain"),
						"id" => "portfolio_four_height",
						"class" => "mini",
						"type" => "number",
						"std" => 150,
						"min" => 5,
						"max" => 1500);
						
	$options[] = array( "name" => __("Four Columns Portfolio with Sidebar", "theme_textdomain"),
						"desc" => __("px Height - 135 px Width", "theme_textdomain"),
						"id" => "portfolio_four_height_w_sidebar",
						"class" => "mini",
						"type" => "number",
						"std" => 115,
						"min" => 5,
						"max" => 1500);
						
	$options[] = array( "name" => __("Single Portfolio", "theme_textdomain"),
						"desc" => __("px Height - 940 px Width", "theme_textdomain"),
						"id" => "portfolio_single_height",
						"class" => "mini",
						"type" => "number",
						"std" => 450,
						"min" => 5,
						"max" => 1500);
						
	$options[] = array( "name" => __("Portfolio Related", "theme_textdomain"),
						"desc" => __("px Height - 293 px Width", "theme_textdomain"),
						"id" => "portfolio_related_height",
						"class" => "mini",
						"type" => "number",
						"std" => 150,
						"min" => 5,
						"max" => 1500);					
						
	$options[] = array( "type" => "toggle-close");
	
	
	/* FOOTER */
						
	$options[] = array( "name" => __("Footer", "theme_textdomain"),
						"type" => "heading");
	
	$options[] = array( "name" => __("Enable Footer Widgets", "theme_textdomain"),
						"desc" => __("Check to enable footer widgets.", "theme_textdomain"),
						"id" => "enable_footer_widgets",
						"std" => "0",
						"class" => "conditional-trigger",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Layout", "theme_textdomain"),
						"desc" => __("Select the layout for your footer widget area.", "theme_textdomain"),
						"id" => "footer_layout",
						"class" => "conditional-content hide",
						"std" => "layout-3col-fixed",
						"type" => "images",
						"options" => $footer_layout );
						
	$options[] = array( "name" => __("Enable Social Area", "theme_textdomain"),
						"desc" => __("Check to enable the social footer area. To configure social icons and links go to the Social section.", "theme_textdomain"),
						"id" => "enable_social",
						"std" => "0",
						"class" => "conditional-trigger",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Social Area Settings", "theme_textdomain"),
						"class" => "conditional-content hide",
						"type" => "toggle");
						
	$options[] = array( "name" => __("Call To Action", "theme_textdomain"),
						"desc" => __("Define a call to action text to engage your user to contact you.", "theme_textdomain"),
						"std" => "Get in touch",
						"id" => "social_footer_call_to_action",
						"type" => "text");					
						
	$options[] = array( "name" => __("Style", "theme_textdomain"),
						"desc" => __("Choose if you want to display just the icons or icons with related text for each of them. This text attached to each icon can be defined in the Social tab.", "theme_textdomain"),
						"id" => "social_footer_style",
						"type" => "select",
						"std" => "accordion",
						"options" => array(
							"call" => "Icons and Call to action",
							"mini" => "Only icons" ));
						
	$options[] = array( "name" => __("Icons Style", "theme_textdomain"),
						"desc" => __("Choose the color style of social profile icons.", "theme_textdomain"),
						"id" => "social_footer_color",
						"type" => "select",
						"std" => "light",
						"options" => array(
							"light" => "Light",
							"grey" => "Grey",
							"dark" => "Dark" ));					
						
	$options[] = array( "type" => "toggle-close");
	
		
	$options[] = array( "name" => __("Copyright Message", "theme_textdomain"),
						"std" => "&copy; 2014 ". get_bloginfo('name'),
						"id" => "copyright",
						"type" => "text");
																	
	return $options;
}