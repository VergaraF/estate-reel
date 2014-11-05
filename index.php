<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
    </head>
<?php
    include('header.php');
    ?>
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
        </section>

    </body>

</html>