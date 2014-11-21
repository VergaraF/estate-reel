<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <script type= "text/javascript" src = "JS/countries.js"></script>
    </head>	
	<?php include('PreCode/header.php'); ?>
	<h2>User Profile</h2>
	<button type="button" onClick="window.location.href='changePassword.php'">Change Password</button>
	<button type="button" onClick="window.location.href='displayAllUsers.php'">DisplayAllProfiles</button>
	<form name="updateProfile" method="POST" action="">
	<table align="center">
		<tbody>
		<?php
			if(isset($_POST['update'])){
				$loginObj->updateProfile($_POST);
			}
			$profileInfo = $loginObj->getUsersProfileInfo();
			if (count($profileInfo) > 0) {
				for($row = 0; $row < count($profileInfo); $row++){
					echo "<tr><td>First Name</td>" . "<td><input name='firstname' type='text' value='" 	. $profileInfo[$row]['firstname'] ."'></td></tr>" .
						 "<tr><td>Last Name</td>"  . "<td><input name='lastname' type='text' value='" 	. $profileInfo[$row]['lastname']  ."'></td></tr>" .
						 "<tr><td>Email</td>" 	   . "<td><input name='email' type='text' value='" 		. $profileInfo[$row]['email'] 	  ."'></td></tr>" .
						 "<tr><td>Username</td>"   . "<td><input name='username' type='text' value='" 	. $profileInfo[$row]['username']  ."'></td></tr>" .
						 "<tr><td></td>"   		   . "<td><input name='update' type='submit' value='Save Changes'></td></tr>";
				}
			}
		?>
		</tbody>
	</table>
	</form>
</section>

</body>
</html>