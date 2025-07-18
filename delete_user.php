<?php
include 'conn.php'; // Ensure this file contains your database connection setup

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Delete the event from the database
    $sql = "DELETE FROM user WHERE user_id = ?";

    if ($stmt = $dbConn->prepare($sql)) {
        $stmt->bind_param("i", $user_id); // Bind event_id as an integer
        if ($stmt->execute()) {
            // Redirect back with a success message
            header("Location: admin_user_database.php?msg=User deleted successfully");
            exit();
        } else {
            echo "Error deleting user: " . $conn->error;
        }
        $stmt->close();
    }
} else {
    echo "Invalid request!";
}

$conn->close();
?>