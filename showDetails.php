<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    </head>
<?php 
	include('PreCode/header.php');
	require('authentication.php');
?>
	<div id="col1">
		<div id="gallery">
			<?php
				$databaseObj->createConnection();
				$allTheImages = $productObj->getAllTheImages($_GET['hiddenID']);
				for ($row = 0; $row < count($allTheImages); $row++) {
					echo "<img id='$row' class='hidden' src='apartment_images/" . $allTheImages[$row]['file_name'] . "'>";
				}
			?>
			<span class="span" id="0" ></span>
		</div>
		<img class="arrow" src="apartment_images/left.png" onClick="return goLeft(document.getElementsByClassName('span'))">
		<img class="bigImage" src="apartment_images/<?php echo $allTheImages[0]['file_name']; ?>">
		<img class="arrow" src="apartment_images/right.png" onClick="return goRight(document.getElementsByClassName('span'))">
	</div>
<div id="col2">
<h2>Detailed Info</h2>
<?php
	$detailedInfo = $productObj->displaySpecificProduct($_GET['hiddenID']);
	for ($row = 0; $row < count($detailedInfo); $row++){
		echo "<p>Address: " . $detailedInfo[$row]['house_no'] . " "  . $detailedInfo[$row]['street_name'] . "<br>" 
							. $detailedInfo[$row]['city'] 	  . ", " . $detailedInfo[$row]['province'] 	  . "<br>" 
							. $detailedInfo[$row]['zip_code'] . ", " . $detailedInfo[$row]['country'] 	  . "</p>";
	}
?>
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