<?php
	class Database{

		public $connection;
		
		//this function is used to create a connection with the database 
		public function createConnection(){
			$servername = "localhost";
			$username = "root";
			$password = "";
			$db = "PHP_database";
			// Create connection
			$this->connection = new mysqli($servername, $username, $password, $db);
			// Check connection
			if ($this->connection->connect_error) {
			    die("Connection failed: " . $this->connection->connect_error);
			}
			$this->connection->set_charset("utf8");
			return $this->connection;
		}

		//this function is used to close the connection was already open
		public function closeConnection(){
			if ($this->connection != null){
				$this->connection->close();
			}
		}

		//this function is used to escape any special character in the user's input
		public function getEscaped($text){
			return $this->createConnection()->real_escape_string($text);
		}

		//this function is used to get the last id of the last successful insert on the same connection
		public function getLastId(){
			return $this->connection->insert_id;
		}

		//this function is used to execute any query and print a message saying if it was successful or not
		public function executeSqlQuery($sqlQuery){
			if($this->createConnection()->query($sqlQuery) === TRUE){
				echo "SUCCESS-";
			}else{
				echo "Error: " . $this->connection->error;
			}
		}

		//this method is used to return a resultSet of a SELECT statement
		public function getResultSetOf($query){
			$rs = mysqli_query($this->createConnection(), $query) or die($this->createConnection()->error);
			return $rs;
		}

		//this function is used to execute a select query whose resultSet values will be stored into an 
		//associative array and then return that array
		public function getResultSetAsArray($query){
			$rs = mysqli_query($this->createConnection(), $query) or die($this->connection->error);
			if($rs->num_rows > 0){
				$index = 0;
				while($row = $rs->fetch_assoc()){
					foreach ($row as $key => $value) {
						$arrayAsResult[$index][$key] = $value;
					}
					$index++;
				}
				return $arrayAsResult;
			}
			return null;
		}

		//this function is used to store a specified message into the specified session variable name with a redirect location
		public function printMessage($sessionVar, $message, $location){
			$_SESSION[$sessionVar] = $message;
		    session_write_close();
		    header("Location: $location");
		    exit();
		}

		//this method is used to get the extension of the image
		function GetImageExtension($imagetype)
	    {
	       if(empty($imagetype)) return false;
	       switch($imagetype){
	           case 'image/bmp': return '.bmp';
	           case 'image/jpeg': return '.jpg';
	           case 'image/png': return '.png';
	           case 'image/gif': return '.gif';
	           default: return false;
	       }
	    }
	}
?>