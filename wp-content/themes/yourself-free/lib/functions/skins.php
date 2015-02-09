<?php

/*******************************************************************/
//						CSS FONTS
/*******************************************************************/

function pi_get_font_faces(){

	$fonts = array();
	
	//websafe fonts
	
	$fonts['Arial'] = array( 				'type' => 'websafe',
							 				'family' => 'Arial, Helvetica, sans-serif' );
						
	$fonts['Courier New'] = array( 			'type' => 'websafe',
											'family' => '"Courier New", Courier, monospace' );
	
	$fonts['Futura'] = array( 				'type' => 'websafe',
											'family' => 'Futura, Verdana, Sans-Serif' );
						
	$fonts['Georgia'] = array( 				'type' => 'websafe',
											'family' => 'Georgia, serif' );
							
	$fonts['Impact'] = array( 				'type' => 'websafe',
											'family' => 'Impact, Charcoal, sans-serif' );
							
	$fonts['Lucida'] = array( 				'type' => 'websafe',
											'family' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif' );					
	
	$fonts['Palatino'] = array( 			'type' => 'websafe',
											'family' => '"Palatino Linotype", "Book Antiqua", Palatino, serif' );					
	
	$fonts['Tahoma'] = array( 				'type' => 'websafe',
											'family' => 'Tahoma, Geneva, sans-serif' );
	
	$fonts['Times New Roman'] = array( 		'type' => 'websafe',
											'family' => '"Times New Roman", Times, serif' );
						
	$fonts['Trebuchet MS'] = array( 		'type' => 'websafe',
											'family' => '"Trebuchet MS", Helvetica, sans-serif' );	
						
	$fonts['Verdana'] = array( 				'type' => 'websafe',
											'family' => 'Verdana, Geneva, sans-serif' );
						
	//google fonts
	
	$fonts['Abel'] = array( 				'type' => 'google',
											'family' => '"Abel", sans-serif;',
											'request' => 'Abel');
						
	$fonts['Amaranth'] = array( 			'type' => 'google',
											'family' => '"Amaranth", sans-serif',
											'request' => 'Amaranth:400,400italic,700,700italic');
						
	$fonts['Anton'] = array( 				'type' => 'google',
											'family' => '"Anton", sans-serif',
											'request' => 'Anton');
	
	$fonts['Arimo'] = array( 				'type' => 'google',
											'family' => '"Arimo", sans-serif',
											'request' => 'Arimo:400,700,400italic,700italic');
						
	$fonts['Arvo'] = array( 				'type' => 'google',
											'family' => '"Arvo", serif',
											'request' => 'Arvo:400,700,400italic,700italic');
	
	$fonts['Bitter'] = array( 				'type' => 'google',
											'family' => '"Bitter", serif',
											'request' => 'Bitter:400,700,400italic');
							
	$fonts['Cabin'] = array( 				'type' => 'google',
											'family' => '"Cabin", sans-serif',
											'request' => 'Cabin:400,700,400italic,700italic');
	
	$fonts['Crete Round'] = array( 			'type' => 'google',
											'family' => '"Crete Round", serif',
											'request' => 'Crete+Round:400,400italic');
						
	$fonts['Droid Sans'] = array( 			'type' => 'google',
											'family' => '"Droid Sans", sans-serif',
											'request' => 'Droid+Sans:400,700');					
						
	$fonts['Droid Serif'] = array(			'type' => 'google',
											'family' => '"Droid Serif", serif',
											'request' => 'Droid+Serif:400,700,400italic,700italic');					
						
	$fonts['Gruppo'] = array( 				'type' => 'google',
											'family' => '"Gruppo", sans-serif',
											'request' => 'Gruppo');					
						
	$fonts['Fjord One'] = array( 			'type' => 'google',
											'family' => '"Fjord One", serif',
											'request' => 'Fjord+One');					
						
	$fonts['Josefin Sans'] = array( 		'type' => 'google',
											'family' => '"Josefin Sans", sans-serif',
											'request' => 'Josefin+Sans:400,700,400italic,700italic');					
	
	$fonts['Lato'] = array( 				'type' => 'google',
											'family' => '"Lato", sans-serif',
											'request' => 'Lato:400,700,400italic,700italic');					
						
	$fonts['Lobster Two'] = array( 			'type' => 'google',
											'family' => '"Lobster Two", cursive',
											'request' => 'Lobster+Two:400,700,400italic,700italic');
							
	$fonts['Marvel'] = array( 				'type' => 'google',
											'family' => '"Marvel", sans-serif',
											'request' => 'Marvel:400,700,400italic,700italic');
						
	$fonts['Michroma'] = array( 			'type' => 'google',
											'family' => '"Michroma", sans-serif',
											'request' => 'Michroma');
						
	$fonts['Nobile'] = array( 				'type' => 'google',
											'family' => '"Nobile", sans-serif',
											'request' => 'Nobile:400,400italic,700,700italic');
						
	$fonts['Noticia Text'] = array( 		'type' => 'google',
											'family' => '"Noticia Text", serif',
											'request' => 'Noticia+Text:400,700italic,400italic,700');
						
	$fonts['Open Sans'] = array( 			'type' => 'google',
											'family' => '"Open Sans", sans-serif',
											'request' => 'Open+Sans:400italic,700italic,400,700');
						
	$fonts['Open Sans Condensed'] = array(	'type' => 'google',
											'family' => '"Open Sans Condensed", sans-serif',
											'request' => 'Open+Sans+Condensed:300,300italic');
	
	$fonts['Oswald'] = array( 				'type' => 'google',
											'family' => '"Oswald", sans-serif',
											'request' => 'Oswald');
						
	$fonts['Pacifico'] = array( 			'type' => 'google',
											'family' => '"Pacifico", cursive',
											'request' => 'Pacifico');
						
	$fonts['Play'] = array( 				'type' => 'google',
											'family' => '"Play", sans-serif',
											'request' => 'Play:400,700');
						
	$fonts['PT Sans'] = array( 				'type' => 'google',
											'family' => '"PT Sans", sans-serif',
											'request' => 'PT+Sans:400,700,400italic,700italic');
						
	$fonts['PT Serif'] = array( 			'type' => 'google',
											'family' => '"PT Serif", serif',
											'request' => 'PT+Serif:400,700,400italic,700italic');
						
	$fonts['Salsa'] = array( 				'type' => 'google',
											'family' => '"Salsa", cursive',
											'request' => 'Salsa');
						
	$fonts['Sancreek'] = array( 			'type' => 'google',
											'family' => '"Sancreek", cursive',
											'request' => 'Sancreek');
						
	$fonts['Sansita One'] = array( 			'type' => 'google',
											'family' => '"Sansita One", cursive',
											'request' => 'Sansita+One');
						
	$fonts['Shanti'] = array( 				'type' => 'google',
											'family' => '"Shanti", sans-serif',
											'request' => 'Shanti');
						
	$fonts['Sofia'] = array( 				'type' => 'google',
											'family' => '"Sofia", cursive',
											'request' => 'Sofia');
						
	$fonts['Terminal Dosis'] = array( 		'type' => 'google',
											'family' => '"Terminal Dosis", sans-serif',
											'request' => 'Terminal+Dosis:400,700');
						
	$fonts['Ubuntu'] = array( 				'type' => 'google',
											'family' => '"Ubuntu", sans-serif',
											'request' => 'Ubuntu:400,700,400italic,700italic');
						
	$fonts['UnifrakturMaguntia'] = array( 	'type' => 'google',
											'family' => '"UnifrakturMaguntia", cursive',
											'request' => 'UnifrakturMaguntia');
						
	$fonts['Yanone Kaffeesatz'] = array( 	'type' => 'google',
											'family' => '"Yanone Kaffeesatz", sans-serif;',
											'request' => 'Yanone+Kaffeesatz:400,700');
						
	return $fonts;
				
}

/* font style */
function pi_skin_font_style($style){
	if( $style == 'bold italic' || $style == 'italic' )
		return 'italic';
	else
		return 'normal';
}

/* font weight */
function pi_skin_font_weight($style){
	if( $style == 'bold italic' || $style == 'bold' )
		return 'bold';
	else
		return 'normal';
}

/* google fonts */
function pi_skin_google_fonts(){
	$query = array();
	$google_query = 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700|Droid+Sans:400,700|Ubuntu:400,700,400italic,700italic|Bitter:400,700,400italic|Oswald';
	echo "<!-- Google Fonts -->\n";
	echo "<link href='" . $google_query . "' rel='stylesheet' type='text/css' />\n";
}
add_action('wp_head', 'pi_skin_google_fonts');

/*******************************************************************/
//						CSS BACKGROUND
/*******************************************************************/

function pi_skin_background($bg){
	if( $bg['image'] == '' )
		return $bg['color'];
	elseif( 1 === preg_match('/^\d+\.png$/', $bg['image'] ) )
		$path = get_template_directory_uri() . '/admin/images/patterns/';
	else 
		$path = '';
	return $bg['color'] . ' ' . 'url(' . $path . $bg['image'] . ') ' . $bg['repeat'] . ' ' . $bg['attachment'] . ' ' . $bg['position'];
}

/*******************************************************************/
//						CSS BORDER
/*******************************************************************/

function pi_skin_border($border){
	if( $border['border-style'] != 'none' ){
		return $border['size'] . 'px ' . $border['border-style'] . ' ' . $border['color'];
	}else{
		return 'none';
	}
}

/*******************************************************************/
//						CSS SHADOW
/*******************************************************************/

function pi_skin_shadow($shadow, $type = 'typo'){
	if( $shadow['display'] == 'enable' ){
		if( $type == 'typo' ){
			return 'text-shadow: ' . $shadow['h-size'] . 'px ' . $shadow['v-size'] . 'px 2px '. $shadow['color'] . ';'."\n";
		}elseif( $type == 'box' ){
			return "\t".'-webkit-box-shadow: ' . $shadow['h-size'] . 'px ' . $shadow['v-size'] . 'px  2px ' . $shadow['color'] . ';
			-moz-box-shadow: ' . $shadow['h-size'] . 'px ' . $shadow['v-size'] . 'px  2px ' . $shadow['color'] . ';
			box-shadow: ' . $shadow['h-size'] . 'px ' . $shadow['v-size'] . 'px  2px ' . $shadow['color'] . ';'."\n";
		}	
	}else{
		if( $type == 'typo' ){
			return 'text-shadow: none;';
		}elseif( $type == 'box' ){
			return "\t".'-webkit-box-shadow: none;' . "\n" . '-moz-box-shadow: none;'  . "\n" . 'box-shadow: none;';
		}
	}
}
?>