<html>
<head>
	<title>Messenger</title>
</head>
<body>
	<button type="button">Create Conversation</button>
<div id="conversation">
	<p>All the conversation will be here</p>
	<ul>
	<?php 
		include('classes/databaseClass.php');
		include('classes/loginClass.php');
		include('classes/conversationClass.php');
		$obj = new Conversation();
		$allConvos = $obj->displayConversations(1);
		for ($row=0; $row < count($allConvos); $row++) { 
	?>
		<form>
			<input name="hiddenId" type="hidden" value=" <?php echo $allConvos[$row]['conversationId']; ?> " />
		</form>
	<?php
			echo "<input name='hiddenId' type='hidden' value='" . $allConvos[$row]['conversationId'] . "'/>";
			echo "<li> Conversation id: " . $allConvos[$row]['conversationId'] . "</li>";
		}
	?>
	</ul>
</div>
<div id="messages">
	<div id="allMessages">
		<ul> <?php 
			$allConvos = $obj->displayMessages(1);
			for ($row=0; $row < count($allConvos); $row++) { 
				echo "<li> Message $row: " . $allConvos[$row]['reply_message'] . "</li>";
			}
		 ?>
		</ul>
	</div>
	<div id="sendMessage">
		<textarea id="mess"></textarea>
		<button id="send">Send</button>
	</div>
</div>

<style type="text/css">
#mess{
	position: relative;
	width: 500px;
	font-size: 18px;
}
#send{
	margin-left: 450px;
	margin-top: 45px;
}
#allMessages{
	height: 400px;
	background-color: yellow;
	margin-top: -16px;
}
#sendMessage{
	height: 100px;
	background-color: orange;
}
#conversation{
	background-color: blue;
	position: absolute;
	width: 250px;
	height: 500px;
}
#messages{
	background-color: red;
	position: absolute;
	margin-left: 250px;
	height: 500px;
	width: 500px;
}
li {
	height: 50px;
}
</style>
</body>
</html>