function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function piShortcodesSubmit(type) {	
	var tagtext;	
	var shortcode_id = null;
	if( type == 'icons' ){
		shortcode_id = 'icons';
	}else{
		if( type == 'sliders' ){
			shortcode_id = 'sliders';
		}else{
			shortcode_id = jQuery('#shortcode_'+type).val();
		}
	}
	switch( shortcode_id ){
		case 'icons':
			tagtext=" [icon type=\"" + jQuery('#shortcode_icons').val() + "\" color=\"light\" bgcolor=\"#6e99b9\"] [h4]SAMPLE TITLE[/h4] Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.[/icon] ";
			break;
		case 'color':
			tagtext = " ["+ shortcode_id + " hex=\"#8d7825\"]Your content here[/" + shortcode_id + "] ";
			break;
		case 'divider':
			tagtext = " ["+ shortcode_id + "] ";
			break;
		case 'space':
			tagtext = " ["+ shortcode_id + " height=\"20\"] ";
			break;
		case 'image':
			tagtext = " ["+ shortcode_id + " src=\"\" align=\"center\" alt=\"image\" width=\"590\" height=\"250\" caption=\"Image caption\"] ";
			break;
		case 'vimeo':
			tagtext = " ["+ shortcode_id + " id=\"21085613\" caption=\"Video caption\"] ";
			break;
		case 'youtube':
			tagtext = " ["+ shortcode_id + " id=\"VIXLRI95MHs\" caption=\"Video caption\"] ";
			break;
		case 'image_lightbox':
			tagtext = " ["+ shortcode_id + " url=\"Image URL\" align=\"center\" width=\"590\" height=\"250\" caption=\"Image caption\"] ";
			break;
		case 'list_ordered':
		case 'list_circle':
		case 'list_square':
		case 'list_check':
		case 'list_delete':
		case 'list_warning':
			var list_type = shortcode_id.split('_')[1];
			tagtext = " [" + shortcode_id + "] [li type=\"" + list_type + "\"]List Item 1[/li] [li type=\"" + list_type + "\"]List Item 2[/li] [li type=\"" + list_type + "\"]List Item 3[/li] [/" + shortcode_id + "] ";	
			break;
		case 'button':
		case 'button_brown':
		case 'button_orange':
		case 'button_blue':
		case 'button_green':
		case 'button_dark':
		case 'button_yellow':
			tagtext = " [" + shortcode_id + " url=\"http://www.sample.com\" target=\"_blank\" float=\"left\"]Button Content[/" + shortcode_id + "] ";
			break;
		case "sliders":
		case 'tabs':
		case "toggle":
		case 'testimonials':
		case 'price_table_2':
		case 'price_table_3':
		case 'price_table_4':
		case 'call_to_action':
		case 'posts':
		case 'portfolio':
			tagtext = "<p>To use this shortcode you need to upgrade your theme to a premium version. Get more information at: http://themeyourself.com/upgrade/</p><p>Para usar este shortcode debe actualizar a la version Premium del Tema. Para más información visite: http://es.themeyourself.com/upgrade/</p>";
			break;
		default:
			tagtext=" [" + shortcode_id + "]Your content here[/" + shortcode_id + "] ";
			break;
	}
	if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		//window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		tinyMCE.activeEditor.selection.setContent(tagtext);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}