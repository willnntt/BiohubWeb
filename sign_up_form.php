<?php
session_start(); 
?>

<?php
include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
    <!-- SIGN UP SECTION -->
    <main class="content">
        <div class="sign-up-container">

            <!-- Left Side -->
            <div class="sign-up-left-container">
                <img src="home_pic/sign_up_bg.jpg" alt="Login Background">
            </div>
            <!-- Right Side -->
            <div class="sign-up-right-container">
                <h1>JOIN US!</h1>
                <form action="sign_up.php" method="POST" enctype="multipart/form-data">
                    <div class="input-box">
                        <input type="text" placeholder="Username" name="username" required />
                    </div>
                    <div class="input-box">
                        <input type="date" placeholder="Date of Birth" name="dob" required />
                    </div>
                    <div class="input-box">
                        <input type="email" placeholder="Email" name="email" required />
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Password" name="password" required />
                    </div>
                    <button class="body-sign-up-button" type="submit">Sign Up</button>
                    <p class="signup">
                        Already have an account? <a href="#">Log In</a>
                    </p>
                </form>
            </div>
        </div>
    </main>
</body>
</html>