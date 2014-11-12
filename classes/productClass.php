<?php
	class Product extends Database{
		public function insertOrUpdateProduct($post){
			parent::createConnection();
			$house_no 		= $post['house_no'];
			$street_name 	= parent::getEscaped($post['street_name']);
			$apartment_no 	= parent::getEscaped($post['apartment_no']);
			$city 			= parent::getEscaped($post['city']);
			$state 			= $post['state'];
			$country 		= $post['country'];
			$zip 			= $post['zip'];
			$type 			= $post['range'];
			$description 	= parent::getEscaped($post['description']);
			$room_no 		= $post['rooms'];
			$bath_no 		= $post['bathrooms'];
			$living_room_no = $post['living_rooms'];
			$price 			= parent::getEscaped($post['price']);

			$loginObj = new Login();
			$user_id = $loginObj->getUserId();
			if(isset($post['upload']) && isset($_FILES['files'])){
				$query = "INSERT INTO apartment_house VALUES (DEFAULT, '$user_id', '$house_no', '$street_name', '$apartment_no', 
			 				'$city', '$state', '" . str_replace(" ", "", $zip) . "', '$country', '$type',
			 				'$description', '$room_no', '$bath_no', '$living_room_no', '$price')";
				parent::executeSqlQuery($query);
				$this->uploadImages($_FILES);
			}elseif (isset($post['update'])) {
				$apartment_houseId = $post['hiddenID'];
				$updateQuery = "UPDATE apartment_house SET house_no 			= '$house_no', 		street_name  		= '$street_name',
														   apartment_no 		= '$apartment_no', 	city 		 		= '$city',
														   province 			= '$state', 		zip_code 	 		= '$zip',
														   country 				= '$country', 		type 		 		= '$type',
														   description 			= '$description', 	no_of_rooms	 		= '$room_no',
														   no_of_bathrooms 		= '$bath_no', 		no_of_living_rooms 	= '$living_room_no',
														   price 				= '$price'
													   WHERE apartment_houseId 	= '$apartment_houseId'";
				parent::executeSqlQuery($updateQuery);
			}
		}

		public function uploadImages($file){
			$errors= array();
			$apartment_houseId = parent::getLastId();
			foreach($file['files']['tmp_name'] as $key => $tmp_name ){
				$file_size =$file['files']['size'][$key];
				$file_tmp =$file['files']['tmp_name'][$key];
				$file_type=$file['files']['type'][$key];
				$randNum = mt_rand();
				$ext= parent::GetImageExtension($file_type);
				$imagename = date("d-m-Y")."-".$randNum."-".time().$ext;
		        
		        if($file_size > 2097152){
					$errors[] = 'File size must be less than 2 MB';
		        }
		        
		        if(empty($errors)==true){
		        	$desired_dir = "apartment_images";
					if(is_dir($desired_dir)==false){
		                mkdir("$desired_dir", 0700);
		            }
		            move_uploaded_file($file_tmp,"$desired_dir/" . $imagename);
					parent::executeSqlQuery("INSERT into apartment_images VALUES(DEFAULT, '$apartment_houseId', '$imagename','$file_size','$file_type')");
		        }else{
		            print_r($errors);
		        }
		    }
		}

		public function deleteProduct($id){
			$query1 = "SELECT file_name FROM apartment_images WHERE apartment_houseId = $id";
			$query2 = "DELETE FROM apartment_images WHERE apartment_houseId = $id";
			$query3 = "DELETE FROM apartment_house WHERE apartment_houseId = $id";
			$imageArray = parent::getResultSetAsArray($query1);
			parent::executeSqlQuery($query2);
			parent::executeSqlQuery($query3);
			for($row = 0; $row < count($imageArray); $row++){
				unlink("apartment_images/" . $imageArray[$row]['file_name'] . "");
			}
		}

		public function displayProduct($query){
			return parent::getResultSetAsArray($query);
		}

		public function showDetailsOfProduct($id){
			return parent::getResultSetAsArray("SELECT * FROM apartment_house WHERE apartment_houseId = '$id'");
		}

		public function getAllTheImages($id){
			return parent::getResultSetAsArray("SELECT file_name FROM apartment_images WHERE apartment_houseId = '$id'");
		}

		public function validateZip($zip){
			$GOODZIPCANADA = "[A-z]\d{1}[A-z][- ]?\d{1}[A-z]\d{1}\b";
			$GOODZIPUSA = "\b\d{5}[-]?\d{4}\b";
			$phonenumber = "[(]?\d{3}[)-. ]?[ ]?\d{3}[-. ]?\d{4}\b";
		}

		public function validatePrice($price){

		}
	}
?>