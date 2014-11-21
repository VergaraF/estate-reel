<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <script type= "text/javascript" src = "JS/countries.js"></script>
    </head>	
	<?php include('PreCode/header.php'); ?>
	<h2>Reset Password</h2>
	<form name="changePass" method="POST" action="">
		<input name="oldPass" type="password" placeholder="Old Password" required /><br>
		<input name="newPass" type="password" placeholder="New Password" required /><br>
		<input name="confirmNewPass" type="password" placeholder="Confirm New Password" required /><br>
		<input name="resetPass" type="submit" value="Reset">
	</form>
	<?php 
		if(isset($_POST['resetPass'])){
			$old = $_POST['oldPass'];
			$new = $_POST['newPass'];
			$newConfirm = $_POST['confirmNewPass'];
			$loginObj->resetPassword($old, $new, $newConfirm);
		}
	?>
</section>

</body>
</html>