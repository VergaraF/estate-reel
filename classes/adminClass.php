<?php 
	class Admin extends Login{
		public function displayAllUsers(){
			return parent::getAllUsers();
		}

		public function updateUser(){
			return parent::updateProfile();
		}

		public function deleteUser(){
			return parent::deactivate();
		}

		public function banUser(){
			
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