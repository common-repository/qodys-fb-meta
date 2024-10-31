<?php 
$email 	= $this->get_option( 'email' );
$phone	= $this->get_option( 'phone' );
$fax 	= $this->get_option( 'fax' );
?>

<table class="form-table">
	<tbody>
		<tr>
			<th>
				<label for="email">Email:</label>
			</th>
			<td>
				<input type="text" name="email" value="<?php echo $email; ?>" id="email" class="widefat">
				<span class="howto">e.g., me@example.com</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="phone">Phone #:</label>
			</th>
			<td>
				<input type="text" name="phone" value="<?php echo $phone; ?>" id="phone" class="widefat">
				<span class="howto">e.g., 650-123-4567</span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="fax">Fax #:</label>
			</th>
			<td>
				<input type="text" name="fax" value="<?php echo $fax; ?>" id="fax" class="widefat">
				<span class="howto">e.g., +1-415-123-4567</span>
			</td>
		</tr>
		
	</tbody>
</table>