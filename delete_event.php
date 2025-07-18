<?php
include 'conn.php'; // Ensure this file contains your database connection setup

if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    // Delete the event from the database
    $sql = "DELETE FROM recycling_event WHERE event_id = ?";

    if ($stmt = $dbConn->prepare($sql)) {
        $stmt->bind_param("i", $event_id); // Bind event_id as an integer
        if ($stmt->execute()) {
            // Redirect back with a success message
            header("Location: admin_event_database.php?msg=Event deleted successfully");
            exit();
        } else {
            echo "Error deleting event: " . $conn->error;
        }
        $stmt->close();
    }
} else {
    echo "Invalid request!";
}

$conn->close();
?>
