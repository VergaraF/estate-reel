<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <link rel="stylesheet" type="text/css" href="CSS/userManagementLayout.css">
        <script type= "text/javascript" src = "JS/countries.js"></script>
    </head>	
	<?php include('header.php'); ?>
	<h2>User Profile</h2>
	<table align="center" border="1">
		<tbody>
		<?php
			$profileInfo = $loginObj->getUsersProfileInfo();
			if (count($profileInfo) > 0) {
				for($row = 0; $row < count($profileInfo); $row++){
					echo "<tr><td>First Name</td><td>" . $profileInfo[$row]['firstname'] . "</td></tr>" .
						 "<tr><td>Last Name</td><td>" . $profileInfo[$row]['lastname'] . "</td></tr>" .
						 "<tr><td>Email</td><td>" . $profileInfo[$row]['email'] . "</td></tr>" . 
						 "<tr><td>Username</td><td>" . $profileInfo[$row]['username'] . "</td></tr>";
				}
			}
		?>
		</tbody>
	</table>
</section>
</body>
</html>