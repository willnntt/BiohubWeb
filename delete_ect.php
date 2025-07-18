<?php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "biohub_database";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $NO = $_GET['id'];

    // Delete the event from the database
    $sql = "DELETE FROM ect WHERE NO = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $NO); // Bind NO as an integer
        if ($stmt->execute()) {
            // Redirect back with a success message
            header("Location: admin_ect_database.php?msg=Event deleted successfully");
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
