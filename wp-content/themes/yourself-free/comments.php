 <?php
 
/*******************************************************************/
//				LOAD DIRECTLY OR PASSWORD PROTECTED
/*******************************************************************/

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) { ?>
	<p class="nocomments"><?php pi_translate_text('This post is password protected. Enter the password to view comments.', '_password_protected', 'directly'); ?></p>
<?php	
	return;
}
  
/*******************************************************************/
//				DISPLAY COMMENTS AND PINGBACKS
/*******************************************************************/

if( have_comments() ) : ?>
	
	<!-- BEGIN #comments-wrap -->
	<div id="comments-wrap" class="clearfix">
	
	<?php if( ! empty($comments_by_type['comment']) ) : 
	//if there are normal comments
	?>
	  	<h3 id="comments"><?php comments_number( pi_translate_text('No Comments', '_no_comments', 'argument'), pi_translate_text('1 Comment', '_1_comment', 'argument'), '% ' . pi_translate_text('Comments', '_comments', 'argument') ); ?></h3>
		<ul class="commentslist">
		     	 <?php wp_list_comments('type=comment&avatar_size=60&callback=pi_custom_comments'); ?>
		</ul>
	
	<?php endif; ?>
	
	<?php if( ! empty($comments_by_type['pings']) ) : 
	//if there are pings
	?>
		<h3 id="pings"><?php pi_translate_text('Trackbacks for this post', '_comments_trackbacks', 'directly') ?></h3>
		<ul class="pingslist">
			<?php wp_list_comments('type=pings'); ?>
		</ul>
	<?php endif; ?> 
	 
		<div class="page-navigation clearfix type-comments">
			<div class="left"><?php previous_comments_link(); ?></div>
			<div class="right"><?php next_comments_link(); ?></div>
		</div>
		
	<!-- END #comments-wrap -->	
	</div>
	
 <?php else : 
 // No comments or closed comments
 ?>	
	<?php if ( $post->comment_status == 'closed' && !is_page() && get_post_type() != 'portfolio' ) : 
	// closed status
	?>
		<p class="nocomments"><?php pi_translate_text('Comments are closed.', '_comments_closed', 'directly') ?></p>
	<?php endif; ?> 

 <?php endif; ?>
 
 <?php
/*******************************************************************/
//				COMMENTS FORM
/*******************************************************************/
 ?>
 
 <?php if ('open' == $post->comment_status) : 
 // open status
 ?>     
	 <div id="respond" class="clearfix">    
	 	
	 	<h3 class="respond-title"><?php comment_form_title( pi_translate_text('Leave a Comment', '_leave_a_comment', 'argument'), pi_translate_text('Leave a Comment to', '_leave_a_comment_to', 'argument') . ' %s' ); ?></h3>
	 	
	 	<div class="cancel-comment-reply">
	 		<p><?php cancel_comment_reply_link(); ?></p>
	 	</div>
	 	
	 	<p class="respond-message"><?php pi_translate_text('Make sure you enter the required information where indicated. Comments are moderated and nofollow is in use. Please no link dropping, no keywords or domains as names, do not spam, and do not advertise!', '_comments_before', 'directly'); ?></p>
	 	
	 	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	 		
	 		<p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'theme_textdomain'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
	 
	 	<?php else : ?>
	 	
		 	<!-- BEGIN form -->
		 	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		 	    
		 	    <?php if ( is_user_logged_in() ) : ?>
		 	    
		 	    	<p><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'theme_textdomain'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'theme_textdomain').'">', '</a>') ?></p>
		 	    
		 		<?php else : ?>
		 			
		 			<p>
		 				<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="50" class="input" tabindex="1" />
		 				<label for="author"><small><?php pi_translate_text('Name', '_comments_name', 'directly'); ?><span class="required-message"><?php if($req)  _e(" *", 'theme_textdomain'); ?></span></small></label>
		 			</p>
		 			
		 			<p>
		 				<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="50" class="input" tabindex="2" />
		 				<label for="email"><small><?php pi_translate_text('Email', '_comments_email', 'directly'); ?><span class="required-message"><?php if ($req) _e(" *", 'theme_textdomain'); ?></span></small></label>
		 			</p>
		 			
		 			<p>
		 				<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="50"  class="input" tabindex="3" />
		 				<label for="url"><small><?php pi_translate_text('Website', '_comments_website', 'directly'); ?></small></label>
		 			</p>
		 			
		 		<?php endif; ?>
		 		
		 		<p>
		 			<textarea name="comment" id="comment" cols="60" rows="7" tabindex="4"></textarea>
		 		</p>
		 		<p>
		 			<button class="btn" type="submit" name="submit">
		 		        <span class="left"><span class="right"><?php pi_translate_text('Submit Comment', '_submit_comment', 'directly'); ?></span></span>
		 		    </button>
		 			<?php comment_id_fields(); ?>
		 		</p>
		 		<?php do_action('comment_form', $post->ID); ?>
		 	</form>	
		 
	 	<?php endif; ?>
	 	
	 </div>
	 	
 <?php endif; ?> 