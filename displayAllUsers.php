<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <script type= "text/javascript" src = "JS/countries.js"></script>
    </head>	
	<?php include('PreCode/header.php'); ?>
	<h2>List of All Users</h2>
	<table align="center" border="1">
		<tbody>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
		<?php
			$profileInfo = $loginObj->getAllUsers();
			if (count($profileInfo) > 0) {
				for($row = 0; $row < count($profileInfo); $row++){
					echo "<tr><td>" . $profileInfo[$row]['firstname'] . "</td>" .
						 "<td>" . $profileInfo[$row]['lastname'] . "</td>" .
						 "<td>" . $profileInfo[$row]['email'] . "</td></tr>";
				}
			}
		?>
		</tbody>
	</table>
</section>

</body>
</html>