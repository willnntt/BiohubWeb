<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']); // Define the variable
include 'header.php'; // Now the variable is available in header.php
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
    <style>
        html, body {
            height: 100%;
            overflow: hidden; /* Prevent scrolling */
            margin: 0;
            padding: 0;
    }
    </style>
</head>
<body>
    <main class="content">
        <div class="login-container">
            <!-- Left Side -->
            <div class="col left-side">
                <h1>WELCOME BACK!</h1>
                <form action="login.php" method="POST">
                    <div class="input-box">
                        <input type="email" placeholder="Email" name="username" required />
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Password" name="password" required />
                    </div>
                    <p class="forgot-password">Forgot your password? <a href="forgetpassword.php">Forgot Password</a></p>
                    <button class="body-login-button">Login Now</button>
                    <p class="signup">
                        Don't have an account? <a href="sign_up_form.php">Sign up now!</a>
                    </p>
                </form>
            </div>
    
            <!-- Right Side -->
            <div class="col right-side">
                <img src="home_pic/login_bg.jpg" alt="Login Background">
            </div>
        </div>
    </main>
</body>
</html>