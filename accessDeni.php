<?php 
	if (isset($_SESSION['USERNAME']) && strcmp($range, "Regular") === 0) {
		header("location: index.php");
		exit();
	}
?>