<?php 
	session_start();
	
	//include('oopClass.php');
	require_once('createDatabase.php');

	if(isset($_POST["createAccount"])){
		$obj = new Myclass();
		$passwordLength = 8;
		$firstName = $_POST["firstName"];
		$lastName = $_POST["lastName"];
		$email = $_POST["email"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$confirmPass = $_POST["cPassword"];
		$type = $_POST['range'];

		if($obj->checkLength($password, $passwordLength) === false){
			$obj->printMessage("MESSAGE", "At least $passwordLength characters are required for the password!", "signUp.php");
		}

		$verifyUsername = "SELECT * FROM users WHERE username = '$username'";
		//$result = mysqli_query($conn, $verifyUser); this does not work for some reason
		$res = $conn->query($verifyUsername);
		if(strcmp($password, $confirmPass) === 0){
			if(mysqli_num_rows($res) == 0){
				$salt = hash('sha256', uniqid(mt_rand(), true) . $password . strtolower($username));
				$pass = crypt($password, $salt);
				$newUser = "INSERT INTO users VALUES (DEFAULT, '$firstName', '$lastName', 
									'$email', '$username', '$pass', '$salt', '$type')";
				$obj->insertUser($newUser);
				$conn->close();
			}else{
				$obj->printMessage("MESSAGE", "The username is already taken! please take another one", "signUp.php");
			}
		}else{
			$obj->printMessage("MESSAGE", "The password confirmation failed! Please try again", "signUp.php");
		}
	}
?>
<?php
	include('header.php');
	if(isset($_SESSION['MESSAGE'])) {
		echo $_SESSION['MESSAGE'];
		unset($_SESSION['MESSAGE']);
	}
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