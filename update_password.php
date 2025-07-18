<?php
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];
    if (strlen($newPassword) < 8) {
        echo "<script>
                alert('Password must be at least 8 characters long!');
                window.history.back(); // Redirect back to the form
              </script>";
        exit();
    }
    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

    // Get user email from token
    $stmt = $conn->prepare("SELECT email FROM password_resets WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->bind_result($email);
    
    if ($stmt->fetch()) {
        $stmt->close();
        // Update password
        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashed_password, $email);
        $stmt->execute();
        $stmt->close();

        // Delete reset token
        $stmt = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $stmt->close();

        echo "<script>
                alert('Password updated successfully!');
                window.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
                alert('Password updated successfully!');
                window.location.href = 'index.php';
            </script>";
    }
}
?>
