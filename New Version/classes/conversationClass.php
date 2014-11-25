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
		$query = "SELECT reply_message FROM conversation_reply WHERE conversationId = '$conversation_id'";
		return Database::getResultSetAsArray($query);
	}

	//this will return an array that contains the conversations of a specific user
	public function displayConversations($user_id){
		$query = "SELECT * FROM conversation WHERE user_one = 1";
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
}
?>