<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <link rel="stylesheet" type="text/css" href="CSS/aptForm.css">
        <script type= "text/javascript" src = "JS/countries.js"></script>
        <script type= "text/javascript" src = "JS/validations.js"></script>
    </head>	
	<?php 
		include('PreCode/header.php');
		if(isset($_POST['upload']) && isset($_FILES['files'])){
			$productObj->insertOrUpdateProduct($_POST);
		}
	?>
	<h2>Register your place!</h2>
	<form id="productForm" name="productForm" method="POST" action="" enctype="multipart/form-data">
		<input name="house_no" type="text" id="house_no" placeholder="No." required />
		<input name="street_name" type="text" id="street_name" placeholder="Street Name" required />
		<input name="apartment_no" type="text" id="apart_no" placeholder="Apartment No. (Optional)" />
		<input name="zip" type="text" id="zip" placeholder="Postal Code (H1H 1H1)" onchange="validateZipCode(document.getElementById('country'), this)" required />

		<select id="country" name ="country" onblur="selectCountry(this)" required></select>
		<select name ="state" id ="state" onblur="selectState(this)" required></select>
		 <script language="javascript">
			populateCountries("country", "state");
		 </script>
		
		<input name="city" type="text"  id="city" placeholder="City" required /></br>
		
		<label>What is it? </label>
		<input id="range" name="range" type="radio" value="House" required>House</input>
		<input id="range" name="range" type="radio" value="Apartment">Apartment</input>
		
		<textarea name="description" type="text" id="desc" placeholder="Type brief description of the place here including any information you think is relevant" required></textarea>
		<label>Bedrooms? </label>
		<input name="rooms" type="number" min="0" max="10"  id="rooms" placeholder="#" required/>
		<label>Bathrooms? </label>
		<input name="bathrooms" type="number" min="0" max="10"  id="bath" placeholder="#" required/>
		<label>Living rooms? </label>
		<input name="living_rooms" type="number" min="0" max="10" id="livingRooms" placeholder="#" required/></br></br>

		<label>It is for : </label>
		<input name="rangeType" type="radio" value="Sale" required>Sale</input>
		<input name="rangeType" type="radio" value="Rent">Rent</input></br></br>

		<label>You can upload pictures! </label><input type="file" name="files[]" multiple required/></br>


		<input name="price" type="text"  id="price" placeholder="Price (DO NOT include dollar sign)" onchange="validatePrice(this)" required/>
		<label>$<label>

		<input name="upload" type="submit" id="upload" value="Upload" onclick="return validateProductForm()" />
	</form>
</section>

</body>
</html>