<?php
session_start();
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Use email instead of username for clarity
    $email = isset($_POST['username']) ? trim($_POST['username']) : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Email and password are required.";
        header("Location: index.php");
        exit();
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT user_id, username, password, role FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $db_username, $db_password, $role);
        $stmt->fetch();

        // Verify password (ensure your DB stores hashed passwords)
        if (password_verify($password, $db_password)) {
            // Regenerate session ID for security
            session_regenerate_id(true); 
            $_SESSION['user'] = $db_username;
            $_SESSION['role'] = $role;
            $_SESSION['userid'] = $user_id;

            // Redirect based on role
            if ($role === "member") {
                header("Location: home.php");
            } else if ($role === "admin") {
                header("Location: admin_home.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password.";
        }
    } else {
        $_SESSION['error'] = "User not found.";
    }

    $stmt->close();
    header("Location: index.php");
    exit();
}
?>
