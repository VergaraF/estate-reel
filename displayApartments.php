<html>
<head>
	<title>Products</title>
</head>
<body>
<h1>Here is the List Of Apartment Info</h1>
<?php 
	require_once('createDatabase.php');
	if(isset($_POST['delete'])){
		$intId = $_POST['something'];
		$deleteApartment = "DELETE FROM address WHERE addressId = '$intId'";
		$deleteTrue = mysqli_query($conn, $deleteApartment);

		if($deleteTrue === TRUE){
			echo "apartment deleted";
		}else{
			echo "could not delete apartment";
		}
	}

	$selectAll = "SELECT * FROM address";
	$done = mysqli_query($conn, $selectAll);
?>
	<table border="1">
		<tbody>
			<tr>
				<th>ID</th>
				<th>House no.</th>
				<th>Street Name</th>
				<th>City</th>
				<th>Province</th>
				<th>Zip</th>
				<th>Country</th>
				<th>Type</th>
			</tr>
			<?php
				if ($done->num_rows > 0) {
					// output data of each row
					while($row = $done->fetch_assoc()) {
						echo "<tr>";
						echo "<td>". $row["addressId"] 	 . "</td>" .
							 "<td>". $row["house_no"] 	 . "</td>" .
							 "<td>". $row["street_name"] . "</td>" .
							 "<td>". $row["city"] 	 	 . "</td>" .
							 "<td>". $row["province"] 	 . "</td>" .
							 "<td>". $row["zip_code"] 	 . "</td>" .
							 "<td>". $row["country"] 	 . "</td>" .
							 "<td>". $row["type"] 		 . "</td>";
						
			?>
						<form name="deleteApart" method="POST" action="">
							<input name="something" type="hidden" value="<?php echo $row['addressId']; ?>" />
							<td><input name='delete' type='submit' value='Delete' /></td>
						</form>
			<?php
						echo "</tr>";
					}
				}
			?>
		</tbody>
	</table>	
</body>
</html>