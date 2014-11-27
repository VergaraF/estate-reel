<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <link rel="stylesheet" type="text/css" href="CSS/searchLayout.css">
        <script type= "text/javascript" src = "JS/validations.js"></script>
     
    </head>
    <?php include('PreCode/header.php'); 
          ?>
	        <form name="search" method="GET" action="">
	       		<label>Search : </label>
	       		<input type="button" onClick="window.location.href='search.php?type=specific'" value="Specific search"></input>
				<input type="button" onClick="window.location.href='search.php?type=flexible'" value="Flexible search"></input>
	        </form>
	      
	      <section id="SearchParametres">
	      	<?php 
	      		if (isset($_GET['type']) && strcmp($_GET['type'], "flexible") === 0) {?>
	      		<form id="flexible"name="flexible" method="GET" action="">
	      			<input type="text" name="searchMethod" hidden value="flexible"></input>
	      			<label>You are looking for ...</label>
	      			<input name="type" type="radio" value="Sale">Sale</input>
					<input name="type" type="radio" value="Rent">Rent</input></br>

					<label>Bedrooms : </label>
					<label>Min </label>
					<input type="number" name="roomMin" value="" placeholder="1" min="0" max="10"></input>
					<label>Max </label>
					<input type="number" name="roomMax" value="" placeholder="2" min="0" max="10"></input></br>

					<label>Bathrooms : </label>
					<label>Min </label>
					<input type="number" name="bathMin" value="" placeholder="1" min="0" max="10"></input>
					<label>Max </label>
					<input type="number" name="bathMax" value="" placeholder="2" min="0" max="10"></input></br>

					<label>Max budget : </label>
				    <input type="text" name="price" value="" placeholder="Not include '$'" onchange="validatePrice(this)"></input><label>$</label></br>
	      			
	      			<label>What is it? </label>
	      			<input name="place" type="radio" value="House">House</input>
					<input name="place" type="radio" value="Apartment">Apartment</input></br>
	      			<input type="submit" name="Search" value="Search"></input>

	      		</form>

	      	<?php	
	      		}elseif (isset($_GET['type']) && strcmp($_GET['type'], "specific") === 0){ ?>
	      		<form id="specific" name="specific" method="GET" action="">
	      			<input type="text" name="searchMethod" hidden value="specific"></input>
	      			<label>You are looking for ...</label>
	      			<input name="type" type="radio" value="Sale">Sale</input>
					<input name="type" type="radio" value="Rent">Rent</input></br>

					<label>Bedrooms : </label>
					<input type="number" name="rooms" value="" placeholder="1" min="0" max="10"></input></br>

					<label>Bathrooms : </label>
					<input type="number" name="baths" value="" placeholder="1" min="0" max="10"></input></br>

					<label>Max budget : </label>
				    <input type="text" name="price" value="" placeholder="Not include '$'" onchange="validatePrice(this)"></input><label>$</label></br>
	      			
	      			<label>What is it? </label>
	      			<input name="place" type="radio" value="house">House</input>
					<input name="place" type="radio" value="apartment">Apartment</input></br>
	      			<input type="submit" name="Search" value="Search"></input>
	      			

	      		</form>

	      	<?php
	      		}
	      	?>
	      </section>
	      <section id="Apartments">
	      	<?php
	      	if (isset($_GET['Search'])){
	      		switch ($_GET['searchMethod']) {
	      			case 'flexible':
	      				$rsForSearchFlex = $productObj->searchFlexible($_GET);
	      				if (count($rsForSearchFlex) > 0) {
	      				 for($row = 0; $row < count($rsForSearchFlex); $row++){
			              	  echo "
			              	 	 <table id='apt' align='center'>
			                	  <tr id='col1'>
			                 	   <td rowspan='3'><img id='placeImg' src='apartment_images/" . $rsForSearchFlex[$row]['file_name'] . "'/></td>
			                	    <td rowspan='3' id='col2'>" . $rsForSearchFlex[$row]['description'] . "</th>
			                  	  <th></th>
			                	  </tr>
			                	  <tr>
			                 	   <td></td>
			                	  </tr>
			                 	 <tr id='price'>
			                 	   <td><p id='number'>" . $rsForSearchFlex[$row]['price'] . "$</p></td>
			               	   </tr>
			              	  </table>";
			       		     }
			    		   }		
	      				break;
	      			case 'specific':
						$rsForSearch = $productObj->searchSpecific($_GET);
	      				if (count($rsForSearch) > 0) {
			      		 for($row = 0; $row < count($rsForSearch); $row++){
		              	  echo "
		              	 	 <table id='apt' align='center'>
		                	  <tr id='col1'>
		                 	   <td rowspan='3'><img id='placeImg' src='apartment_images/" . $rsForSearch[$row]['file_name'] . "'/></td>
		                	    <td rowspan='3' id='col2'>" . $rsForSearch[$row]['description'] . "</th>
		                  	  <th></th>
		                	  </tr>
		                	  <tr>
		                 	   <td></td>
		                	  </tr>
		                 	 <tr id='price'>
		                 	   <td><p id='number'>" . $rsForSearch[$row]['price'] . "$</p></td>
		               	   </tr>
		              	  </table>";
		          	 	 }
		      		   }
	      				break;
	      			default:
	      				# code...
	      				break;
	      		}
	      	}

	      	?>

	      </section>
       </section>

    </body>
</html>