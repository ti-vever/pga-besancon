<?php

/*******************************************************************/
//						SHORTCODES
/*******************************************************************/

/* columns */
function pi_column_one_half($atts, $content=null){
	return '<div class="column one_half">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half', 'pi_column_one_half');

function pi_column_one_half_last($atts, $content=null){
	return '<div class="column one_half last">'.do_shortcode($content).'</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'pi_column_one_half_last');


function pi_column_one_third($atts, $content=null){
	return '<div class="column one_third">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third', 'pi_column_one_third');

function pi_column_one_third_last($atts, $content=null){
	return '<div class="column one_third last">'.do_shortcode($content).'</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'pi_column_one_third_last');

function pi_column_two_third($atts, $content=null){
	return '<div class="column two_third">'.do_shortcode($content).'</div>';
}
add_shortcode('two_third', 'pi_column_two_third');

function pi_column_two_third_last($atts, $content=null){
	return '<div class="column two_third last">'.do_shortcode($content).'</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'pi_column_two_third_last');


function pi_column_one_fourth($atts, $content=null){
	return '<div class="column one_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth', 'pi_column_one_fourth');

function pi_column_one_fourth_last($atts, $content=null){
	return '<div class="column one_fourth last">'.do_shortcode($content).'</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'pi_column_one_fourth_last');

function pi_column_three_fourth($atts, $content=null){
	return '<div class="column three_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fourth', 'pi_column_three_fourth');

function pi_column_three_fourth_last($atts, $content=null){
	return '<div class="column three_fourth last">'.do_shortcode($content).'</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'pi_column_three_fourth_last');


function pi_column_one_fifth($atts, $content=null){
	return '<div class="column one_fifth">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fifth', 'pi_column_one_fifth');

function pi_column_one_fifth_last($atts, $content=null){
	return '<div class="column one_fifth last">'.do_shortcode($content).'</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'pi_column_one_fifth_last');

function pi_column_two_fifth($atts, $content=null){
	return '<div class="column two_fifth">'.do_shortcode($content).'</div>';
}
add_shortcode('two_fifth', 'pi_column_two_fifth');

function pi_column_two_fifth_last($atts, $content=null){
	return '<div class="column two_fifth last">'.do_shortcode($content).'</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'pi_column_two_fifth_last');

function pi_column_three_fifth($atts, $content=null){
	return '<div class="column three_fifth">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fifth', 'pi_column_three_fifth');

function pi_column_three_fifth_last($atts, $content=null){
	return '<div class="column three_fifth last">'.do_shortcode($content).'</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'pi_column_three_fifth_last');

function pi_column_four_fifth($atts, $content=null){
	return '<div class="column four_fifth">'.do_shortcode($content).'</div>';
}
add_shortcode('four_fifth', 'pi_column_four_fifth');

function pi_column_four_fifth_last($atts, $content=null){
	return '<div class="column four_fifth last">'.do_shortcode($content).'</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'pi_column_four_fifth_last');

/* blockquote */

function pi_typo_blockquote($atts, $content=null){
	return '<blockquote><p>'.do_shortcode($content).'</p></blockquote>';
}
add_shortcode('blockquote', 'pi_typo_blockquote');

function pi_typo_pull_right($atts, $content=null){
	return '<span class="pull right">'.do_shortcode($content).'</span>';
}
add_shortcode('pull_quote_right', 'pi_typo_pull_right');

function pi_typo_pull_left($atts, $content=null){
	return '<span class="pull left">'.do_shortcode($content).'</span>';
}
add_shortcode('pull_quote_left', 'pi_typo_pull_left');

/* note */
function pi_typo_note( $atts, $content = null ) {
	return '<div class="note"><p>'.do_shortcode($content).'</p></div>';
}
add_shortcode('note', 'pi_typo_note');

/* highlight */
function pi_typo_highlight($atts, $content=null){
	return '<span class="highlight">'.do_shortcode($content).'</span>';
}
add_shortcode('highlight', 'pi_typo_highlight');

/* dropcap */
function pi_typo_dropcap($atts, $content=null){
	return '<span class="dropcap">'.do_shortcode($content).'</span>';
}
add_shortcode('dropcap', 'pi_typo_dropcap');

/* color */
function pi_typo_color($atts, $content = null){
	extract( shortcode_atts( array(
	      'hex' => '#ff0000'
	      ), $atts ) );
	return '<span style="color:' . $hex . '">'.do_shortcode($content).'</span>';
}
add_shortcode('color', 'pi_typo_color');

/* heading */
function pi_typo_heading_h1($atts, $content=null){
	return '<h1>'.do_shortcode($content).'</h1>';
}
add_shortcode('h1', 'pi_typo_heading_h1');

function pi_typo_heading_h2($atts, $content=null){
	return '<h2>'.do_shortcode($content).'</h2>';
}
add_shortcode('h2', 'pi_typo_heading_h2');

function pi_typo_heading_h3($atts, $content=null){
	return '<h3>'.do_shortcode($content).'</h3>';
}
add_shortcode('h3', 'pi_typo_heading_h3');

function pi_typo_heading_h4($atts, $content=null){
	return '<h4>'.do_shortcode($content).'</h4>';
}
add_shortcode('h4', 'pi_typo_heading_h4');

function pi_typo_heading_h5($atts, $content=null){
	return '<h5>'.do_shortcode($content).'</h5>';
}
add_shortcode('h5', 'pi_typo_heading_h5');

function pi_typo_heading_h6($atts, $content=null){
	return '<h6>'.do_shortcode($content).'</h6>';
}
add_shortcode('h6', 'pi_typo_heading_h6');

/* lists */
function pi_list_item($atts, $content=null){
	extract( shortcode_atts( array(
	      'type' => 'circle',
	      ), $atts ) );
	return '<li class="'.$type.'">'.do_shortcode($content).'</li>';
}
add_shortcode('li', 'pi_list_item');

function pi_typo_list_ordered( $atts, $content = null ) {
	return '<ol>'.do_shortcode($content).'</ol>';	
}
add_shortcode('list_ordered', 'pi_typo_list_ordered');

function pi_typo_list_square( $atts, $content = null ) {
	return '<ul class="list clasic square">'.do_shortcode($content).'</ul>';	
}
add_shortcode('list_square', 'pi_typo_list_square');

function pi_typo_list_circle( $atts, $content = null ) {
	return '<ul class="list clasic circle">'.do_shortcode($content).'</ul>';	
}
add_shortcode('list_circle', 'pi_typo_list_circle');

function pi_typo_list_check( $atts, $content = null ) {
	return '<ul class="list check">'.do_shortcode($content).'</ul>';	
}
add_shortcode('list_check', 'pi_typo_list_check');

function pi_typo_list_delete( $atts, $content = null ) {
	return '<ul class="list delete">'.do_shortcode($content).'</ul>';	
}
add_shortcode('list_delete', 'pi_typo_list_delete');

function pi_typo_list_warning( $atts, $content = null ) {
	return '<ul class="list warning">'.do_shortcode($content).'</ul>';	
}
add_shortcode('list_warning', 'pi_typo_list_warning');

/* buttons */
function pi_button_default($atts, $content = null){
	extract( shortcode_atts( array(
	      'url' => '#',
	      'target' => '_self',
	      'float' => 'left',
	      ), $atts ) );
	if($float != "left" && $float != "right")
		$float = "left";      
	return '<a href="'.$url.'" target="'.$target.'" class="btn grey '.$float.'"><span>'.do_shortcode($content).'</span></a>';
}
add_shortcode('button', 'pi_button_default');

function pi_button_brown($atts, $content = null){
	extract( shortcode_atts( array(
	      'url' => '#',
	      'target' => '_self',
	      'float' => 'left',
	      ), $atts ) );
	if($float != "left" && $float != "right")
		$float = "left";
	return '<a href="'.$url.'" target="'.$target.'" class="btn brown '.$float.'"><span>'.do_shortcode($content).'</span></a>';
}
add_shortcode('button_brown', 'pi_button_brown');

function pi_button_orange($atts, $content = null){
	extract( shortcode_atts( array(
	      'url' => '#',
	      'target' => '_self',
	      'float' => 'left',
	      ), $atts ) );
	if($float != "left" && $float != "right")
		$float = "left";
	return '<a href="'.$url.'" target="'.$target.'" class="btn orange '.$float.'"><span>'.do_shortcode($content).'</span></a>';
}
add_shortcode('button_orange', 'pi_button_orange');

function pi_button_blue($atts, $content = null){
	extract( shortcode_atts( array(
	      'url' => '#',
	      'target' => '_self',
	      'float' => 'left',
	      ), $atts ) );
	if($float != "left" && $float != "right")
		$float = "left";
	return '<a href="'.$url.'" target="'.$target.'" class="btn blue '.$float.'"><span>'.do_shortcode($content).'</span></a>';
}
add_shortcode('button_blue', 'pi_button_blue');

function pi_button_green($atts, $content = null){
	extract( shortcode_atts( array(
	      'url' => '#',
	      'target' => '_self',
	      'float' => 'left',
	      ), $atts ) );
	if($float != "left" && $float != "right")
		$float = "left";
	return '<a href="'.$url.'" target="'.$target.'" class="btn green '.$float.'"><span>'.do_shortcode($content).'</span></a>';
}
add_shortcode('button_green', 'pi_button_green');

function pi_button_dark($atts, $content = null){
	extract( shortcode_atts( array(
	      'url' => '#',
	      'target' => '_self',
	      'float' => 'left',
	      ), $atts ) );
	if($float != "left" && $float != "right")
		$float = "left";
	return '<a href="'.$url.'" target="'.$target.'" class="btn dark '.$float.'"><span>'.do_shortcode($content).'</span></a>';
}
add_shortcode('button_dark', 'pi_button_dark');

function pi_button_yellow($atts, $content = null){
	extract( shortcode_atts( array(
	      'url' => '#',
	      'target' => '_self',
	      'float' => 'left',
	      ), $atts ) );
	if($float != "left" && $float != "right")
		$float = "left";
	return '<a href="'.$url.'" target="'.$target.'" class="btn yellow '.$float.'"><span>'.do_shortcode($content).'</span></a>';
}
add_shortcode('button_yellow', 'pi_button_yellow');

/* Icons */
function pi_icon($atts, $content = null) {
	extract(shortcode_atts(array(
		"color" => 'dark',
		"bgcolor" => '#6e99b9',
		"type" => ''
	), $atts));
	$type =  preg_replace('/\W/', '-', strtolower( $type ) );
	return '<div class="icons"><span class="icon ' . $color . ' '.$type.'" style="background-color: ' . $bgcolor . ';"></span><div class="icon-content">'.do_shortcode($content).'</div></div>';
}
add_shortcode('icon', 'pi_icon');  

/* Image */
function pi_media_image($atts, $content = null){
	extract( shortcode_atts( array(
	      'src' => '',
	      'align' => 'center',
	      'alt' => 'image',
	      'width' => 590,
	      'height' => 350,
	      'caption' => '',
	      ), $atts ) );
	if( $width == "" && $height == "" ){
		$return = '<div class="align' . $align . '"><img src="'.$src.'" class="wp-caption" alt="' . $alt . '">';
		if( $caption != "" )
			$return .= '<p class="wp-caption-text">' . $caption . '</p>';
		return $return .= '</div>';
	}else{
		$image = vt_resize( '', $src , $width, $height, true );
		$return = '<div class="align' . $align . '"><img src="' . $image['url'] . '" class="wp-caption" width="' . $image['width'] . '" height="' .$image['height'] . '" alt="' . $alt . '" />';
		if( $caption != "" )
			$return .= '<p class="wp-caption-text">' . $caption . '</p>';
		return $return .= '</div>';
	}
}
add_shortcode('image', 'pi_media_image');

/* Image Lightbox */
function pi_media_image_lightbox($atts, $content = null){
	extract( shortcode_atts( array(
	      'url' => '',
	      'width' => 590,
	      'height' => 350,
	      'align' => 'center',
	      'caption' => '',
	      ), $atts ) );	      	
	$image = vt_resize( '', $url , $width, $height, true );
	$return = '<div class="align' . $align . '"><a href="' . $url . '" rel="prettyPhoto[gallery]"><img src="' . $image['url'] . '" class="hover-opacity wp-caption" width="' . $image['width'] . '" height="' .$image['height'] . '" alt="photo lightbox" /></a>';
	if( $caption != "" )
		$return .= '<p class="wp-caption-text">' . $caption . '</p>';
	return $return .= '</div>';
}
add_shortcode('image_lightbox', 'pi_media_image_lightbox');

/* Vimeo */
function pi_media_vimeo($atts, $content = null){
	extract( shortcode_atts( array(
	      'id' => '',
	      'caption' => '',
	      ), $atts ) );
	$return = '<div class="media-video"><iframe src="http://player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" frameborder="0"></iframe>';
	if( $caption != '' )
		$return .= '<p class="wp-caption-text">' . $caption . '</p>';
	return $return .= '</div>';
}
add_shortcode('vimeo', 'pi_media_vimeo');

/* YouTube */
function pi_media_youtube($atts, $content = null){
	extract( shortcode_atts( array(
	      'id' => '',
	      'caption' => '',
	      ), $atts ) );
	$return = '<div class="media-video"><iframe src="http://www.youtube.com/embed/'.$id.'" frameborder="0"></iframe>';
	if( $caption != '' )
		$return .= '<p class="wp-caption-text">' . $caption . '</p>';
	return $return .= '</div>';
}
add_shortcode('youtube', 'pi_media_youtube');

/* Divider */
function pi_mix_divider( $atts, $content = null ) {
	return '<div class="custom-divider"></div>';
}
add_shortcode('divider', 'pi_mix_divider');

/* Divider */
function pi_mix_space( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'height' => 20,
	), $atts ) );
	return '<div style="clear:both; height:' . $height . 'px;"></div>';
}
add_shortcode('space', 'pi_mix_space');

/* Alerts */
function pi_mix_alert_red( $atts, $content = null ) {
	return '<div class="alert red"><p>'.do_shortcode($content).'</p></div>';
}
add_shortcode('alert_red', 'pi_mix_alert_red');

function pi_mix_alert_green( $atts, $content = null ) {
	return '<div class="alert green"><p>'.do_shortcode($content).'</p></div>';
}
add_shortcode('alert_green', 'pi_mix_alert_green');

function pi_mix_alert_blue( $atts, $content = null ) {
	return '<div class="alert blue"><p>'.do_shortcode($content).'</p></div>';
}
add_shortcode('alert_blue', 'pi_mix_alert_blue');

function pi_mix_alert_yellow( $atts, $content = null ) {
	return '<div class="alert yellow"><p>'.do_shortcode($content).'</p></div>';
}
add_shortcode('alert_yellow', 'pi_mix_alert_yellow');

?>