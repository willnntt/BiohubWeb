<?php
session_start(); 
?>

<?php
include 'adminheader.php'; 
?>

<?php
if (isset($_POST['create'])) {
    $title       = $_POST['title'];
    $description = $_POST['description'];
    $link        = $_POST['link'];


    $host    = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "biohub_database";

    
    // Connect to the database
    $conn = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data using prepared statement
    $sql = "INSERT INTO ect (title, description, link) 
            VALUES (?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $description, $link);

    if ($stmt->execute()) {
        echo "Event added successfully.";
        header("refresh:1; url=admin_ect_database.php");
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
                <h1>Add New Tips</h1>
            </div>             
        </section>

        <div class="registration-form">
            <form action="" method="POST" enctype="multipart/form-data">
            <table class="event-registration-container">
                <tr>
                    <td colspan="2">
                        <a href="admin_ect_database.php" class="cancel_create_event">Cancel<i class="fa-solid fa-xmark"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td><input type="text" name="title" required="required" class="registration-input"></td>
                </tr>
                <!-- Location Input -->
                <tr>
                    <th>Description</th>
                    <th>
                        <textarea rows="5" name="description" class="registration-input"></textarea>
                    </th>
                </tr>
                <tr>
                    <th>Link</th>
                        <td><input type="text" name="link" required="required" class="registration-input"></td>
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