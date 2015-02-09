<?php
/*
Plugin Name: Options Framework
Plugin URI: http://www.wptheming.com
Description: A framework for building theme options.
Version: 0.6
Author: Devin Price
Author URI: http://www.wptheming.com
License: GPLv2
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/* Basic plugin definitions */

define('OPTIONS_FRAMEWORK_VERSION', '0.6');

/* Make sure we don't expose any info if called directly */

if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a little plugin, don't mind me.";
	exit;
}

/* If the user can't edit theme options, no use running this plugin */

add_action('init', 'optionsframework_rolescheck' );

function optionsframework_rolescheck () {
	if ( current_user_can('edit_theme_options') ) {
		// If the user can edit theme options, let the fun begin!
		add_action('admin_menu', 'optionsframework_add_page');
		add_action('admin_init', 'optionsframework_init' );
		add_action('admin_init', 'optionsframework_mlu_init' );
	}
}

/* 
 * Creates the settings in the database by looping through the array
 * we supplied in options.php.  This is a neat way to do it since
 * we won't have to save settings for headers, descriptions, or arguments-
 * and it makes it a little easier to change and set up in my opinion.
 *
 * Read more about the Settings API in the WordPress codex:
 * http://codex.wordpress.org/Settings_API
 *
 */

function optionsframework_init() {

	// Include the required files
	require_once dirname( __FILE__ ) . '/options-sanitize.php';
	require_once dirname( __FILE__ ) . '/options-interface.php';
	require_once dirname( __FILE__ ) . '/options-medialibrary-uploader.php';
	
	// Loads the options array from the theme
	if ( $optionsfile = locate_template( array('options.php') ) ) {
		require_once($optionsfile);
	}
	else if (file_exists( dirname( __FILE__ ) . '/options.php' ) ) {
		require_once dirname( __FILE__ ) . '/options.php';
	}
	
	$optionsframework_settings = get_option('optionsframework');
	
	// Updates the unique option id in the database if it has changed
	optionsframework_option_name();
	
	// Gets the unique id, returning a default if it isn't defined
	$option_name = $optionsframework_settings['id'];
	
	// Set the option defaults in case they have changed
	optionsframework_setdefaults();
	
	// Registers the settings fields and callback
	register_setting('optionsframework', $option_name, 'optionsframework_validate' );
}


function optionsframework_docu_check_feed(){
	global $of_docu_feed_content;
	$cache = optionsframework_get_docu_feed();
	if ( false === $cache ) {
		//notification
	} else {
		$of_docu_feed_content = $cache;
	}	 
}

function optionsframework_get_docu_feed(){
	if (false === ( $cache = get_transient('optionsframework_toc_trial_feed') ) ) {
		if( get_bloginfo("language") == "es-ES" || get_bloginfo("language") == "es-PE" ){
			$feed = wp_remote_get('http://themes.villauriz.com/toc/spanish-trial.html');
		}else{
			$feed = wp_remote_get('http://themes.villauriz.com/toc/english-trial.html');
		}
		if( !is_wp_error( $feed ) ) {
			if (isset($feed['body']) && strlen($feed['body'])>0) {
				$cache = wp_remote_retrieve_body( $feed );
				set_transient('optionsframework_toc_trial_feed', $cache, 3600);
			}
		}
	}
	return $cache;
}

function optionsframework_addons_check_feed(){
	global $of_addons_feed_content;
	$cache = optionsframework_get_addons_feed();
	if ( false === $cache ) {
		//notification
	} else {
		$of_addons_feed_content = $cache;
	}	 
}

function optionsframework_get_addons_feed(){
	if (false === ( $cache = get_transient('optionsframework_addons_feed') ) ) {
		if( get_bloginfo("language") == "es-ES" || get_bloginfo("language") == "es-PE" ){
			$feed = wp_remote_get('http://themes.villauriz.com/addons/addons-spanish.html');
		}else{
			$feed = wp_remote_get('http://themes.villauriz.com/addons/addons-english.html');
		}
		if( !is_wp_error( $feed ) ) {
			if (isset($feed['body']) && strlen($feed['body'])>0) {
				$cache = wp_remote_retrieve_body( $feed );
				set_transient('optionsframework_addons_feed', $cache, 3600);
			}
		}
	}
	return $cache;
}


function optionsframework_premium_check_feed(){
	global $of_premium_feed_content;
	$cache = optionsframework_get_premium_feed();
	if ( false === $cache ) {
		//notification
	} else {
		$of_premium_feed_content = $cache;
	}	 
}

function optionsframework_get_premium_feed(){
	if (false === ( $cache = get_transient('optionsframework_premium_feed') ) ) {
		if( get_bloginfo("language") == "es-ES" || get_bloginfo("language") == "es-PE" ){
			$feed = wp_remote_get('http://themes.villauriz.com/premium/premium-spanish.html');
		}else{
			$feed = wp_remote_get('http://themes.villauriz.com/premium/premium-english.html');
		}
		if( !is_wp_error( $feed ) ) {
			if (isset($feed['body']) && strlen($feed['body'])>0) {
				$cache = wp_remote_retrieve_body( $feed );
				set_transient('optionsframework_premium_feed', $cache, 3600);
			}
		}
	}
	return $cache;
}

/* 
 * Adds default options to the database if they aren't already present.
 * May update this later to load only on plugin activation, or theme
 * activation since most people won't be editing the options.php
 * on a regular basis.
 *
 * http://codex.wordpress.org/Function_Reference/add_option
 *
 */

function optionsframework_setdefaults() {

	$optionsframework_settings = get_option('optionsframework');

	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	/* 
	 * Each theme will hopefully have a unique id, and all of its options saved
	 * as a separate option set.  We need to track all of these option sets so
	 * it can be easily deleted if someone wishes to remove the plugin and
	 * its associated data.  No need to clutter the database.  
	 *
	 */
	 
	if ( isset($optionsframework_settings['knownoptions']) ) {
		$knownoptions =  $optionsframework_settings['knownoptions'];
		if ( !in_array($option_name, $knownoptions) ) {
			array_push( $knownoptions, $option_name );
			$optionsframework_settings['knownoptions'] = $knownoptions;
			update_option('optionsframework', $optionsframework_settings);
		}
	} else {
		$newoptionname = array($option_name);
		$optionsframework_settings['knownoptions'] = $newoptionname;
		update_option('optionsframework', $optionsframework_settings);
	}
	
	// Gets the default options data from the array in options.php
	$options = optionsframework_options();
		
	// If the options haven't been added to the database yet, they are added now
	foreach ($options as $option) {
		if( isset( $option['id'] ) ){
			if ( ($option['type'] != 'heading') && ($option['type'] != 'info') ) {
				$option_id = preg_replace('/\W/', '', strtolower($option['id']) );
				
				// wp_filter_post_kses for strings
				if (isset($option['std']) ) {
					if ( !is_array($option['std' ]) ) {
						$values[$option_id] = wp_filter_post_kses($option['std']);
					} else {
						foreach ($option['std' ] as $key => $value) {
							$optionarray[$key] = wp_filter_post_kses($value);
						}
						$values[$option_id] = $optionarray;
						unset($optionarray);
					}
				} else {
					$value = '';
				}
			}
		}
	}
	
	if ( isset($values) ) {
		add_option($option_name, $values);
	}
}

/* Add a subpage called "Theme Options" to the appearance menu. */
if ( !function_exists( 'optionsframework_add_page' ) ) {
	function optionsframework_add_page() {
		
		if( function_exists( 'add_object_page' ) ) {
			add_object_page( 'Yourself', 'Yourself', 'manage_options', 'options-framework', 'optionsframework_page', null);
		}else{
			add_menu_page( 'Yourself', 'Yourself', 'manage_options', 'options-framework', 'optionsframework_page', null);
		}
		
		$of_page = add_submenu_page('options-framework', 'Theme Options', 'Theme Options', 'manage_options', 'options-framework','optionsframework_page');
		
		$of_addons_page = add_submenu_page('options-framework', 'Addons', 'Addons', 'manage_options', 'options-framework-addons','optionsframework_addons_page');
		
		$of_premium_page = add_submenu_page('options-framework', 'Premium', 'Premium', 'manage_options', 'options-framework-premium','optionsframework_premium_page');
		
		// Adds actions to hook in the required css and javascript
		add_action("admin_print_styles-$of_page", 'optionsframework_load_styles');
		add_action("admin_print_scripts-$of_page", 'optionsframework_load_scripts');
		add_action("admin_print_styles-$of_addons_page", 'optionsframework_load_addons_styles');
		add_action("admin_print_styles-$of_premium_page", 'optionsframework_load_premium_styles');
		
		//docuemntation feed
		add_action( 'load-'.$of_page, 'optionsframework_docu_check_feed');
		add_action( 'load-'.$of_addons_page, 'optionsframework_addons_check_feed');
		add_action( 'load-'.$of_premium_page, 'optionsframework_premium_check_feed');
		
	}
}

/* Loads the CSS */

function optionsframework_load_styles() {
	wp_enqueue_style('thickbox');
	wp_enqueue_style('admin-style', OPTIONS_FRAMEWORK_DIRECTORY .'css/admin-style.css');
	wp_enqueue_style('color-picker', OPTIONS_FRAMEWORK_DIRECTORY .'css/colorpicker.css');
}	

function optionsframework_load_addons_styles() {
	wp_enqueue_style('addons-style', OPTIONS_FRAMEWORK_DIRECTORY .'css/addons-style.css');
}

function optionsframework_load_premium_styles() {
	wp_enqueue_style('premium-style', OPTIONS_FRAMEWORK_DIRECTORY .'css/premium-style.css');
}

/* Loads the javascript */

function optionsframework_load_scripts() {

	// Inline scripts from options-interface.php
	add_action('admin_head', 'of_admin_head');
	
	// Enqueued scripts
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('media-upload');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('color-picker', OPTIONS_FRAMEWORK_DIRECTORY . 'js/colorpicker.js', array('jquery'));
	wp_enqueue_script('admin-panel', OPTIONS_FRAMEWORK_DIRECTORY . 'js/admin.js', array('jquery'));
}

function of_admin_head() {

	// Hook to add custom scripts
	do_action( 'optionsframework_custom_scripts' );
}

/* 
 * Builds out the options panel.
 *
 * If we were using the Settings API as it was likely intended we would use
 * do_settings_sections here.  But as we don't want the settings wrapped in a table,
 * we'll call our own custom optionsframework_fields.  See options-interface.php
 * for specifics on how each individual field is generated.
 *
 * Nonces are provided using the settings_fields()
 *
 */

if ( !function_exists( 'optionsframework_page' ) ) {
function optionsframework_page() {

	$optionsframework_settings = get_option('optionsframework');

	// Gets the unique option id
	if (isset($optionsframework_settings['id'])) {
		$option_name = $optionsframework_settings['id'];
	}
	else {
		$option_name = 'optionsframework';
	};
	
	// Get the theme name so we can display it up top
	if( function_exists('wp_get_theme') ){
		$current_theme = wp_get_theme();
		$themename = $current_theme->Name;
	}else{
		$themename = get_theme_data(STYLESHEETPATH . '/style.css');
		$themename = $themename['Name'];
	}
	settings_errors();
	?>
	
	<div class="wrap pi_theme_name" id="<?php echo $option_name; ?>">
    <?php screen_icon( 'themes' ); ?>
	<h2><?php esc_html_e( 'Theme Options' ); ?></h2>
    
    <div id="of_container">
       <form action="options.php" method="post">
	  <?php settings_fields('optionsframework'); ?>

        <div id="header">
          <div class="logo">
            <h2><?php esc_html_e( $themename ); ?></h2>
          </div>
          <div class="clear"></div>
        </div>
        <div id="main">
        <?php $return = optionsframework_fields(); ?>
          <div id="of-nav">
            <ul>
              <?php echo $return[1]; ?>
            </ul>
          </div>
          <div id="content">
            <?php echo $return[0]; /* Settings */ ?>
          </div>
          <div class="clear"></div>
        </div>
        <div class="of_admin_bar">
			<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e( __('Save Options', 'theme_textdomain') ); ?>" />
            <input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e( __('Restore Defaults', 'theme_textdomain') ); ?>" onclick="return confirm( '<?php print esc_js( __( 'Click OK to reset. Any theme settings will be lost!', 'theme_textdomain' ) ); ?>' );" />
		</div>
<div class="clear"></div>
	</form>
</div> <!-- / #container -->  
</div> <!-- / .wrap -->

<?php
}
}

/* Addons */

if ( !function_exists( 'optionsframework_addons_page' ) ){
	function optionsframework_addons_page(){ 
		global $of_addons_feed_content; ?>
		
		<div class="wrap">
			<?php screen_icon( 'themes' ); ?>
			<?php if( get_bloginfo("language") == "es-ES" || get_bloginfo("language") == "es-PE" ){ ?>
				<h2><?php esc_html_e( 'Plugins y Servicios Recomendados' ); ?></h2>
			<?php }else{ ?>
				<h2><?php esc_html_e( 'Plugins and Services we Recommend' ); ?></h2>
			<?php } ?>
			<?php echo $of_addons_feed_content; ?>
		</div>
<?php }
}

if ( !function_exists( 'optionsframework_premium_page' ) ){
	function optionsframework_premium_page(){ 
		global $of_premium_feed_content; ?>
		
		<div class="wrap">
			<?php screen_icon( 'themes' ); ?>
			<?php if( get_bloginfo("language") == "es-ES" || get_bloginfo("language") == "es-PE" ){ ?>
				<h2><?php esc_html_e( 'Beneficios de la versión Premium' ); ?></h2>
			<?php }else{ ?>
				<h2><?php esc_html_e( 'Upgrade to Premium Version' ); ?></h2>
			<?php } ?>
			<?php echo $of_premium_feed_content; ?>
		</div>
<?php }
}

/* 
 * Data sanitization!
 *
 * This runs after the submit/reset button has been clicked and
 * validates the inputs.
 *
 */

function optionsframework_validate($input) {

	$optionsframework_settings = get_option('optionsframework');
	
	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	// If the reset button was clicked
	if (!empty($_POST['reset'])) {
		// If options are deleted sucessfully update the error message
		if (delete_option($option_name) ) {
			add_settings_error('options-framework', 'restore_defaults', __('Default options restored.', 'theme_textdomain'), 'updated fade');
		}
	}
	
	else
	
	{
	
	if (!empty($_POST['update'])) {
	
		$clean = array();

		// Get the options array we have defined in options.php
		$options = optionsframework_options();
		
		foreach ($options as $option) {
			
			// Verify that the option has an id
			if ( isset ($option['id']) ) {
				
				if( $option['type'] == "sliders" || $option['type'] == "sidebars"  ){
					//Set id to sliders and sidebars
					$clean_id = preg_replace( '/\W/', '', strtolower( $option['id'] ) );
					$id = $option['type']; 
				}else{
					// Keep all ids lowercase with no spaces
					$id = preg_replace( '/\W/', '', strtolower( $option['id'] ) );
					$clean_id = $id; 
				}
			
				// Set checkbox to false if it wasn't sent in the $_POST
				if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) {
					$input[$id] = "0";
				}
				
				// Set each item in the multicheck to false if it wasn't sent in the $_POST
				if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
					foreach ( $option['options'] as $key => $value ) {
						$input[$id][$key] = "0";
					} 
				}
				
				// For a value to be submitted to database it must pass through a sanitization filter
				if ( ( isset ( $input[$id] ) ) && has_filter('of_sanitize_' . $option['type']) ) {
					$clean[$clean_id] = apply_filters( 'of_sanitize_' . $option['type'], $input[$id], $option );
				}
				
			} // end isset $input
			
		} // end foreach
		
	} // end post
	
	if ( isset($clean) ) {
		add_settings_error('options-framework', 'save_options', __('Options saved.', 'theme_textdomain'), 'updated fade');
		return $clean; // Return validated input
	}
	
	} // end $_POST['update']
	
}


/* 
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 */
	
if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {
	
	$optionsframework_settings = get_option('optionsframework');
	
	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];

	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}
	
	if ( !empty($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
}

/**
 * Add Theme Options menu item to Admin Bar.
 */
 
add_action( 'wp_before_admin_bar_render', 'optionsframework_adminbar' );

/*-----------------------------------------------------------------------------------*/
/* Redirect to "Theme Options" */
/*-----------------------------------------------------------------------------------*/
add_action( 'of_theme_activate', 'of_themeoptions_redirect', 10 );

function of_themeoptions_redirect () {
	// Do redirect
	header( 'Location: ' . admin_url() . 'admin.php?page=options-framework' );
} 

global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
	// Custom action for theme-setup (redirect is at priority 10).
	do_action( 'of_theme_activate' );
}

/*-----------------------------------------------------------------------------------*/
/* WP Admin Bar: Theme Options  */
/*-----------------------------------------------------------------------------------*/

function optionsframework_adminbar() {
	
	global $wp_admin_bar;
	
	$wp_admin_bar->add_menu( array(
		'parent' => 'appearance',
		'id' => 'of_theme_options',
		'title' => __( 'Theme Options', 'theme_textdomain'),
		'href' => admin_url( 'admin.php?page=options-framework' )
  ));
} ?>