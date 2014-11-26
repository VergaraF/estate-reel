<?php
	class Login extends Database{
		
		public function processSignupForm($post){
			$passwordLength = 8;
			$firstName 	 = parent::getEscaped($post['firstName']);
			$lastName 	 = parent::getEscaped($post['lastName']);
			$email 		 = parent::getEscaped($post['email']);
			$phoneNum	 = parent::getEscaped($post['phoneNum']);
			$username 	 = parent::getEscaped(strtolower($post['username']));
			$password 	 = parent::getEscaped($post['password']);
			$confirmPass = parent::getEscaped($post['cPassword']);
			$type 		 = parent::getEscaped($post['range']);
			$rangeType	 = 'Regular';

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
			$username = parent::getEscaped(strtolower($post['username']));
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

		public function getRangeType($username){
			$rangeTypeArray = $this->getSpecificUser($username);
			$type = "";
			for ($row=0; $row < count($rangeTypeArray); $row++) { 
				$type = $rangeTypeArray[$row]['rangeType'];
			}
			return $type;
		}

		public function dateDiff ($d1, $d2) {
			// Return the number of days between the two dates:
			  return round(abs(strtotime($d1)-strtotime($d2))/86400);
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

		public function getUserById($user_id){
			return parent::getResultSetAsArray("SELECT * FROM users WHERE user_id = '$user_id'");
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

		public function getUsername($user_id){
			$usernameRs = parent::getResultSetAsArray("SELECT username FROM users WHERE user_id = $user_id");
			if (count($usernameRs) === 1) {
				return strtoupper($usernameRs[0]['username']);
			}
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
			$phone 		= $post['phoneNum'];
			$update = "UPDATE users SET firstname 	 = '$first_name', lastname = '$last_name',
										email 	  	 = '$email', 	   username = '$username',
										phoneNumber  = '$phone'
									WHERE user_id = '$user_id'";
			parent::executeSqlQuery($update);
			$_SESSION['USERNAME'] = $username;
		}

		public function logout(){
			unset($_SESSION['USERNAME']);
			header("location: index.php");
			session_start();
			session_unset();
			session_destroy();
		}

		public function checkBannedUsers($user_id){
			return parent::getResultSetAsArray("SELECT * FROM bannedusers WHERE user_id = '$user_id'");
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
			//get all the conversations of that user
			$allTheConversations = Conversation::displayConversations($user_id);

			//delete all the conversations with all their messages
			for ($row=0; $row < count($allTheConversations); $row++) { 
				Conversation::deleteConversation($allTheConversations[$row]['conversationId']);
			}
			
			//get all the apartments of this user in an array
			$apartmentArray = Product::displayOwnerProducts($user_id);

			//delete all the selected apartments
			for ($row=0; $row < count($apartmentArray); $row++) { 
				Product::deleteProduct($apartmentArray[$row]['dwelling_Id'], $user_id);
			}

			//delete the user from the database
			parent::executeSqlQuery("DELETE FROM bannedusers WHERE user_id = '$user_id'");
			parent::executeSqlQuery("DELETE FROM users WHERE user_id = '$user_id'");
			parent::printMessage("MESSAGE", "Your account has been delete successfully!", "login.php");
		}
	}
?>