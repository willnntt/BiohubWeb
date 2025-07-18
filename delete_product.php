<?php 
include '../conn.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Delete the event from the database
    $sql = "DELETE FROM product_swap WHERE product_id = ?";

    if ($stmt = $dbConn->prepare($sql)) {
        $stmt->bind_param("i", $product_id); // Bind event_id as an integer
        if ($stmt->execute()) {
            // Redirect back with a success message
            header("Location: admin_product_database.php?msg=Product deleted successfully");
            exit();
        } else {
            echo "Error deleting prodcuct: " . $dbConn->error;
        }
        $stmt->close();
    }
} else {
    echo "Invalid request!";
}

$dbConn->close();
?>