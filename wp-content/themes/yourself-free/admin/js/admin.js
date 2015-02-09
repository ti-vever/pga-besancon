jQuery.noConflict();

var optionsPanel = {
	
	init : function(){
		this.addSidebar();
		this.updateSidebar();
		this.removeSidebar();
		this.customTabs();
		this.logoManager();
		this.excerptManager();
		this.conditionalContent();
		this.createSlider();
		this.updateSlider();
		this.reloadSlider();
		this.removeSlider();
		this.patternUploader();
		this.fontSelector();
		this.imagesSelector();
		this.colorPicker();
		this.integerChecker();
		this.slider3DSwitcher();
		this.removeFile();
		this.recreateFileField();
		this.mediaUpload();
	},//init
	
	addSidebar : function(){
	
		var $sidebarWrap = null, 
			$sidebarList = null, 
			sidebarFound = false, 
			sidebarName = { 'new' : null, 'old' : null }; 
		
		jQuery('#sidebar_generator_button').click(function(e){
			    
			e.preventDefault();
			if( jQuery('#sidebar_generator').val() != "" ){
			
				$sidebarWrap = jQuery(this).parent();
				sidebarName['new'] = jQuery('#sidebar_generator').val();
					
				if( jQuery('#sidebars-list').length )
					$sidebarList = jQuery('#sidebars-list');
				else
					$sidebarList = jQuery('<ul id="sidebars-list"></ul>').appendTo($sidebarWrap);
				        
				$sidebarList.find('li').each( function () {
					if ( jQuery(this).find('input').val() === sidebarName['new'] ){
						sidebarFound = true;
						return false;
					}
				});
				        
				if ( sidebarFound == true ){
					sidebarFound = false;
					alert('Sidebar \"' + sidebarName['new'] + '\" Already Exists.');
				}else{
					$sidebarList.append('<li><input id="sidebar-item_' + jQuery.trim( sidebarName['new'] ) + '" class="sidebar-item" type="text" value="' + sidebarName['new'] + '" name="yourself[sidebars][' + jQuery.trim( sidebarName['new'] ) + ']"><span class="item-buttons"><a class="item-delete" href="#"></a></span></li>');
				}
				
			}else{
				alert("Please, Introduce sidebar name.");
			}
						   
		});
	
	},//addSidebar
	
	updateSidebar : function(){
	
		var	sidebarFound = false,
			sidebarName = { 'new' : null, 'old' : null };
		
		jQuery('#section-sidebar_generator')
		.delegate('#sidebars-list input', 'focus', function(e){
			e.preventDefault();
			currentSidebar = jQuery(this);
			sidebarName['old'] = currentSidebar.val();
			currentSidebar.addClass('current');	
		})
		.delegate('#sidebars-list input', 'blur', function(e){
			e.preventDefault();
			sidebarName['new'] = jQuery(this).val();	
			jQuery('#sidebars-list input').not('.current').each( function () {
				if ( jQuery(this).val() === sidebarName['new'] ){
					sidebarFound = true;
					return false;
				}        
			});
			if (sidebarFound == true || sidebarName['new'] == ""){
				sidebarFound = false;
				currentSidebar.val(sidebarName['old']);
				if(sidebarName['new'] == ""){
					alert('Please, Introduce sidebar name.');
				}else{
					alert('Sidebar \"' + sidebarName['new'] + '\" Already Exists.');
				}	
			}else{
				currentSidebar.attr({
					'id' : 'sidebar-item_' + jQuery.trim( sidebarName['new'] ) , 
					'name' : 'yourself[sidebars][' + jQuery.trim( sidebarName['new'] ) + ']',
				});
			}		
			currentSidebar.removeClass('current');
		});
		
	},//updateSidebar
	
	removeSidebar : function(){
		
		jQuery('#section-sidebar_generator').delegate('a.item-delete', 'click', function(e){
			
			e.preventDefault();
			
				var $currentItem = jQuery(this),
					confirmRemove = confirm('Are you sure to delete this item?');
				
				if( confirmRemove == true){
					$currentItem.closest('li').remove();
				}
				
		});
			
	},//removeSidebar
	
	customTabs : function(){
		
		var self = this;
		
		// Fade out the save message
		jQuery('.fade').delay(1000).fadeOut(1000);
		
		// Switches option sections
		jQuery('.group').hide();
		jQuery('.group:first').fadeIn();
		jQuery('.group .collapsed').each(function(){
			jQuery(this).find('input:checked').parent().parent().parent().nextAll().each( function(){
				if (jQuery(this).hasClass('last')) {
					jQuery(this).removeClass('hidden');
					return false;
				}
				jQuery(this).filter('.hidden').removeClass('hidden');
			});
		});
		
		//customToggle
		jQuery('#of_container').delegate('a.item-display', 'click', function(e){
			e.preventDefault();
			jQuery(this).closest('.custom-toggle').next('.inner-toggle').slideToggle('slow');
		});
		
		//imageRadio
		jQuery('#slider_generator').delegate('.of-radio-img-img', 'click', function(){
		    jQuery(this).parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		    jQuery(this).addClass('of-radio-img-selected');
		    jQuery(this).prev().prev().attr('checked', true);
		});
		
		//conditionalContent
		jQuery('.conditional-trigger input.checkbox').change(function(){
			var $conditional_cont = jQuery(this).closest('.section').next('.conditional-content');
			if( $conditional_cont.hasClass('hide') ){
				$conditional_cont.removeClass('hide');
				if( $conditional_cont.hasClass('custom-toggle') ){
					$conditional_cont.next('.inner-toggle').slideToggle('slow');
				}
			}
			else{
				if( $conditional_cont.hasClass('custom-toggle') ){
					$conditional_cont.next('.inner-toggle').hide();
				}
				$conditional_cont.addClass('hide');
			}		
		});
		
		//logoManager
		jQuery('input[name*="[logo_settings]"]').change(function(){
			self.logoManager();
		});	
		
		//excerptManager
		jQuery('input[name*="[overview_excerpt]"]').change(function(){
			self.excerptManager();
		});
				
	},//customTabs
	
	logoManager : function(){
	
		if( jQuery('#yourself-logo_settings-logo').is(':checked') ){
			jQuery('#section-logo').removeClass('hide');
		}else{
			if(!jQuery('#section-logo').hasClass('hide')){
				jQuery('#section-logo').addClass('hide');
			}
		}	
	
	},//logoManager
	
	excerptManager : function(){
	
		if( jQuery('#yourself-overview_excerpt-manually').is(':checked') ){
			jQuery('#section-excerpt_length').addClass('hide');
		}else{
			if(jQuery('#section-excerpt_length').hasClass('hide')){
				jQuery('#section-excerpt_length').removeClass('hide');	
			}
		}
	
	},//excerptManager
	
	conditionalContent : function(){
	
		var $conditionals = jQuery('.conditional-trigger input.checkbox:checked');
		if( $conditionals.length ){
			$conditionals.each(function(){
				jQuery(this).closest('.section').next('.conditional-content').removeClass('hide');
			});
		}
	
	},//conditionalContent
	
	createSlider : function(){
		
		var self = this, 
			nextSlide = 0, 
			sliderName = '', 
			sliderType = '', 
			nameAttrSplitted = '',
			$slideList = null, 
			$sliderList = null, 
			$currentSlideItem = null, 
			$currentSliderItem = null, 
			$sliderWrap = jQuery('#slider_generator'); 
		
		//Add new slider
		jQuery('#slider_generator_button').click(function(e){
		
			e.preventDefault();
			
			if( jQuery('#slider-list').length ){
				$sliderList = jQuery('#slider-list');
			}else{
				$sliderList = jQuery('<ul id="slider-list"></ul>').appendTo($sliderWrap);
		    }
		    
		    $currentSliderItem = jQuery('<li class="slider"></li>').appendTo($sliderList);
		    jQuery('#add-slider .slider-wrap').clone().appendTo($currentSliderItem);
			sliderType = jQuery($currentSliderItem).find("option:selected").val();
			jQuery('#slider-settings ' + '.' + sliderType + '_slider_settings').clone().appendTo($currentSliderItem.find('.inner-toggle').slideToggle('slow'));
			
		});
		
		//Add Slide
		jQuery('#slider_generator').delegate('.add_slide', 'click', function(){
		
			$currentSliderItem = jQuery(this).closest('li');
			
			if( $currentSliderItem.find('input.slider_name').val() != "" ){
				
				sliderName = $currentSliderItem.find('input.slider_name').val();
				sliderType = $currentSliderItem.find('select.slider_type').val();
				
				if( $currentSliderItem.find('.slide-list li').length ){
					
					$slideList = $currentSliderItem.find('.slide-list');
					nextSlide = $slideList.find('li:last').attr('class').split('-')[1];
					nextSlide = parseInt( nextSlide ) + 1;
					$currentSlideItem = jQuery('<li class="slide-' + nextSlide + '"></li>').appendTo($slideList);
					
				}else{
				
					if( !$currentSliderItem.find('.slide-list').length ){
						$slideList = jQuery('<ul class="slide-list"></ul>').appendTo($currentSliderItem.find('.inner-toggle:first'));
						$slideList.sortable({
							axis : 'y',
							update : function(event, ui){
								self.updateSlides($slideList);
							}
						});
					}else{
						$slideList = $currentSliderItem.find('.slide-list');
					}
					nextSlide = 0;	
					$currentSlideItem = jQuery('<li class="slide-' + nextSlide + '"></li>').appendTo($slideList);
				
				}				
				
				jQuery('#slide-settings ' + '.' + sliderType + '_slide_settings').clone().appendTo($currentSlideItem).find('.inner-toggle').slideToggle('slow');
				self.setUploaders($currentSlideItem, sliderName, nextSlide);
				
				$currentSlideItem.find(':input[name]').each(function(){
				
					nameAttrSplitted = self.namingSliderItems(jQuery(this));
					jQuery(this).attr('name', nameAttrSplitted[0] + '[sliders][' + sliderName + '][slides][' + nextSlide + '][' + nameAttrSplitted[1] + ']' );
						
				});
										
			}else{
				alert("Please, Introduce slider name.");
			}
			
		});
	
	},//createSlider 
	
	updateSlider : function(){
		
		var self = this,
			nextSlide = 0, 
			slideData = {}, 
			sliderName = '', 
			sliderType = '',
			themeName = '',
			nameAttrSplitted = '', 
			$slideList = null,
			$currentSlideItem = null,
			$currentSliderItem = null; 
		
		themeName = jQuery('.pi_theme_name').attr('id');	
		
		//If name change
		jQuery('#slider_generator').delegate('#slider-list input.slider_name', 'change', function(){
			
			var $nameInput = jQuery(this);
		
			sliderName = $nameInput.val();
			$currentSliderItem = $nameInput.closest('li');
			$currentSliderItem.find('h4:first').text(sliderName);
			$currentSliderItem.find('select.slider_type').attr('name', themeName + '[sliders][' + sliderName + '][type]');
				
			$currentSliderItem.find('.slider_settings :input[name]').each(function(){
				nameAttrSplitted = self.namingSliderItems(jQuery(this));
				jQuery(this).attr('name', nameAttrSplitted[0] + '[sliders][' + sliderName + '][settings][' + nameAttrSplitted[1] + ']' );
			});
				
			$currentSliderItem.find('.slide-list li').each(function(){
					
				nextSlide = jQuery(this).attr('class').split('-')[1];  
					
				jQuery(this).find(':input[name]').each(function(){
					nameAttrSplitted = self.namingSliderItems(jQuery(this));
					jQuery(this).attr('name', nameAttrSplitted[0] + '[sliders][' + sliderName + '][slides][' + nextSlide + '][' + nameAttrSplitted[1] + ']' );
				});
				
			});
			
		});
		
		//If slider type change
		jQuery('#slider_generator').delegate('#slider-list select.slider_type', 'change', function(){
		
			sliderType = jQuery(this).val();
			
			$currentSliderItem = jQuery(this).closest('li');
			$currentSliderItem.find('.slider_settings').remove();
			jQuery('#slider-settings ' + '.' + sliderType + '_slider_settings').clone().insertAfter($currentSliderItem.find('.inner-toggle .section').eq(1));
			sliderName = $currentSliderItem.find('input.slider_name').val();
			$currentSliderItem.find('select.slider_type').attr('name', themeName + '[sliders][' + sliderName + '][type]');
			
			//update slider settings names
			$currentSliderItem.find('.slider_settings :input[name]').each(function(){
				
				nameAttrSplitted = self.namingSliderItems(jQuery(this));
				jQuery(this).attr('name', nameAttrSplitted[0] + '[sliders][' + sliderName + '][settings][' + nameAttrSplitted[1] + ']' );
				
			});
			
			$slideList = $currentSliderItem.find('.slide-list');
			
			//Update Slides settings
			$slideList.find('li').each(function(index){
			
				slideSettings = {};
				
				jQuery(this).find(':input[name]').each(function(){
					key = jQuery(this).attr('class').split('_')[1];
					slideSettings[key] = jQuery(this).val();
				});
				
				slideData[index] = slideSettings;
				jQuery(this).remove();
			});
						
			jQuery.each(slideData, function(key, value){ 
								  
				$currentSlideItem = jQuery('<li class="slide-' + key + '"></li>').appendTo($slideList);
			  	jQuery('#slide-settings ' + '.' + sliderType + '_slide_settings').clone().appendTo($currentSlideItem);
			  	self.setUploaders($currentSlideItem, sliderName, key);
			  
			  	$currentSlideItem.find(':input[name]').each(function(){
			  	
			  		var $currentItem = jQuery(this);
			  		nameAttrSplitted = self.namingSliderItems(jQuery(this));
			  		$currentItem.attr('name', nameAttrSplitted[0] + '[sliders][' + sliderName + '][slides][' + key + '][' + nameAttrSplitted[1] + ']' );
					
			  		jQuery.each(value, function(key, value){
			  		
			  			if( /\s+/g.test(key) ){
			  				key = key.split(' ')[0];
			  			}
			  			
			  			if( $currentItem.hasClass(sliderType + '_' + key) ){
			  				$currentItem.val(value);
			  				if(key == 'file-url'){
			  					jQuery('<img src="' + value + '" alt="screenshot">\n<a href="javascript:(void);" class="mlu_remove button">Remove</a>').appendTo($currentItem.parent().find('.screenshot'));
			  				}
			  			}
			  		
					});
			  		
				});
			   
			});
		
		});
			
	},//updateSlider
	
	reloadSlider : function(){
		
		var self = this;
			
		jQuery('#slider-list li').each(function(){
			
			var nameAttrSplitted = '',
				$currentItem = jQuery(this),
				sliderName = $currentItem.find('input.slider_name').val();
				
			$currentItem.find('.slider_settings :input[name]').each(function(){
			
				nameAttrSplitted = self.namingSliderItems(jQuery(this));
				jQuery(this).attr('name', nameAttrSplitted[0]  + '[sliders][' + sliderName + '][settings][' + nameAttrSplitted[1] + ']');
				
			});
			
			var $slideList = $currentItem.find('.slide-list');
			
			if($slideList.length){
			
				$slideList.find('li').each(function(index){
					
					jQuery(this).find(':input[name]').each(function(){
					
						var is_checked = false;
						nameAttrSplitted = self.namingSliderItems(jQuery(this));
						if( jQuery(this).hasClass('layout-checked') ){ is_checked = true; }
						jQuery(this).attr('name', nameAttrSplitted[0]  + '[sliders][' + sliderName + '][slides][' + index + '][' + nameAttrSplitted[1] + ']');
						if( is_checked ){ jQuery(this).attr('checked', 'checked'); }
					
					});
				
				});
				
				$slideList.sortable({
					axis : 'y',
					update : function(event, ui){
						self.updateSlides($slideList);
					}
				});	
			
			}
			
		});
	
	},//reloadSlider
	
	removeSlider : function(){
	
		jQuery('#slider_generator').delegate('a.item-delete', 'click', function(e){
		
			e.preventDefault();
		
			var $currentItem = jQuery(this),
				confirmRemove = confirm('Are you sure to delete this item?');
			
			if( confirmRemove == true){
				$currentItem.closest('li').remove();
			}
			
		});
	
	},//removeSlider
	
	updateSlides : function($slideList){
	
		$slideList.find('li').each(function(index){
			jQuery(this).attr('class', 'slide-' + index);
			jQuery(this).find(':input[name]').each(function(){
				var currentName = jQuery(this).attr('name');
				jQuery(this).attr('name', currentName.replace(/\[slides\]\[\d+\]/, '[slides][' + index + ']'));
			});
		});
	
	},//updateSlides
	
	setUploaders : function($slideList, sliderName, index){
	
		$slideList.find('[id*=file-url]').each(function(){
		
			var currentId = jQuery(this).attr('id');
			jQuery(this).attr('id', sliderName.toLowerCase().replace(/\s+/g, '') + '_' + index + '_' + currentId);
		
		});
	
	},//setUploaders
	
	patternUploader : function(){
	
		jQuery('.pattern_upload_button').click(function(e){
		    e.preventDefault();
		    jQuery(this).parent().find('.patterns').removeClass('hide');
			document.onclick = function() {
				document.onclick = function() {
					jQuery('.patterns').addClass('hide');
					document.onclick = null;
				}
			}    
		});
				
		jQuery('#of_container').delegate('a.pattern', 'click', function(e){
			e.preventDefault();
			var $currentItem = jQuery(this).closest('.controls');
			$currentItem.find('.upload').val( jQuery(this).attr('title') );
			$currentItem.find('.patterns').addClass('hide');
		    $currentItem.find('.of-background-properties').show();
		    if( $currentItem.find('.screenshot img').length && !$currentItem.find('.screenshot').hasClass('hide') ){
		    	$currentItem.find('.screenshot').addClass('hide');		
			}
		});
	
	},//patternUploader
	
	fontSelector : function(){
	
		jQuery('.font_selector').click(function(e){
			e.preventDefault();
			jQuery(this).parent().find('.fonts').removeClass('hide');
			document.onclick = function() {
				document.onclick = function() {
					jQuery('.fonts').addClass('hide');
					document.onclick = null;
				}
			}
		});
		
		jQuery('#of_container').delegate('a.font', 'click', function(e){
			e.preventDefault();
			var $currentItem = jQuery(this).closest('.controls');
			$currentItem.find('option[value="' + jQuery(this).text() + '"]').attr('selected','selected');
			$currentItem.find('.fonts').addClass('hide');
		});
	
	},//fontSelector
	
	imagesSelector : function(){
		
		jQuery('.of-radio-img-img').click(function(){
			jQuery(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
			jQuery(this).addClass('of-radio-img-selected');		
		});
			
		jQuery('.of-radio-img-label').hide();
		jQuery('.of-radio-img-img').show();
		jQuery('.of-radio-img-radio').hide();
		
		jQuery('#of-nav li:first').addClass('current');
		jQuery('#of-nav li a').click(function(evt) {
			jQuery('#of-nav li').removeClass('current');
			jQuery(this).parent().addClass('current');
			var clicked_group = jQuery(this).attr('href');
			jQuery('.group').hide();
			jQuery(clicked_group).fadeIn();
			evt.preventDefault();
		}); 	
		
	},//imagesSelector
	
	colorPicker : function(){
	
		// Color Picker
		jQuery('.colorSelector').each(function(){
			var Othis = this; //cache a copy of the this variable for use inside nested function
			var initialColor = jQuery(Othis).next('input').attr('value');
			jQuery(this).ColorPicker({
				color: initialColor,
				onShow: function (colpkr) {
					jQuery(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					jQuery(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb) {
					jQuery(Othis).children('div').css('backgroundColor', '#' + hex);
					jQuery(Othis).next('input').attr('value','#' + hex);
				}
			});
		});
	
	},//colorPicker
	
	slider3DSwitcher : function(){
		
		jQuery('#slider3d_preview-file-url').closest('.section').addClass('hide');
		jQuery('#of_container').find('.slider3d_file_type').each(function(){
			var $currentItem = jQuery(this).closest('li')
			if( jQuery(this).val() == 'image' ){
				$currentItem.find('.slider3d_preview-file-url').closest('.section').addClass('hide');
			}else{
				$currentItem.find('.slider3d_description, .slider3d_link').closest('.section').addClass('hide');
			}
		});
		
		jQuery('#of_container').delegate('.slider3d_file_type', 'change' ,function(){
			var $currentItem = jQuery(this).closest('li'),
				fileType = jQuery(this).val();	
			$currentItem.find('.section').removeClass('hide');
			switch(fileType){
				case "image":
					$currentItem.find('.slider3d_preview-file-url').closest('.section').addClass('hide');
					break;
				case "swf": 
					$currentItem.find('.slider3d_description, .slider3d_link').closest('.section').addClass('hide');
					break;
			}
		});
	
	},//slider3DSwitcher
	
	integerChecker : function(){
		
		var currentVal = ''; 
			regex = /^\s*(\+|-)?\d+\s*$/;
		
		jQuery('#of_container')
			.delegate('.number-field', 'focus', function(){
				currentVal = jQuery(this).val();
			})
			.delegate('.number-field', 'blur', function(){
				if( !regex.test(jQuery(this).val()) ){
					jQuery(this).val(currentVal);
					alert('Sorry but this field only support integer numbers.');
				}
			});
			
	},//integerChecker
	
	namingSliderItems : function(item){
		
		themeName = jQuery('.pi_theme_name').attr('id');
		return [ themeName, item.attr('class').split(' ')[1] ];
	
	},//namingSlider
	
	removeFile: function () {
	 
		jQuery('.mlu_remove').live('click', function(event) { 
	    	jQuery(this).hide();
	    	jQuery(this).parents().parents().children('.upload').attr('value', '');
	    	jQuery(this).parents('.screenshot').slideUp();
	    	jQuery(this).parents('.screenshot').siblings('.of-background-properties').hide(); //remove background properties
	    	return false;
	  	});
	  
		 // Hide the delete button on the first row 
		jQuery('a.delete-inline', "#option-1").hide();
	  
	},
	
	recreateFileField: function () {
	   
		jQuery('input.file').each(function(){
			var uploadbutton = '<input class="upload_file_button" type="button" value="Upload" />';
	      	jQuery(this).wrap('<div class="file_wrap" />');
			jQuery(this).addClass('file').css('opacity', 0); //set to invisible
			jQuery(this).parent().append(jQuery('<div class="fake_file" />').append(jQuery('<input type="text" class="upload" />').attr('id',jQuery(this).attr('id')+'_file')).val( jQuery(this).val() ).append(uploadbutton));
	
			jQuery(this).bind('change', function() {
				jQuery('#'+jQuery(this).attr('id')+'_file').val(jQuery(this).val());
			});
			jQuery(this).bind('mouseout', function() {
				jQuery('#'+jQuery(this).attr('id')+'_file').val(jQuery(this).val());
			});
		});
	     
	}, // End recreateFileField
	   
	mediaUpload: function () {
	
		jQuery.noConflict();
		
		jQuery( 'input.upload_button' ).removeAttr('style');
		
		var formfield,
			formID,
			btnContent = true,
			tbframe_interval;
			// On Click
			jQuery('input.upload_button').live("click", function () {
		    formfield = jQuery(this).prev('input').attr('id');
		    formID = jQuery(this).attr('rel');
			
			//Change "insert into post" to "Use this Button"
			tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
		    
		    // Display a custom title for each Thickbox popup.
		    var woo_title = 'File Uploader';
		    
			//if ( $(this).parents('.section').find('.heading') ) { woo_title = $(this).parents('.section').find('.heading').text(); } // End IF Statement
		    
			tb_show( woo_title, 'media-upload.php?post_id='+formID+'&TB_iframe=1' );
			return false;
		});
		        
		window.original_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
		    
			if (formfield) {
				
				//clear interval for "Use this Button" so button text resets
				clearInterval(tbframe_interval);
		    	
				// itemurl = $(html).attr('href'); // Use the URL to the main image.
		      
			if ( jQuery(html).html(html).find('img').length > 0 ) {
		      
				itemurl = jQuery(html).html(html).find('img').attr('src'); // Use the URL to the size selected.
		      	
			} else {
			    // It's not an image. Get the URL to the file instead.
			   	
			   	var htmlBits = html.split("'"); // jQuery seems to strip out XHTML when assigning the string to an object. Use alternate method.
				itemurl = htmlBits[1]; // Use the URL to the file.
			      	
				var itemtitle = htmlBits[2];
			      	
				itemtitle = itemtitle.replace( '>', '' );
				itemtitle = itemtitle.replace( '</a>', '' );
			
			} // End IF Statement
		               
			var image = /(^.*\.jpg|jpeg|png|gif|ico*)/gi;
			var document = /(^.*\.pdf|doc|docx|ppt|pptx|odt*)/gi;
			var audio = /(^.*\.mp3|m4a|ogg|wav*)/gi;
			var video = /(^.*\.mp4|m4v|mov|wmv|avi|mpg|ogv|3gp|3g2*)/gi;
		      
			if (itemurl.match(image)) {
				btnContent = '<img src="'+itemurl+'" alt="" /><a href="#" class="mlu_remove button">Remove Image</a>';
			} else {
		      	
				// No output preview if it's not an image.
				// btnContent = '';
				// Standard generic output if it's not an image.
		        
				html = '<a href="'+itemurl+'" target="_blank" rel="external">View File</a>';
				btnContent = '<div class="no_image"><span class="file_link">'+html+'</span><a href="#" class="mlu_remove button">Remove</a></div>';
			}
		      
			jQuery('#' + formfield).val(itemurl);
			// $('#' + formfield).next().next('div').slideDown().html(btnContent);
			jQuery('#' + formfield).siblings('.screenshot').slideDown().html(btnContent);
			jQuery('#' + formfield).siblings('.of-background-properties').show(); //show background properties
			tb_remove();
		      
			} else {
				window.original_send_to_editor(html);
		    }
		    
		    // Clear the formfield value so the other media library popups can work as they are meant to. - 2010-11-11.
			formfield = '';
		}
		  
	}//End mediaUpload
			
}//optionsPanel
	
jQuery(document).ready(function(){
	optionsPanel.init();
});