<?php 
	class Admin extends Login{
		public function displayAllUsers(){
			return parent::getAllUsers();
		}

		public function updateUser($post){
			$user_id 	= $post['hiddenUserId'];
			$first_name = $post['firstname'];
			$last_name  = $post['lastname'];
			$email 		= $post['email'];
			$username 	= $post['username'];
			$phone 		= $post['phoneNum'];
			$range 	    = $post['urng'];
			$update = "UPDATE users SET firstname 	 = '$first_name', lastname      = '$last_name',
										email 	  	 = '$email', 	  username 		 = '$username',
										phoneNumber  = '$phone',	  rangeType 	 = '$range'
									WHERE user_id = '$user_id'";
			parent::executeSqlQuery($update);
			
		
		}

		public function modifyUser($user_id){
			//this function will modify the status of a user (admin or regular)
		}

		public function deleteUser($user_id){
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
		}

		public function banUser($user_id, $message){
			$rs = parent::checkBannedUsers($user_id);
			if(count($rs) == 0){
				$description = Database::getEscaped($message);
				$query = "INSERT INTO bannedUsers(banId, user_id, description, from_ ,to_) VALUES(DEFAULT, '$user_id', '$description', NOW() , ADDDATE(NOW(), INTERVAL 31 DAY))";
				Database::executeSqlQuery($query);
			}else{
				echo "this user is already banned from this site";
			}
		}

		public function listAllProducts(){
			return Product::displayAllProducts();
		}

		public function updateProduct($post){
			return Product::insertOrUpdateProduct($post);
			//call insertOrUpdateProduct function inside product class
		}

		public function listAllConversations(){
			//call displayConversations function inside conversation class
		}

		public function listAllMessages(){
			//call displayMessages function inside conversation class
		}

		public function getOppositeRange($actualRange){
			if (strcmp($actualRange, "Admin") === 0){
				return "Regular";
			}else{
				return "Admin";
			}
		}
	}
?>