<?php
	session_start();
	if(!isset($_SESSION['USERNAME']) || (trim($_SESSION['USERNAME']) == '')) {
		header("location: login.php");
		exit();
	}
?>