<!-- THIS FILE IS USED FOR UPLOADING APARTMENTS/HOUSES -->	
	<?php 
		require('authentication.php');
		require_once('connect.php');
		include('loggedOn.php');
		if(isset($_POST['upload']) && isset($_FILES['files'])){
		    $errors= array();
		    
		    $house_no = $_POST['house_no'];
			$street_name = $_POST['street_name'];
			$apartment_no = $_POST['apartment_no'];
			$city = $_POST['city'];
			$province =  $_POST['state'];
			$zip =  $_POST['zip'];
			$country =  $_POST['country'];
			$type =  $_POST['range'];
			$desc = $_POST['description'];
			$rooms = $_POST['rooms'];
			$baths = $_POST['bathrooms'];
			$livingRooms = $_POST['living_rooms'];
			$price = $_POST['price'];


			$user_id = $obj->getUserId();
			$insert = "INSERT INTO apartment_house VALUES (DEFAULT, '$user_id', '$house_no', '$street_name', '$apartment_no', 
			 				'$city', '$province', '" . str_replace(" ", "", $_POST['zip']) . "', '$country', '$type',
			 				'$desc', '$rooms', '$baths', '$livingRooms', '$price')";
			$obj->executeSqlQuery($insert);
			$apartment_houseId = mysqli_insert_id($conn);
		    //foreach loop is used to get al the selected files and modify their name and store it into the database
			foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
				$file_size =$_FILES['files']['size'][$key];
				$file_tmp =$_FILES['files']['tmp_name'][$key];
				$file_type=$_FILES['files']['type'][$key];
				$randNum = mt_rand();
				$ext= $obj->GetImageExtension($file_type);
				$imagename = date("d-m-Y")."-".$randNum."-".time().$ext;
		        
		        //to check the size of a file
		        if($file_size > 2097152){
					$errors[] = 'File size must be less than 2 MB';
		        }
		        $query = "INSERT into apartment_images VALUES(DEFAULT, '$apartment_houseId', '$imagename','$file_size','$file_type'); ";
		  
		        //this if statement executes when everything went fine
		        if(empty($errors)==true){
		        	$desired_dir = "apartment_images";
		        	//this if statement is to create a directory for the images if it is not there
					if(is_dir($desired_dir)==false){
		                mkdir("$desired_dir", 0700);
		            }
		            move_uploaded_file($file_tmp,"$desired_dir/" . $imagename);
					$obj->executeSqlQuery($query);
		        }else{
		            print_r($errors);
		        }
		    }

			//DO ALL THE ERROR CHECKING ON CLIENT SIDE
			//	-verify zip code
			//	-verify price (string or integer?)
			//	-check apartment number (null or not null)
			//	-etc

			
		}
		
	?>
	<h2>Upload Apartment/House</h2>
	<form name="productFome" method="POST" action="" enctype="multipart/form-data">
		<input name="house_no" type="text" id="house_no" placeholder="House Number"  /><br>
		<input name="street_name" type="text" id="street_name" placeholder="Street Name"  /><br>
		<select id="country" name ="country"></select>
		<select name ="state" id ="state"></select>
		 <script language="javascript">
			populateCountries("country", "state");
		 </script>
		<input name="apartment_no" type="text" id="apart_no" placeholder="Apartment Number (Optional)" /><br>
		<input name="city" type="text"  id="city" placeholder="City"  /><br>
		<input name="zip" type="text" id="zip" placeholder="Postal Code (H1H 1H1)"  /><br>
		<label>Type: </label>
		<input name="range" type="radio" value="House">House</input>
		<input name="range" type="radio" value="Apartment">Apartment</input>
		<input name="range" type="radio" value="Companie">Companie</input><br>
		<textarea style="height:75px;" name="description" type="text" id="desc" placeholder="Type brief description of the place here"></textarea><br>
		<input name="rooms" type="number" min="0" max="10"  id="rooms" placeholder="Number Of Rooms" /><br>
		<input name="bathrooms" type="number" min="0" max="10"  id="bath" placeholder="Number Of BathRooms" /><br>
		<input name="living_rooms" type="number" min="0" max="10" id="livingRooms" placeholder="Number Of Living Rooms" /><br>
		<input name="price" type="text"  id="price" placeholder="Price" /><br>
		<input type="file" name="files[]" multiple/>
		<input name="upload" type="submit" id="upload" value="Upload" />
	</form>
</section>
</body>
</html>