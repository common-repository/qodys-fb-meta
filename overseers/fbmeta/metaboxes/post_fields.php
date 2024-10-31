<?php 
global $post;

$custom = get_post_custom( $post->ID );

$types = $this->Owner()->GetContentTypes();
?>

<input type="hidden" name="qody_noncename" id="qody_noncename" value="<?php echo wp_create_nonce( $this->GetUrl() ); ?>" />

<p style="text-align:center; padding:10px 0px 0px 0px;">
	<a target="_blank" href="https://developers.facebook.com/tools/debug/og/object?q=<?php echo urlencode( get_permalink( $post->ID ) ); ?>">
		Preview post in Facebook Tester
	</a>
	- <span style="color:#cc0000;">save first!</span>
</p>

<table class="form-table">
	<tbody>
		<tr>
			<?php $nextItem = 'use_custom_title'; ?>
			<th>
				<label for="<?php echo $nextItem; ?>1">Content Title:</label>
			</th>
			<td>
				<label>
					<input onclick="jQuery('#<?php echo $nextItem; ?>').hide();" type="radio" name="field_<?php echo $nextItem; ?>" value="-1" id="<?php echo $nextItem; ?>1" <?php if( !$custom[ $nextItem ][0] || $custom[ $nextItem ][0] == -1 ) echo 'checked="checked"'; ?>>
					Post Title
				</label>
				<label>
					<input onclick="jQuery('#<?php echo $nextItem; ?>').show();" type="radio" name="field_<?php echo $nextItem; ?>" value="1" id="<?php echo $nextItem; ?>2" <?php if( $custom[ $nextItem ][0] == 1 ) echo 'checked="checked"'; ?>>
					Custom
				</label>
				<span class="howto">Choose what you'd like the title to be when this post is shared</span>
			</td>
		</tr>
	</tbody>
</table>

<div id="<?php echo $nextItem; ?>" style="display: <?php if( $custom[ $nextItem ][0] == 1 ) echo 'block'; else echo 'none'; ?>; ">
	<table class="form-table">
		<tbody>
			<?php $nextItem = 'custom_title'; ?>
			<tr>
				<th>
					
				</th>
				<td>
					<input type="text" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" id="<?php echo $nextItem; ?>" class="widefat">
					<span class="howto">The title of your content as it should appear, e.g., "The Rock"</span>
				</td>
			</tr>		
		</tbody>
	</table>
</div>

<table class="form-table">
	<tbody>
		<?php $nextItem = 'content_type'; ?>
		<tr>
			<th>
				<label for="<?php echo $nextItem; ?>">Content Type:</label>
			</th>
			<td>
				<select name="field_<?php echo $nextItem; ?>" id="<?php echo $nextItem; ?>">
					
					<?php
					
					if( !$custom[ $nextItem ][0] )
						$custom[ $nextItem ][0] = 'article';
						
					foreach( $types as $key => $value )
					{ ?>
					<optgroup label="<?php echo $key; ?>">
						<?php
						foreach( $value as $key2 => $value2 )
						{
							if( $value2 == $custom[ $nextItem ][0] )
								$selected = 'selected="selected"';
							else
								$selected = ''; ?>
						<option <?php echo $selected; ?> value="<?php echo $value2; ?>"><?php echo ucwords( str_replace( '_', ' ', $value2 ) ); ?></option>
						<?php
						} ?>
					</optgroup>
					<?php					
					} ?>
					
				</select>
				<span class="howto">The type of your content, e.g., "movie"</span>
			</td>
		</tr>
		<tr>
			<?php $nextSection = $nextItem = 'custom_preview_image'; ?>
			<th>
				<label for="<?php echo $nextItem; ?>1">Preview Image:</label>
			</th>
			<td>
				<label>
					<input onclick="jQuery('#<?php echo $nextSection; ?>1').hide(); jQuery('#<?php echo $nextSection; ?>2').hide();" type="radio" name="field_<?php echo $nextItem; ?>" value="-1" <?php if( !$custom[ $nextItem ][0] || $custom[ $nextItem ][0] == -1 ) echo 'checked="checked"'; ?>>
					Default / Auto
				</label>
				<label>
					<input onclick="jQuery('#<?php echo $nextSection; ?>1').hide(); jQuery('#<?php echo $nextSection; ?>2').hide();" type="radio" name="field_<?php echo $nextItem; ?>" value="1" <?php if( $custom[ $nextItem ][0] == 1 ) echo 'checked="checked"'; ?>>
					Featured Image
				</label>
				<label>
					<input onclick="jQuery('#<?php echo $nextSection; ?>1').show(); jQuery('#<?php echo $nextSection; ?>2').hide();" type="radio" name="field_<?php echo $nextItem; ?>" value="2" <?php if( $custom[ $nextItem ][0] == 2 ) echo 'checked="checked"'; ?>>
					From URL
				</label>
				<label>
					<input onclick="jQuery('#<?php echo $nextSection; ?>2').show(); jQuery('#<?php echo $nextSection; ?>1').hide();" type="radio" name="field_<?php echo $nextItem; ?>" value="3" <?php if( $custom[ $nextItem ][0] == 3 ) echo 'checked="checked"'; ?>>
					Upload New
				</label>
				<span class="howto">An image which should represent your content. The image must be at 
				least 50px by 50px and have a maximum aspect ratio of 3:1. Supported extensions are PNG, JPEG and GIF.</span>
			</td>
		</tr>
	</tbody>
</table>

<div id="<?php echo $nextSection; ?>1" style="display: <?php if( $custom[$nextSection][0] == 2 ) echo 'block'; else echo 'none'; ?>; ">
	<table class="form-table">
		<tbody>
			<?php $nextItem = 'preview_image_from_url'; ?>
			<tr>
				<th>
					
				</th>
				<td style="padding-top:0px;">
					<input type="text" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" id="<?php echo $nextItem; ?>" class="widefat">
					<span class="howto">Enter an image url</span>
				</td>
			</tr>		
		</tbody>
	</table>
</div>
<div id="<?php echo $nextSection; ?>2" style="display: <?php if( $custom[$nextSection][0] == 3 ) echo 'block'; else echo 'none'; ?>; ">
	<table class="form-table">
		<tbody>
			<?php $nextItem = 'preview_image_from_upload'; ?>
			<tr>
				<th>
					
				</th>
				<td style="padding-top:0px;">
					<div class="postbox">
						<?php $this->Owner()->m_extra_image->ShowExtraThumbnailControl(); ?>
					</div>
				</td>
			</tr>		
		</tbody>
	</table>
</div>

<table class="form-table">
	<tbody>
		<tr>
			<?php $nextItem = 'use_content_url'; ?>
			<th>
				<label for="<?php echo $nextItem; ?>1">Content Url:</label>
			</th>
			<td>
				<label>
					<input onclick="jQuery('#<?php echo $nextItem; ?>').hide();" type="radio" name="field_<?php echo $nextItem; ?>" value="-1" id="<?php echo $nextItem; ?>1" <?php if( !$custom[ $nextItem ][0] || $custom[ $nextItem ][0] == -1 ) echo 'checked="checked"'; ?>>
					Post Permalink
				</label>
				<label>
					<input onclick="jQuery('#<?php echo $nextItem; ?>').show();" type="radio" name="field_<?php echo $nextItem; ?>" value="1" id="<?php echo $nextItem; ?>2" <?php if( $custom[ $nextItem ][0] == 1 ) echo 'checked="checked"'; ?>>
					Custom URL (advanced)
				</label>
				<span class="howto">Choose which url to pull meta from when this post is shared</span>
			</td>
		</tr>
	</tbody>
</table>

<div id="<?php echo $nextItem; ?>" style="display: <?php if( $custom[ $nextItem ][0] == 1 ) echo 'block'; else echo 'none'; ?>; ">
	<table class="form-table">
		<tbody>
			<?php $nextItem = 'content_url'; ?>
			<tr>
				<th>
					
				</th>
				<td>
					<input type="text" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" id="<?php echo $nextItem; ?>" class="widefat">
					<span class="howto">The full url of the page to pull meta from e.g., "http://google.com"</span>
				</td>
			</tr>		
		</tbody>
	</table>
</div>

<table class="form-table">
	<tbody>
		<tr>
			<?php $nextItem = 'use_description'; ?>
			<th>
				<label for="<?php echo $nextItem; ?>1">Content Description:</label>
			</th>
			<td>
				<label>
					<input onclick="jQuery('#<?php echo $nextItem; ?>').hide();" type="radio" name="field_<?php echo $nextItem; ?>" value="-1" id="<?php echo $nextItem; ?>1" <?php if( !$custom[ $nextItem ][0] || $custom[ $nextItem ][0] == -1 ) echo 'checked="checked"'; ?>>
					Default / Auto
				</label>
				<label>
					<input onclick="jQuery('#<?php echo $nextItem; ?>').hide();" type="radio" name="field_<?php echo $nextItem; ?>" value="1" id="<?php echo $nextItem; ?>2" <?php if( $custom[ $nextItem ][0] == 1 ) echo 'checked="checked"'; ?>>
					Post Excerpt
				</label>
				<label>
					<input onclick="jQuery('#<?php echo $nextItem; ?>').show();" type="radio" name="field_<?php echo $nextItem; ?>" value="2" id="<?php echo $nextItem; ?>3" <?php if( $custom[ $nextItem ][0] == 2 ) echo 'checked="checked"'; ?>>
					Custom Description
				</label>
				<span class="howto">Choose the text to show as the description of the page's content</span>
			</td>
		</tr>
	</tbody>
</table>

<div id="<?php echo $nextItem; ?>" style="display: <?php if( $custom[ $nextItem ][0] == 2 ) echo 'block'; else echo 'none'; ?>; ">
	<table class="form-table">
		<tbody>
			<tr>
				<?php $nextItem = 'content_description'; ?>
				<th>
				
				</th>
				<td>
					<textarea name="field_<?php echo $nextItem; ?>" id="<?php echo $nextItem; ?>" class="widefat"><?php echo $custom[ $nextItem ][0]; ?></textarea>
					<span class="howto">A one to two sentence description of your content.</span>
				</td>
			</tr>		
		</tbody>
	</table>
</div>

<table class="form-table">
	<tbody>
		<tr>
			<?php $nextItem = 'use_video'; ?>
			<th>
				<label for="<?php echo $nextItem; ?>1">Post Video:</label>
			</th>
			<td>
				<label>
					<input onclick="jQuery('#<?php echo $nextItem; ?>').show();" type="radio" name="field_<?php echo $nextItem; ?>" value="1" id="<?php echo $nextItem; ?>2" <?php if( $custom[ $nextItem ][0] == 1 ) echo 'checked="checked"'; ?>>
					Yes
				</label>
				<label>
					<input onclick="jQuery('#<?php echo $nextItem; ?>').hide();" type="radio" name="field_<?php echo $nextItem; ?>" value="-1" id="<?php echo $nextItem; ?>1" <?php if( !$custom[ $nextItem ][0] || $custom[ $nextItem ][0] == -1 ) echo 'checked="checked"'; ?>>
					No
				</label>
				<span class="howto">Select if you'd like to include video when sharing this post</span>
			</td>
		</tr>
	</tbody>
</table>

<div id="<?php echo $nextItem; ?>" style="display: <?php if( $custom[ $nextItem ][0] == 1 ) echo 'block'; else echo 'none'; ?>; ">
	<table class="form-table">
		<tbody>
			<?php $nextItem = 'video_url'; ?>
			<tr>
				<th>
					
				</th>
				<td>
					<input type="text" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" id="<?php echo $nextItem; ?>" class="widefat">
					<span class="howto">e.g., http://example.com/awesome.swf. Facebook supports embedding video 
					in SWF format only. You must include a valid <strong>Preview Image</strong> for your video to be 
					displayed in the news feed.</span>
				</td>
			</tr>
			<tr>
				<?php $nextItem = 'video_fb_width'; ?>
				<th>
					<label for="<?php echo $nextItem; ?>">Video Width:</label>
				</th>
				<td>
					<input type="text" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" id="<?php echo $nextItem; ?>" class="widefat">
					<span class="howto">e.g. "385" (max 398)</span>
				</td>
			</tr>
			<tr>
				<?php $nextItem = 'video_fb_height'; ?>
				<th>
					<label for="<?php echo $nextItem; ?>">Video Height:</label>
				</th>
				<td>
					<input type="text" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" id="<?php echo $nextItem; ?>" class="widefat">
					<span class="howto">e.g. "400" (max 460)</span>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<table class="form-table">
	<tbody>
		<tr>
			<?php $nextItem = 'use_audio'; ?>
			<th>
				<label for="<?php echo $nextItem; ?>1">Post Audio:</label>
			</th>
			<td>
				<label>
					<input onclick="jQuery('#<?php echo $nextItem; ?>').show();" type="radio" name="field_<?php echo $nextItem; ?>" value="1" id="<?php echo $nextItem; ?>2" <?php if( $custom[ $nextItem ][0] == 1 ) echo 'checked="checked"'; ?>>
					Yes
				</label>
				<label>
					<input onclick="jQuery('#<?php echo $nextItem; ?>').hide();" type="radio" name="field_<?php echo $nextItem; ?>" value="-1" id="<?php echo $nextItem; ?>1" <?php if( !$custom[ $nextItem ][0] || $custom[ $nextItem ][0] == -1 ) echo 'checked="checked"'; ?>>
					No
				</label>
				<span class="howto">Select if you'd like to include audio when sharing this post</span>
			</td>
		</tr>
	</tbody>
</table>

<div id="<?php echo $nextItem; ?>" style="display: <?php if( $custom[ $nextItem ][0] == 1 ) echo 'block'; else echo 'none'; ?>; ">
	<table class="form-table">
		<tbody>
			<tr>
				<?php $nextItem = 'audio_url'; ?>
				<th>
					<label for="<?php echo $nextItem; ?>">Audio Url:</label>
				</th>
				<td>
					<input type="text" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" id="<?php echo $nextItem; ?>" class="widefat">
					<span class="howto">e.g., http://example.com/amazing.mp3</span>
				</td>
			</tr>
			<tr>
				<?php $nextItem = 'audio_title'; ?>
				<th>
					<label for="<?php echo $nextItem; ?>">Audio Title:</label>
				</th>
				<td>
					<input type="text" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" id="<?php echo $nextItem; ?>" class="widefat">
					<span class="howto">e.g. "Amazing Soft Rock Ballad"</span>
				</td>
			</tr>
			<tr>
				<?php $nextItem = 'audio_artist'; ?>
				<th>
					<label for="<?php echo $nextItem; ?>">Audio Artist:</label>
				</th>
				<td>
					<input type="text" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" id="<?php echo $nextItem; ?>" class="widefat">
					<span class="howto">e.g. "Amazing Band"</span>
				</td>
			</tr>
			<tr>
				<?php $nextItem = 'audio_album'; ?>
				<th>
					<label for="<?php echo $nextItem; ?>">Audio Album:</label>
				</th>
				<td>
					<input type="text" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" id="<?php echo $nextItem; ?>" class="widefat">
					<span class="howto">e.g. "Amazing Album"</span>
				</td>
			</tr>

		</tbody>
	</table>
</div>

<?php $nextItem = 'video_type'; ?>
<input type="hidden" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" /> <!-- application/x-shockwave-flash -->

<?php $nextItem = 'audio_type'; ?>
<input type="hidden" name="field_<?php echo $nextItem; ?>" value="<?php echo $custom[ $nextItem ][0]; ?>" /> <!-- application/mp3 -->