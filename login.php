<html>
    <head>
        <title>Estate R&eacuteel - Login</title>
        <link rel="stylesheet" type="text/css" href="CSS/userManagementLayout.css">
    </head>
    <body>
		<?php 
			session_start();
			unset($_SESSION['USERNAME']);
			include('oopClass.php');
			require_once('connect.php');
			if(isset($_POST["login"])){
				$obj = new Myclass();
				$username = $_POST["username"];
				$password = $_POST["password"];

				$selectInfo = "SELECT * FROM users WHERE username = '$username'";
				$result = mysqli_query($conn, $selectInfo);
				if(mysqli_num_rows($result) > 0){
					$row = mysqli_fetch_array($result);
					$dbUsername = $row['username'];
				   	$dbPassword = $row['password'];
				   	$salt = $row['salt'];
				   	if(strcmp($username, $dbUsername) === 0 && strcmp($dbPassword, crypt($password, $salt)) === 0){
						$obj->printMessage("USERNAME", $username, "index.php");
					}else{
						$obj->printMessage("MESSAGE" ,"The username or password is wrong! Please try again", "login.php");
					}
				}else{
					$obj->printMessage("MESSAGE", "The username does not exist in the database! Do you really have an account?", "login.php");
				}
			}
		?>
		<?php
			include('header.php');
			if(isset($_SESSION['MESSAGE'])) {
				echo "<p>" . $_SESSION['MESSAGE'] . "</p>";
				unset($_SESSION['MESSAGE']);
			}	
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