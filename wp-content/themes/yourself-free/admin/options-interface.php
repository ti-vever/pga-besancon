<?php

/**
 * Generates the options fields that are used in the form.
 */

function optionsframework_fields() {

	global $allowedtags, $of_docu_feed_content;
	$optionsframework_settings = get_option('optionsframework');

	// Gets the unique option id
	if (isset($optionsframework_settings['id'])) {
		$option_name = $optionsframework_settings['id'];
	}
	else {
		$option_name = 'optionsframework';
	};

	$settings = get_option($option_name);
    $options = optionsframework_options();
        
    $counter = 0;
	$menu = '';
	$output = '';  
	
	foreach ($options as $value) {
	   
		$counter++;
		$val = '';
		$select_value = '';
		$checked = '';
		$lazy_fields = array("heading", "info", "sliders", "group", "toggle", "group-close", "toggle-close", "feed");
		
		// Wrap all options
		if( !in_array($value['type'], $lazy_fields) ){
		
			// Keep all ids lowercase with no spaces
			$value['id'] = preg_replace('/\W/', '', strtolower($value['id']) );

			$id = 'section-' . $value['id'];

			$class = 'section ';
			if ( isset( $value['type'] ) ) {
				$class .= ' section-' . $value['type'];
			}
			if ( isset( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}

			$output .= '<div id="' . esc_attr( $id ) .'" class="' . esc_attr( $class ) . '">'."\n";
			if ( isset( $value['heading']) )
				$output .= '<' . $value['heading'] . ' class="heading">' . esc_html( $value['name'] ) . '</' . $value['heading'] . '>' . "\n";
			else
				$output .= '<h3 class="heading">' . esc_html( $value['name'] ) . '</h3>' . "\n";
			$output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
		 }
		
		// Set default value to $val
		if ( isset( $value['std']) ) {
			$val = $value['std'];
		}
		
		// If the option is already saved, ovveride $val
		if( ($value['type'] != 'heading') && ($value['type'] != 'info')) {
			if( isset($value['id']) ){
				if( isset( $settings[ $value['id'] ] ) ) {
					$val = $settings[ $value['id'] ];
					// Striping slashes of non-array options
					if( !is_array($val) ){
						$val = stripslashes($val);
					}
				}
			}
		}
		                                
		switch ( $value['type'] ) {
		
		// Basic text input
		case 'text':
			$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="text" value="' . esc_attr( $val ) . '" />';
		break;
		
		// Basic number input
		case 'number':
			$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="of-input number-field" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="text" value="' . esc_attr( $val ) . '" />';
		break;
		
		// Textarea
		case 'textarea':
			$cols = '8';
			$ta_value = '';
			
			if(isset($value['options'])){
				$ta_options = $value['options'];
				if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
				} else { $cols = '8'; }
			}
			
			$val = stripslashes( $val );
			
			$output .= '<textarea id="' . esc_attr( $value['id'] ) . '" class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" cols="'. esc_attr( $cols ) . '" rows="8">' . esc_attr( $val ) . '</textarea>';
		break;
		
		// Select Box
		case ($value['type'] == 'select'):
			$output .= '<select class="of-input" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '">';
			
			foreach ($value['options'] as $key => $option ) {
				$selected = '';
				 if( $val != '' ) {
					 if ( $val == $key) { $selected = ' selected="selected"';} 
			     }
				 $output .= '<option'. $selected .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
			 } 
			 $output .= '</select>';
		break;

		
		// Radio Box
		case "radio":
			$name = $option_name .'['. $value['id'] .']';
			foreach ($value['options'] as $key => $option) {
				$id = 'yourself-' . $value['id'] .'-'. $key;
				$output .= '<input class="of-input of-radio" type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="'. esc_attr( $key ) . '" '. checked( $val, $key, false) .' /><label for="' . esc_attr( $id ) . '">' . esc_html( $option ) . '</label><br />';
			}
		break;
		
		// Image Selectors
		case "images":
			$name = $option_name .'['. $value['id'] .']';
			foreach ( $value['options'] as $key => $option ) {
				$selected = '';
				$checked = '';
				if ( $val != '' ) {
					if ( $val == $key ) {
						$selected = ' of-radio-img-selected';
						$checked = ' checked="checked"';
					}
				}
				$output .= '<input type="radio" id="' . esc_attr( $value['id'] .'_'. $key) . '" class="of-radio-img-radio" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. $checked .' />';
				$output .= '<div class="of-radio-img-label">' . esc_html( $key ) . '</div>';
				$output .= '<img src="' . esc_url( $option ) . '" alt="' . $option .'" class="of-radio-img-img' . $selected .'" onclick="document.getElementById(\''. esc_attr($value['id'] .'_'. $key) .'\').checked=true;" />';
			}
		break;
		
		// Checkbox
		case "checkbox":
			$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="checkbox of-input" type="checkbox" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" '. checked( $val, 1, false) .' />';
		break;
		
		// Multicheck
		case "multicheck":
			foreach ($value['options'] as $key => $option) {
				$checked = '';
				$label = $option;
				$option = preg_replace('/\W/', '', strtolower($key));

				$id = $option_name . '-' . $value['id'] . '-'. $option;
				$name = $option_name . '[' . $value['id'] . '][' . $option .']';

			    if ( isset($val[$option]) ) {
					$checked = checked($val[$option], 1, false);
				}

				$output .= '<input id="' . esc_attr( $id ) . '" class="checkbox of-input" type="checkbox" name="' . esc_attr( $name ) . '" ' . $checked . ' /><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label><br />';
			}
		break;
		
		// Color picker
		case "color":
			$output .= '<div id="' . esc_attr( $value['id'] . '_picker' ) . '" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $val ) . '"></div></div>';
			$output .= '<input class="of-color" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" id="' . esc_attr( $value['id'] ) . '" type="text" value="' . esc_attr( $val ) . '" />';
		break; 
		
		// Uploader
		case "upload":
			$output .= optionsframework_medialibrary_uploader( $value['id'], $val, null ); // New AJAX Uploader using Media Library	
		break;
		
		// Typography
		case 'typography':	
		
			$typography_stored = $val;
			
			//Fonts available
			$output .= '<div class="fonts hide">';
			$fonts = pi_get_font_faces();
			foreach($fonts as $font => $v_font){
				$output .= '<a href="#" class="font ' . esc_attr( preg_replace('/\W/', '-', strtolower($font) ) ) . '">' . esc_html( $font ) . '</a>';
			}
			$output .= '</div>';
			
			// Font Size
			$output .= '<select class="of-typography of-typography-size" name="' . esc_attr( $option_name . '[' . $value['id'] . '][size]' ) . '" id="' . esc_attr( $value['id'] . '_size' ) . '">';
			for ($i = 1; $i <= 100; $i++) { 
				$size = $i . 'px';
				$output .= '<option value="' . esc_attr( $i ) . '" ' . selected( $typography_stored['size'], $i, false ) . '>' . esc_html( $size ) . '</option>';
			}
			$output .= '</select>';
		
			// Font Face
			$output .= '<select class="of-typography of-typography-face" name="' . esc_attr( $option_name . '[' . $value['id'] . '][face]' ) . '" id="' . esc_attr( $value['id'] . '_face' ) . '">';
			
			foreach ( $fonts as $font => $v_font ) {
				$output .= '<option value="' . esc_attr( $font ) . '" ' . selected( $typography_stored['face'], $font, false ) . '>' . esc_html( $font ) . '</option>';
			}			
			
			$output .= '</select>';	

			// Font Weight
			$output .= '<select class="of-typography of-typography-style" name="'.$option_name.'['.$value['id'].'][style]" id="'. $value['id'].'_style">';

			$styles = array('normal'=>'Normal',
							'italic'=>'Italic',
							'bold'=>'Bold',
							'bold italic'=>'Bold Italic');

			foreach ($styles as $key => $style) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $typography_stored['style'], $key, false ) . '>'. $style .'</option>';
			}
			$output .= '</select>';

			// Font Color		
			$output .= '<div id="' . esc_attr( $value['id'] ) . '_color_picker" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $typography_stored['color'] ) . '"></div></div>';
			$output .= '<input class="of-color of-typography of-typography-color" name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" type="text" value="' . esc_attr( $typography_stored['color'] ) . '" />';
			
			$output .= '<div class="font_selector"></div>';

		break;
		
		// Link
		case 'link' :
		
			$link_stored = $val;
			
			// Text Decoration
			$output .= '<select class="of-link of-link-text-decoration" name="' . esc_attr( $option_name . '[' . $value['id'] . '][text-decoration]' ) . '" id="' . esc_attr( $value['id'] . '_text_decoration' ) . '">';
			
			$decorations = of_recognized_text_decorations();
			foreach ( $decorations as $key => $decoration ) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $link_stored['text-decoration'], $key, false ) . '>' . esc_html( $decoration ) . '</option>';
			}
			
			$output .= '</select>';	
				
			// Font Color		
			$output .= '<div id="' . esc_attr( $value['id'] ) . '_color_picker" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $link_stored['color'] ) . '"></div></div>';
			$output .= '<input class="of-color of-typography of-typography-color" name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" type="text" value="' . esc_attr( $link_stored['color'] ) . '" />';	
			
		break;
		
		//Border
		case 'border':
		
			$border_stored = $val;
			
			// Border Style
			$output .= '<select class="of-border of-border-style" name="' . esc_attr( $option_name . '[' . $value['id'] . '][border-style]' ) . '" id="' . esc_attr( $value['id'] . '_border_style' ) . '">';
			
			$borders = of_recognized_borders();
			foreach ( $borders as $key => $border ) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $border_stored['border-style'], $key, false ) . '>' . esc_html( $border ) . '</option>';
			}		
			$output .= '</select>';
			
			// Size
			$output .= '<select class="of-border of-border-size" name="' . esc_attr( $option_name . '[' . $value['id'] . '][size]' ) . '" id="' . esc_attr( $value['id'] . '_size' ) . '">';
			for ($i = 1; $i <= 100; $i++) { 
				$size = $i . 'px';
				$output .= '<option value="' . esc_attr( $i ) . '" ' . selected( $border_stored['size'], $i, false ) . '>' . esc_html( $size ) . '</option>';
			}
			$output .= '</select>';
			
			// Color		
			$output .= '<div id="' . esc_attr( $value['id'] ) . '_color_picker" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $border_stored['color'] ) . '"></div></div>';
			$output .= '<input class="of-color of-border of-border-color" name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" type="text" value="' . esc_attr( $border_stored['color'] ) . '" />';
			
		break;
		
		// Shadow
		case 'shadow':
		
			$shadow_stored = $val;
			
			// Display
			$output .= '<select class="of-shadow of-shadow-display" name="' . esc_attr( $option_name . '[' . $value['id'] . '][display]' ) . '" id="' . esc_attr( $value['id'] . '_display' ) . '">';
			
			$displays = of_recognized_display();
			foreach ( $displays as $key => $display ) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $shadow_stored['display'], $key, false ) . '>' . esc_html( $display ) . '</option>';
			}		
			$output .= '</select>';
			
			// Horizontal Size
			$output .= '<select class="of-shadow of-shadow-size" name="' . esc_attr( $option_name . '[' . $value['id'] . '][h-size]' ) . '" id="' . esc_attr( $value['id'] . '_hsize' ) . '">';
			for ($i = 1; $i <= 10; $i++) { 
				$size = $i . 'px - Horizontal';
				$output .= '<option value="' . esc_attr( $i ) . '" ' . selected( $shadow_stored['h-size'], $i, false ) . '>' . esc_html( $size ) . '</option>';
			}
			$output .= '</select>';
			
			// Verical Size
			$output .= '<select class="of-shadow of-shadow-size" name="' . esc_attr( $option_name . '[' . $value['id'] . '][v-size]' ) . '" id="' . esc_attr( $value['id'] . '_vsize' ) . '">';
			for ($i = 1; $i <= 10; $i++) { 
				$size = $i . 'px - Vertical';
				$output .= '<option value="' . esc_attr( $i ) . '" ' . selected( $shadow_stored['v-size'], $i, false ) . '>' . esc_html( $size ) . '</option>';
			}
			$output .= '</select>';
			
			// Color		
			$output .= '<div id="' . esc_attr( $value['id'] ) . '_color_picker" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $shadow_stored['color'] ) . '"></div></div>';
			$output .= '<input class="of-color of-shadow of-shadow-color" name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" type="text" value="' . esc_attr( $shadow_stored['color'] ) . '" />';
			
		break;
			
		
		// Background
		case 'background':
			
			$background = $val;
			
			$output .= '<div class="patterns hide">';
			foreach( range(1, 110) as $pattern_i ){
				$output .= '<a href="#" title="' . $pattern_i . '.png" class="pattern pattern' . $pattern_i . '">Pattern' . $pattern_i . '</a>';	
			}
			$output .= '</div>';
			
			// Background Color		
			$output .= '<div id="' . esc_attr( $value['id'] ) . '_color_picker" class="colorSelector"><div style="' . esc_attr( 'background-color:' . $background['color'] ) . '"></div></div>';
			$output .= '<input class="of-color of-background of-background-color" name="' . esc_attr( $option_name . '[' . $value['id'] . '][color]' ) . '" id="' . esc_attr( $value['id'] . '_color' ) . '" type="text" value="' . esc_attr( $background['color'] ) . '" />';
			
			// Background Image - New AJAX Uploader using Media Library
			if (!isset($background['image'])) {
				$background['image'] = '';
			}
			
			$output .= optionsframework_medialibrary_uploader( $value['id'], $background['image'], null, '',0,'image', '', true);
			$class = 'of-background-properties';
			if ( '' == $background['image'] ) {
				$class .= ' hide';
			}
			$output .= '<div class="' . esc_attr( $class ) . '">';
			
			// Background Repeat
			$output .= '<select class="of-background of-background-repeat" name="' . esc_attr( $option_name . '[' . $value['id'] . '][repeat]'  ) . '" id="' . esc_attr( $value['id'] . '_repeat' ) . '">';
			$repeats = of_recognized_background_repeat();
			
			foreach ($repeats as $key => $repeat) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['repeat'], $key, false ) . '>'. esc_html( $repeat ) . '</option>';
			}
			$output .= '</select>';
			
			// Background Position
			$output .= '<select class="of-background of-background-position" name="' . esc_attr( $option_name . '[' . $value['id'] . '][position]' ) . '" id="' . esc_attr( $value['id'] . '_position' ) . '">';
			$positions = of_recognized_background_position();
			
			foreach ($positions as $key=>$position) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['position'], $key, false ) . '>'. esc_html( $position ) . '</option>';
			}
			$output .= '</select>';
			
			// Background Attachment
			$output .= '<select class="of-background of-background-attachment" name="' . esc_attr( $option_name . '[' . $value['id'] . '][attachment]' ) . '" id="' . esc_attr( $value['id'] . '_attachment' ) . '">';
			$attachments = of_recognized_background_attachment();
			
			foreach ($attachments as $key => $attachment) {
				$output .= '<option value="' . esc_attr( $key ) . '" ' . selected( $background['attachment'], $key, false ) . '>' . esc_html( $attachment ) . '</option>';
			}
			$output .= '</select>';
			$output .= '</div>';
		
		break;  
		
		// Info
		case "info":
			$class = 'section';
			if ( isset( $value['type'] ) ) {
				$class .= ' section-' . $value['type'];
			}
			if ( isset( $value['class'] ) ) {
				$class .= ' ' . $value['class'];
			}

			$output .= '<div class="' . esc_attr( $class ) . '">' . "\n";
			if ( isset($value['name']) ) {
				$output .= '<h3 class="heading">' . esc_html( $value['name'] ) . '</h3>' . "\n";
			}
			if ( $value['desc'] ) {
				$output .= '<p>'. wp_kses( $value['desc'], $allowedtags) . '</p>' . "\n";
			}
			$output .= '<div class="clear"></div></div>' . "\n";
		break;
		
		case "group":
			if( isset( $value['class'] ) ){
				$value_class = esc_attr( $value['class'] );
			}else{
				$value_class = '';
			}
			if( of_get_option('skin_generator', 'no entry') == "skins" )
				$output .= '<div class="group-options section ' . $value_class . '">';
			else
				$output .= '<div class="group-options section">';
			$output .= '<h3 class="heading">' . esc_attr( $value['name'] ) . '</h3>';
		break;
		
		case "feed":
			$output .= $of_docu_feed_content;
		break;
		
		case "group-close":
			$output .= '</div>';
		break;	
	
		case "toggle":
			if( isset( $value['class'] ) )
				$value_class = esc_attr( $value['class'] );
			else
				$value_class = '';
			$output .= '<div class="custom-toggle ' . $value_class . '"><h4>' . esc_html( $value['name'] ) . ' </h4><span class="item-buttons"><a class="item-display" href="#"></a></span></div><div class="inner-toggle">';
		break;
		
		case "toggle-close":
			$output .= '</div>';
		break;
		
		// Sidebar Generator
		case "sidebars":
			
			if( $value['class'] == "generator" ){
				$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="sidebar" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="text" value="" />';
				$output .= '<input id="' . esc_attr( $value['id'] ) . '_button" class="sidebar_button button" type="button" value="Add New Sidebar" />';
			}
			if ( !empty($val) ){
				$output .= '<ul id="sidebars-list">';
				foreach( $val as $sidebar ){
					$sidebar_trimed = preg_replace('/\W/', '', strtolower($sidebar) );
					$output .= '<li><input id="sidebar-item_' . $sidebar_trimed . '" class="sidebar-item" type="text" value="' . $sidebar . '" name=" '. $option_name .'[sidebars][' . $sidebar . ']" /><span class="item-buttons"><a class="item-delete" href="#"></a></span></li>';
				}
				$output .= '</ul>';
			}
		break;
		
		case "sliders":
			
			$slider_types = array();
			$slide_options = '';
			$slider_options = '';
			$current_value = $value;
			
			$value['id'] = preg_replace('/\W/', '', strtolower($value['id']) );
			
			$output .= '<div id="' . esc_attr( $value['id'] ) .'" class="section section-sliders">'."\n";
			$output .= '<h3 class="heading">' . esc_html( $value['name'] ) . '</h3>' . "\n";
			$output .= '<div class="option">' . "\n" . '<div class="controls full-controls">' . "\n";
			$output .= '<input id="' . esc_attr( $value['id'] ) . '_button" class="sidebar_button button" type="button" value="Create a Slider" /><div class="clear"></div> ';
			$output .= '</div><div class="explain full-explain">' . wp_kses( $value['desc'], $allowedtags) . '</div>'."\n";
			$output .= '<div class="clear"></div></div>'."\n";
			
			// if exist db option sliders
			if ( isset( $settings[$value['id']] ) && !empty( $settings[$value['id']] ) ) {
				
				//Get slider types
				foreach( $value['options'] as $slider){
					$slider['id'] = preg_replace('/\W/', '', strtolower($slider['id']) );
					$slider_types[$slider['id']] = $slider['name'] ;
				}
				
				$output .= '<ul id="slider-list">'."\n";
				// Current sliders
				foreach( $settings[$value['id']] as $slider_name => $slider ){
					
					$output .= '<li class="slider">'."\n";
					$output .= slider_template_base($slider_types, $slider['type'], $slider_name, $option_name);
					$output .= '<div class="' . $slider['type'] . '_slider_settings slider_settings"><div class="custom-toggle"><h4>' . ucfirst( $slider['type'] ) . ' Slider Settings</h4><span class="item-buttons"><a class="item-display" href="#"></a></span></div><div class="inner-toggle">';
					

					foreach($value['options'] as $slider_opts){
							
						if( $slider_opts['id'] == $slider['type'] ){
							
							foreach( $slider_opts['settings'] as $slider_option ){
								
								if ( isset($settings[ $value['id'] ][ $slider_name ]['settings'][ $slider_option['id'] ] ) ) {
									$val = $settings[ $value['id'] ][ $slider_name ]['settings'][ $slider_option['id'] ];
									if (!is_array($val)) {
										$val = stripslashes($val);
									}
								}
				
								$output .= slider_custom_fields($slider_option, $val);
								
							}
							
						}
						
					}
						
					$output .= '</div><div class="clear"></div><input class="button add_slide" type="button" value="Add a Slide" /><div class="clear"></div></div>';
					
					if( isset( $slider['slides'] ) ){
					
						$output .= '<ul class="slide-list">';
						
						foreach( $slider['slides'] as $index => $slide ){
							
							$slide_name = 'Slide';
							if ( $slide[ $slider['type'] . '_title'] != '' )
								$slide_name = $slide[ $slider['type'] . '_title'];
							$output .= '<li class="slide-' . $index . '">';
							$output .= '<div class="' . $slider['type'] . '_slide_settings slide_settings"><div class="custom-toggle"><h4>' . $slide_name . '</h4><span class="item-buttons"><a class="item-display" href="#"></a><a class="item-delete" href="#"></a></span></div><div class="inner-toggle">';
							
							foreach($value['options'] as $slider_opts){
										
								if( $slider_opts['id'] == $slider['type'] ){
										
									foreach( $slider_opts['slide_settings'] as $slider_option ){
										
										if ( isset($settings[ $value['id'] ][ $slider_name ]['slides'][ $index ][ $slider_option['id'] ] ) ) {
											$val = $settings[ $value['id'] ][ $slider_name ]['slides'][ $index ][ $slider_option['id'] ];
											if (!is_array($val)) {
												$val = stripslashes($val);
											}
										}
							
										$output .= slider_custom_fields($slider_option, $val, $slider_name, $index);
											
									}
										
								}
									
							}
							
							$output .= '</div></div>'; //slide_settings & inner_toggle
							$output .= '</li>'; //slide
						}
					
						$output .= '</ul>'; //slide_list
						
					}		 
					
					$output .= '</div></div>';//slider wrap & inner_toggle
					$output .= '</li>'; //slider
				
				}
				
				$output .= '</ul>'; //slider_list
				
			}
			
			$output .= '</div>'; //slider_generator
			
			// Slider template
			foreach( $value['options'] as $slider){
			
				$slider_template =  array( "settings" => "", "slide_settings" => "" );
				$slider_generator =  array( "settings" => array(), "slide_settings" => array() );
				
				$slider['id'] = preg_replace('/\W/', '', strtolower($slider['id']) );
				$slider_types[$slider['id']] = $slider['name'] ;
				
				$slider_template['settings'] = '<div class="' . $slider['id'] . '_slider_settings slider_settings"><div class="custom-toggle"><h4>' . $slider['name'] . ' Settings</h4><span class="item-buttons"><a class="item-display" href="#"></a></span></div><div class="inner-toggle">';
				$slider_template['slide_settings'] = '<div class="' . $slider['id'] . '_slide_settings slide_settings"><div class="custom-toggle"><h4>' . $slider['name'] . ' Slide</h4><span class="item-buttons"><a class="item-display" href="#"></a><a class="item-delete" href="#"></a></span></div><div class="inner-toggle">';
				
				foreach( $slider['settings'] as $slider_settings ){
					array_push( $slider_generator['settings'], $slider_settings );
				}
				foreach( $slider['slide_settings'] as $slide_settings ){
					array_push( $slider_generator['slide_settings'], $slide_settings );
				}
				
				foreach( $slider_generator as $k => $v ){
					
					$slider_output = '';
					
					foreach( $v as $value ){
						$slider_output .= slider_custom_fields($value, '', '', '', false);
					}
					
					if( $k == "settings" ){
						$slider_template['settings'] .= $slider_output;
					}
					else{
						$slider_template['slide_settings'] .= $slider_output;	
					}
					
				}
				$slider_options .= $slider_template['settings'] .= '</div><div class="clear"></div><input class="button add_slide" type="button" value="Add a Slide" /><div class="clear"></div></div>';
				$slide_options .= $slider_template['slide_settings'] .= '</div></div>';
			}
			$output .= '<div id="slider-template" class="hide">
							<div id="add-slider">' . slider_template_base($slider_types) . '</div></div></div>
							<div id="slider-settings">
								' . $slider_options . '
							</div>
							<div id="slide-settings">
								' . $slide_options . '
							</div>
						</div>';
						
			$value = $current_value;			
		
		break;                    
		
		// Heading for Navigation
		case "heading":
			if($counter >= 2){
			   $output .= '</div>'."\n";
			}
			$jquery_click_hook = "of-option-" . $counter;
			$menu .= '<li><a title="' . esc_attr( $value['name'] ) . '" href="' . esc_attr( '#'.  $jquery_click_hook ) . '">' . esc_html( $value['name'] ) . '</a></li>';
			$output .= '<div class="group" id="' . esc_attr( $jquery_click_hook ) . '"><h2>' . esc_html( $value['name'] ) . '</h2>' . "\n";
			break;
		}

		if( !in_array($value['type'], $lazy_fields) ){
			if ( $value['type'] != "checkbox" ) {
				$output .= '<br/>';
			}
			$explain_value = '';
			if ( isset( $value['desc'] ) ) {
				$explain_value = $value['desc'];
			}
			$output .= '</div><div class="explain">' . wp_kses( $explain_value, $allowedtags) . '</div>'."\n";
			$output .= '<div class="clear"></div></div></div>'."\n";
		}
	}
    $output .= '</div>';
    return array($output,$menu);
}

/* 
// Slider Template base
*/

function slider_template_base($slider_types, $slider_type = '', $slider_name = '', $option_name = ''){
	
	if( $slider_name == '' ){
		$slider_name = 'New Slider';
		$slider_valuename = '';
		$input_name = '';
	}else{
		$slider_valuename = $slider_name;
		$input_name = $option_name . '[sliders][' . $slider_name . '][type]';
	}
	
	$base = '<div class="slider-wrap">
				<div class="slider-name custom-toggle"><h4>' . esc_attr( $slider_name ) . '</h4><span class="item-buttons"><a class="item-display" href="#"></a><a class="item-delete" href="#"></a></span></div>
				<div class="inner-toggle">
					<div class="section">
						<h4 class="heading">Name</h4>
						<div class="option">
							<div class="controls">
								<input class="slider_name" type="text" name="" value="' . esc_attr( $slider_valuename ) . '" />
							</div>
							<div class="explain">' . __("Add slider name", "theme_textdomain") . '</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="section">
						<h4 class="heading">Type</h4>
						<div class="option">
							<div class="controls">
								<select class="of-input slider_type" name="' . esc_attr( $input_name ) . '">';
											
	foreach( $slider_types as $id => $name ){
		if( $id == $slider_type )
			$base .= '<option value="' . $id . '" selected="selected">' . $name . '</option>';
		else
			$base .= '<option value="' . $id . '">' . $name . '</option>';
	}
										
	$base .= '					</select>
							</div>
						</div>
						<div class="explain">' . __("Select the slider type you want", "theme_textdomain") . '</div>
						<div class="clear"></div>
					</div>';
	return $base;

}


/*
// Slider custom fileds
*/

function slider_custom_fields($value, $val = '', $slider_name = '', $index = '', $theme_name = true){
	
	global $allowedtags;
	if( $theme_name ){ 
		$option_name = 'yourself';
	}else{
		$option_name = '';
	}
	if( isset( $value['class'] ) ){
		$value_class = $value['class'];
	}else{
		$value_class = '';
	}
	$parcial_output = '';					
	$parcial_output .= '<div class="section ' . $value_class . '">'."\n";
	$parcial_output .= '<h4 class="heading">' . esc_html( $value['name'] ) . '</h4>' . "\n";
	$parcial_output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
						
	if ( isset( $value['std'] ) && $val == '' ) {
		$val = $value['std'];
	}
	
	switch ( $value['type'] ) {			
		//text or number
		case 'text':
			$parcial_output .= '<input class="of-input ' . esc_attr( $value['id'] ) . '" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="text" value="' . esc_attr( $val ) . '" />';
		break;
		
		// Basic number input
		case 'number':
			$parcial_output .= '<input class="of-input ' . esc_attr( $value['id'] ) . ' number-field" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '" type="text" value="' . esc_attr( $val ) . '" />';
		break;
		
		// Image Selectors
		case "images":
			$name = esc_attr( $option_name .'['. $value['id'] .']' );
			foreach ( $value['options'] as $key => $option ) {
				$selected = '';
				$checked = '';
				$class = '';
				if ( $val != '' ) {
					if ( $val == $key ) {
						$selected = ' of-radio-img-selected';
						$checked = ' checked="checked"';
						$class = ' layout-checked';
					}
				}
				$parcial_output .= '<input type="radio" class="of-radio-img-radio ' . esc_attr( $value['id'] ) . $class . '" value="' . esc_attr( $key ) . '" name="' . esc_attr( $name ) . '" '. $checked .' />';
				$parcial_output .= '<div class="of-radio-img-label">' . esc_html( $key ) . '</div>';
				$parcial_output .= '<img src="' . esc_url( $option ) . '" alt="' . $option .'" class="of-radio-img-img' . $selected .'" />';
			}
		break;
							
		// Uploader
		case "upload":
			if( $slider_name != '' ){
				$input_name = $value['id'];
				//echo $input_name . "\n";
				$value['id'] = preg_replace('/\W/', '', strtolower( $slider_name ) ) . '_' . $index . '_' . esc_attr( $value['id'] );
				$parcial_output .= $test = optionsframework_medialibrary_uploader( $value['id'], $val, null, '',0,'', $input_name ); // New AJAX Uploader using Media Library
				//echo $value['id'];
			}else{
				$parcial_output .= $test = optionsframework_medialibrary_uploader( $value['id'], $val); // New AJAX Uploader using Media Library
			}
		break;
							
		// Select Box
		case ($value['type'] == 'select'):
			$parcial_output .= '<select class="of-input ' . esc_attr( $value['id'] ) . '" name="' . esc_attr( $option_name . '[' . $value['id'] . ']' ) . '">';
								
			foreach ($value['options'] as $key => $option ) {
				$selected = '';
				if( $val != '' ) {
					if ( $val == $key) { $selected = ' selected="selected"'; } 
				}
				$parcial_output .= '<option'. $selected .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
			} 
			$parcial_output .= '</select>';
		break;	
	}
	
	$parcial_output .= '<br/>';
	$parcial_output .= '</div><div class="explain">' . wp_kses( $value['desc'], $allowedtags) . '</div>'."\n";
	$parcial_output .= '<div class="clear"></div></div></div>'."\n";
	
	return $parcial_output;	

} ?>