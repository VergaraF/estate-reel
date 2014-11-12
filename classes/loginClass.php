<?php
	class Login extends Database{
		public static function isLoggedIn(){
			return (isset($_SESSION["USERNAME"]) && $_SESSION["USERNAME"] != null);
		}

		public function checkLength($variable, $requiredLength){
			if(strlen($variable) < $requiredLength){
				return false;
			}
			return true;
		}

		public function insertUser($query){
			if (parent::createConnection()->query($query) === TRUE) {
			    parent::printMessage("MESSAGE", "Your account has been created! You may login now", "login.php");
			}
		}

		public function getUserId(){
			$selectUserId = "SELECT user_id FROM users WHERE username = '" . $_SESSION['USERNAME'] . "'";
			$rs = mysqli_query(parent::createConnection(), $selectUserId);
			if ($rs->num_rows > 0) {
				while($row = $rs->fetch_assoc()) {
					$user_id = $row['user_id'];
				}
				return $user_id;
			}
			return null;
		}

		public function getUsersProfileInfo(){
			return parent::getResultSetAsArray("SELECT * FROM users WHERE username = '" . $_SESSION['USERNAME'] . "'");
		}

		public function updateProfile($post){
			$first_name = $post['firstname'];
			$last_name  = $post['lastname'];
			$email 		= $post['email'];
			$username 	= $post['username'];
			$type 		= $post['range'];
			$update = "UPDATE users SET firstname = '$first_name', lastname = '$last_name',
										email 	  = '$email', 	   username = '$username', type = '$type'
									WHERE user_id = $this->getUserId()";
		}

		public function logout(){
			unset($_SESSION['USERNAME']);
			header("location: index.php");
		}

		public function displayMessage(){
			if(isset($_SESSION['MESSAGE'])) {
				echo "<p>" . $_SESSION['MESSAGE'] . "</p>";
				unset($_SESSION['MESSAGE']);
			}
		}

		public function hashPassword($password, $salt){
			return crypt($password, $salt);
		}

		public function generateSalt($password, $username){
			return hash('sha256', uniqid(mt_rand(), true) . $password . strtolower($username));
		}

		public function resetPassword($old, $new, $confirmNem){
			if(strcmp($new, $confirmNew) === 0){
				$query = "SELECT password, salt FROM users WHERE username = '" . $_SESSION['USERNAME'] . "'";
				$arrayValues = parent::getResultSetAsArray($query);
				for ($row = 0; $row < count($arrayValues); $row++) {
					$db_password = $arrayValues[$row]['password'];
					$db_salt = $arrayValues[$row]['salt'];
				}
				$hashedOld = $this->hashPassword($old, $db_salt);
				if(strcmp($hashedOld, $db_password) === 0){
					$newSalt = $this->generateSalt($new, $_SESSION['USERNAME']);
					$newHashedPass = $this->hashPassword($new, $newSalt);
					$updatePass = "UPDATE users SET password = '$newHashedPass', salt = '$newSalt' WHERE username = '" . $_SESSION['USERNAME'] . "'";
					parent::executeSqlQuery($updatePass);
				}else{
					echo "your old pass is wrong! please retype it";
				}
			}else{
				echo "confirmation failed";
			}
		}

		public function deactivateAccount(){
			
		}
	}
?>