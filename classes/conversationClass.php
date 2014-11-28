<?php
class Conversation extends Login{
	//this will check if the conversation betwenn two user already exist or not
	public function checkConversation($user_one, $user_two){
		$query = "SELECT conversationId FROM conversation WHERE (user_one='$user_one' AND user_two='$user_two') 
												   OR (user_one='$user_two' AND user_two='$user_one')";
		return Database::getResultSetAsArray($query);
	}

	//this will create a conversation between two users if it doesn't already exist
	public function createConversation($user_one, $user_two){
		$c_id_array = $this->checkConversation($user_one, $user_two);
		if(count($c_id_array) === 0){
			$query = "INSERT INTO conversation(conversationId, user_one, user_two) VALUES (DEFAULT, '$user_one','$user_two')";
			Database::executeSqlQuery($query);
		}
	}

	//this function is used to return the usernane of the user who is having conversation with the logged in user
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
			return strtoupper($username[0]['username']);
		}
	}

	//this function is used to return an array that contains both usernames for the specific conversation
	public function getUsernamesForConvo($rsArrayWithIds){
		$user_id_one = $rsArrayWithIds[0]['user_one'];
		$user_id_two = $rsArrayWithIds[0]['user_two'];

		$userName_one = parent::getUsername($user_id_one);
		$userName_two = parent::getUsername($user_id_two);

		$arrayWithNames = array($userName_one, $userName_two);
		return $arrayWithNames;
	}

	//this function returns user_ids for the specified conversation
	public function getUserIdsForConvo($conversationId){
		$query = "SELECT user_one, user_two FROM conversation WHERE conversationId = $conversationId";
		return Database::getResultSetAsArray($query);
	}
	//this will delete the specifed conversation with all its messages
	public function deleteConversation($conversationId){
		self::deleteAllMessages($conversationId);
		$query = "DELETE FROM conversation WHERE conversationId = '$conversationId'";
		Database::executeSqlQuery($query);
	}

	//this will delete a specific message from a specific conversation
	public function deleteMessage($id){
		$query = "DELETE FROM conversation_reply WHERE cr_id = '$id'";
		Database::executeSqlQuery($query);
	}

	//this will store the message into the database
	public function sendMessage($conversation_id, $message, $user_id){
		$description = Database::getEscaped($message);
		$query = "INSERT INTO conversation_reply(cr_id, sender, reply_message, conversationId) VALUES(DEFAULT, $user_id, '$description', '$conversation_id')";
		Database::executeSqlQuery($query);
	}

	//this will return an array of messages for a specific conversation
	public function displayMessages($conversation_id){
		$query = "SELECT * FROM conversation_reply WHERE conversationId = '$conversation_id'";
		return Database::getResultSetAsArray($query);
	}

	//this will return an array that contains the conversations of a specific user
	public function displayConversations($user_id){
		$query = "SELECT * FROM conversation WHERE user_one = $user_id OR user_two = $user_id";
		return Database::getResultSetAsArray($query);
	}

	//this function will delete all the message inside the specified conversation
	public function deleteAllMessages($conversation_id){
		$query = "DELETE FROM conversation_reply WHERE conversationId = '$conversation_id'";
		Database::executeSqlQuery($query);
	}

	//this function will return all the conversations for all the users
	public function displayAllConversations(){
		$query = "SELECT * FROM conversation";
		return Database::getResultSetAsArray($query);
	}

	//this function is used to get the sender id to know who sent which message
	public function getSender($conversation_id){
		$query = "SELECT sender FROM conversation_reply WHERE conversationId = '$conversation_id'";
		$senderId = Database::getResultSetAsArray($query);
		for ($row=0; $row < count($senderId); $row++) { 
			 return $senderId[$row]['sender'];
		}
	}
}
?>