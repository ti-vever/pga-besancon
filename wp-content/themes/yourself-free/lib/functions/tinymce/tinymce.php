<?php
 
// TinyMCE Button

	class add_pi_shortcodes_button {
	var $pluginname = 'pi_shortcodes';
	var $path = '';
	var $internalVersion = 100;
	
	function add_pi_shortcodes_button()  
	{
		
		// Set path to editor-plugin.js
		$this->path = get_template_directory_uri() . '/lib/functions/tinymce/';	
		
		// Modify the version when tinyMCE plugins are changed.
		add_filter('tiny_mce_version', array (&$this, 'change_tinymce_version') );

		// init process for button control
		add_action('init', array (&$this, 'addbuttons') );
	}
	
	function addbuttons() 
	{
		global $page_handle;
		
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) 
			return;
			
			// Add only in Rich Editor mode
			if ( get_user_option('rich_editing') == 'true') 
			{
				add_filter("mce_external_plugins", array (&$this, 'add_tinymce_plugin' ), 5);
				add_filter('mce_buttons', array (&$this, 'register_button' ), 5);
			}
		}

	
	function register_button($buttons) 
	{
		array_push($buttons, 'separator', $this->pluginname );
		return $buttons;
	}
	
	function add_tinymce_plugin($plugin_array) 
	{	
		$plugin_array[$this->pluginname] =  $this->path . 'editor-plugin.js';
			
		return $plugin_array;
	}
	
	function add_tinymce_langs_path($plugin_array) 
	{
		// Load the TinyMCE language file	
		$plugin_array[$this->pluginname] = get_template_directory_uri() . '/lib/functions/tinymce/langs.php';
		return $plugin_array;
	}
	
	
	/**
	 * add_nextgen_button::change_tinymce_version()
	 * A different version will rebuild the cache
	 * 
	 * @return $version
	 */
	function change_tinymce_version($version) 
	{
		$version = $version + $this->internalVersion;
		return $version;
	}
	
}

// Call it now
$tinymce_button = new add_pi_shortcodes_button ();
?>