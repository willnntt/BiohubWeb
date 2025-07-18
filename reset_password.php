<?php
include 'header.php';
require 'conn.php';

if (!isset($_GET['token'])) {
    die("Invalid request!");
}

$token = $_GET['token'];
$stmt = $conn->prepare("SELECT email FROM password_resets WHERE token = ?");
$stmt->execute([$token]);
$user = $stmt->fetch();
$stmt->close();

if (!$user) {
    die("Invalid token!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <center>
    <div class="resetpassword" >
        <h2>Set New Password</h2>
        <div class="resetpassword_container">
        <form action="update_password.php" method="POST">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <input class="reset_password" type="password" name="new_password" placeholder="New Password" required>
            <button class="resetbutton" type="submit">Reset Password</button>
        </form>
        </div>
    </div>
    </center>
</body>
</html>