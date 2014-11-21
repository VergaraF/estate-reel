<?php
	class Login extends Database{
		
		public function processSignupForm($post){
			$passwordLength = 8;
			$firstName 	 = parent::getEscaped($post['firstName']);
			$lastName 	 = parent::getEscaped($post['lastName']);
			$email 		 = parent::getEscaped($post['email']);
			$phoneNum	 = parent::getEscaped($post['phoneNum']);
			$username 	 = parent::getEscaped($post['username']);
			$password 	 = parent::getEscaped($post['password']);
			$confirmPass = parent::getEscaped($post['cPassword']);
			$type 		 = parent::getEscaped($post['range']);
			$rangeType	 = 'Regular User';

			$res = $this->getSpecificUser($username);
			//this if statement executes when the passwords are identical
			if(strcmp($password, $confirmPass) === 0){
				if(count($res) == 0){
					$salt = $this->generateSalt($password, $username);
					$pass = $this->hashPassword($password, $salt);
					$newUser = "INSERT INTO users VALUES (DEFAULT, '$firstName', '$lastName', 
										'$email', '$phoneNum', '$username', '$pass', '$salt', '$type', '$rangeType')";
					$this->insertUser($newUser);
					parent::closeConnection();
				}else{
					parent::printMessage("MESSAGE", "The username is already taken! please take another one", "signUp.php");
				}
			}else{
				parent::printMessage("MESSAGE", "The password confirmation failed! Please try again", "signUp.php");
			}
		}

		public function processLoginForm($post){
			$username = parent::getEscaped($post['username']);
			$password = parent::getEscaped($post['password']);

			$getInfo = parent::getResultSetAsArray("SELECT * FROM users WHERE username = '$username'");
			if(count($getInfo) > 0){
				for($row = 0; $row < count($getInfo); $row++){
					$db_username = $getInfo[$row]['username'];
					$db_password = $getInfo[$row]['password'];
					$db_salt 	 = $getInfo[$row]['salt'];

					if(strcmp($username, $db_username) === 0 && strcmp($db_password, $this->hashPassword($password, $db_salt)) === 0){
						parent::printMessage("USERNAME", $username, "index.php");
					}else{
						parent::printMessage("MESSAGE" ,"The username or password is wrong! Please try again", "login.php");
					}
				}
			}else{
				parent::printMessage("MESSAGE", "The username does not exist in the database! Do you really have an account?", "login.php");
			}
		}

		public function getSpecificUser($username){
			return parent::getResultSetAsArray("SELECT * FROM users WHERE username = '$username'");
		}

		public static function isLoggedIn(){
			return (isset($_SESSION["USERNAME"]) && $_SESSION["USERNAME"] != null);
		}

		public function insertUser($query){
			if (parent::createConnection()->query($query) === TRUE) {
			    parent::printMessage("MESSAGE", "Your account has been created! You may login now", "login.php");
			}
		}

		public function getAllUsers(){
			return parent::getResultSetAsArray("SELECT * FROM users");
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
			$user_id 	= $this->getUserId();
			$first_name = $post['firstname'];
			$last_name  = $post['lastname'];
			$email 		= $post['email'];
			$username 	= $post['username'];
			//$type 		= $post['range'];
			$update = "UPDATE users SET firstname = '$first_name', lastname = '$last_name',
										email 	  = '$email', 	   username = '$username'
									WHERE user_id = '$user_id'";
			parent::executeSqlQuery($update);
			$_SESSION['USERNAME'] = $username;
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

		public function resetPassword($old, $new, $confirmNew){
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
					echo "Password changed successfully";
				}else{
					echo "your old pass is wrong! please retype it";
				}
			}else{
				echo "confirmation failed";
			}
		}

		public function deactivateAccount(){
			$user_id = $this->getUserId();
			$query1 = "SELECT conversationId FROM conversation WHERE user_one = '$user_id' OR user_two = '$user_id'";
			$allConversations = parent::getResultSetAsArray($query1);

			for ($row = 0; $row < count($allConversations); $row++){
				Conversation::deleteAllMessages($allConversations[$row]['conversationId']);
				Conversation::deleteConversation($allConversations[$row]['conversationId']);
			}

			$query = "SELECT apartment_houseId FROM apartment_house WHERE user_id = $user_id";
			$query = "SELECT file_name FROM apartment_images WHERE apartment_houseId = $id"; //select for all the apartment ids
			$query1 = "DELETE FROM apartment_images WHERE apartment_houseId = $id"; //for all the apartments
			$query2 = "DELETE FROM apartment_house WHERE apartment_houseId = $id"; //all the apartments
			$query3 = "DELETE FROM conversation_reply WHERE user_id = $user_id"; // all the messages
			$query4 = "DELETE FROM conversation WHERE user_one = $user_id OR user_two = $user_id";
			$query5 = "DELETE FROM users WHERE username = $username";
			// $query6 will be used to delete pictures from the folder
		}
	}
?>