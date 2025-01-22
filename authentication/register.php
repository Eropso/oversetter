<?php
session_start();
include("../database.php");


?>



    






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="body-login">
    <div class="form-container">
        <h2>Register</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        
            if (empty($email) || empty($username) || empty($password)) {
                echo "Please fill in all fields";
            } else {
                $sql_check = "SELECT * FROM users WHERE email = ?";
                $stmt_check = mysqli_prepare($conn, $sql_check);
                mysqli_stmt_bind_param($stmt_check, "s", $email);
                mysqli_stmt_execute($stmt_check);
                $result_check = mysqli_stmt_get_result($stmt_check);
        
                if (mysqli_num_rows($result_check) > 0) {
                    echo "User already exists. Please log in.";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
                    $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "sss", $email, $username, $hashed_password);
                        if (mysqli_stmt_execute($stmt)) {
                            echo "Registration successful! You can now log in.";
                        } else {
                            echo "<p class='error-message'>Could not execute query.</p>";
                        }
                    } else {
                        echo "<p class='error-message'>Could not prepare query.</p>";
                    }
                }
            }
        }

        ?>
        <form action="" method="POST">
            <div>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button class="registration-button" type="submit" name="submit" value="register">Sign Up</button>
        </form>
        <p>
            Already have an account? 
            <a href="login.php">Log in here</a>
        </p>
    </div>
</body>
</html>