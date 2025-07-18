<?php
session_start(); 
?>

<?php
include 'adminheader.php'; 
?>

<?php
if (isset($_POST['create'])) {
    $event_name        = $_POST['event_name'];
    $location          = $_POST['location'];
    $event_date        = $_POST['event_date'];
    $event_start_time  = $_POST['event_start_time'];
    $event_end_time    = $_POST['event_end_time'];
    $event_detail      = $_POST['event_detail'];

    $host    = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "biohub_database";

    
    // Connect to the database
    $conn = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle Image Upload
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";

        // Ensure uploads directory exists
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create folder with full permissions
        }

        $imageName = basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Allow only specific image types
        $allowedTypes = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedTypes)) {
            die("Error: Only JPG, JPEG, PNG, and GIF files are allowed.");
        }


        // Move the uploaded file
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            die("Error uploading image.");
        }
    } else {
        $imageName = ""; // No image uploaded
    }

    // Insert data using prepared statement
    $sql = "INSERT INTO recycling_event (event_name, location, event_date, event_start_time, event_end_time, event_detail, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $event_name, $location, $event_date, $event_start_time, $event_end_time, $event_detail, $imageName);

    if ($stmt->execute()) {
        echo "Event added successfully.";
        header("refresh:1; url=admin_event_database.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Event Creation Form</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
    <script src="map_script.js" defer></script>
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
</head>
<form-body>
    <main class="form-content">
        <section>
            <div class="registration-form-title">
                <h1>Upcoming Event Creation Form</h1>
            </div>             
        </section>

        <div class="registration-form">
            <form action="" method="POST" enctype="multipart/form-data">
            <table class="event-registration-container">
                <tr>
                    <td colspan="2">
                        <a href="admin_event_database.php" class="cancel_create_event">Cancel<i class="fa-solid fa-xmark"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>Event Name</th>
                    <td><input type="text" name="event_name" required="required" class="registration-input"></td>
                </tr>
                <!-- Location Input -->
                <tr>
                    <th>Location</th>
                    <th>
                        <textarea rows="3" name="location" class="registration-input"></textarea>
                    </th>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><input type="date" name="event_date" required="required" class="registration-input"></td>
                </tr> 
                <tr>
                    <th>Event Start Time</th>
                    <td><input type="time" name="event_start_time" required="required" class="registration-input"></td>
                </tr>
                <tr>
                    <th>Event End Time</th>
                    <td><input type="time" name="event_end_time" required="required" class="registration-input"></td>
                </tr>
                <tr>
                    <th>Event Detail</th>
                    <th>
                        <textarea rows="3" name="event_detail" class="registration-input"></textarea>
                    </th>
                </tr>

                <tr>
                    <th>Upload Event Image</th>
                    <th>
                        <input type="file" name="image" id="image" accept="image/*" required>
                    </th>
                </tr>
            </table>

            <div class="registration-button">
                <input type="reset" name="reset" value="Reset" class="reset_button"/>
                <input type="submit" name="create" value="Create" class="create_button"/>
            </div>            
        </form>
    </div>
    </main>
</form-body>
</html>