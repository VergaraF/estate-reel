<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
    </head>
    <?php include('header.php'); ?>
    <section id="content">
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
                if (count($rsForIndex) > 0) {
                    for($row = 0; $row < count($rsForIndex); $row++){
                        echo "<tr><td><img style='width:100px;height:100px;' src='apartment_images/" . $rsForIndex[$row]['file_name'] . "'/></td>" .
                             "<td>" . $rsForIndex[$row]['description'] . "</td>" .
                             "<td>" . $rsForIndex[$row]['price'] . "</td>";
            ?>
                        <form name="deleteApart" method="GET" action="showDetails.php">
                            <input name="hiddenID" type="hidden" value="<?php echo $rsForIndex[$row]['apartment_houseId']; ?>" />
                            <td><input name='showDetail' type='submit' value='Show Details' /></td>
                        </form>
            <?php
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
    </section>
    </body>
</html>