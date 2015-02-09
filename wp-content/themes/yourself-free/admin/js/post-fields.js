jQuery.noConflict();
jQuery(document).ready(function(){
	jQuery('.of-radio-img-img').show();
	jQuery('.post-meta-boxes').delegate('.of-radio-img-img', 'click', function(){
	    jQuery(this).parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
	    jQuery(this).addClass('of-radio-img-selected');
	    jQuery(this).prev().prev().attr('checked', true);
	});
	jQuery('#upload_button_image_1').click(function() {
		window.send_to_editor = function(html){
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image_1').val(imgurl);
			tb_remove();
		}
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});
	jQuery('#upload_button_image_2').click(function() {
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image_2').val(imgurl);
			tb_remove();
		}
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});
	jQuery('#upload_button_image_3').click(function() {	
		window.send_to_editor = function(html){
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image_3').val(imgurl);
			tb_remove();
		}
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});	
	jQuery('#upload_button_image_4').click(function() {
		window.send_to_editor = function(html){
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image_4').val(imgurl);
			tb_remove();
		}
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});
	jQuery('#upload_button_image_5').click(function() {
		window.send_to_editor = function(html){
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image_5').val(imgurl);
			tb_remove();
		}
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});
	jQuery('#upload_button_image_6').click(function() {
		window.send_to_editor = function(html){
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image_6').val(imgurl);
			tb_remove();
		}
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});
});