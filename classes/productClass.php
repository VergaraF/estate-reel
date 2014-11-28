<?php
	class Product extends Database{
		//this function is used to process the insert or update of an apartment
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
			$price 			= parent::getEscaped($post['price']);
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

		//this function is used to store the selected images by the user into the database and move them to another folder
		public function uploadImages($file){
			$errors= array();
			$dwelling_Id = parent::getLastId();
			foreach($file['files']['tmp_name'] as $key => $tmp_name ){
				$file_size =$file['files']['size'][$key];
				$file_tmp =$file['files']['tmp_name'][$key];
				$file_type=$file['files']['type'][$key];
				$ext= parent::GetImageExtension($file_type);
				$imagename = date("d-m-Y")."-". mt_rand() ."-".time().$ext;
		        
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

		//this function is used to delete a specific apartment with all the other related data to it
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

		//this function is used to return an associative array containing all the information for a specific apartment
		public function displaySpecificProduct($dwelling_Id){
			return parent::getResultSetAsArray("SELECT * FROM dwellings INNER JOIN address_info
														   ON dwellings.address_id = address_info.address_id
														WHERE dwelling_Id = $dwelling_Id");
		}

		//this function is used to return an associative array containing all the apartments for the specified user
		public function displayOwnerProducts($userId){
			$query = "SELECT * FROM dwellings INNER JOIN apartment_images 
								 ON dwellings.dwelling_Id = apartment_images.dwelling_Id
							  WHERE dwellings.user_id = $userId
						   GROUP BY dwellings.dwelling_Id";
			return parent::getResultSetAsArray($query);
		}

		//this function is used to return an associative array containing all the products
		public function displayAllProducts(){
			$query = "SELECT * FROM dwellings INNER JOIN apartment_images 
                                 ON dwellings.dwelling_Id = apartment_images.dwelling_Id
                           GROUP BY dwellings.dwelling_Id";
            return parent::getResultSetAsArray($query);
		}

		//this function returns an assiciative array containing all the images for the specified apartment
		public function getAllTheImages($id){
			return parent::getResultSetAsArray("SELECT file_name FROM apartment_images WHERE dwelling_Id = '$id'");
		}

		//this function is used to return the address_id of the specified apartment so that we can use it to get its whole address from the address table
		public function getAddressId($dwelling_Id){
			$infoArray = parent::getResultSetAsArray("SELECT address_id FROM dwellings WHERE dwelling_Id = '$dwelling_Id'");
			for ($row=0; $row < count($infoArray); $row++) { 
				return $infoArray[$row]['address_id'];
			}
		}

		//this function is used to check which sort button was clicked so that it can call a specific function accorrding to the button click
		public function checkSortBy($value){
			if (strcmp($value, "Sale") === 0 || strcmp($value, "Rent") === 0) {
				return $this->sortByRange($value);
			}elseif (strcmp($value, "low") === 0) {
				$value = "ASC";
				return $this->sortByPrice($value);

			}elseif (strcmp($value, "high") === 0) {
				$value = "DESC";
				return $this->sortByPrice($value);
			}else{
				return $this->displayAllProducts();
			}
		}

		//this function is used to sort all the products by price
		public function sortByPrice($value){
			$query = "SELECT * FROM dwellings INNER JOIN apartment_images 
                                 ON dwellings.dwelling_Id = apartment_images.dwelling_Id
                           GROUP BY dwellings.dwelling_Id
                           ORDER BY dwellings.price $value";
            return parent::getResultSetAsArray($query);
		}

		//this function is used to sort all the products by its range(Sale or Rent)
		public function sortByRange($type){
			$query = "SELECT * FROM dwellings INNER JOIN apartment_images 
                                 ON dwellings.dwelling_Id = apartment_images.dwelling_Id
                              WHERE dwellings.rangeType = '$type'
                           GROUP BY dwellings.dwelling_Id";
            return parent::getResultSetAsArray($query);
		}

		//this function is used to sort the products by the flexible filters that are provide by the user
		public function searchFlexible($get){
	     	$typeOfDeal	 = $get['type'];
	    	$room_min	 = $get['roomMin'];
	     	$room_max	 = $get['roomMax'];
	     	$bath_min	 = $get['bathMin'];
	        $bath_max	 = $get['bathMax'];
	     	$max_price	 = $get['price'];
	        $kindOfPlace = $get['place'];

	        $query = "SELECT * FROM dwellings INNER JOIN apartment_images 
                                 ON dwellings.dwelling_Id = apartment_images.dwelling_Id
                         WHERE 
	        			 rangeType        = '$typeOfDeal'         					         AND 
	        			 (no_of_rooms 	  >= '$room_min' AND no_of_rooms     <= '$room_max') AND 
	        			 (no_of_bathrooms >= '$bath_min' AND no_of_bathrooms <= '$bath_max') AND
	        			 price 			  < '$max_price'								     AND
	        			 type             = '$kindOfPlace'"; 
	        return parent::getResultSetAsArray($query);
		}

		//this function is used to sort the products by the specific parameters provided by the user
		public function searchSpecific($get){
			$typeOfDeal  = $get['type'];
	    	$rooms	     = $get['rooms'];
	     	$baths       = $get['baths'];
	        $max_price	 = $get['price'];
	        $kindOfPlace = $get['place'];

	        $query = "SELECT * FROM dwellings INNER JOIN apartment_images 
                                 ON dwellings.dwelling_Id = apartment_images.dwelling_Id
                         WHERE 
	        			 rangeType        = '$typeOfDeal' AND 
	        			 no_of_rooms 	  = '$rooms' 	  AND 
	        			 no_of_bathrooms  = '$baths'	  AND
	        			 price 			  < '$max_price'  AND
	        			 type             = '$kindOfPlace'"; 
	        return parent::getResultSetAsArray($query);
		}
	}
?>