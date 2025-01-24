<?php
session_start();
include("database.php");



if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: authentication/login.php");
    exit();
}


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
            <li><a href="about.php">About</a></li>
            <li><a href="inquiry.php">Inquiry</a></li>
            <li><a href="mailto:phpkuben@gmail.com">Contact</a></li>
        </ul>
        
        <ul>
            <li><a class="tradutt-logo" href="index.php"><p>Tradutt</p></a></li>
            <li class="hideOnMobile"><a href="about.php">About</a></li>
            <li class="hideOnMobile"><a href="inquiry.php">Inquiry</a></li>

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


    
    
    <div class="inquiry">

        <form action="" method="POST">
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_SPECIAL_CHARS);
                $languages = $_POST['languages'];

                if(empty($book) || empty($languages)){
                    echo "<p class='error-message'>Please fill in all fields.</p>";
                }
                else{
                    $user_id = $_SESSION['user']['id'];
                
                    $sql = "INSERT INTO book (user_id, book, languages) VALUES (?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "iss", $user_id, $book, $languages);
                    mysqli_stmt_execute($stmt);
                    header("Location: receipt.php");
                }
            }

            ?>
            <h2>Name of Book</h2>
            <input type="text" name="book">


            <div class="language-container">
                <h2>Choose a language:</h2>

                <select name="languages" id="languages">
                    <option value="English">English</option>
                    <option value="Spanish">Spanish</option>
                    <option value="German">German</option>
                    <option value="French">French</option>
                    <option value="Mandarin">Mandarin</option>
                </select>
            </div>





            <div>
                <button class="inquiry-submit">Submit</button>
            </div>
        </form>

    </div>


    <script src="script.js"></script>
</body>
</html>