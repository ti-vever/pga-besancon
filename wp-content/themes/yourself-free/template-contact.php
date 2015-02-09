<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>

<?php include 'includes/heading-tagline.php'; ?>

<!-- BEGIN #content -->
<div id="content" class="clearfix">
		
	<!-- BEGIN .contact-wrap -->
	<div id="contact-form" class="one_half">
		<?php if(isset($emailSent) && $emailSent == true) : ?>
			<div class="alert green"><?php pi_translate_text('Thanks, your email was sent successfully.', '_contact_email_sent', 'directly'); ?></div>
		<?php else : ?>
			<!-- BEGIN #contact-form -->
			<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
				<fieldset>
					<p>
						<input type="text" name="cName" value="<?php if(isset($_POST['cName'])) echo $_POST['cName'];?>" id="cName" class="required" tabindex="1" />
						<?php if(isset($nameError) && $nameError == true ) { ?> 
							<span class="error"><?php pi_translate_text('Please enter your name.', 'contact_name_error', 'directly'); ?></span>
						<?php } ?>
						<label for="cName"><?php pi_translate_text('Name', '_contact_name', 'directly'); ?> <span class="required-message">*</span></label>
					</p>
					<p>
						<input type="text" name="cEmail" value="<?php if(isset($_POST['cEmail'])) echo $_POST['cEmail'];?>" id="cEmail" class="required email" tabindex="2" />
						<?php if(isset($emailError) && $emailError == true ) { ?> 
							<span class="error"><?php pi_translate_text('You entered an invalid email address.', 'contact_email_error', 'directly'); ?></span>
						<?php } ?>
						<label for="cEmail"><?php pi_translate_text('Email', '_contact_email', 'directly'); ?> <span class="required-message">*</span></label>
					</p>
					<p>
						<textarea name="cComment" id="cComment" class="required" cols="60" rows="7" tabindex="3"><?php if(isset($_POST['cComment'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['cComment']); } else { echo $_POST['cComment']; } } ?></textarea>		
						<?php if(isset($commentError) && $commentError == true ) { ?> 
							<span class="error"><?php pi_translate_text('Please enter a message.', 'contact_message_error', 'directly'); ?></span>
						<?php } ?>
					</p>
					<p>
						<input type="hidden" name="pi_contact_form" value="true"/>
						<input type="hidden" name="submitted" id="submitted" value="true" />
						<button class="btn" type="submit" name="submit">
							<span class="left"><span class="right"><?php pi_translate_text('Submit Email', '_contact_submit_email', 'directly'); ?></span></span>
						</button>
					</p>
				</fieldset>
			<!-- END #contact-form -->
			</form>
		<?php endif; ?>
	<!-- END .contact-wrap -->
	</div>
		
	<!-- BEGIN .contact-wrap -->
	<div id="contact-info" class="one_half last">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<!-- BEGIN .post -->
			<div id="post-<?php the_ID(); ?>">
				<!-- BEGIN .post-content -->
				<div class="post-content clearfix">
					<!-- END .entry-title-wrap -->
					<?php if( current_user_can('edit_post', $post->ID) ): ?>
						<div class="edit-message">
							<?php edit_post_link( __('Edit this', 'theme_textdomain') ); ?>
						</div>
					<?php endif; ?>
					<!-- BEGIN #entry-content -->
					<div class="entry-content">
						<?php the_content(); ?>
					<!-- END entry-content -->
					</div>
				<!-- END .post-content -->
				</div>
			<!-- END .post -->
			</div>
		<?php endwhile; endif; ?>
	<!-- END .contact-info -->
	</div>
		
<!-- END #content -->
</div>

<?php get_footer(); ?>