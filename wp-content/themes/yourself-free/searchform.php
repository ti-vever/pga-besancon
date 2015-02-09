<!--BEGIN #searchform-->
<form method="get" id="searchform" class="clearfix" action="<?php echo home_url(); ?>/">
		<input type="text" name="s" id="s" class="s" value="<?php pi_translate_text("Search ...", "_search_text", "directly"); ?>" onfocus="if(this.value=='<?php pi_translate_text("Search ...", "_search_text", "directly"); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php pi_translate_text("Search ...", "_search_text", "directly"); ?>';" />
		<button class="btn" type="submit" name="submit">
		    <span class="left"><span class="right"><?php pi_translate_text("Search", "_search_button", "directly"); ?></span></span>
		</button>
<!--END #searchform-->
</form>