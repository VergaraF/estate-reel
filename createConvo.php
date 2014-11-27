<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
     
    </head>
<?php include('PreCode/header.php'); ?>
<form name="sending" method="POST" action="">
<?php
	if (isset($_POST['messageOwner']) && isset($_SESSION['USERNAME'])) {
		$user_id = null;
		$resultSetArray = $productObj->displaySpecificProduct($_POST['hiddenID2']);
		if (count($resultSetArray) === 1) {
			$user_id = $resultSetArray[0]['user_id'];
			$userInfoArray = $loginObj->getUserById($user_id);
			if(count($userInfoArray) === 1){
				$ownerName = $userInfoArray[0]['username'];
			}
		}
?>
		<label>Send message to the owner: </label>
		<select name="username">
		<option> <?php echo $ownerName; ?> </option>
		
<?php
	}
	//the following statement is executed when the user clicks message the owner and he is not logged in
	elseif (!isset($_SESSION['USERNAME'])) {
		$databaseObj->printMessage("MESSAGE", "You need to login in order to send a message to the owner", "login.php");
	}
	
	//this if statement is executed when the user wants to send a message to the owner by clicking create conversation
	if (!isset($ownerName)) {
?>
		<label>Send message to the owner: </label>
		<select name="username">
		<option>Select Username</option>
		<?php 
			$userArray = $loginObj->getAllUsers();
			for ($row=0; $row < count($userArray); $row++) { 
				echo "<option>". $userArray[$row]['username'] ."</option>";
			}
		?>
		</select>
<?php } ?>
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
					$databaseObj->printMessage("MESSAGE", "Your message has been sent successfully", "messenger.php");
				}
			}else{
				echo "the specified user does not exit in the database";
			}
			
		}
	}


 ?>