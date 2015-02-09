<?php 
/*******************************************************************/
//					SLIDERS LAYOUT
/*******************************************************************/

function pi_get_slider($slider_name){
	global $shortcode_sliders;
	$return = '';
	$slides = '';
	$thumbs = '';
	$slider_width = 1280;
	$sliders = of_get_option('slider_generator');
	$slider = $sliders[$slider_name];
	$slider_id = preg_replace('/\W/', '_', strtolower( $slider_name ) );
	if( isset( $slider['slides'] ) && !empty( $slider['slides'] ) ){
		switch($slider['type']){
			/* Flex Sldier */
			case 'flex' :
				$shortcode_sliders['flex'] = true;
				foreach($slider['slides'] as $slide):
					if( $slide['flex_file-url'] != '' ):
						$image = vt_resize( '', $slide['flex_file-url'], $slider_width, $slider['settings']['flex_height'], true ); 
						if( $slide['flex_link'] ):
							$slides .= '<li><a href="' . $slide['flex_link'] . '" title="' . $slide['flex_title'] . '"><img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' .$image['height'] . '" title="' . $slide['flex_title'] . '" alt="slider image" /></a><h2 class="flex-caption"><a href="' . $slide['flex_link'] . '" title="' . $slide['flex_title'] . '">' . $slide['flex_title'] . '</a></h2></li>';
						else:
							$slides .= '<li><img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" title="' . $slide['flex_title'] . '" alt="slider image" /><h2 class="flex-caption">' . $slide['flex_title'] . '</h2></li>';
						endif;
					endif;
				endforeach;
				foreach($slider['slides'] as $slide):
					if( $slide['flex_file-url'] != '' ):
						$image = vt_resize( '', $slide['flex_file-url'], $slider_width, $slider['settings']['flex_height'], true ); 
						if( $slide['flex_link'] ):
							$thumbs .= '<li><a href="' . $slide['flex_link'] . '" title="' . $slide['flex_title'] . '"><img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' .$image['height'] . '" title="' . $slide['flex_title'] . '" alt="slider image" /></a></li>';
						else:
							$thumbs .= '<li><img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" title="' . $slide['flex_title'] . '" alt="slider image" /></li>';
						endif;
					endif;
				endforeach;
				$return .= '<div id="' . $slider_id . '" class="flexslider home-flex"><ul class="slides">'. $slides .'</ul></div><div id="carousel" class="flexslider"><ul class="slides">'. $thumbs .'</ul></div>';
			break;
			
			/* Nivo Sldier */
			case 'nivo' :
				$shortcode_sliders['nivo'] = true;
					$return .= '<div class="nivo-wrap">'; 
					$return .= '<div id="' . $slider_id . '" class="nivoSlider">';
						foreach($slider['slides'] as $slide):
							if( $slide['nivo_file-url'] != '' ):
								$image = vt_resize( '', $slide['nivo_file-url'], $slider_width, $slider['settings']['nivo_height'], true ); 
								if( $slide['nivo_link'] ):
									$return .= '<a href="' . $slide['nivo_link'] . '" title="' . $slide['nivo_title'] . '"><img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' .$image['height'] . '" title="' . $slide['nivo_title'] . '" alt="slider image" /></a>';
								else:
									$return .= '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" title="' . $slide['nivo_title'] . '" alt="slider image" />';
								endif;
							endif;
						endforeach;
					$return .= '</div>';
				$return .= '</div>';
			break;	
						
		}
		return $return;
	}
	return '<p>Slider empty. Go to: Theme Options - Slider, and add slides to this slider.</p>';
}

/*******************************************************************/
//					HOME SLIDER SCRIPT
/*******************************************************************/

/* Homepage Sliders */
function pi_load_home_slider(){
	if( of_get_option('enable_featured_homepage') && of_get_option('hompepage_featured_type') == "slider" && is_page_template('template-home.php') ){
		$slider_name = of_get_option('homepage_slider');
		$sliders = of_get_option('slider_generator');
		$slider = $sliders[$slider_name];
		switch($slider['type']){
			case 'flex':
				wp_enqueue_script('flex-slider');
			break;
			case 'nivo':
				wp_enqueue_script('nivo-slider');
			break;
		}
	}
}
add_action('wp_print_scripts', 'pi_load_home_slider');


/*******************************************************************/
//					SLIDERS LOADER
/*******************************************************************/

/* Homepage Sliders */
function pi_sliders_script($slider_name){
	$sliders = of_get_option('slider_generator');
	$slider = $sliders[$slider_name];
	$slider_id = preg_replace('/\W/', '_', strtolower( $slider_name ) );
	switch($slider['type']){
		/* Flex Sldier */
		case 'flex': ?>
			<script type="text/javascript">
				jQuery(window).load(function(){
				  jQuery('#carousel').flexslider({
				    animation: "slide",
				    controlNav: false,
				    animationLoop: false,
				    slideshow: false,
				    itemWidth: 210,
				    itemMargin: 5,
				    asNavFor: '#<?php echo $slider_id; ?>'
				  });
				  
				  jQuery('#<?php echo $slider_id; ?>').flexslider({
				    animation: '<?php echo $slider["settings"]["flex_transition_effect"]; ?>',
				    controlNav: false,
				    animationLoop: false,
				    slideshow: false,
				    sync: '#carousel'
				  });
				});
			</script>
		<?php break;
		/* Cycle */
		case 'nivo': ?>
			<script type="text/javascript">
				jQuery(window).load(function(){
				    jQuery('#<?php echo $slider_id; ?>').nivoSlider({
				    	effect:'<?php echo $slider["settings"]["nivo_transition_effect"]; ?>', // Specify sets like: 'fold,fade,sliceDown...'
				    	<?php if( $slider["settings"]["nivo_pause_time"] != 0 ) echo "pauseTime:" . $slider["settings"]["nivo_pause_time"];
				    	else echo "manualAdvance:true"; ?>
				    });
				});
			</script>
		<?php break;
	}
		
} //end pi_slider_script

/*******************************************************************/
//					SLIDER HOOKS
/*******************************************************************/

global $shortcode_sliders;
$shortcode_sliders = array('flex' => false, 'nivo' => false );

function pi_slider_script_if_active(){
	global $shortcode_sliders;
	if( $shortcode_sliders['flex'] ){
		wp_print_scripts('flex-slider');
	}
	if( $shortcode_sliders['nivo'] ){
		wp_print_scripts('nivo-slider');
	}	
}
add_action('wp_footer', 'pi_slider_script_if_active');

function pi_load_home_slider_script(){
	if( of_get_option('enable_featured_homepage') && of_get_option('hompepage_featured_type') == "slider" && is_page_template('template-home.php')  ){
		pi_sliders_script( of_get_option('homepage_slider') );
	}
}
add_action('wp_footer', 'pi_load_home_slider_script');
add_action('pi_shortcode_slider', 'pi_sliders_script');

?>