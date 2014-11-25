	<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/userManagementLayout.css">
    </head>
		<?php
			include('PreCode/header.php');
			unset($_SESSION['USERNAME']);
			if(isset($_POST["login"])){
				$loginObj->processLoginForm($_POST);
			}
		?>
		<?php
			$loginObj->displayMessage();
		?>
        <form name ="singUp" method="POST" action="">
           <input type="text"     name="username" id="usn" placeholder="Username" required/>
           <input type="password" name="password" id="pwd" placeholder="Password" required/>
           <label id="error">Error : Invalid username or password!</label>
           <input name="login" type="submit" value="Login" id="login"/>
        </form>
    </section>

</body>
</html>