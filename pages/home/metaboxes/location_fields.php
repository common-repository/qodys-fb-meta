<?php 
$lat 		= $this->get_option( 'lat' );
$lon 		= $this->get_option( 'lon' );
$address 	= $this->get_option( 'address' );
$city 		= $this->get_option( 'city' );
$state 		= $this->get_option( 'state' );
$zipcode	= $this->get_option( 'zipcode' );
$country 	= $this->get_option( 'country' );
?>

<table class="form-table">
	<tbody>
		<tr>
			<th>
				<label for="lat">Latitude:</label>
			</th>
			<td>
				<input type="text" name="lat" value="<?php echo $lat; ?>" id="lat" class="widefat">
				<span class="howto">e.g., 37.416343</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="lon">Longitude:</label>
			</th>
			<td>
				<input type="text" name="lon" value="<?php echo $lon; ?>" id="lon" class="widefat">
				<span class="howto">e.g., -122.153013</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="address">Address:</label>
			</th>
			<td>
				<input type="text" name="address" value="<?php echo $address; ?>" id="address" class="widefat">
				<span class="howto">e.g., 1601 S California Ave</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="city">Locality / City:</label>
			</th>
			<td>
				<input type="text" name="city" value="<?php echo $city; ?>" id="city" class="widefat">
				<span class="howto">e.g., Palo Alto</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="state">Region / State:</label>
			</th>
			<td>
				<input type="text" name="state" value="<?php echo $state; ?>" id="state" class="widefat">
				<span class="howto">e.g., CA</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="zipcode">Zipcode:</label>
			</th>
			<td>
				<input type="text" name="zipcode" value="<?php echo $zipcode; ?>" id="zipcode" class="widefat">
				<span class="howto">e.g., 94304</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="country">Country:</label>
			</th>
			<td>
				<input type="text" name="country" value="<?php echo $country; ?>" id="country" class="widefat">
				<span class="howto">e.g., USA</span>
			</td>
		</tr>
		
	</tbody>
</table>