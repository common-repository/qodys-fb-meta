<?php 
$site_type			= $this->get_option( 'site_type', true );
$site_name 			= $this->get_option( 'site_name', true );
$admins 			= $this->get_option( 'admins', true );
$app_id 			= $this->get_option( 'app_id', true );
$site_description 	= $this->get_option( 'site_description', true );

$preview_image 		= $this->get_option( 'preview_image' );

$types = $this->Owner()->GetContentTypes();
?>

<p style="text-align:center;"><strong>For the best & most reliable results, disable all other Facebook open-graph / meta plugins</strong></p>

<table class="form-table">
	<tbody>
		<!--<tr>
			<th>
				<label for="html_change">
					<strong>Important!</strong> - change the <strong><?php echo htmlentities('<html>'); ?></strong> tag in your template's header.php to this:
				</label>
			</th>
			<td>
				<input type="text" onclick="this.select()" id="html_change" readonly="readonly" class="widefat" value='<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">'>
				<span class="howto">Without this change, the FB meta might not work.</span>
			</td>
		</tr>-->
		<tr>
			<th>
				<label for="site_type">Website Type:</label>
			</th>
			<td>
				<select id="site_type" name="site_type">
					
					<?php
					foreach( $types as $key => $value )
					{ ?>
					<optgroup label="<?php echo $key; ?>">
						<?php
						foreach( $value as $key2 => $value2 )
						{
							if( $value2 == $site_type )
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
				<span class="howto">The main category of content found on this site</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="site_name">Website Name:</label>
			</th>
			<td>
				<input type="text" name="site_name" value="<?php echo $site_name; ?>" id="site_name" class="widefat">
				<span class="howto">A human-readable name for your site, e.g., "IMDb".</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="site_description">Website Description:</label>
			</th>
			<td>
				<textarea name="site_description" id="site_description" class="widefat"><?php echo $site_description; ?></textarea>
				<span class="howto">A one to two sentence description of your website.</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="preview_image">Default Preview Image:</label>
			</th>
			<td>
				<input type="text" name="preview_image" value="<?php echo $preview_image; ?>" id="preview_image" class="widefat">
				<span class="howto">An image URL which should represent your content. The image must be at 
				least 50px by 50px and have a maximum aspect ratio of 3:1. Supported extensions are PNG, JPEG and GIF.  
				This image is used when post-specific images aren't available.</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="admins">Website Administrators:</label>
			</th>
			<td>
				<input type="text" name="admins" value="<?php echo $admins; ?>" id="admins" class="widefat">
				<span class="howto">An optional comma-separated list of Facebook user IDs who administer this site.</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="app_id">FB Application ID (extra):</label>
			</th>
			<td>
				<input type="text" name="app_id" value="<?php echo $app_id; ?>" id="app_id" class="widefat">
				<span class="howto">An optional Facebook application ID to hook into this site for stats/whatnot.</span>
			</td>
		</tr>

	</tbody>
</table>