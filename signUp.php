<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/userManagementLayout.css">
        <script type="text/javascript" src="JS/validations.js"></script>
    </head>
<?php 
	include('PreCode/header.php');
	$databaseObj->createConnection();
	if(isset($_POST['username'])){
		$loginObj->processSignupForm($_POST);
	}
	$loginObj->displayMessage();
?>
	<form id="signUp" name="signUp" method="POST" action="signUp.php">
		<input name="firstName" type="text" id="firstN" placeholder="First Name" required/>
		<input name="lastName" type="text" id="lastN" placeholder="Last Name" required/>
		<input name="email" type="email" id="email" placeholder="Email" required/><br>
		<input name="username" type="text" id="usn" placeholder="Username" onchange="validateUsername(this, 5)" required/><br>
		<input name="password" type="password" id="pwd" placeholder="Password" onchange="checkPassword(this)" required/><br>
		<input name="cPassword" type="password" id="cpwd" placeholder="Confirm Password" 
			   onchange="comparePasswords(document.getElementById('pwd'), this)" required/><br>
	<label>Type: </label>
		<input name="range" type="radio" value="Owner" required>Owner</input>
		<input name="range" type="radio" value="Tenant">Tenant</input>
		<input name="range" type="radio" value="Landlord">Landlord</input><br>
		<input name="phoneNum" type="text" id="pnum" placeholder="Phone number (514 555 5555)" onchange="phoneNumber(this)" required/>
	<input name="createAccount" type="submit" id="createAcc" onclick="return validateSignupForm()" value="Create Account"/>
	</form>
	</section>	
</body>
</html>