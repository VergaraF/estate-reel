<?php
class Conversation extends Login{
	//this will check if the conversation betwenn two user already exist or not
	public function checkConversation($user_one, $user_two){
		$query = "SELECT c_id FROM conversation WHERE (user_one='$user_one' AND user_two='$user_two') 
												   OR (user_one='$user_two' AND user_two='$user_one')";
		return Database::getResultSetAsArray($query);
	}

	//this will create a conversation between two users if it doesn't already exist
	public function createConversation($user_one, $user_two){
		$c_id_array = $this->checkConversation($user_one, $user_two);
		if(count($c_id_array) === 0){
			$query = "INSERT INTO conversation VALUES (DEFAULT, '$user_one','$user_two','$time')";
			Database::executeSqlQuery($query);
		}
	}

	//this will delete the specifed conversation with all its messages
	public function deleteConversation($conversationId){
		$this->deleteAllMessages($conversationId);
		$query = "DELETE FROM conversation WHERE conversationId = '$conversationId'";
		Database::executeSqlQuery($query);
	}

	//this will delete a specific message from a specific conversation
	public function deleteMessage($id){
		$query = "DELETE FROM conversation_reply WHERE cr_id = '$id'";
		Database::executeSqlQuery($query);
	}

	//this will store the message into the database
	public function sendMessage($conversation_id){
		$query = "INSERT INTO conversation_reply VALUES(DEFAULT, '$message', '$time', '$conversation_id')";
		Database::executeSqlQuery($query);
	}

	//this will return an array of messages for a specific conversation
	public function displayMessages($conversation_id){
		$query = "SELECT * FROM conversation_reply WHERE conversationId = '$conversation_id'";
		return Database::getResultSetAsArray($query);
	}

	//this will return an array that contains the conversations of a specific user
	public function displayConversations($user_id){
		$query = "SELECT * FROM conversation WHERE user_one = '$user_id' OR user_two = '$user_id'";
		return Database::getResultSetAsArray($query);
	}

	public function displayAllConversations(){
		$query = "SELECT * FROM conversation";
		return Database::getResultSetAsArray($query);
	}

	public function deleteAllMessages($conversation_id){
		$query = "DELETE FROM conversation_reply WHERE conversationId = '$conversation_id'";
		Database::executeSqlQuery($query);
	}

	//DO WE REALLY NEED THIS FUNCTION?? BECAUSE WITH THIS FUNCTION THE USER WILL ABLE TO DELETE ALL THE CONVERSATIONS AT ONE CLICK
	//************************************************************//
	public function deleteAllConversations($user_id){
		$result = $this->displayConversations($user_id);
		$this->deleteAllMessages();
		$this->deleteConversation();
	}
	//************************************************************//

	public function getSender($conversation_id){
		$query = "SELECT sender FROM conversation_reply WHERE conversationId = '$conversation_id'";
		$senderId = Database::getResultSetAsArray($query);
		for ($row=0; $row < count($senderId); $row++) { 
			 return $senderId[$row]['sender'];
		}

	}
// NEW STUFF
	public function getUsernameForConvo($rsArrayWithIds, $user_id){
		$user_id_one = $rsArrayWithIds[0]['user_one'];
		$user_id_two = $rsArrayWithIds[0]['user_two'];
		$userId = null;
		if ($user_id === $user_id_one) {
			$userId = $user_id_two;
		}else{
			$userId = $user_id_one;
		}
		$query = "SELECT username FROM users WHERE user_id = $userId";
		$username = Database::getResultSetAsArray($query);
		if (count($query) === 1) {
			return $username[0]['username'];
		}
	}

	public function getUserIdsForConvo($conversationId){
		$query = "SELECT user_one, user_two FROM conversation WHERE conversationId = $conversationId";
		return Database::getResultSetAsArray($query);
	}
}



?>