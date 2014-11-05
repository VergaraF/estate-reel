<?php
	require_once('connect.php');
	class Myclass{
		//method to verify the length of the specified string with the specified length
		public function checkLength($variable, $requiredLength){
			if(strlen($variable) < $requiredLength){
				return false;
			}
			return true;
		}

		//method used to print specific message using SESSION variables
		public function printMessage($sessionVar, $message, $location){
			$_SESSION[$sessionVar] = $message;
		    session_write_close();
		    header("Location: $location");
		    exit();
		}

		//method to insert a user inside the database and print a message friendly message
		public function insertUser($query){
			GLOBAL $conn;
			if ($conn->query($query) === TRUE) {
			    self::printMessage("MESSAGE", "Your account has been created! You may login now", "login.php");
			}
		}

		//this method is used to execute any query (except SELECT)
		public function executeSqlQuery($sqlQuery){
			GLOBAL $conn;
			if($conn->query($sqlQuery) === TRUE){
				echo "SUCCESSFULL";
			}else{
				echo "Error: " . $conn->error;
			}
		}

		//this method is used to get the user_id by using username stored in the session when the user is logged in
		public function getUserId(){
			GLOBAL $conn;
			$selectUserId = "SELECT user_id FROM users WHERE username = '" . $_SESSION['USERNAME'] . "'";
			$rs = mysqli_query($conn, $selectUserId);
			if ($rs->num_rows > 0) {
				while($row = $rs->fetch_assoc()) {
					$user_id = $row['user_id'];
				}
				return $user_id;
			}
			return null;
		}

		//this method is used to return a resultSet of a SELECT statement
		public function getResultSetOf($query){
			GLOBAL $conn;
			$rs = mysqli_query($conn, $query) or die($conn->error);
			return $rs;
		}

		//this method is used to get the extension of the image
		function GetImageExtension($imagetype)
	    {
	       if(empty($imagetype)) return false;
	       switch($imagetype)
	       {
	           case 'image/bmp': return '.bmp';
	           case 'image/jpeg': return '.jpg';
	           case 'image/png': return '.png';
	           default: return false;
	       }
	    }
	}
?>