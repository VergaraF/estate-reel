    <body>
        <header>
            <h1>Estate R&eacuteel</h1>
        </header>

        <?php
            include('classes/databaseClass.php');
            include('classes/loginClass.php');
            include('classes/productClass.php');
            include('classes/conversationClass.php');
            include('classes/adminClass.php');
            $databaseObj     = new Database();
            $loginObj        = new Login();
            $productObj      = new Product();
            $conversationObj = new Conversation();
            $adminObj        = new Admin();
            session_start();
            $range = $loginObj->getRangeType($_SESSION['USERNAME']);
            $user_id = $loginObj->getUserId();
            $bannedUser = $loginObj->checkBannedUsers($user_id);
            if ($loginObj->isLoggedIn() && count($bannedUser) = 1) {
                echo "you are banned for a while";
            }
            elseif($loginObj->isLoggedIn() && strcmp($range, "Regular") === 0){
        ?>
        <aside id="loggedMenu" >
            <button type="button" onClick="window.location.href='index.php'">Home</button>
            <button type="button" onClick="window.location.href='userProfile.php'">Profile</button>
            <button type="button" onClick="window.location.href='messenger.php'">Messages</button>
            <button type="button" onClick="window.location.href='product.php'" >Upload</button>
            <button type="button" onClick="window.location.href='displayApartments.php'">View</button>
            <button type="button" onClick="window.location.href='logout.php'">Logout</button>
        </aside>
        <?php
          }elseif($loginObj->isLoggedIn() && strcmp($range, "Admin") === 0) {
        ?>
        <aside id="loggedMenu" >
            <button type="button" onClick="window.location.href='index.php'">Home</button>
            <button type="button" onClick="window.location.href='userProfile.php'">Admin</button>
            <button type="button" onClick="window.location.href=''">Conversations</button>
            <button type="button" onClick="window.location.href='displayApartments.php'">Apartments</button>
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
        
        <?php 
            } 
            ?>
        <section id="content">