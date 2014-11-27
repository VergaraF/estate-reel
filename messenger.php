<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <link rel="stylesheet" type="text/css" href="CSS/messengerLayout.css">
        <script type= "text/javascript" src = "JS/countries.js"></script>
    </head>	
	<?php 
		include('PreCode/header.php'); 
		require('PreCode/authentication.php');
		
	?>
	<div id="container">
		<?php 
			if (isset($_SESSION['MESSAGE'])) {
			echo $_SESSION['MESSAGE'];
			unset($_SESSION['MESSAGE']);
		}
		 ?>
		<form name="createForm" method="POST" action="createConvo.php">
			<input id="sort" type="submit" name="create" value="Create Conversation">
		</form>
	<div id="convo">
		<p id="list">List of conversations</p>
		<table>
			<?php 
				$user_id = $loginObj->getUserId();
				$convoArray = $conversationObj->displayConversations($user_id);
				for ($row=0; $row < count($convoArray); $row++) {
					$userIdsArray = $conversationObj->getUserIdsForConvo($convoArray[$row]['conversationId']);
					$otherUsername = $conversationObj->getUsernameForConvo($userIdsArray, $user_id);
			?>
					<form name='conversationDelete' method='POST' action=''>
						<tr><td> <?php echo "<p id='uName'> >" . $otherUsername . "<p>" ?> </td>
						<input type="hidden" name="c_id" value=" <?php echo $convoArray[$row]['conversationId']; ?>">
						<td><input id='showM' type='submit' name='show' value='show messages'></td>
						<td><input id='del' type='submit' name='deleteConvo' value='x'></td></tr>
					</form>
		<?php  } ?>
		</table>
	</div>
	<div id="messages">
		<p>List of messages</p>
		<?php  
			if (isset($_POST['show'])) {
				$messages = $conversationObj->displayMessages($_POST['c_id']);
		?>
		<table>
			<?php
				for ($row=0; $row < count($messages); $row++) { 
			?>
					<form name='deleteMessage' method='POST' action=''>
						<tr>
							<td> <?php echo $loginObj->getUsername($messages[$row]['sender']) . ": " . $messages[$row]['reply_message']; ?> </td>
							<input type="hidden" name="cr_id_toDeleteMessage" value="<?php echo $messages[$row]['cr_id'] ?>">
							<td><input id='del' type='submit' name='deleteMess' value='x'></td>
						</tr>
					</form>
			<?php } ?>
					<form name='sendMessage' method='POST' action=''>
						<div id="sendMess">
							<input type="hidden" name="c_id_toSendMessage" value="<?php echo $_POST['c_id']; ?>">
							<textarea id="messageInput" name="message"></textarea>
							<input name="sendMessage" type="submit" value="Send">
						</div>
					</form>
		</table>			
			<?php
				}elseif (isset($_POST['sendMessage'])) {
					$conversationObj->sendMessage($_POST['c_id_toSendMessage'], $_POST['message'], $user_id);
				}elseif (isset($_POST['deleteMess'])) {
					$conversationObj->deleteMessage($_POST['cr_id_toDeleteMessage']);
				}elseif (isset($_POST['deleteConvo'])) {
					$conversationObj->deleteConversation($_POST['c_id']);
					header("location: messenger.php");
				}
			 ?>
	</div>
	</div>
	</section>

</body>
</html>