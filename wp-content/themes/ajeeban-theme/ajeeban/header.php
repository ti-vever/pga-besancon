<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link href='<?php bloginfo('stylesheet_directory'); ?>/style.css' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/tangoskin.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" media="only screen and (max-width: 768px)" href="<?php bloginfo('stylesheet_directory'); ?>/break1.css" />
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/lib/jquery-1.7.1.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/lib/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/lib/jquery.lavalamp.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700,700italic,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/lib/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/lib/jquery.masonry.min.js"></script>
<link rel="stylesheet" type="text/css"  href="<?php echo of_get_option('stylesheet',''); ?>" />


<script type="text/javascript">
	if (navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i)) {
	    var viewportmeta = document.querySelector('meta[name="viewport"]');
	    if (viewportmeta) {
	        viewportmeta.content = 'width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0';
	        document.body.addEventListener('gesturestart', function () {
	            viewportmeta.content = 'width=device-width, minimum-scale=0.25, maximum-scale=1.6';
	        }, false);
	    }
	}
	
</script>

	
<script type="text/javascript">
	$(window).load(function(){
		$('.front-blog-posts').masonry({
		  itemSelector: '.front-blog-post',
		  columnWidth: 332
		});
	});
</script>
	
	
<script type="text/javascript">
	$(document).ready(function(){
		 $(".main-menu h2").toggle(
		   function () {
		     $(".main-menu ul").show();
		   },
		   function () {
		     $(".main-menu ul").hide();
		   });
	});
</script>

		
		
		<script type="text/javascript">
			$(document).ready(function(){
					
					$('.featured-post:not(:first)').hide();
					$(".featured-nav ul li").click(function () {
					  $(this).addClass("current");
					  $(this).siblings(".featured-nav ul li").removeClass("current");
					  $('.featured-post').eq($(this).index()).fadeIn().siblings(".featured-post").fadeOut('fast');
					 });
					 
					 if (parseInt($('.featured-wrap').css('width')) > 767) {
					 	$('.featured-nav ul li').click(function() { $(this).addClass('current').siblings('.current').removeClass('current'); });
					 	
					 	setInterval(function() {
					 	 var onTab = $('.featured-nav ul li').filter('.current');
					 	
					 	        var nextTab = onTab.index() < $('.featured-nav ul li').length-1 ? onTab.next() : $('.featured-nav ul li').first();
					 	        nextTab.click();
					 	    }, 10000);
					 } 
					 else {
					 	$('.featured-nav ul li').click(function() { $(this).addClass('current').siblings('.current').removeClass('current'); });
					 	setInterval(function() {
					 	        var onTab = $('.featured-nav ul li').filter('.current');
					 	
					 	        var nextTab = onTab.index() < $('.featured-nav ul li').length-1 ? onTab.next() : $('.featured-nav ul li').first();
					 	        nextTab.click();
					 	    }, 50000);
			 }
					
			});
		</script>
		
	
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/ie.css" />
	<![endif]-->


<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.png" />



	<!--[if lte IE 6]>
	<meta http-equiv="refresh" content="0; url=/<?php bloginfo('stylesheet_directory'); ?>/no-ie.html" />
	<script type="text/javascript">
	/* <![CDATA[ */
	window.top.location = '<?php bloginfo('stylesheet_directory'); ?>/no-ie.html';
	/* ]]> */
	</script>
	<![endif]-->
	
	<!--[if lte IE 7]>
	<meta http-equiv="refresh" content="0; url=/<?php bloginfo('stylesheet_directory'); ?>/no-ie.html" />
	<script type="text/javascript">
	/* <![CDATA[ */
	window.top.location = '<?php bloginfo('stylesheet_directory'); ?>/no-ie.html';
	/* ]]> */
	</script>
	<![endif]-->
	

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>

<?php 
    $background = of_get_option('background-one');
    if ($background['color'] || $background['image']) {
        echo '<style type="text/css" >';
        echo 'body {';
        if ($background['color']) {   
            echo '
            background: ' .$background['color']. ';';
        }

        if ($background['image']) {
            echo '
            background: url('.$background['image']. ') ';
            echo ''.$background['repeat']. ' ';
            echo ''.$background['position']. ' ';
            echo ''.$background['attachment']. ';';
        } 
        echo '
        }';
        echo '</style>';
    }
?>
