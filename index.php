<!-- THIS FILE IS OPENED WHEN THE USER LOGS INTO THE SITE!! THIS SHOULD DISPLAY ALL 
     THE APARTMENTS/HOUSES ALSO (WITH A DIFFERENT HEADER THAN THE OTHER FILE WHICH IS anonymousUserLayout.php) 
-->
<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
    </head>
    <body>
        <header>
            <h1>Estate R&eacuteel</h1>
        </header>


        <aside id="loggedMenu">
            <button type="button">Home</button>
            <button type="button">Profile</button>
            <button type="button">Messages</button>
        </aside>

        <aside id="unloggedMenu">
            <?php 
                require('authentication.php');
                if(isset($_SESSION['USERNAME'])){
                    echo "Logged in as: " . $_SESSION['USERNAME'];
                }
            ?>
            <button type="button" onClick="window.location.href='login.php'">Logout</button>
            <button type="button" onClick="window.location.href='product.php'" >Upload</button>
            <button type="button" onClick="window.location.href='displayApartments.php'">View</button>
        </aside>

        <section id="content">
            <h2>Second Header TEST</h2>
           <p> content section where everything is going to be displayed</p>
        </section>
			
		<footer>
			<p> Estate R&eacuteel - Ajmer Singh & Fabian Vergara</p>
		</footer>
    </body>

</html>