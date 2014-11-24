<?php
	class Product extends Database{
		public function insertOrUpdateProduct($post){
			parent::createConnection();
			$house_no 		= $post['house_no'];
			$street_name 	= parent::getEscaped($post['street_name']);
			$apartment_no 	= parent::getEscaped($post['apartment_no']);
			$city 			= parent::getEscaped(ucwords($post['city']));
			$state 			= $post['state'];
			$country 		= $post['country'];
			$zip 			= strtoupper($post['zip']);
			$type 			= $post['range'];
			$description 	= parent::getEscaped($post['description']);
			$room_no 		= $post['rooms'];
			$bath_no 		= $post['bathrooms'];
			$living_room_no = $post['living_rooms'];
			$price 			= parent::getEscaped(number_format($post['price'], 2));
			$rangeType		= $post['rangeType'];

			$loginObj = new Login();
			$user_id = $loginObj->getUserId();
			if(isset($post['upload']) && isset($_FILES['files'])){
				$query1 = "INSERT INTO address_info VALUES (DEFAULT, '$house_no', '$street_name', '$apartment_no', '$city', '$state', '$zip', '$country')";
				parent::executeSqlQuery($query1);
				$addressId = parent::getLastId();
				$query = "INSERT INTO dwellings VALUES (DEFAULT, '$addressId', '$user_id', '$type', '$description', '$room_no', '$bath_no', '$living_room_no', '$price', '$rangeType')";
				parent::executeSqlQuery($query);
				$this->uploadImages($_FILES);
			}elseif (isset($post['update'])) {
				$dwelling_Id = $post['hiddenID'];
				$address_id = $this->getAddressId($dwelling_Id);
				$updateDwellings = "UPDATE dwellings SET type 		 		= '$type',    		description 	= '$description',
														 no_of_rooms 		= '$room_no', 		no_of_bathrooms	= '$bath_no', 		
													     no_of_living_rooms = '$living_room_no',price 			= '$price'
												   WHERE dwelling_Id = $dwelling_Id";
				$updateAddress = "UPDATE address_info SET house_no 			= '$house_no', 		street_name  		= '$street_name',
													    apartment_no 		= '$apartment_no', 	city 		 		= '$city',
													    province 			= '$state', 		zip_code 	 		= '$zip',
													    country				= '$country'
											      WHERE address_id 	= '$address_id'";
				parent::executeSqlQuery($updateDwellings);
				parent::executeSqlQuery($updateAddress);
			}
		}

		public function uploadImages($file){
			$errors= array();
			$dwelling_Id = parent::getLastId();
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
					parent::executeSqlQuery("INSERT into apartment_images VALUES(DEFAULT, '$dwelling_Id', '$imagename','$file_size','$file_type')");
		        }else{
		            print_r($errors);
		        }
		    }
		}

		public function deleteProduct($id, $user_id){
			//storing all the image names into an array so that later on we can delete those images from the folder
			$imageArray = parent::getResultSetAsArray("SELECT file_name FROM apartment_images WHERE dwelling_Id = $id");
			
			//deleting apartment images from the database
			parent::executeSqlQuery("DELETE FROM apartment_images WHERE dwelling_Id = $id");
			
			//storing address id into an array so that we can delete address of the apartment later on
			$address_id = self::getAddressId($id);

			//deleting apartment information such as description, price, etc
			parent::executeSqlQuery("DELETE FROM dwellings WHERE dwelling_Id = $id");

			//deleting the pictures from the folder
			for($row = 0; $row < count($imageArray); $row++){
				unlink("apartment_images/" . $imageArray[$row]['file_name'] . "");
			}

			//deleting the addresse of apartments
			parent::executeSqlQuery("DELETE FROM address_info WHERE address_id = '$address_id'");
			
		}

		public function displaySpecificProduct($dwelling_Id){
			return parent::getResultSetAsArray("SELECT * FROM dwellings INNER JOIN address_info
														   ON dwellings.address_id = address_info.address_id
														WHERE dwelling_Id = $dwelling_Id");
		}

		public function displayOwnerProducts($userId){
			$query = "SELECT * FROM dwellings INNER JOIN apartment_images 
								 ON dwellings.dwelling_Id = apartment_images.dwelling_Id
							  WHERE dwellings.user_id = $userId
						   GROUP BY dwellings.dwelling_Id";
			return parent::getResultSetAsArray($query);
		}

		public function displayAllProducts(){
			$query = "SELECT * FROM dwellings INNER JOIN apartment_images 
                                 ON dwellings.dwelling_Id = apartment_images.dwelling_Id
                           GROUP BY dwellings.dwelling_Id";
            return parent::getResultSetAsArray($query);
		}

		// public function showDetailsOfProduct($id){
		// 	return parent::getResultSetAsArray("SELECT * FROM dwellings INNER JOIN address_info 
		// 												   ON dwellings.address_id = address_info.address_id
		// 										WHERE dwellings.dwelling_Id = '$id'");
		// }

		public function getAllTheImages($id){
			return parent::getResultSetAsArray("SELECT file_name FROM apartment_images WHERE dwelling_Id = '$id'");
		}

		public function getAddressId($dwelling_Id){
			$infoArray = parent::getResultSetAsArray("SELECT address_id FROM dwellings WHERE dwelling_Id = '$dwelling_Id'");
			for ($row=0; $row < count($infoArray); $row++) { 
				$address_id = $infoArray[$row]['address_id'];
			}
			return $address_id;
		}

		// for example 500-1000 or 1000-1500 etc
		public function sortByPrice(){
		
		}

		// for example for sale or for rent
		public function sortByRange(){

		}

		// for example owner name
		public function sortByOwner(){

		}

		// for example apartment or house
		public function sortByType(){

		}
	}
?>