<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<div class="comment" id="comments-anchor">


<?php if ( have_comments() ) : ?>
<div id="comnums"> <h3><?php comments_number('No Comments On This Project', '1 Comment On This Project', '% Comments On This Post' );?>
</h3> </div>

	<ol class="commentlist">
<?php wp_list_comments('avatar_size=128&type=comment'); ?>

	</ol>
		<ol class="pinglist">
<?php wp_list_comments('type=pings'); ?>
	</ol>
	<div class="cnavigation">
<?php paginate_comments_links(); ?>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>
<div style="clear:both;"></div>

<?php if ('open' == $post->comment_status) : ?>
<div style="clear:both;"></div>
<div id="respond" class="comments">

<div style="clear:both;"></div>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>

<div class="left-comment" name="leave-comment" style="margin-right:40px;">

<h2><?php comment_form_title( 'Leave a Comment'); ?></h2>

<input type="text" value="Your Name:" id="author" onfocus="if (this.value == 'Your Name:') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Your Name:';}" name="author" />

<input type="text" value="Your Email:" name="email" id="email" onfocus="if (this.value == 'Your Email:') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Your Email:';}" />

<input type="text" value="Your Website:" name="url" id="url" onfocus="if (this.value == 'Your Website:') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Your Website:';}" />

</div>
<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
<?php if (function_exists('lmbbox_comment_quicktags_display')) { lmbbox_comment_quicktags_display(); } ?>


<div class="right-comment">

<p><textarea tabindex="4" rows="14" cols="80" id="comment" name="comment" value="Your Message:" onfocus="if (this.value == 'Your Message:') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Your Message:';}"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
<?php comment_id_fields(); ?>
</p>

</div>
<?php do_action('comment_form', $post->ID); ?>

</form>
<div class="widecolumn-subscription-manager">
<?php if(function_exists('show_manual_subscription_form')) show_manual_subscription_form(); ?></div>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
</div>