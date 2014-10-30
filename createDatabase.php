<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Create database
$createDatabase = "CREATE DATABASE PHP_database";
$User_tbl = "CREATE TABLE users (
				user_id INT(6) AUTO_INCREMENT PRIMARY KEY, 
				firstname VARCHAR(30),
				lastname VARCHAR(30), 
				email VARCHAR(50),
				username VARCHAR(30) NOT NULL,
				password VARCHAR(20) NOT NULL,
				salt VARCHAR(255) NOT NULL,
				type VARCHAR(50)
			)";
$Apartment_tbl = "CREATE TABLE apartment (
					apartmentId INT(6) AUTO_INCREMENT PRIMARY KEY,
					addressId INT(6) NOT NULL,
					user_id INT(6) NOT NULL, 
					image VARCHAR(255),
					description VARCHAR(255),
					no_of_rooms INT,
					no_of_bathrooms INT,
					no_of_living_rooms INT,
					price INT,
					FOREIGN KEY (addressId) REFERENCES address (addressId),
					FOREIGN KEY (user_id) REFERENCES users (user_id)
				)";
$Address_tbl = "CREATE TABLE address (
					addressId INT(6) AUTO_INCREMENT PRIMARY KEY,
					house_no INT(10),
					street_name VARCHAR(255),
					apartment_no VARCHAR(10),
					city VARCHAR(255),
					province VARCHAR(255),
					zip_code VARCHAR(6),
					country VARCHAR(255),
					type VARCHAR(255)
			    )";
$Conversation_tbl = "CREATE TABLE conversation (
						conversationId INT(6) AUTO_INCREMENT PRIMARY KEY,
						user_one INT(6) NOT NULL,
						user_two INT(6) NOT NULL,
						ip VARCHAR(255),
						time VARCHAR(255),
						status VARCHAR(255),
						FOREIGN KEY (user_one) REFERENCES users (user_id),
						FOREIGN KEY (user_two) REFERENCES users (user_id)
				    )";
$Convo_reply_tbl = "CREATE TABLE conversation_reply (
						cr_id INT(6) AUTO_INCREMENT PRIMARY KEY,
						reply_message VARCHAR(1000),
						ip VARCHAR(255),
						time VARCHAR(255),
						status VARCHAR(255),
						conversationId INT(6),
						FOREIGN KEY (conversationId) REFERENCES conversation (conversationId)
				    )";

include('oopClass.php');
$obj = new Myclass();
//executeSqlQuery($createDatabase);
require('connect.php');
// $obj->dropTable('conversation_reply');
// $obj->dropTable('conversation');
// $obj->dropTable('apartment');
// $obj->dropTable('address');
// $obj->dropTable('users');
// $obj->executeSqlQuery($User_tbl);
// $obj->executeSqlQuery($Address_tbl);
// $obj->executeSqlQuery($Apartment_tbl);
// $obj->executeSqlQuery($Conversation_tbl);
// $obj->executeSqlQuery($Convo_reply_tbl);
//$conn->close();
?>