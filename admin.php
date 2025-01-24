<?php
session_start();
include("database.php");
$role = $_SESSION['user']['role'];


//If not admin sent back to home
if ( $role !== 'admin') {
    header("Location: index.php");
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

    <div class="admin-container">
        <div>
            <h1>Orders</h1>
            <?php
            // fetch all the orders
            $sql = "SELECT * FROM book";
            $result = mysqli_query($conn, $sql);
            
            // Check if there are any orders to display
            if (mysqli_num_rows($result) > 0) {
                echo "<table border='1'>";
                echo "<tr><th>User ID</th><th>Book Name</th><th>Languages</th><th>Description</th><th>Reg_date</th></tr>";
                
                // Loop through the orders and display each row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>" . $row['user_id'] . "</td><td>" . $row['book'] . "</td><td>" . $row['languages'] . "</td><td>" . $row['descriptions'] . "</td><td>" . $row['reg_date'] . "</td></tr>";
                }
                echo "</table>";
            } else {
                // If no orders are found, error message
                echo "No orders found.";
            }
            ?>
        </div>

        <div>
            <h1>Users</h1>
            <?php
            // fetch all users
            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql);
            
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Username</th><th>Password</th><th>Reg_date</th><th>Role</th></tr>";
            
            // Loop through the users and display each row
            while ($row = mysqli_fetch_array($result)) {
                $id = $row["id"];
                $username = $row["username"];
                $password = $row["password"];
                $reg_date = $row["reg_date"];
                $role = $row["role"];

                // If admin yellow
                if ($role == 'admin') {
                    $color = 'yellow';
                } else {
                    // Not admin green
                    $color = 'greenyellow';
                }

                echo '<tr style="background-color: ' . $color . '"><td>' . $id . '</td><td>' . $username . '</td><td>' . $password . '</td><td>' . $reg_date . '</td><td>' . $role . ' </td></tr>';
            }
            echo "</table>";
            ?>
        </div>
    </div>


    



    <script src="script.js"></script>
</body>
</html>