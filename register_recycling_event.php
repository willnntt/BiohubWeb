<?php
if (isset($_POST['cancel'])) {
    header("Location: recycling_program.php");
    exit();
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $first_name     = trim($_POST['first_name']);
    $last_name      = trim($_POST['last_name']);
    $email          = trim($_POST['email']);
    $contact_number = trim($_POST['contact_number']);
    $address        = trim($_POST['address']);
    $gender         = $_POST['gender'];
    $event_name     = $_POST['event_name']; // Should be fetched dynamically from the dropdown

    // Database credentials
    $host    = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "biohub_database";

    // Connect to the database
    $conn = new mysqli($host, $db_user, $db_pass, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the event exists
    $event_check_sql = "SELECT event_name FROM recycling_event WHERE event_name = ?";
    $stmt_check = $conn->prepare($event_check_sql);
    $stmt_check->bind_param("s", $event_name);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows === 0) {
        echo "Error: Selected event does not exist.";
    } else {
        // Insert data using a prepared statement
        $sql = "INSERT INTO event_registration (first_name, last_name, email, contact_number, address, gender, event_name) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $first_name, $last_name, $email, $contact_number, $address, $gender, $event_name);

        if ($stmt->execute()) {
            // Redirect to recycling_program.php after successful registration
            header("Location: recycling_program.php?status=success");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close connections
    $stmt_check->close();
    $conn->close();
}
?>