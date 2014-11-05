    <body>
        <header>
            <h1>Estate R&eacuteel</h1>
        </header>

        <?php
            include('oopClass.php');
            $obj = new Myclass();
            session_start();
            $rs = $obj->getResultSetOf("SELECT * FROM apartment_house INNER JOIN apartment_images 
                                ON apartment_house.apartment_houseId = apartment_images.apartment_houseId
                                GROUP BY apartment_house.apartment_houseId");
            if(isset($_SESSION['USERNAME'])){
        ?>
        <aside id="loggedMenu" >
            <button type="button" onClick="window.location.href='index.php'">Home</button>
            <button type="button">Profile</button>
            <button type="button">Messages</button>
            <button type="button" onClick="window.location.href='product.php'" >Upload</button>
            <button type="button" onClick="window.location.href='displayApartments.php'">View</button>
            <button type="button" onClick="window.location.href='logout.php'">Logout</button>
        </aside>
        <?php
          } else{

        ?>
        <aside id="unloggedMenu">
            <button type="button" onClick="window.location.href='index.php'">Home</button>
            <button type="button" onClick="window.location.href='login.php'" >Login</button>
            <button type="button" onClick="window.location.href='signUp.php'">Sign Up</button>
        </aside>
        <section id="content">
        <?php 
            } 
            ?>
