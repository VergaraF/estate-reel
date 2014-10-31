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
            <button type="button">Logout</button>
            <?php 
                session_start();
                if(isset($_SESSION['USERNAME'])){
                    echo $_SESSION['USERNAME'];
                    unset($_SESSION['USERNAME']);
                }
            ?>
        </aside>

        <aside id="unloggedMenu">
            <button type="button" onClick="window.location.href='index.php'">Home</button>
            <button type="button" onClick="window.location.href='login.php'" >Login</button>
            <button type="button" onClick="window.location.href='signUp.php'">Sign Up</button>
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