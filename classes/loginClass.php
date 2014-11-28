<?php
	class Login extends Database{
		//parent::createConnection();
		//this function is used to process the signup form and register the user into the database
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

		//this function is used to process the login form
		public function processLoginForm($post){
			$username = parent::getEscaped(strtolower($post['username']));
			$password = parent::getEscaped($post['password']);

			//the following statement is storing associative array of users inside the variable '$getInfo'
			$getInfo = parent::getResultSetAsArray("SELECT * FROM users WHERE username = '$username'");

			//the following if statement executes when the username provided by the user exists in the database
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

		//this function is used to return the rangeType(Regular or Admin) of the user by using the username
		public function getRangeType($username){
			$rangeTypeArray = $this->getSpecificUser($username);
			$type = "";
			for ($row=0; $row < count($rangeTypeArray); $row++) { 
				$type = $rangeTypeArray[$row]['rangeType'];
			}
			return $type;
		}

		//this function is used to get the number of days the user is banned from the site
		public function dateDiff ($d1, $d2) {
			  return round(abs(strtotime($d1)-strtotime($d2))/86400);
		}

		//this function returns the associative array which contains a specific users' information by using username
		public function getSpecificUser($username){
			return parent::getResultSetAsArray("SELECT * FROM users WHERE username = '$username'");
		}

		//this function is used to determine if the user is logged in or not
		public static function isLoggedIn(){
			return (isset($_SESSION["USERNAME"]) && $_SESSION["USERNAME"] != null);
		}

		//this function is called when a user creates an account on the site. Its purpose is to insert user information into the database
		public function insertUser($query){
			if (parent::createConnection()->query($query) === TRUE) {
			    parent::printMessage("MESSAGE", "Your account has been created! You may login now", "login.php");
			}
		}

		//this function is used to return an associative array containing all the existing users' information 
		public function getAllUsers(){
			return parent::getResultSetAsArray("SELECT * FROM users");
		}

		//this function is used to return an associative array containing a single user information by using his id
		public function getUserById($user_id){
			return parent::getResultSetAsArray("SELECT * FROM users WHERE user_id = '$user_id'");
		}

		//this function returns the user_id of the user who is logged into the site
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

		//this function returns the username by using the user_id
		public function getUsername($user_id){
			$usernameRs = parent::getResultSetAsArray("SELECT username FROM users WHERE user_id = $user_id");
			if (count($usernameRs) === 1) {
				return ucwords($usernameRs[0]['username']);
			}
		}

		//this function returns an associative array containing all the information of the logged in user
		public function getUsersProfileInfo(){
			return parent::getResultSetAsArray("SELECT * FROM users WHERE username = '" . $_SESSION['USERNAME'] . "'");
		}

		//this function is used to update the profile information a user. It processes the post request.
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

		//this function is executed when the user clicks on logout button
		public function logout(){
			unset($_SESSION['USERNAME']);
			header("location: index.php");
			session_start();
			session_unset();
			session_destroy();
		}

		//this function selects the user who us banned from the site by using his id
		public function checkBannedUsers($user_id){
			return parent::getResultSetAsArray("SELECT * FROM bannedusers WHERE user_id = '$user_id'");
		}

		//this function is used to display any message which is stored inside the session variable  
		public function displayMessage(){
			if(isset($_SESSION['MESSAGE'])) {
				echo "<p>" . $_SESSION['MESSAGE'] . "</p>";
				unset($_SESSION['MESSAGE']);
			}
		}

		//this function is used to return the hashed password of users
		public function hashPassword($password, $salt){
			return crypt($password, $salt);
		}

		//this function is used to generate a salt and return it
		public function generateSalt($password, $username){
			return hash('sha256', uniqid(mt_rand(), true) . $password . strtolower($username));
		}

		//this function is used to change password of the user
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

		//this function is used to delete a user's account with all the other data he has posted
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