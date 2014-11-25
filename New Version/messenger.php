<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <script type= "text/javascript" src = "JS/countries.js"></script>
    </head>	
	<?php 
		include('PreCode/header.php'); 
		require('PreCode/authentication.php');
		
	?>
	<div id="container">
	<div id="convo">
		<p>List of conversations</p>
	</div>
	<div id="messages">
		<p>List of messages</p>
		<div id="sendMess">
			<textarea id="messageInput"></textarea>
			<button>Send</button>
		</div>
	</div>
	</div>
	</section>
<style type="text/css">
#convo{
	position: relative;
	background-color: yellow;
	width: 150px;
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



<!-- <html>
<head>
	<title>Messenger</title>
</head>
<body>
	<button type="button">Create Conversation</button>
<div id="conversation">
	<p>All the conversation will be here</p>
	<ul> -->
	<?php 
		// include('classes/databaseClass.php');
		// include('classes/loginClass.php');
		// include('classes/conversationClass.php');
		// $obj = new Conversation();
		// $allConvos = $obj->displayConversations(1);
		// for ($row=0; $row < count($allConvos); $row++) { 
	?>
		<!-- <form>
			<input name="hiddenId" type="hidden" value=" <?php echo $allConvos[$row]['conversationId']; ?> " />
		</form> -->
	<?php
		// 	echo "<input name='hiddenId' type='hidden' value='" . $allConvos[$row]['conversationId'] . "'/>";
		// 	echo "<li> Conversation id: " . $allConvos[$row]['conversationId'] . "</li>";
		// }
	?>
	<!-- </ul>
</div>
<div id="messages">
	<div id="allMessages">
		<ul>  -->
			<?php 
			// $allConvos = $obj->displayMessages(1);
			// for ($row=0; $row < count($allConvos); $row++) { 
			// 	echo "<li> Message $row: " . $allConvos[$row]['reply_message'] . "</li>";
			// }
		 ?>
		<!-- </ul>
	</div>
	<div id="sendMessage">
		<textarea id="mess"></textarea>
		<button id="send">Send</button>
	</div>
</div> -->

<style type="text/css">
/*#mess{
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
}*/
/*</style>
</body>
</html>*/