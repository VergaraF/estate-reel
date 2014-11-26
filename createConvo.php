<?php include('PreCode/header.php'); ?>

<form name="sending" method="POST" action="">
	<select name="username">
	<option>Select Username</option>
	<?php 
		$userArray = $loginObj->getAllUsers();
		for ($row=0; $row < count($userArray); $row++) { 
			echo "<option>". $userArray[$row]['username'] ."</option>";
		}
	?>
	</select>
	<textarea id="messageInput" name="message"></textarea>
	<input name="sendMessage" type="submit" value="Send">
</form>	

<?php 
	if (isset($_POST['sendMessage'])) {
		if (strcmp($_POST['username'], "Select Username") === 0) {
			echo "Please select a username from the list";
		}else{
			$rs = $loginObj->getSpecificUser($_POST['username']);
			if (count($rs) === 1) {
				$user_id = $loginObj->getUserId(); //the user who is sending the message
				$user_two = $rs[0]['user_id']; //the user to who the message will be sent
				$conversationObj->createConversation($user_id, $user_two); //using this to get the conversation id for these two users' conversation
				$convo_id = $conversationObj->checkConversation($user_id, $user_two);
				if (count($convo_id) === 1) {
					$conversationObj->sendMessage($convo_id[0]['conversationId'], $_POST['message'], $user_id);
					echo "created conversation and sent the message";
				}
			}else{
				echo "the specified user doesnt exit in the database";
			}
			
		}
	}


 ?>