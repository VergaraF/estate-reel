<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <script type= "text/javascript" src = "JS/countries.js"></script>
    </head>	
	<?php 
		include('PreCode/header.php'); 
		require('PreCode/authentication.php');
		require('PreCode/accessDeni.php');
	
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
								 "<tr><td>For</td>" 					. "<td><input name='rangeType' type='text' value='" 	. $allResult[$row]['rangeType'] 		."'></td></tr>" .
						    	 "<input name='hiddenID' type='hidden' value='" . $allResult[$row]['dwelling_Id'] . "'/>
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
	}?>

	<form name="options" method="GET" action="">
		  <button id="sort" type="button" onClick="window.location.href='adminPanel.php?action=user'">User management</button>
		  <button id="sort" type="button" onClick="window.location.href='adminPanel.php?action=place'">Place management</button>
	      <button id="sort" type="button" onClick="window.location.href='adminPanel.php?action=conversation'">Conversation management</button>
	</form>

	<?php
		if (isset($_GET['action'])){
			$value = $_GET['action'];
			switch ($value) {
				case 'user':
					?> 
					<h2>List of All Users</h2>
				<table align="center" border="1">
					<tbody>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Range</th>
						<th>Options</th>
					<?php
						$profileInfo = $loginObj->getAllUsers();
						if (count($profileInfo) > 0) {
							for($row = 0; $row < count($profileInfo); $row++){
								if (strcmp($profileInfo[$row]['username'], $_SESSION['USERNAME']) !== 0) {
									echo "<tr><td>" . $profileInfo[$row]['firstname'] . "</td>" .
										 "<td>" . $profileInfo[$row]['lastname'] . "</td>" .
										 "<td>" . $profileInfo[$row]['username'] . "</td>" .
										 "<td>" . $profileInfo[$row]['email'] . "</td>" . 
										 "<td>" . $profileInfo[$row]['rangeType'] . "</td>";
						?>
										<form name="displayUsers" method="POST" action="">
											<input name="hiddenID" type="hidden" value="<?php echo $profileInfo[$row]['user_id']; ?>" />
											<td>
												<input name='editU' type='submit' value='Edit' />
												<input name='deactivateUser' type='submit' value='Deactivate' />
												<?php if (count($loginObj->checkBannedUsers($profileInfo[$row]['user_id'])) === 1) {
													echo "<input name='unbanUser' type='submit' value='Un-Ban' />";
												}else{
												?>
												<input name='banUser' type='submit' value='Ban' />
												<?php } ?>
											</td>
										</form>
					<?php
								}
							}
						}
					?>
					</tbody>
				</table>
				<?php 
			if (isset($_POST['editU'])){
			    $profileInfo = $loginObj->getUserById($_POST['hiddenID']);
				if (count($profileInfo) > 0) {
					for($row = 0; $row < count($profileInfo); $row++){
						echo "<table align='center'><form name='updateProfile' method='POST' action=''>" .
							 "<h2>User Profile</h2>" .
						     "<tr><td>First Name : </td>" . "<td><input name='firstname' type='text' value='" 	. $profileInfo[$row]['firstname'] ."'></td></tr>" .
							 "<tr><td>Last Name : </td>"  . "<td><input name='lastname' type='text' value='" 	. $profileInfo[$row]['lastname']  ."'></td></tr>" .
							 "<tr><td>Email : </td>" 	   . "<td><input name='email' type='text' value='" 		. $profileInfo[$row]['email'] 	  ."'></td></tr>" .
							 "<tr><td>Username : </td>"   . "<td><input name='username' type='text' value='" 	. $profileInfo[$row]['username']  ."'></td></tr>" .
							 "<tr><td>Phone No. : </td>"  . "<td><input name='phoneNum' type='text' value='" 	. $profileInfo[$row]['phoneNumber']  ."'></td></tr>" .
							 "<tr><td>Range : </td><td><select id='urng' name='urng'>" .
                  			 "<option value=" . $profileInfo[$row]['rangeType'] . ">" . $profileInfo[$row]['rangeType'] ."</option>" .
                			 "<option value=" . $adminObj->getOppositeRange($profileInfo[$row]['rangeType']) . ">" . $adminObj->getOppositeRange($profileInfo[$row]['rangeType']) . "</option>" .
                			 "</select></td>" .
                			 "<input type='hidden' name='hiddenUserId' value='" . $profileInfo[$row]['user_id'] . "'>" . 
							 "<tr><td></td><td><input name='updateU' type='submit' value='Save Changes'></td></tr>";
					    echo "</form></table>";
					}
				}
							
			} elseif (isset($_POST['deactivateUser'])) {
				$adminObj->deleteUser($_POST['hiddenID']);
			} elseif (isset($_POST['banUser'])) {
				$profileInfo = $loginObj->getUserById($_POST['hiddenID']);
				if (count($profileInfo) > 0) {
					for($row = 0; $row < count($profileInfo); $row++){
						echo "<table align='center'><form name='updateProfile' method='POST' action=''>";
						echo "<h2>Ban User</h2>";
						echo "<tr><td>First Name</td>" . "<td><input name='firstname' type='text' value='" 	. $profileInfo[$row]['firstname'] ."'></td></tr>" .
							 "<tr><td>Last Name</td>"  . "<td><input name='lastname' type='text' value='" 	. $profileInfo[$row]['lastname']  ."'></td></tr>" .
							 "<tr><td>Username</td>"   . "<td><input name='username' type='text' value='" 	. $profileInfo[$row]['username']  ."'></td></tr>" .
							 "<tr><td>Description</td>". "<td><textarea name='description' type='text' style='width:175px; height:100px;'></textarea></td></tr>" .
							 "<input type='hidden' name='hiddenUserId' value='" . $profileInfo[$row]['user_id'] . "'>" . 
							 "<tr><td></td>"   		   . "<td><input name='ban' type='submit' value='Ban this user'></td></tr>";
						echo "</form></table>";
					}
				}
			} elseif (isset($_POST['ban'])) {
				$adminObj->banUser($_POST['hiddenUserId'], $_POST['description']);
			} elseif (isset($_POST['updateU'])){
				$adminObj->updateUser($_POST);
			} elseif (isset($_POST['unbanUser'])) {
				$adminObj->unBanUser($_POST['hiddenID']);
			}
					break;
				case 'place':

					$rs = $productObj->displayAllProducts();
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
								if (count($rs) > 0) {
									for($row = 0; $row < count($rs); $row++){
										echo "<tr>";
										echo "<td><img style='width:100px;height:100px;' src='apartment_images/" . $rs[$row]['file_name'] . "'/></td>" .
											 "<td>" . $databaseObj->cutDownTheDescription($rs[$row]['description']) . "</td>" .
											 "<td>" . $rs[$row]['price'] . "</td>";
							?>
										<form name="deleteApart" method="POST" action="">
											<input name="hiddenID" type="hidden" value="<?php echo $rs[$row]['dwelling_Id']; ?>" />
											<td>
												<input name='delete' type='submit' value='Delete' />
												<input name='edit' type='submit' value='Edit' />
											</td>
										</form>
										<form name="showApart" method="GET" action="showDetails.php">
											<td>
												<input name="hiddenID" type="hidden" value="<?php echo $rs[$row]['dwelling_Id']; ?>" />
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
				<?php

					break;
				case 'conversation':
					
					?>
					<div id="container">	
						<div id="convo">
							<p>List of conversations</p>
							<table>
								<?php 
									$convoArray = $conversationObj->displayAllConversations();
									for ($row=0; $row < count($convoArray); $row++) {
										$userIdsArray = $conversationObj->getUserIdsForConvo($convoArray[$row]['conversationId']);
										$usernameArray = $conversationObj->getUsernamesForConvo($userIdsArray);

										$username_one = $usernameArray[0];
										$username_two = $usernameArray[1];
								?>
										<form name='conversationDelete' method='POST' action=''>
											<tr><td> <?php echo "<p>" . $username_one . " - " . $username_two . "</p>"?> </td>
											<input type="hidden" name="c_id" value=" <?php echo $convoArray[$row]['conversationId']; ?>">
											<td><input type='submit' name='show' value='show messages'></td>
											<td><input type='submit' name='deleteConvo' value='Delete'></td></tr>
										</form>
							<?php  } ?>
							</table>
						</div>
						<div id="messages">
							<p>List of messages</p>
							<?php  
								if (isset($_POST['show'])) {
									$messages = $conversationObj->displayMessages($_POST['c_id']);
							?>
							<table>
								<?php
									for ($row=0; $row < count($messages); $row++) { 
								?>
										<form name='sendOrDelete' method='POST' action=''>
											<tr>
												<td> <?php echo $loginObj->getUsername($messages[$row]['sender']) . ": " . $messages[$row]['reply_message']; ?> </td>
												<input type="hidden" name="cr_id_toDeleteMessage" value="<?php echo $messages[$row]['cr_id'] ?>">
												<td><input type='submit' name='deleteMess' value='Delete'></td>
											</tr>
										</form>
							  <?php } ?>	
							</table>			
							<?php
									
								}elseif (isset($_POST['deleteMess'])) {
									$conversationObj->deleteMessage($_POST['cr_id_toDeleteMessage']);
								}elseif (isset($_POST['deleteConvo'])) {
									$conversationObj->deleteConversation($_POST['c_id']);
									header("location: adminPanel.php?action=conversation");
								}
							?>
						</div>
					</div>
						</section>
					<style type="text/css">
					#convo{
						position: relative;
						background-color: yellow;
						width: 250px;
						height: 500px;
						display: inline-block;
					}
					#messages{
						position: relative;
						background-color: red;
						width: 500px;
						height: 500px;
						display: inline-block;
					}
					#container{
						margin-top: 10px;
						display: inline-block;
					}
					</style>
					<?php

					break;
				
				default:
					# code...
					break;
			}

		}else{
	?> 		<p>Please choose an option you want to perform from the button above</p>
	<?php
		}
	?>
	</section>

</body>
</html>