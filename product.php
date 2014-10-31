	<?php 
		require_once('connect.php');
		include('oopClass.php');
		if(isset($_POST['upload'])){
			$obj = new Myclass();
			$house_no = $_POST['house_no'];
			$street_name = $_POST['street_name'];
			$apartment_no = $_POST['apartment_no'];
			$city = $_POST['city'];
			$province =  $_POST['state'];
			$zip =  $_POST['zip'];
			$country =  $_POST['country'];
			$type =  $_POST['range'];
			// $imagePath = $_POST['image'];
			// $desc = $_POST['description'];
			// $rooms = $_POST['rooms'];
			// $baths = $_POST['bathrooms'];
			// $livingRooms = $_POST['living_rooms'];
			// $price = $_POST['price'];

			//DO THIS ON THE CLIENT SIDE
			// if(strcmp($country, "Canada") === 0 && strlen(str_replace(" ", "", $zip)) === 6){
			// 	echo "<div>" . "the zip is ok" . "</div>";
			// }
			// else{
			// 	echo "<div>" . "bla bla bla" . "</div>";
			// }

			$insertApartment = "INSERT INTO address VALUES (DEFAULT, '$house_no', '$street_name', '$apartment_no', 
							'$city', '$province', '" . str_replace(" ", "", $_POST['zip']) . "', '$country', '$type')";
			$obj->executeSqlQuery($insertApartment); 
		}
		include('header.php');
	?>
	<a href="displayApartments.php">Display All Apartments</a>
	<form name="productFome" method="POST" action="">
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
		<input name="image" type="text" id="image" placeholder="Image Path" /><br>
		<textarea style="height:75px;" name="description" type="text" id="desc" placeholder="Type brief description of the place here"></textarea><br>
		<input name="rooms" type="number" min="0" max="10"  id="rooms" placeholder="Number Of Rooms" /><br>
		<input name="bathrooms" type="number" min="0" max="10"  id="bath" placeholder="Number Of BathRooms" /><br>
		<input name="living_rooms" type="number" min="0" max="10" id="livingRooms" placeholder="Number Of Living Rooms" /><br>
		<input name="price" type="text"  id="price" placeholder="Price" /><br>
		<input name="upload" type="submit" id="upload" value="Upload" />
	</form>
</body>
</html>