<?php
session_start();
include 'conn.php';

$host    = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "biohub_database";

// Connect to the database
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $username = trim($_POST['username']);
    $dob = $_POST['dob'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: sign_up_form.php");
        exit();
    }

    if (strlen($password) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters long.";
        header("Location: sign_up_form.php");
        exit();
    }

    // Check if email already exists
    $check_stmt = $conn->prepare("SELECT email FROM user WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $_SESSION['error'] = "Email already exists.";
        header("Location: sign_up_form.php");
        exit();
    }

    $check_stmt->close();

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $role = "member";
    $stmt = $conn->prepare("INSERT INTO user (username, dob, email, password, role, register_date) VALUES (?, ?, ?, ?, ?, NOW())");

    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error, 3, "errors.log");
        die("An error occurred. Please try again.");
    }
    
    $stmt->bind_param("sssss", $username, $dob, $email, $hashed_password, $role);
    
    if (!$stmt->execute()) {
        error_log("Execution failed: " . $stmt->error, 3, "errors.log");
        die("An error occurred. Please try again.");
    }
    
    $_SESSION['success'] = "User registered successfully!";
    header("Location: index.php");
    exit();
}
?>
