<?php
session_start();
include("database.php");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <ul class="sidebar">
            <li onclick=hideSidebar()><a href="#"><img src="images/close.svg" alt=""></a></li>
            <li><a href="inquiry.php">Inquiry</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li><a href="mailto:phpkuben@gmail.com">Contact</a></li>
        </ul>
        
        <ul>
            <li><a class="tradutt-logo" href="index.php"><p>Tradutt</p></a></li>
            <li class="hideOnMobile"><a href="about.php">About</a></li>
            <li class="hideOnMobile"><a href="inquiry.php">Inquiry</a></li>

            <!-- If logged in show profile else show login -->
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <div class="dropdown">
                    <img class="profile" src="images/defaultprofile.svg" alt="defaultprofile" onclick="myFunction()">
                    <div id="myDropdown" class="dropdown-content">
                        <?php $role = $_SESSION['user']['role']; if($role == 'admin'){echo '<a href="admin.php">Orders</a>';} ?>
                        <a href="authentication/logout.php" class="logout-button"><img src="images/logout.svg" alt="">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="authentication/login.php" class="login-button"><img src="images/person_white.svg" alt="">Login</a>
            <?php endif; ?>            
            <li class="menu-button" onclick=showSidebar()><a href="#"><img src="images/menu.svg" alt=""></a></li>
        </ul>
    </nav>


    


    <div class="hero">
        <div class="hero_text">
            <h1 class="title_hero">
                Translate Your Book Today
            </h1>


            <hr class="line_home">
            <ul class="short_about">
                <li>Get Your Book Translated</li>
                <li>Rapid Service</li>
                <li>Low Cost</li>
            </ul>


            <a class="button_hero"href="inquiry.php">
                <button class="Translate">Translate</button>
            </a>
        </div>

        
        <div class="book">
            <img src="images/book.jpg" alt="book">
            <div>
                Image by <a href=" https://www.vectorportal.com" >Vectorportal.com</a>,  <a class="external text" href="https://creativecommons.org/licenses/by/4.0/" >CC BY</a>
            </div>
        </div>

    </div>



    <script src="script.js"></script>
</body>
</html>