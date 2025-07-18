<?php
session_start(); 
?>

<?php
include 'header.php'; 
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
    $NO = $_GET['id'];
    $sql = "SELECT * FROM ect WHERE NO='$NO'";
    $result = $conn->query($sql);
    $event = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];

    $update_sql = "UPDATE ect SET title='$title', description='$description', link='$link'  WHERE NO='$NO'";

    if ($conn->query($update_sql) === TRUE) {
        echo "Event updated successfully!";
        header("Location: admin_ect_database.php"); // Redirect back to the main page
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
                <h1>Edit Energy Conversion Tips</h1>
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
                    <td><input type="text" name="title" value="<?php echo htmlspecialchars($event['title']); ?>"></td>
                </tr>

                <tr>
                    <th>Description</th>
                    <td>
                        <textarea rows="3" name="description" class="registration-input"><?php echo htmlspecialchars($event['description']); ?></textarea>
                    </td>
                </tr>

                <tr>
                    <th>Link</th>
                    <td><input type="text" name="link" value="<?php echo htmlspecialchars($event['link']); ?>"></td>
                </tr>

            </table>

            <div class="registration-button">
                <input type="reset" name="reset" value="Reset" class="reset_button"/>
                <input type="submit" name="update" value="Update" class="create_button"/>
            </div>            
        </form>
    </div>
    </main>
</form-body>
</html>