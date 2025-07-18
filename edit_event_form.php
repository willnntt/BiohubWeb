<?php
session_start(); 
?>

<?php
include 'adminheader.php'; 
?>

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
    $event_id = $_GET['id'];
    $sql = "SELECT * FROM recycling_event WHERE event_id='$event_id'";
    $result = $conn->query($sql);
    $event = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['event_name'];
    $location = $_POST['location'];
    $date = $_POST['event_date'];
    $start_time = $_POST['event_start_time'];
    $end_time = $_POST['event_end_time'];
    $detail = $_POST['event_detail'];

    $update_sql = "UPDATE recycling_event SET event_name='$name', location='$location', event_date='$date', 
                   event_start_time='$start_time', event_end_time='$end_time', event_detail='$detail' WHERE event_id='$event_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "Event updated successfully!";
        header("Location: admin_event_database.php"); // Redirect back to the main page
        exit();
    } else {
        echo "Error updating event: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event Form</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
    <script src="map_script.js" defer></script>
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
</head>
<form-body>
    <main class="form-content">
        <section>
            <div class="registration-form-title">
                <h1>Edit Event Form</h1>
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
                    <td><input type="text" name="event_name" class="registration-input" value="<?php echo $event['event_name']; ?>"></td>
                </tr>
                <!-- Location Input -->
                <tr>
                    <th>Location</th>
                    <th>
                        <textarea rows="3" name="location" class="registration-input"><?php echo htmlspecialchars($event['location']); ?></textarea>
                    </th>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><input type="date" name="event_date" class="registration-input" value="<?php echo $event['event_date']; ?>"></td>
                </tr> 
                <tr>
                    <th>Event Start Time</th>
                    <td> <input type="time" name="event_start_time" class="registration-input" value="<?php echo $event['event_start_time']; ?>"></td>
                </tr>
                <tr>
                    <th>Event End Time</th>
                    <td><input type="time" name="event_end_time" class="registration-input" value="<?php echo $event['event_end_time']; ?>"></td>
                </tr>
                <tr>
                    <th>Event Detail</th>
                    <th>
                        <textarea name="event_detail" class="registration-input"><?php echo $event['event_detail']; ?></textarea>
                    </th>
                </tr>
            </table>
    
            <div id="eventDetails" class="event-details">
                <h3>Important Note!</h3>
                <p id="eventDescription"> Event images are not editable. If any unforeseen issues occur with the images, the related event must be removed to address the problem.</p>   
            </div>

            <div class="registration-button">
                <input type="reset" name="reset" value="Reset" class="reset_button"/>
                <input type="submit" name="update" value="Update" class="create_button"/>
            </div>            
        </form>
    </div>
    </main>
</form-body>
</html>