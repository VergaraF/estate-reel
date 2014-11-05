<!--THIS IS THE MAIN FILE!! IT DOES DELETE, EDIT, AND DISPLAY SPECIFIC APARTMENTS FOR A SPECIFIC USER -->
<?php 
	//including and requiring files
	require('authentication.php');
	require_once('connect.php');
	include('loggedOn.php');

	//this if and else statements are executed when the user clicks delete or edit 
	//DON NOT FORGET TO DELETE IMAGES FROM THE FOLDER
	if(isset($_POST['delete'])){
		$deleteImages = "DELETE FROM apartment_images WHERE apartment_houseId = '" . $_POST['hiddenID'] . "'";
		$deleteApartment = "DELETE FROM apartment_house WHERE apartment_houseId = '" . $_POST['hiddenID'] . "'";
		mysqli_query($conn, $deleteImages);
		mysqli_query($conn, $deleteApartment);
	}elseif(isset($_POST['edit'])){
		//header("location: editApartment.php");
		$selectAllInfo = "SELECT * FROM apartment_house WHERE apartment_houseId = '" . $_POST['hiddenID'] . "'";
		$allResult = $obj->getResultSetOf($selectAllInfo);
?>
		<table align="center">
			<tbody>
				<?php 
					if($allResult->num_rows > 0){
						while($row = $allResult->fetch_assoc()){
							echo "<tr>";
							echo "<tr><td>House no</td>" 				. "<td><input name='house_no' type='text' value='" 		. $row['house_no'] 			."'></td></tr>" .
								 "<tr><td>Street name</td>" 			. "<td><input name='street_name' type='text' value='" 	. $row['street_name'] 		."'></td></tr>" .
								 "<tr><td>City</td>" 					. "<td><input name='city' type='text' value='" 			. $row['city'] 				."'></td></tr>" .
								 "<tr><td>State</td>" 					. "<td><input name='province' type='text' value='" 		. $row['province'] 			."'></td></tr>" .
								 "<tr><td>Country</td>" 				. "<td><input name='country' type='text' value='" 		. $row['country'] 			."'></td></tr>" .
								 "<tr><td>Zip</td>" 					. "<td><input name='zip' type='text' value='" 			. $row['zip_code'] 			."'></td></tr>" .
								 "<tr><td>Description</td>" 			. "<td><input name='description' type='text' value='" 	. $row['description'] 		."'></td></tr>" .
								 "<tr><td>Number of Rooms</td>" 		. "<td><input name='room_no' type='text' value='" 		. $row['no_of_rooms'] 		."'></td></tr>" .
								 "<tr><td>Number of Bathrooms</td>" 	. "<td><input name='bath_no' type='text' value='" 		. $row['no_of_bathrooms'] 	."'></td></tr>" .
								 "<tr><td>Number of Living romms</td>" 	. "<td><input name='living_room_no' type='text' value='". $row['no_of_living_rooms']."'></td></tr>" .
								 "<tr><td>Price</td>" 					. "<td><input name='price' type='text' value='" 		. $row['price'] 			."'></td></tr>";
							echo "</tr>";
						}
					}
				?>
			</tbody>
		</table>
<?php
	}

	$userId = $obj->getUserId();
	$rs = $obj->getResultSetOf("SELECT * FROM apartment_house INNER JOIN apartment_images 
								ON apartment_house.apartment_houseId = apartment_images.apartment_houseId
								WHERE apartment_house.user_id = $userId
								GROUP BY apartment_house.apartment_houseId");
?>
	<h2>List of Apartments/Houses</h2>
	<table border="1" align="center">
		<tbody>
			<tr>
				<th>Image</th>
				<th>Description</th>
				<th>Price</th>
				<th>Options</th>
			</tr>
			<?php
				if ($rs->num_rows > 0) {
					while($row = $rs->fetch_assoc()) {
						echo "<tr>";
						echo "<td><img style='width:100px;height:100px;' src='apartment_images/" . $row['file_name'] . "'/></td>" .
							 "<td>" . $row['description'] . "</td>" .
							 "<td>" . $row['price'] . "</td>";
			?>
						<!-- this form is used to delete or edit a specific apartment/house -->
						<form name="deleteApart" method="POST" action="">
							<input name="hiddenID" type="hidden" value="<?php echo $row['apartment_houseId']; ?>" />
							<td>
								<input name='delete' type='submit' value='Delete' />
								<input name='edit' type='submit' value='Edit' />
								<input name='showDetail' type='submit' value='Show Details' />
							</td>
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