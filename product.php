<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <link rel="stylesheet" type="text/css" href="CSS/userManagementLayout.css">
        <script type= "text/javascript" src = "JS/countries.js"></script>
    </head>	
	<?php 
		include('header.php');
		if(isset($_POST['upload']) && isset($_FILES['files'])){
			$productObj->insertOrUpdateProduct($_POST);
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