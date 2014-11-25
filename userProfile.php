<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <script type= "text/javascript" src = "JS/countries.js"></script>
    </head>	
	<?php 
		include('PreCode/header.php');
		require('authentication.php');
	?>
	<form name="buttons" method="POST" action="">
		<input name="editProfile" type="submit" value="Edit Profile" />
		<input name="changePass" type="submit" value="Change Password" />
		<input name="deactivate" type="submit" value="Deactivate My Account" />
		<?php 
			  if(strcmp($range, "Admin") === 0){
		?>
		<input name="displayAll" type="submit" value="Display All Users" />
		<?php } ?>
	</form>
	<form name="updateProfile" method="POST" action="">
	<table align="center">
		<tbody>
		<?php
			if(isset($_POST['update'])){
				$loginObj->updateProfile($_POST);
			}
			if(isset($_POST['resetPass'])){
				$old = $_POST['oldPass'];
				$new = $_POST['newPass'];
				$newConfirm = $_POST['confirmNewPass'];
				$loginObj->resetPassword($old, $new, $newConfirm);
			}
			if(isset($_POST['editProfile'])){
				$profileInfo = $loginObj->getUsersProfileInfo();
				if (count($profileInfo) > 0) {
					for($row = 0; $row < count($profileInfo); $row++){
						echo "<h2>User Profile</h2>";
						echo "<tr><td>First Name</td>" . "<td><input name='firstname' type='text' value='" 	. $profileInfo[$row]['firstname'] ."'></td></tr>" .
							 "<tr><td>Last Name</td>"  . "<td><input name='lastname' type='text' value='" 	. $profileInfo[$row]['lastname']  ."'></td></tr>" .
							 "<tr><td>Email</td>" 	   . "<td><input name='email' type='text' value='" 		. $profileInfo[$row]['email'] 	  ."'></td></tr>" .
							 "<tr><td>Username</td>"   . "<td><input name='username' type='text' value='" 	. $profileInfo[$row]['username']  ."'></td></tr>" .
							 "<tr><td>Phone Num</td>"  . "<td><input name='phoneNum' type='text' value='" 	. $profileInfo[$row]['phoneNumber']  ."'></td></tr>" .
							 "<tr><td></td>"   		   . "<td><input name='update' type='submit' value='Save Changes'></td></tr>";
					}
				}
			} elseif (isset($_POST['changePass'])) {
		?>
				<h2>Reset Password</h2>
				<form name="changePass" method="POST" action="">
					<input name="oldPass" type="password" placeholder="Old Password" required /><br>
					<input name="newPass" type="password" placeholder="New Password" required /><br>
					<input name="confirmNewPass" type="password" placeholder="Confirm New Password" required /><br>
					<input name="resetPass" type="submit" value="Reset">
				</form>
		<?php 
			} elseif (isset($_POST['displayAll'])) {
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
								echo "<tr><td>" . $profileInfo[$row]['firstname'] . "</td>" .
									 "<td>" . $profileInfo[$row]['lastname'] . "</td>" .
									 "<td>" . $profileInfo[$row]['username'] . "</td>" .
									 "<td>" . $profileInfo[$row]['email'] . "</td>" . 
									 "<td>" . $profileInfo[$row]['rangeType'] . "</td>";
					?>
									<form name="deleteApart" method="POST" action="">
										<input name="hiddenID" type="hidden" value="<?php echo $profileInfo[$row]['user_id']; ?>" />
										<td>
											<input name='edit' type='submit' value='Edit' />
											<input name='deactivateUser' type='submit' value='Deactivate' />
											<input name='banUser' type='submit' value='Ban' />
										</td>
									</form>
					<?php
							}
						}
					?>
					</tbody>
				</table>
	<?php 
			} elseif (isset($_POST['deactivate'])) {
				$loginObj->deactivateAccount();
			} elseif (isset($_POST['deactivateUser'])) {
				$adminObj->deleteUser($_POST['hiddenID']);
			} elseif (isset($_POST['banUser'])) {
				$profileInfo = $loginObj->getUserById($_POST['hiddenID']);
				if (count($profileInfo) > 0) {
					for($row = 0; $row < count($profileInfo); $row++){
						echo "<h2>Ban User</h2>";
						echo "<tr><td>First Name</td>" . "<td><input name='firstname' type='text' value='" 	. $profileInfo[$row]['firstname'] ."'></td></tr>" .
							 "<tr><td>Last Name</td>"  . "<td><input name='lastname' type='text' value='" 	. $profileInfo[$row]['lastname']  ."'></td></tr>" .
							 "<tr><td>Username</td>"   . "<td><input name='username' type='text' value='" 	. $profileInfo[$row]['username']  ."'></td></tr>" .
							 "<tr><td>Description</td>". "<td><textarea name='description' type='text' ></textarea></td></tr>" .
							 "<input type='hidden' name='hiddenUserId' value='" . $profileInfo[$row]['user_id'] . "'>" . 
							 "<tr><td></td>"   		   . "<td><input name='ban' type='submit' value='Ban this user'></td></tr>";
					}
				}
			} elseif (isset($_POST['ban'])) {
				$adminObj->banUser($_POST['hiddenUserId'], $_POST['description']);
			}
	?>
		</tbody>
	</table>
	</form>
</section>

</body>
</html>