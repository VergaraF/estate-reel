<?php
	//session_start();
	require_once('connect.php');
	class Myclass{
		public function checkLength($variable, $requiredLength){
			if(strlen($variable) < $requiredLength){
				return false;
			}
			return true;
		}

		public function printMessage($sessionVar, $message, $location){
			$_SESSION[$sessionVar] = $message;
		    session_write_close();
		    header("Location: $location");
		    exit();
		}

		public function insertUser($query){
			GLOBAL $conn;
			if ($conn->query($query) === TRUE) {
			    self::printMessage("MESSAGE", "Your account has been created! You may login now", "login.php");
			}
		}

		public function executeSqlQuery($sqlQuery){
			GLOBAL $conn;
			if($conn->query($sqlQuery) === TRUE){
				echo "SUCCESSFULL";
			}else{
				echo "Error: " . $conn->error;
			}
		}

		public function dropTable($tableName){
			$sql = "DROP TABLE $tableName";
			GLOBAL $conn;
			if($conn->query($sql) === TRUE){
				echo "DROPPED TABLE $tableName";
			}else{
				echo "Error: " . $conn->error;
			}
		}
	}
?>