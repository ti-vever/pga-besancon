<?php
require_once('mce-config.php');
// check for rights
if ( !current_user_can('edit_pages') && !current_user_can('edit_posts') ) 
	wp_die( __("You are not allowed to be here", 'theme_textdomain') );
    global $wpdb;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
		<title>Shortcodes Panel</title>
			<script language="javascript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
			<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
			<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
			<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
			<script language="javascript" type="text/javascript" src="<?php echo  get_template_directory_uri() ?>/lib/functions/tinymce/tinymce.js"></script>
			<style type="text/css">
				#shortcodes-editor{
					background-color: #eee;
				}
				#shortcode-tabs{
					float: left;
					margin: 0;
					padding: 0;
					max-width: 130px;
					z-index: 99;
				}
				#shortcode-tabs a{
					text-decoration: none;
					color: #5597b2;
				}
				#shortcode-tabs li{
					list-style: none;
					padding: 5px 5px;
				}
				#shortcode-tabs li a{
					display: block;
				}
				#shortcode-tabs li.active{
					background-color: #fff;
					border-top: 1px solid #d7d7d7;
					border-bottom: 1px solid #d7d7d7;
					border-left: 1px solid #d7d7d7;
				}
				.tab_container{
					float: left;
					margin-left: -3px;
					z-index: 10;
					background-color: #fff;
					padding: 10px;
					width: 140px;
					height: 150px;
					border-top: 1px solid #d7d7d7;
					border-bottom: 1px solid #d7d7d7;
					border-right: 1px solid #d7d7d7;
					z-index: 1;
				}
				select{
					text-align: center;
					width: 140px;
				}
				.mceActionPanel{
					margin-top: 10px;
				}
				.premium{
					padding: 2px;
					font-size: 8px;
					background-color: #fffbcc;
					border: 1px solid #e6db55;
					color: #000;
				}
				.upgrade{
					float: left;
					font-size: 9px;
					line-height: 1.6;
					margin-top: 5px;
					width: 268px;
				}
				.upgrade p{
					margin: 0;
					padding: 0;
				}
				.upgrade a{
					color: #5597b2;
					font-weight: bold;
				}
				.red{
					color: red;
				}
			</style>
			<script type="text/javascript">
				jQuery(document).ready(function(){	
					jQuery(".tab_content").hide(); 
					jQuery("ul#shortcode-tabs li:first").addClass("active").show(); 
					jQuery(".tab_content:first").show(); 
					jQuery("ul#shortcode-tabs li").click(function() {
						jQuery("ul#shortcode-tabs li").removeClass("active"); 
						jQuery(this).addClass("active"); 
						jQuery(".tab_content").hide(); 
						var activeTab = jQuery(this).find("a").attr("href");
						jQuery(activeTab).fadeIn(); 
						return false;
					});
					jQuery('.cancel').click(function(){
						tinyMCEPopup.close();
					});
					jQuery('.insert').click(function(){
						piShortcodesSubmit( jQuery(this).parent().parent().attr('id') );
					});				
				});
			</script>
	</head>

	<body>
		<!-- BEGIN #shortcodes-editor -->
		<div id="shortcodes-editor">
			<!-- BEGIN .tabs -->
			<ul id="shortcode-tabs">
				<li><a href="#columns" title="Columns">Columns</a></li>
			    <li><a href="#icons" title="Icons">Icons</a></li>
			    <li><a href="#buttons" title="Buttons">Buttons</a></li>
			    <li><a href="#typography" title="Typography">Typography</a></li>
			    <li><a href="#media" title="Media">Media</a></li>
			    <li><a href="#sliders" title="Sliders">Sliders <span class="premium">PREMIUM</span></a></li>
			    <li><a href="#miscellaneous" title="Miscellaneous">Advanced <span class="premium">PREMIUM</span></a></li>
			<!-- END .tabs -->
			</ul>
			<!-- BEGIN .tab_container -->
			<div class="tab_container">
				<!-- BEGIN .columns -->
				<div id="columns" class="tab_content">
					<p>Columns shortcode:</p>
					<select id="shortcode_columns" name="pi_shortcode_columns">
					<?php
						if( is_array( $shortcode_tags ) ){
							foreach( $shortcode_tags as $shortcode_key => $shortcode_val ){
								if( stristr( $shortcode_val ,'pi_column_' ) ){
									$shortcode_name = str_replace( 'pi column ','', str_replace( '_', ' ', $shortcode_val ) );
									echo '<option value="' . $shortcode_key . '" >' . ucwords( $shortcode_name ) .'</option>' . "\n";
								}
							}	
						} ?>
					</select>
					<div class="mceActionPanel">
						<input type="button" class="cancel" name="cancel" value="Cancel" />
						<input type="submit" class="insert" name="insert" value="Insert" />
					</div>
				<!-- END .columns -->
				</div>
				<!-- BEGIN .icons -->
				<div id="icons" class="tab_content">
					<p>Select Icon Shortcode:</p>
					<select id="shortcode_icons" name="pi_shortcode_icons">
						<option value="address_book">Address Book</option>
						<option value="clock">Clock</option>
						<option value="alert_icon">Alert</option>
						<option value="american_express">American Express</option>
						<option value="android">Android</option>
						<option value="archive">Archive</option>
						<option value="blackberry">Blackberry</option>
						<option value="bluetooth">Bluetooth</option>
						<option value="calendar">Calendar</option>
						<option value="chart">Chart</option>
						<option value="chemical">Chemical</option>
						<option value="clapboard">Clapboard</option>
						<option value="clipboard">Clipboard</option>
						<option value="cloud">Cloud</option>
						<option value="cog">Cog</option>
						<option value="cup">Cup</option>
						<option value="file_cabinet">File Cabinet</option>
						<option value="film">Film</option>
						<option value="firefox">Firebox</option>
						<option value="flag">Flag</option>
						<option value="folder">Folder</option>
						<option value="globe">Globe</option>
						<option value="help">Help</option>
						<option value="image">Image</option>
						<option value="info">Info</option>
						<option value="ipad">Ipad</option>
						<option value="iphone">Iphone</option>
						<option value="light_bulb">Light Bulb</option>
						<option value="link">Link</option>
						<option value="mail">Mail</option>
						<option value="mastercard">Mastercard</option>
						<option value="megaphone">Megaphone</option>
						<option value="microphone">Microphone</option>
						<option value="note_book">Note Book</option>
						<option value="paypal">PayPal</option>
						<option value="pencil">Pencil</option>
						<option value="piggy_bank">Piggy Bank</option>
						<option value="presentation">Presentation</option>
						<option value="price_tags">Price Tags</option>
						<option value="tools">Tools</option>
						<option value="trash">Trash</option>
						<option value="shopping_basket">Shopping Basket</option>
						<option value="shopping_cart">Shopping Cart</option>
						<option value="sign_post">Sign Post</option>
						<option value="sound">Sound</option>
						<option value="speech_bubbles">Speech Bubbles</option>
						<option value="suitcase">Suitcase</option>
						<option value="tags">Tags</option>
						<option value="visa">Visa</option>
						<option value="wifi">Wifi</option>
					</select>
					<div class="mceActionPanel">
						<input type="button" class="cancel" name="cancel" value="Cancel" />
						<input type="submit" class="insert" name="insert" value="Insert" />
					</div>
				<!-- END .icons -->
				</div>
				<!-- BEGIN .buttons -->
				<div id="buttons" class="tab_content">
					<p>Buttons shortcode:</p>
					<select id="shortcode_buttons" name="pi_shortcode_buttons">
					<?php
						if( is_array( $shortcode_tags ) ){
							foreach( $shortcode_tags as $shortcode_key => $shortcode_val ){
								if( stristr( $shortcode_val ,'pi_button_' ) ){
									$shortcode_name = str_replace( 'pi button ','', str_replace( '_', ' ', $shortcode_val ) );
									echo '<option value="' . $shortcode_key . '" >' . ucwords( $shortcode_name ) .'</option>' . "\n";
								}
							}	
						} ?>
					</select>
					<div class="mceActionPanel">
						<input type="button" class="cancel" name="cancel" value="Cancel" />
						<input type="submit" class="insert" name="insert" value="Insert" />
					</div>
				<!-- END .buttons -->
				</div>
				<!-- BEGIN .typography -->
				<div id="typography" class="tab_content">
					<p>Typography shortcode:</p>
					<select id="shortcode_typography" name="pi_shortcode_typography">
					<?php
						if( is_array( $shortcode_tags ) ){
							foreach( $shortcode_tags as $shortcode_key => $shortcode_val ){
								if( stristr( $shortcode_val ,'pi_typo_' ) ){
									$shortcode_name = str_replace( 'pi typo ','', str_replace( '_', ' ', $shortcode_val ) );
									echo '<option value="' . $shortcode_key . '" >' . ucwords( $shortcode_name ) .'</option>' . "\n";
								}
							}	
						} ?>
					</select>
					<div class="mceActionPanel">
						<input type="button" class="cancel" name="cancel" value="Cancel" />
						<input type="submit" class="insert" name="insert" value="Insert" />
					</div>
				<!-- END .typography -->
				</div>
				<!-- BEGIN .media -->
				<div id="media" class="tab_content">
					<p>Media shortcode:</p>
					<select id="shortcode_media" name="pi_shortcode_media">
					<?php
						if( is_array( $shortcode_tags ) ){
							foreach( $shortcode_tags as $shortcode_key => $shortcode_val ){
								if( stristr( $shortcode_val ,'pi_media_' ) ){
									$shortcode_name = str_replace( 'pi media ','', str_replace( '_', ' ', $shortcode_val ) );
									echo '<option value="' . $shortcode_key . '" >' . ucwords( $shortcode_name ) .'</option>' . "\n";
								}
							}	
						} ?>
					</select>
					<div class="mceActionPanel">
						<input type="button" class="cancel" name="cancel" value="Cancel" />
						<input type="submit" class="insert" name="insert" value="Insert" />
					</div>
				<!-- END .typography -->
				</div>
				<!-- BEGIN .sliders -->
				<div id="sliders" class="tab_content">
					<?php $sliders = of_get_option('slider_generator', 'no entry'); 
					if( $sliders == 'no entry' ){
						echo '<p>To select shortcode sliders you must create a slider before via Theme Options - Slider.</p>';
					}else{ ?>
						<p>Slider shortcode:</p>
						<select id="shortcode_sliders" name="pi_shortcode_sliders">
							<?php foreach( $sliders as $name => $slider ) { ?>
								<option value="<?php echo $name; ?>"><?php echo $name; ?></option>
							<?php } ?>
						</select>
					<?php } ?>
					<div class="mceActionPanel">
						<input type="button" class="cancel" name="cancel" value="Cancel" />
						<input type="submit" class="insert" name="insert" value="Insert" />
					</div>
				<!-- END .sliders -->
				</div>
				<!-- BEGIN .miscellaneous -->
				<div id="miscellaneous" class="tab_content">
					<p>Advanced shortcode:</p>
					<select id="shortcode_miscellaneous" name="pi_shortcode_miscellaneous">
					<?php
						if( is_array( $shortcode_tags ) ){
							foreach( $shortcode_tags as $shortcode_key => $shortcode_val ){
								if( stristr( $shortcode_val ,'pi_mix_' ) ){
									$shortcode_name = str_replace( 'pi mix ','', str_replace( '_', ' ', $shortcode_val ) );
									echo '<option value="' . $shortcode_key . '" >' . ucwords( $shortcode_name ) .'</option>' . "\n";	
								}
							}	
						} 
						$premium_shortcodes = array( "tabs" => "Tabs [premium]", "toggle" => "Toggle [Premium]", "testimonials" => "Testimonials [Premium]", "price_table_2" => "Price Table 2 Columns [Premium]", "price_table_3" => "Price Table 3 Columns [Premium]", "price_table_4" => "Price Table 4 Columns [Premium]", "call_to_action" => "Call To Action [Premium]", "posts" => "Recent Posts [Premium]", "portfolio" => "Portfolio Posts [Premium]", );
						foreach( $premium_shortcodes as $k => $v ){
							echo '<option value="' . $k . '" >' . ucwords( $v ) .'</option>' . "\n";
						}
						?>
					</select>
					<div class="mceActionPanel">
						<input type="button" class="cancel" name="cancel" value="Cancel" />
						<input type="submit" class="insert" name="insert" value="Insert" />
					</div>
				<!-- END .miscellaneous -->
				</div>
			<!-- END .tab_container -->
			</div>
			<!-- BEGIN .premium.upgrade -->
			<div class="premium upgrade">
				<p><?php echo pi_upgrade_cta("shortcodes"); ?></p>
			</div>
			<!-- END .premium.upgrade -->
		<!-- END #shortcodes-editor -->	
		</div>
	</body>
	
</html>