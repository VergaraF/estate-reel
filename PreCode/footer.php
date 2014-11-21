<?php
 //	include('classes/loginClass.php');
 //	$loginObj = new Login();
 
 	  if($loginObj->isLoggedIn()){
 ?>

<footer id ="footer">
			
			<p> Estate R&eacuteel - Ajmer Singh & Fabian Vergara</p>
</footer>

<?php
} else {

?> <footer id ="footer">
			<p>Remember you need an account to have full access to our site.</p>
			<p> Estate R&eacuteel - Ajmer Singh & Fabian Vergara</p>
</footer>
<?php }
?>
