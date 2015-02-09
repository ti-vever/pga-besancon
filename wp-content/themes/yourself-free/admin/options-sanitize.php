<?php

function of_sanitize_text($input) {
	global $allowedtags;
	$output = wp_kses( $input, $allowedtags);
	return $output;
}

/* Text */

add_filter( 'of_sanitize_text', 'of_sanitize_text' );

/* Textarea */

add_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );

/* Select */

add_filter( 'of_sanitize_select', 'of_sanitize_enum', 10, 2);

/* Radio */

add_filter( 'of_sanitize_radio', 'of_sanitize_enum', 10, 2);

/* Images */

add_filter( 'of_sanitize_images', 'of_sanitize_enum', 10, 2);

/* Checkbox */

function of_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = "1";
	} else {
		$output = "0";
	}
	return $output;
}
add_filter( 'of_sanitize_checkbox', 'of_sanitize_checkbox' );

/* Multicheck */

function of_sanitize_multicheck( $input, $option ) {
	$output = '';
	if ( is_array( $input ) ) {
		foreach( $option['options'] as $key => $value ) {
			$output[$key] = "0";
		}
		foreach( $input as $key => $value ) {
			if ( array_key_exists( $key, $option['options'] ) && $value ) {
				$output[$key] = "1"; 
			}
		}
	}
	return $output;
}
add_filter( 'of_sanitize_multicheck', 'of_sanitize_multicheck', 10, 2 );

/* Color Picker */

function of_sanitize_color( $input ){
	$output = '';
	$output = apply_filters( 'of_sanitize_hex', $input );
	return $output;
}
add_filter( 'of_sanitize_color', 'of_sanitize_color' );

/* Uploader */

function of_sanitize_upload( $input ) {
	$output = '';
	$filetype = wp_check_filetype($input);
	$video_supported = pi_is_video_supported($input);
	if ( $filetype["ext"] || $video_supported ) {
		$output = $input;
	}
	return $output;
}
add_filter( 'of_sanitize_upload', 'of_sanitize_upload' );

/* Check that the key value sent is valid */

function of_sanitize_enum( $input, $option ) {
	$output = '';
	if ( array_key_exists( $input, $option['options'] ) ) {
		$output = $input;
	}
	return $output;
}

/* return code - header and footer */
function of_sanitize_textarea( $input ){
	return $input;
}

/* Background */

function of_sanitize_background( $input ) {
	$output = wp_parse_args( $input, array(
		'color' => '',
		'image'  => '',
		'repeat'  => 'repeat',
		'position' => 'top center',
		'attachment' => 'scroll'
	) );
	
	$output['color'] = apply_filters( 'of_sanitize_hex', $input['color'] );
	$output['image'] = apply_filters( 'of_sanitize_upload', $input['image'] );
	$output['repeat'] = apply_filters( 'of_background_repeat', $input['repeat'] );
	$output['position'] = apply_filters( 'of_background_position', $input['position'] );
	$output['attachment'] = apply_filters( 'of_background_attachment', $input['attachment'] );

	return $output;
}
add_filter( 'of_sanitize_background', 'of_sanitize_background' );

function of_sanitize_background_repeat( $value ) {
	$recognized = of_recognized_background_repeat();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_background_repeat', current( $recognized ) );
}
add_filter( 'of_background_repeat', 'of_sanitize_background_repeat' );

function of_sanitize_background_position( $value ) {
	$recognized = of_recognized_background_position();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_background_position', current( $recognized ) );
}
add_filter( 'of_background_position', 'of_sanitize_background_position' );

function of_sanitize_background_attachment( $value ) {
	$recognized = of_recognized_background_attachment();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_background_attachment', current( $recognized ) );
}
add_filter( 'of_background_attachment', 'of_sanitize_background_attachment' );

/* Typography */

function of_sanitize_typography( $input ) {
	$output = wp_parse_args( $input, array(
		'size'  => '',
		'face'  => '',
		'style' => '',
		'color' => ''
	) );

	$output['size']  = apply_filters( 'of_font_size', $output['size'] );
	$output['face']  = apply_filters( 'of_font_face', $output['face'] );
	$output['style'] = apply_filters( 'of_font_style', $output['style'] );
	$output['color'] = apply_filters( 'of_sanitize_hex', $output['color'] );
	
	return $output;
}
add_filter( 'of_sanitize_typography', 'of_sanitize_typography' );

/* Link */

function of_sanitize_link( $input ){
	$output = wp_parse_args( $input, array(
		'color'  => '',
		'text-decoration'  => '',
	) );
	
	$output['color'] = apply_filters( 'of_sanitize_hex', $output['color'] );
	$output['text-decoration'] = apply_filters( 'of_text_decoration', $output['text-decoration'] );
	
	return $output;
	
}
add_filter('of_sanitize_link', 'of_sanitize_link');


/* Border */

function of_sanitize_border( $input ){
	$output = wp_parse_args( $input, array(
		'border-style'  => '',
		'size' => '',
		'color'  => '',
	) );
	
	$output['border-style'] = apply_filters( 'of_border_style', $output['border-style'] );
	$output['size']  = apply_filters( 'of_font_size', $output['size'] );
	$output['color'] = apply_filters( 'of_sanitize_hex', $output['color'] );
	
	return $output;
	
}
add_filter('of_sanitize_border', 'of_sanitize_border');

/* Shadow */

function of_sanitize_shadow( $input ){
	$output = wp_parse_args( $input, array(
		'display'=> '',
		'h-size' 	 => '',
		'v-size' 	 => '',
		'color'  => '',
	) );
	
	$output['display'] = apply_filters( 'of_display', $output['display'] );
	$output['h-size']  = apply_filters( 'of_font_size', $output['h-size'] );
	$output['v-size']  = apply_filters( 'of_font_size', $output['v-size'] );
	$output['color'] = apply_filters( 'of_sanitize_hex', $output['color'] );
	
	return $output;
	
}
add_filter('of_sanitize_shadow', 'of_sanitize_shadow');


function of_sanitize_font_style( $value ) {
	$recognized = of_recognized_font_styles();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_font_style', current( $recognized ) );
}
add_filter( 'of_font_style', 'of_sanitize_font_style' );


function of_sanitize_font_face( $value ) {
	$recognized = pi_get_font_faces();
	foreach($recognized as $font => $font_details){
		if ( $font == $value ) {
			return $value;
		}
	}
	return apply_filters( 'of_default_font_face', current( $recognized ) );
}
add_filter( 'of_font_face', 'of_sanitize_font_face' );

function of_sanitize_font_size( $value ) {
	foreach (range(0, 100) as $number) {
	    if ( (int)$value == $number ) {
	    	return (int) $value;
	    }
	}
	return (int) apply_filters( 'of_default_font_size', $recognized );
}
add_filter( 'of_font_size', 'of_sanitize_font_size' );

function of_sanitize_text_decoration( $value ){
	$recognized = of_recognized_text_decorations();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_text_decoration', current( $recognized ) );
}
add_filter('of_text_decoration', 'of_sanitize_text_decoration');


function of_sanitize_border_style( $value ){
	$recognized = of_recognized_borders();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_borders', current( $recognized ) );
}
add_filter('of_border_style', 'of_sanitize_border_style');


function of_sanitize_display( $value ){
	$recognized = of_recognized_display();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'of_default_display', current( $recognized ) );
}
add_filter('of_display', 'of_sanitize_display');

/**
 * Get recognized background repeat settings
 *
 * @return   array
 *
 */
function of_recognized_background_repeat() {
	return array(
		'no-repeat'=> 'No Repeat',
		'repeat-x' => 'Repeat Horizontally',
		'repeat-y' => 'Repeat Vertically',
		'repeat'   => 'Repeat All',
		);
}

/**
 * Get recognized background positions
 *
 * @return   array
 *
 */
function of_recognized_background_position() {
	return array(
		'left top' => 'Left Top',
		'left center' => 'Left Center',
		'left bottom' => 'Left Bottom',
		'right top' => 'Right Top',
		'right center' => 'Right Center',
		'right bottom' => 'Right Bottom',
		'center top' => 'Center Top',
		'center center' => 'Center Center',
		'center bottom' => 'Center Bottom'
		);
}

/**
 * Get recognized background attachment
 *
 * @return   array
 *
 */
function of_recognized_background_attachment() {
	return array(
		'scroll' => 'Scroll Normally',
		'fixed' => 'Fixed in Place'
		);
}

/**
 * Get the display ootion
 *
 * @return   array
 *
 */

function of_recognized_display() {
	return array(
		'enable' => 'Enable',
		'disable' => 'Disable'
		);
}

/**
 * Sanitize a color represented in hexidecimal notation.
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @param    string    The value that this function should return if it cannot be recognized as a color.
 * @return   string
 *
 */
 
function of_sanitize_hex_color( $hex, $default = '' ) {
	if ( of_validate_hex( $hex ) ) {
		return $hex;
	}
	return $default;
}
add_filter('of_sanitize_hex', 'of_sanitize_hex_color');

/**
 * Get recognized font styles.
 *
 * Returns an array of all recognized font styles.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */
function of_recognized_font_styles() {
	return array(
		'normal'      => 'Normal',
		'italic'      => 'Italic',
		'bold'        => 'Bold',
		'bold italic' => 'Bold Italic'
		);
}

/**
 * Get recognized text decorations.
 *
 * Returns an array of all text decorations.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */

function of_recognized_text_decorations(){
	return array(
		'none'	=> 'None',
		'solid'	=> 'Solid',
		'dashed'=> 'Dashed'
		);	
}

/**
 * Get border styles.
 *
 * Returns an array of all border styless.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return   array
 *
 */

function of_recognized_borders(){
	return array(
		'none'	 => 'None',
		'dotted' => 'Dotted',
		'dashed' => 'Dashed',
		'solid'	 => 'Solid',
		'double' => 'Double',
		'groove' => 'Groove',
		'ridge'  => 'Ridge',
		'inset'  => 'Inset',
		'outset' => 'Outset'
		);
}

/**
 * Is a given string a color formatted in hexidecimal notation?
 *
 * @param    string    Color in hexidecimal notation. "#" may or may not be prepended to the string.
 * @return   bool
 *
 */
 
function of_validate_hex( $hex ) {
	$hex = trim( $hex );
	/* Strip recognized prefixes. */
	if ( 0 === strpos( $hex, '#' ) ) {
		$hex = substr( $hex, 1 );
	}
	elseif ( 0 === strpos( $hex, '%23' ) ) {
		$hex = substr( $hex, 3 );
	}
	/* Regex match. */
	if ( 0 === preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
		return false;
	}
	else {
		return true;
	}
}

/* Number */

function of_sanitize_number( $input, $option ){

	if ( 0 === preg_match( '/^[0-9]*$/', $input ) ) {
		$output = $option['std'];
	}else{
		if( ( $input >= $option['min'] ) && ( $input <= $option['max'] ) ){
			$output = $input;
		}else{
			$output = $option['std'];
		}
	}	
	return $output;
	
}

add_filter('of_sanitize_number', 'of_sanitize_number', 10, 2);


/* Slider */

function of_sanitize_sliders( $input, $option ){
	
	$output = array();
		
	foreach( $input as $slider_name => $slider ){
		foreach( $option['options'] as $slider_type ){
			if( $slider['type'] == $slider_type['id'] ){
				$output[ $slider_name ]['type'] = $slider['type'];
				foreach( $slider_type['settings'] as $setting ){
					if( isset( $slider['settings'] ) && is_array( $slider['settings'] ) ){
						if( array_key_exists( $setting['id'], $slider['settings'] ) && has_filter('of_sanitize_' . $setting['type'] ) ){
							$output[ $slider_name ]['settings'][ $setting['id'] ] = apply_filters( 'of_sanitize_' . $setting['type'], $slider['settings'][ $setting['id'] ], $setting );
						}
					}
				}//end for
				if( array_key_exists('slides', $slider ) ){
					if( !empty( $slider['slides'] ) ){
						foreach( $slider['slides'] as $index => $slide ){
							foreach( $slider_type['slide_settings'] as $slide_setting ){
								if( array_key_exists( $slide_setting['id'], $slide ) && has_filter('of_sanitize_' . $slide_setting['type'] ) ){
									$output[ $slider_name ][ 'slides' ][ $index ][ $slide_setting['id'] ] = apply_filters( 'of_sanitize_' . $slide_setting['type'], $slider['slides'][ $index ][ $slide_setting['id'] ], $slide_setting );
								}	
							}//end for
						}//end for
					}//endif
				}//end if
			}//endif
		}//end for
	}//end for
	
	return $output;
}
add_filter('of_sanitize_sliders', 'of_sanitize_sliders', 10, 2); ?>