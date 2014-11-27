<html>
    <head>
        <title>Estate R&eacuteel</title>
         <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
       
    </head>
<?php
	include('PreCode/header.php');
	require('PreCode/authentication.php');
	$databaseObj->createConnection();
	$userId = $loginObj->getUserId();

	if(isset($_POST['delete'])){
		$productObj->deleteProduct($_POST['hiddenID'], $userId);
	}elseif(isset($_POST['edit'])){
		$allResult = $productObj->displaySpecificProduct($_POST['hiddenID']);
?>
		<form name="editForm" method="POST" action="">
		<h2>Edit Form</h2>
		<table align="center">
			<tbody>
				<?php 
					if(count($allResult) > 0){
						for($row = 0; $row < count($allResult); $row++){
							echo "<tr><td>House no</td>" 				. "<td><input name='house_no' type='text' value='" 		. $allResult[$row]['house_no'] 			."'></td></tr>" .
								 "<tr><td>Street name</td>" 			. "<td><input name='street_name' type='text' value='" 	. $allResult[$row]['street_name'] 		."'></td></tr>" .
								 "<tr><td>Apartment no</td>" 			. "<td><input name='apartment_no' type='text' value='" 	. $allResult[$row]['apartment_no'] 		."'></td></tr>" .
								 "<tr><td>City</td>" 					. "<td><input name='city' type='text' value='" 			. $allResult[$row]['city'] 				."'></td></tr>" .
								 "<tr><td>State</td>" 					. "<td><input name='state' type='text' value='" 		. $allResult[$row]['province'] 			."'></td></tr>" .
								 "<tr><td>Country</td>" 				. "<td><input name='country' type='text' value='" 		. $allResult[$row]['country'] 			."'></td></tr>" .
								 "<tr><td>Zip</td>" 					. "<td><input name='zip' type='text' value='" 			. $allResult[$row]['zip_code'] 			."'></td></tr>" .
								 "<tr><td>Type</td>" 					. "<td><input name='range' type='text' value='" 		. $allResult[$row]['type'] 				."'></td></tr>" .
								 "<tr><td>Description</td>" 			. "<td><textarea name='description' type='text' >"		. $allResult[$row]['description'] 		."</textarea></td></tr>" .
								 "<tr><td>Number of Rooms</td>" 		. "<td><input name='rooms' type='number' max='10' min='0' value='" 			. $allResult[$row]['no_of_rooms'] 		."'></td></tr>" .
								 "<tr><td>Number of Bathrooms</td>" 	. "<td><input name='bathrooms' type='number' max='10' min='0' value='" 		. $allResult[$row]['no_of_bathrooms'] 	."'></td></tr>" .
								 "<tr><td>Number of Living Rooms</td>" 	. "<td><input name='living_rooms' type='number' max='10' min='0' value='"	. $allResult[$row]['no_of_living_rooms']."'></td></tr>" .
								 "<tr><td>Price</td>" 					. "<td><input name='price' type='text' value='" 		. $allResult[$row]['price'] 			."'></td></tr>" .
								 "<tr><td>For</td>" 					. "<td><input name='rangeType' type='text' value='" 	. $allResult[$row]['rangeType'] 		."'></td></tr>";
						    echo "<input name='hiddenID' type='hidden' value='" . $allResult[$row]['dwelling_Id'] . "'/>
	                             <td><input name='update' type='submit' value='Update' /></td>";
						}
					}
				?>
			</tbody>
		</table>
	</form>
<?php
	}elseif(isset($_POST['update'])){
		$productObj->insertOrUpdateProduct($_POST);
	}

	$type = $loginObj->getRangeType($_SESSION['USERNAME']);

	$rs = $productObj->displayOwnerProducts($userId);
	
?>
	<h2>List of Apartments/Houses</h2>
	<table id="apt" align="center">
		<tbody>
			<tr>
				<th id="image">Image</th>
				<th id="descr" style="width: 800px;">Description</th>
				<th id="priceH">Price</th>
				<th id="option">Options</th>
			</tr>
		</tbody>
	</table>
			<?php
				if (count($rs) > 0) {
					for($row = 0; $row < count($rs); $row++){
						echo "<table id='apt2' align='center'><tbody>";
						echo "<tr>";
						echo "<td><img id='placeImg' src='apartment_images/" . $rs[$row]['file_name'] . "'/></td>" .
							 "<td style='width: 800px;'>" . $rs[$row]['description'] . "</td>" .
							 "<td>" . $rs[$row]['price'] . "$</td>";
			?>
						<form name="deleteApart" method="POST" action="">
							<input name="hiddenID" type="hidden" value="<?php echo $rs[$row]['dwelling_Id']; ?>" />
							<td>
								<input id='delete' name='delete' type='submit' value='Delete' />
								<input id='edit' name='edit' type='submit' value='Edit' />
							</td>
						</form>
						<form name="showApart" method="GET" action="showDetails.php">
							<td>
								<input name="hiddenID" type="hidden" value="<?php echo $rs[$row]['dwelling_Id']; ?>" />
								<input id='showD' name='showDetail' type='submit' value='Show Details' />
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