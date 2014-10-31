<html>
<head>
	<title>Edit Form</title>
</head>
<body>
	<?php
		require('authentication.php');
		require('connect.php');
		include('loggedOn.php');
		//inner join table address and apartment using addressId
		//store the result into variables and then display them in edit form
		
	?>

	<h2>Edit Apartment Info</h2>
	<form>
		<table align="center">
			<tr>
				<td>House Number</td>
				<td><input name="house_no" type="text" value="<?php echo ""; ?>" ></td>
			</tr>
			<tr>
				<td>Street Name</td>
				<td><input name="street_name" type="text" value="<?php echo ""; ?>" ></td>
			</tr>
			<tr>
				<td>City</td>
				<td><input name="city" type="text" value="<?php echo ""; ?>" ></td>
			</tr>
			<tr>
				<td>Country</td>
				<td><input name="country" type="text" value="<?php echo ""; ?>" ></td>
			</tr>
			<tr>
				<td>Province</td>
				<td><input name="state" type="" value="<?php echo ""; ?>" ></td>
			</tr>
			<tr>
				<td>Apartment Number</td>
				<td><input name="apart_no" type="text" value="<?php echo ""; ?>" ></td>
			</tr>
			<tr>
				<td>Zip</td>
				<td><input name="zip" type="text" value="<?php echo ""; ?>" ></td>
			</tr>
			<tr>
				<td>Type</td>
				<td><input name="type" type="text" value="<?php echo ""; ?>" ></td>
			</tr>
			<tr>
				<td>Description</td>
				<td><input name="desc" type="text" value="<?php echo ""; ?>" ></td>
			</tr>
			<tr>
				<td>Rooms</td>
				<td><input name="rooms" type="number" value="<?php echo ""; ?>" ></td>
			</tr>
			<tr>
				<td>Bathrooms</td>
				<td><input name="baths" type="number" value="<?php echo ""; ?>" ></td>
			</tr>
			<tr>
				<td>Living Rooms</td>
				<td><input name="livingRooms" type="number" value="<?php echo ""; ?>" ></td>
			</tr>
			<tr>
				<td>Price</td>
				<td><input name="price" type="text" value="<?php echo ""; ?>" ></td>
			</tr>
		</table>
	</form>
</body>
</html>