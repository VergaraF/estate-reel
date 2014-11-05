<!-- THIS FILE COULD BE REMOVED AND ITS CODES COULD BE PUT INSIDE A FUNCTION INTO THE CLASS FILE -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "PHP_database";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>