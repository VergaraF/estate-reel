	<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/userManagementLayout.css">
    </head>
		<?php
			include('header.php');
			unset($_SESSION['USERNAME']);
			if(isset($_POST["login"])){
				$databaseObj->createConnection();
				$username = $databaseObj->getEscaped($_POST["username"]);
				$password = $databaseObj->getEscaped($_POST["password"]);

				$getInfo = $databaseObj->getResultSetAsArray("SELECT * FROM users WHERE username = '$username'");
				if(count($getInfo) > 0){
					for($row = 0; $row < count($getInfo); $row++){
						$db_username = stripslashes($getInfo[$row]['username']);
						$db_password = stripslashes($getInfo[$row]['password']);
						$db_salt = stripslashes($getInfo[$row]['salt']);

						if(strcmp($username, $db_username) === 0 && strcmp($db_password, $loginObj->hashPassword($password, $db_salt)) === 0){
							$databaseObj->printMessage("USERNAME", $username, "index.php");
						}else{
							$databaseObj->printMessage("MESSAGE" ,"The username or password is wrong! Please try again", "login.php");
						}
					}
				}else{
					$databaseObj->printMessage("MESSAGE", "The username does not exist in the database! Do you really have an account?", "login.php");
				}
			}
		?>
		<?php
			$loginObj->displayMessage();
		?>
        <form name ="singUp" method="POST" action="">
           <input type="text"     name="username" id="usn" placeholder="Username"/>
           <input type="password" name="password" id="pwd" placeholder="Password"/>
           <label id="error">Error : Invalid username or password!</label>
           <input name="login" type="submit" value="Login" id="login"/>
        </form>
    </section>
	    <p>Remember you need an account to have full access to our site.</p>
		<footer id ="footer"><p> Estate R&eacuteel - Ajmer Singh & Fabian Vergara</p></footer>
</body>
</html>