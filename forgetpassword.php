<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgetpassword</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <center>
    <div class="resetpassword" >
        <h2>Reset Password</h2>
        <div class="resetpassword_container">
        <form action="send_reset.php" method="POST">
            <input class="reset_email" type="email" name="email" placeholder="Enter your email" required>
            <button class="resetbutton" type="submit">Get Reset Link</button>
        </form>
        </div>
    </div>
    </center>
</body>
</html>

