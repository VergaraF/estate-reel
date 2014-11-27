<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    </head>
<?php 
	include('PreCode/header.php');
	//require('PreCode/authentication.php');
?>
	<form name="viewOwnerProfile" method="POST" action="">
		<input name="viewProfile" type="submit" value="View Owner Profile" >
	</form>
	<form name="mess" method="POST" action="createConvo.php">
		<input name="hiddenID2" type="hidden" value="<?php echo $_GET['hiddenID']; ?>" >
		<input name="messageOwner" type="submit" value="Message the Owner" >
	</form>
	<div id="col1">
		<div id="gallery">
			<?php
				if (isset($_POST['viewProfile'])) {
			?>		
					<h2>Owner Info</h2>
					<table align="center" border="1">
						<tbody>
			<?php	
					$user_id = null;
					$resultSetArray = $productObj->displaySpecificProduct($_GET['hiddenID']);
					if (count($resultSetArray) === 1) {
						$user_id = $resultSetArray[0]['user_id'];
						$userInfoArray = $loginObj->getUserById($user_id);
						for ($row=0; $row < count($userInfoArray); $row++) { 
			?>
							<tr>
								<td>First Name</td>
								<td> <?php echo $userInfoArray[$row]['firstname']; ?> </td>
							</tr>
							<tr>
								<td>Last Name</td>
								<td> <?php echo $userInfoArray[$row]['lastname']; ?> </td>
							</tr>
							<tr>
								<td>Phone Number</td>
								<td> <?php echo $userInfoArray[$row]['phoneNumber']; ?> </td>
							</tr>
			<?php 	
						} 
					}else{
						echo "Invalid input";
					}
			?>
						</tbody>
					</table><br>
			<?php	
				}elseif (isset($_POST['messageOwner'])) {
					if (isset($_SESSION['USERNAME'])) {
						header("location: createConvo.php");
						exit();
					}else{
						$databaseObj->printMessage("MESSAGE", "You need to login in order to send a message to the owner", "login.php");
					}
				}
				$databaseObj->createConnection();
				$allTheImages = $productObj->getAllTheImages($_GET['hiddenID']);
				for ($row = 0; $row < count($allTheImages); $row++) {
					echo "<img id='$row' class='hidden' src='apartment_images/" . $allTheImages[$row]['file_name'] . "'>";
				}
			?>
			<span class="span" id="0" ></span>
		</div>
		<img class="arrow" src="apartment_images/left.png" onClick="return goLeft(document.getElementsByClassName('span'))">
		<img class="bigImage" src="apartment_images/
			<?php 
				if(strcmp($allTheImages[0]['file_name'], '') === 0){
					echo 'no_image.jpg';
				}else{
					echo $allTheImages[0]['file_name'];
				}
			?>">
		<img class="arrow" src="apartment_images/right.png" onClick="return goRight(document.getElementsByClassName('span'))">
	</div>
<div id="col2">
<h2>Detailed Info</h2>
<table id="details" align="center" border="1">
	<tbody>
<?php
	$detailedInfo = $productObj->displaySpecificProduct($_GET['hiddenID']);
	for ($row = 0; $row < count($detailedInfo); $row++){
?>
		<tr>
			<td>House Number</td>
			<td> <?php echo $detailedInfo[$row]['house_no']; ?> </td>
		</tr>
		<tr>
			<td>Street Name</td>
			<td> <?php echo $detailedInfo[$row]['street_name']; ?> </td>
		</tr>
		<tr>
			<td>City</td>
			<td> <?php echo $detailedInfo[$row]['city']; ?> </td>
		</tr>
		<tr>
			<td>Province</td>
			<td> <?php echo $detailedInfo[$row]['province']; ?> </td>
		</tr>
		<tr>
			<td>Zip Code</td>
			<td> <?php echo $detailedInfo[$row]['zip_code']; ?> </td>
		</tr>
		<tr>
			<td>Country</td>
			<td> <?php echo $detailedInfo[$row]['country']; ?> </td>
		</tr>
		<tr>
			<td>Type</td>
			<td> <?php echo $detailedInfo[$row]['type']; ?> </td>
		</tr>
		<tr>
			<td>Description</td>
			<td> <?php echo $detailedInfo[$row]['description']; ?> </td>
		</tr>
		<tr>
			<td>Rooms no.</td>
			<td> <?php echo $detailedInfo[$row]['no_of_rooms']; ?> </td>
		</tr>
		<tr>
			<td>Bathrooms no.</td>
			<td> <?php echo $detailedInfo[$row]['no_of_bathrooms']; ?> </td>
		</tr>
		<tr>
			<td>Living no.</td>
			<td> <?php echo $detailedInfo[$row]['no_of_living_rooms']; ?> </td>
		</tr>
		<tr>
			<td>Price</td>
			<td> <?php echo $detailedInfo[$row]['price']; ?> </td>
		</tr>
		<tr>
			<td>It is for </td>
			<td> <?php echo $detailedInfo[$row]['rangeType']; ?> </td>
		</tr>
		</tbody>
<?php } ?>
</table>
</div>
</section>
<script>
	var imageArray = new Array();
    <?php for ($row = 0; $row < count($allTheImages); $row++) { ?>
        imageArray.push("<?php echo $allTheImages[$row]['file_name']; ?>");
    <?php } ?>
	var index = 0;
	function goRight(div) {
		var newID = parseInt(div[index].id) + 1;
		div[index].id = newID;
		
		if ( document.getElementById(newID).src == null) {
			newID = 0;
			div[index].id = newID;
		}
		document.getElementsByClassName("bigImage")[index].src = document.getElementById(newID).src;
		console.log(document.getElementById(newID));
	}
	
	function goLeft(div) {
		var newID = parseInt(div[index].id) - 1;
		div[index].id = newID;
		
		if ( document.getElementById(newID).src == null) {
			newID = imageArray.length - 1;
			div[index].id = newID;
		}
		document.getElementsByClassName("bigImage")[index].src = document.getElementById(newID).src;
		console.log(document.getElementById(newID));
	}
</script>

</body>
</html>