<?php
	session_start();
	include('oopClass.php');
	$obj = new Myclass();
	if(!isset($_SESSION['USERNAME']) || (trim($_SESSION['USERNAME']) == '')) {
		$obj->printMessage("MESSAGE", "", "login.php");
	}
?>