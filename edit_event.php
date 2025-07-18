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