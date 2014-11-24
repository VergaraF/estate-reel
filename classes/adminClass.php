<?php 
	class Admin extends Login{
		public function displayAllUsers(){
			return parent::getAllUsers();
		}

		public function updateUser(){
			return parent::updateProfile();
		}

		public function modifyUser($user_id){
			//this function will modify the status of a user (admin or regular)
		}

		public function deleteUser(){
			return parent::deactivate();
		}

		public function banUser($user_id, $message){
			$query = "INSERT INTO bannedUsers VALUES(DEFAULT, '$user_id', '$message')"
			Database::executeSqlQuery($query);
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
	}
?>