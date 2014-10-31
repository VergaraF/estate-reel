<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        
        <script type= "text/javascript" src = "countries.js"></script>
    </head>
    <body>
        <header>
            <h1>Estate R&eacuteel</h1>
        </header>

        <aside id="loggedMenu">
            <button type="button" onClick="window.location.href='index.php'">Home</button>
            <button type="button">Profile</button>
            <button type="button">Messages</button>
        </aside>

        <aside id="unloggedMenu">
            <?php 
                if(isset($_SESSION['USERNAME'])){
                    echo "Logged in as: " . $_SESSION['USERNAME'];
                }
            ?>
            <button type="button" onClick="window.location.href='login.php'">Logout</button>
            <button type="button" onClick="window.location.href='product.php'" >Upload</button>
            <button type="button" onClick="window.location.href='displayApartments.php'">View</button>
        </aside>
        <section id="content">