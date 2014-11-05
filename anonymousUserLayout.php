<?php

/*THIS FILE WILL BE USED FOR DISPLAYING ALL THE APARTMENTS/HOUSES TO ANY USER*/

    include('header.php');
    require_once('oopClass.php');
    $obj = new Myclass();
    $rs = $obj->getResultSetOf("SELECT * FROM apartment_house INNER JOIN apartment_images 
                                ON apartment_house.apartment_houseId = apartment_images.apartment_houseId
                                GROUP BY apartment_house.apartment_houseId");


?>
<h2>List of All Apartments/Houses</h2>
    <table border="1" align="center">
        <tbody>
            <tr>
                <th>Image</th>
                <th>Description</th>
                <th>Price</th>
                <th>Options</th>
            </tr>
            <?php
                if ($rs->num_rows > 0) {
                    while($row = $rs->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img style='width:100px;height:100px;' src='apartment_images/" . $row['file_name'] . "'/></td>" .
                             "<td>" . $row['description'] . "</td>" .
                             "<td>" . $row['price'] . "</td>";
            ?>
                        <!-- this form is used to delete or edit a specific apartment/house -->
                        <form name="deleteApart" method="POST" action="">
                            <input name="hiddenID" type="hidden" value="<?php echo $row['apartment_houseId']; ?>" />
                            <td>
                                <input name='showDetail' type='submit' value='Show Details' />
                            </td>
                        </form>
            <?php
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>