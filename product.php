<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <script type= "text/javascript" src = "JS/countries.js"></script>
        <script type= "text/javascript" src = "JS/validations.js"></script>
    </head>	
	<?php 
		include('PreCode/header.php');
		if(isset($_POST['upload']) && isset($_FILES['files'])){
			$productObj->insertOrUpdateProduct($_POST);
		}
	?>
	<h2>Upload Apartment/House</h2>
	<form name="productForm" method="POST" action="" enctype="multipart/form-data">
		<input name="house_no" type="text" id="house_no" placeholder="House Number" required /><br>
		<input name="street_name" type="text" id="street_name" placeholder="Street Name" required /><br>
		<select id="country" name ="country" onblur="selectCountry(this)" required></select>
		<select name ="state" id ="state" onblur="selectState(this)" required></select>
		 <script language="javascript">
			populateCountries("country", "state");
		 </script>
		<input name="apartment_no" type="text" id="apart_no" placeholder="Apartment Number (Optional)" /><br>
		<input name="city" type="text"  id="city" placeholder="City" required /><br>
		<input name="zip" type="text" id="zip" placeholder="Postal Code (H1H 1H1)" onchange="validateZipCode(document.getElementById('country'), this)" required /><br>
		<label>Type: </label>
		<input name="range" type="radio" value="House" required>House</input>
		<input name="range" type="radio" value="Apartment">Apartment</input>
		<input name="range" type="radio" value="Companie">Companie</input><br>
		<textarea style="height:75px;" name="description" type="text" id="desc" placeholder="Type brief description of the place here" required></textarea><br>
		<input name="rooms" type="number" min="0" max="10"  id="rooms" placeholder="Number Of Rooms" required/><br>
		<input name="bathrooms" type="number" min="0" max="10"  id="bath" placeholder="Number Of BathRooms" required/><br>
		<input name="living_rooms" type="number" min="0" max="10" id="livingRooms" placeholder="Number Of Living Rooms" required/><br>
		<input name="price" type="text"  id="price" placeholder="Price" onchange="validatePrice(this)" required/><br>
		<label>For: </label>
		<input name="rangeType" type="radio" value="Sale" required>Sale</input>
		<input name="rangeType" type="radio" value="Rent">Rent</input><br>
		<input type="file" name="files[]" multiple required/>
		<input name="upload" type="submit" id="upload" value="Upload" onclick="return validateProductForm()" />
	</form>
</section>

</body>
</html>