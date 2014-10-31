CREATE TABLE users (
	user_id INT(6) AUTO_INCREMENT PRIMARY KEY, 
	firstname VARCHAR(30),
	lastname VARCHAR(30), 
	email VARCHAR(50),
	username VARCHAR(30) NOT NULL,
	password VARCHAR(20) NOT NULL,
	salt VARCHAR(255) NOT NULL,
	type VARCHAR(50)
);
CREATE TABLE apartment (
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
);
CREATE TABLE address (
	addressId INT(6) AUTO_INCREMENT PRIMARY KEY,
	house_no INT(10),
	street_name VARCHAR(255),
	apartment_no VARCHAR(10),
	city VARCHAR(255),
	province VARCHAR(255),
	zip_code VARCHAR(6),
	country VARCHAR(255),
	type VARCHAR(255)
);
CREATE TABLE conversation (
	conversationId INT(6) AUTO_INCREMENT PRIMARY KEY,
	user_one INT(6) NOT NULL,
	user_two INT(6) NOT NULL,
	ip VARCHAR(255),
	time VARCHAR(255),
	status VARCHAR(255),
	FOREIGN KEY (user_one) REFERENCES users (user_id),
	FOREIGN KEY (user_two) REFERENCES users (user_id)
);
CREATE TABLE conversation_reply (
	cr_id INT(6) AUTO_INCREMENT PRIMARY KEY,
	reply_message VARCHAR(1000),
	ip VARCHAR(255),
	time VARCHAR(255),
	status VARCHAR(255),
	conversationId INT(6),
	FOREIGN KEY (conversationId) REFERENCES conversation (conversationId)
);