<?php 
	//including and requiring files
	require('authentication.php');
	require_once('connect.php');
	include('loggedOn.php');

	//this if and else statements are executed when the user clicks delete or edit 
	if(isset($_POST['delete'])){
		$deleteApartment = "DELETE FROM apartment_house WHERE apartment_houseId = '" . $_POST['hiddenID'] . "'";
		$deleteTrue = mysqli_query($conn, $deleteApartment);
	}elseif(isset($_POST['edit'])){
		header("location: editApartment.php");
	}

	$userId = $obj->getUserId();

	//the following rs (resultSet) will display all the apartment for a specific user
	$rs = $obj->getResultSetOf("SELECT * FROM apartment_house WHERE user_id = '" . $userId . "'");
?>
	<h2>List of Apartments/Houses</h2>
	<table border="1" align="center">
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
				<th>Option</th>
			</tr>
			<?php
				if ($rs->num_rows > 0) {
					while($row = $rs->fetch_assoc()) {
						echo "<tr>";
						echo "<td>". $row["apartment_houseId"] 	 . "</td>" .
							 "<td>". $row["house_no"] 	 . "</td>" .
							 "<td>". $row["street_name"] . "</td>" .
							 "<td>". $row["city"] 	 	 . "</td>" .
							 "<td>". $row["province"] 	 . "</td>" .
							 "<td>". $row["zip_code"] 	 . "</td>" .
							 "<td>". $row["country"] 	 . "</td>" .
							 "<td>". $row["type"] 		 . "</td>";
						
			?>
						<form name="deleteApart" method="POST" action="">
							<input name="hiddenID" type="hidden" value="<?php echo $row['apartment_houseId']; ?>" />
							<td>
								<input name='delete' type='submit' value='Delete' />
								<input name='edit' type='submit' value='Edit' />
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