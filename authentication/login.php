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
        <h2>Login</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitize and filter user input
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
            
            //error if empty
            if (empty($email) || empty($password)) {
                echo "Please fill in all fields.";
            } else {
                // Check if the email already exists in the database
                $sql_check = "SELECT * FROM users WHERE email = ?";
                $stmt_check = mysqli_prepare($conn, $sql_check);
                if ($stmt_check) {
                    mysqli_stmt_bind_param($stmt_check, "s", $email);
                    mysqli_stmt_execute($stmt_check);
                    $result_check = mysqli_stmt_get_result($stmt_check);
                    
                    // If the query returns at least one row, that means the email exists in the database
                    if ($result_check && mysqli_num_rows($result_check) > 0) {
                        $user = mysqli_fetch_assoc($result_check); 
                        // If password match put info in session
                        if (password_verify($password, $user['password'])) {
                            $_SESSION['user'] = [
                                'id' => $user['id'],
                                'email' => $user['email'],
                                'username' => $user['username'],
                                'role' => $user['role']
                            ];
                            echo "Login successful!";
                            $_SESSION['loggedin'] = true; 
                            header("Location: ../index.php");
                            exit;
                        } else {
                            //error if password is incorrect
                            echo "<p class='error-message'>Incorrect password. Please try again.</p>";
                        }
                    } else {
                        //error if email is not in database
                        echo "<p class='error-message'>No account found with that email address.</p>";
                    }
                } else {
                        // Error preparing the SQL query
                        echo "<p class='error-message'>Unable to prepare the database query.</p>";
                }
            }
        }
        ?>
        <form action="" method="POST">
            <div>
                <input type="text" name="email" placeholder="Email" required>
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button class="registration-button" type="submit" name="submit" value="login">Log In</button>

            <p>
                Not a user?
                <a href="register.php">Register yourself now</a>
            </p>
            
        </form>
    </div>
</body>
</html>