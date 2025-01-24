<?php
session_start();
include("database.php");


//If not logged in sent to login
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


    
    
    <div class="inquiry">

        <form class="form-container-inquiry" action="" method="POST">
            <div class="content-inquiry">

            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_SPECIAL_CHARS);
                $languages = $_POST['languages'];
                $description = $_POST['description-of-book'];

                
                //empty show error
                if(empty($book) || empty($languages || empty($description))){
                    echo "<p class='error-message'>Please fill in all fields.</p>";
                }
                else{
                    $user_id = $_SESSION['user']['id'];
                
                    $sql = "INSERT INTO book (user_id, book, languages, descriptions) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "isss", $user_id, $book, $languages, $description);
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



            <h2>Write your book translation request</h2>
            <textarea name="description-of-book" id="description-of-book"></textarea>





            <div>
                <button class="inquiry-submit">Submit</button>
            </div>
            </div>
        </form>

    </div>


    <script src="script.js"></script>
</body>
</html>