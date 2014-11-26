<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <script type= "text/javascript" src = "JS/countries.js"></script>
    </head>	
	<?php 
		include('PreCode/header.php'); 
		require('PreCode/authentication.php');
		//require('accessDeni.php');
	?>
	<div id="container">
		<form name="createForm" method="POST" action="createConvo.php">
			<input type="submit" name="create" value="Create Conversation">
		</form>
	<div id="convo">
		<p>List of conversations</p>
		
		<table>
			<?php 
				$user_id = $loginObj->getUserId();
				$convoArray = $conversationObj->displayConversations($user_id);
				for ($row=0; $row < count($convoArray); $row++) {
					$userIdsArray = $conversationObj->getUserIdsForConvo($convoArray[$row]['conversationId']);
					$otherUsername = $conversationObj->getUsernameForConvo($userIdsArray, $user_id);
					echo "<form name='conversationDelete' method='POST' action=''>";
					echo "<tr><td>". $otherUsername ."</td>";
					echo "<input type='hidden' name='c_id' value='" . $convoArray[$row]['conversationId'] ."'>";
					echo "<td><input type='submit' name='show' value='show messages'></td>";
					echo "<td><input type='submit' name='deleteConvo' value='Delete'></td></tr>";
					echo "</form>";
				}
			?>
		</table>
		
	</div>
	<div id="messages">
		<p>List of messages</p>

		<form name="sendOrDelete" method="POST" action="">
			<table>
				<?php
					if (isset($_POST['show'])) {
						$messages = $conversationObj->displayMessages($_POST['c_id']);
						for ($row=0; $row < count($messages); $row++) { 
							echo "<tr>
								<td>" . $loginObj->getUsername($messages[$row]['sender']) . ": " . $messages[$row]['reply_message'] . "</td>
								<input type='hidden' name='CID' value='" . $messages[$row]['cr_id'] ."'>
								<td><input type='submit' name='deleteMess' value='Delete'></td>
							 </tr>";
						}
				?>
							<div id="sendMess">
								<textarea id="messageInput" name="message"></textarea>
								<input name="sendMessage" type="submit" value="Send">
							</div>
				<?php
					}elseif (isset($_POST['sendMessage'])) {
						$conversationObj->sendMessage($_POST['CID'], $_POST['message'], $user_id);
						header("location: messenger.php");
					}elseif (isset($_POST['deleteMess'])) {
						//$conversationObj->
					}
					
					
				 ?>
			</table>
		</form>
		
	</div>
	</div>
	</section>
<style type="text/css">
#convo{
	position: relative;
	background-color: yellow;
	width: 250px;
	height: 500px;
	display: inline-block;
}
#messages{
	position: relative;
	background-color: red;
	width: 500px;
	height: 500px;
	display: inline-block;
}
#container{
	margin-top: 10px;
	display: inline-block;
}
#messageInput{
}
#sendMess{
}

</style>
</body>
</html>