<html>
<head>
	<title>Home Page</title>
</head>
<body>
	<?php 
		session_start();
		if(isset($_SESSION['USERNAME'])){
			echo $_SESSION['USERNAME'];
			unset($_SESSION['USERNAME']);
		}
	?>
<h1>Welcome To The Site</h1>
</body>
</html>