<?php
	//session_start();
	if(!isset($_SESSION['USERNAME']) || (trim($_SESSION['USERNAME']) == '')) {
		header("location: login.php");
		exit();
	}
	if(isset($_SESSION['USERNAME']) && strcmp($range, "Regular") === 0 && count($bannedUser) == 1){
		header("location: index.php");
		exit();
	}
?>