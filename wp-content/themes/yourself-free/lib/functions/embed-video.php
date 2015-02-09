<?php
/*******************************************************************/
//						EMBED VIDEO
/*******************************************************************/
	
function pi_embed_video($post_id, $url, $width, $height, $type=null, $echo = true){
	$video_url = '';
	$video_code = '';
	
	if($url != ''){
		$video_url = $url;
	}elseif($type != null){
		$video = get_post_meta( $post_id, $type, true );
		if( isset($video['vimeo-youtube']) && $video['vimeo-youtube'] != '' )	
			$video_url = $video['vimeo-youtube'] ;
		elseif( isset($video['embedded-code']) && $video['embedded-code'] != '' )	
			$video_code = $video['embedded-code'];
	}
	if($width == '')
		$width = 400;
	if($height == '')
		$height = 225;
	
	/* priority: 1.url , 2.code */
	if($video_url != ''){
		/* youtube */
		if(preg_match('/youtube/', $video_url)){
			if(preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video_url, $matches)){
				$video_result = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$matches[1].'?wmode=transparent" frameborder="0" allowFullScreen></iframe>';
			}else{
				$video_result = __('Invalid YouTube URL, please check it again.', 'theme_textdomain');
			}
		}
		/* vimeo */
		elseif(preg_match('/vimeo/', $video_url)){
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches)){
				$video_result = '<iframe src="http://player.vimeo.com/video/'.$matches[1].'" width="'.$width.'" height="'.$height.'" frameborder="0"></iframe>';
			}else{
				$video_result = __('Invalid Vimeo URL, please check it again.', 'theme_textdomain');
			}
		}
		else{
			$video_result = __('Invalid YouTube or Vimeo URL, please check it again.', 'theme_textdomain');
		}
		if( $echo ){
			echo $video_result;
		}else{
			return $video_result;
		} 
	/* embedded code */ 
	}elseif( $video_code != '' ){
		if( $echo ){
			echo stripslashes(htmlspecialchars_decode($video_code));
		}else{
			return stripslashes(htmlspecialchars_decode($video_code));
		}
	}
}


/*******************************************************************/
//						VIDEO LIGHTBOX
/*******************************************************************/

function pi_video_lightbox($post_id, $img_width, $img_height, $echo = true){
	$video = get_post_meta( $post_id, 'portfolio_video', true );
	$thumb = get_post_thumbnail_id(); 
	$image = vt_resize( $thumb,'' , $img_width, $img_height, true );
	if($video['vimeo-youtube'] != ''){
		$return = '<a href="'.$video['vimeo-youtube'].'" rel="prettyPhoto[gallery]" title=""><img src="'.$image['url'].'" alt="'.the_title('', '', false).'" /></a>';
		if( $echo )
			echo $return;
		else
			return $return;
	}else{
		$return = '<a href="#inline-'.$post_id.'" rel="prettyPhoto[gallery]"><img src="'.$image['url'].'" alt="'.the_title('', '', false).'" /></a><div id="inline-'.$post_id.'" class="hide">'.$video['embedded-code'].'</div>';
		if( $echo )
			echo $return;
		else
			return $return;
	}
}

/*******************************************************************/
//						GET VIDEO
/*******************************************************************/

function pi_get_video($video){
	if($video != ''){
		/* youtube */
		if(preg_match('/youtube/', $video)){
			if(preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video, $matches)){
				$video_result = '<iframe title="YouTube video player" class="youtube-player" type="text/html" src="http://www.youtube.com/embed/'.$matches[1].'" frameborder="0" allowFullScreen></iframe>';
			}else{
				$video_result = __('Invalid YouTube URL, please check it again.', 'theme_textdomain');
			}
		}
		/* vimeo */
		elseif(preg_match('/vimeo/', $video)){
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video, $matches)){
				$video_result = '<iframe src="http://player.vimeo.com/video/'.$matches[1].'" frameborder="0"></iframe>';
			}else{
				$video_result = __('Invalid Vimeo URL, please check it again.', 'theme_textdomain');
			}
		}
		else{
			$video_result = __('Invalid YouTube or Vimeo URL, please check it again.', 'theme_textdomain');
		} 
	}
	return $video_result;
}

/*******************************************************************/
//						SUPPORTED VIDEOS
/*******************************************************************/

function pi_is_video_supported($video_url){
	if( preg_match('/youtube/', $video_url) || preg_match('/vimeo/', $video_url) )
		return true;
	else
		return false;
}
?>