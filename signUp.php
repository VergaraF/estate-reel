<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/userManagementLayout.css">
    </head>
<?php 
	include('header.php');
	$databaseObj->createConnection();
	//this if statement is executed when the user click on Create Account
	if(isset($_POST["createAccount"])){
		$passwordLength = 8;
		$firstName 	 = $_POST["firstName"];
		$lastName 	 = $_POST["lastName"];
		$email 		 = $_POST["email"];
		$username 	 = $_POST["username"];
		$password 	 = $_POST["password"];
		$confirmPass = $_POST["cPassword"];
		$type 		 = $_POST['range'];

		//matching the passwords (IT SHOULD BE DONE ON CLIENT SIDE)
		if($loginObj->checkLength($password, $passwordLength) === false){
			$databaseObj->printMessage("MESSAGE", "At least $passwordLength characters are required for the password!", "signUp.php");
		}
		$res = $databaseObj->getResultSetAsArray("SELECT * FROM users WHERE username = '$username'");

		//this if statement executes when the passwords are identical
		if(strcmp($password, $confirmPass) === 0){
			if(count($res) == 0){
				$salt = $loginObj->generateSalt($password, $username);
				$pass = $loginObj->hashPassword($password, $salt);
				$newUser = "INSERT INTO users VALUES (DEFAULT, '$firstName', '$lastName', 
									'$email', '$username', '$pass', '$salt', '$type')";
				$loginObj->insertUser($newUser);
				$databaseObj->closeConnection();
			}else{
				$databaseObj->printMessage("MESSAGE", "The username is already taken! please take another one", "signUp.php");
			}
		}else{
			$databaseObj->printMessage("MESSAGE", "The password confirmation failed! Please try again", "signUp.php");
		}
	}
?>
<?php
	$loginObj->displayMessage();
?>
	<form name="signUp" method="POST" action="">
		<input name="firstName" type="text" id="firstN" placeholder="First Name" required/><br>
		<input name="lastName" type="text" id="lastN" placeholder="Last Name" required/><br>
		<input name="email" type="email" id="email" placeholder="Email" required/><br>
		<input name="username" type="text" id="usn" placeholder="Username" required/><br>
		<input name="password" type="password" id="pwd" placeholder="Password" required/><br>
		<input name="cPassword" type="password" id="cpwd" placeholder="Confirm Password" required/><br>
	<label>Type: </label>
		<input name="range" type="radio" value="Owner">Owner</input>
		<input name="range" type="radio" value="Tenant">Tenant</input>
		<input name="range" type="radio" value="Landlord">Landlord</input><br>
	<input name="createAccount" type="submit" id="createAcc" value="Create Account"/>
	</form><address>Author: Ajmer Singh Gadreh AND Fabian Vergara</address>
	</section>	
</body>
</html>