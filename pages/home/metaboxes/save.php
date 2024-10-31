<div class="submitbox" id="submitpost">
	<div id="minor-publishing">
		<div id="misc-publishing-actions">
			
			<a id="submitseriallink" style="text-decoration:none;" target="_blank" href="https://developers.facebook.com/tools/debug/og/object?q=<?php echo urlencode(get_bloginfo('url')); ?>">
				Test FB meta settings*</a>
				
			<span class="howto">*required to see changes - save first though</span>
		</div>
	</div>
	<div id="major-publishing-actions">
		<div id="publishing-action">
			<input class="button-primary" type="submit" name="save" value="<?php _e('Save Configuration', $this -> plugin_name); ?>" />
		</div>
		<br class="clear" />
	</div>
</div>


<script type="text/javascript">
jQuery(document).ready(function(e)
{
	//jQuery('#submitseriallink').colorbox();

});
</script>