<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <script type= "text/javascript" src = "JS/countries.js"></script>
    </head>	
	<?php 
		include('PreCode/header.php');
		require('PreCode/authentication.php');
	?>
	<form name="buttons" method="POST" action="">
		<input id="sort" name="editProfile" type="submit" value="Edit Profile" />
		<input id="sort" name="changePass" type="submit" value="Change Password" />
		<input id="sort" name="deactivate" type="submit" value="Deactivate My Account" />

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
							 "<tr><td></td>"   		   . "<td><input id='sort' name='update' type='submit' value='Save Changes'></td></tr>";
					}
				}
			} elseif (isset($_POST['changePass'])) {
		?>
				<h2>Reset Password</h2>
				<form name="changePass" method="POST" action="">
					<input name="oldPass" type="password" placeholder="Old Password" required /><br>
					<input name="newPass" type="password" placeholder="New Password" required /><br>
					<input name="confirmNewPass" type="password" placeholder="Confirm New Password" required /><br>
					<input id="sort" name="resetPass" type="submit" value="Reset">
				</form>
		
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
							 "<tr><td></td>"   		   . "<td><input id='ssort' name='ban' type='submit' value='Ban this user'></td></tr>";
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