<?php
session_start(); 
include 'adminheader.php'; 

// Database connection 
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

// Initial query to fetch all events
$sql = "SELECT * FROM recycling_event";

// Check if search is performed
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM recycling_event 
            WHERE event_name LIKE '%$search%' 
            OR location LIKE '%$search%' 
            OR event_detail LIKE '%$search%'";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Recycling Events</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
</head>
<body>
    <main class="content">
        <section>
            <div class="database_title">
                <h1>Recycling Event Database</h1>
            </div>             
        </section>
        <section>
            <div class="search-container">
                <form method="GET" action="">
                    <div class="search-box">
                        <input class="search-input" type="search" name="search" placeholder="Search event data here" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <a href="create_event_form.php" class="create_event_link">Create <i class="fa-solid fa-square-plus"></i></a>
            </div>
        </section>
        <div class="table-container">
            <table class="database">
                <thead>
                    <tr>
                        <th>Event ID</th>
                        <th>Event Name</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Details</th>
                        <th>Image</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['event_id']}</td>
                                <td>{$row['event_name']}</td>
                                <td>{$row['location']}</td>
                                <td>{$row['event_date']}</td>
                                <td>{$row['event_start_time']}</td>
                                <td>{$row['event_end_time']}</td>
                                <td>{$row['event_detail']}</td>
                                <td><img src='uploads/{$row['image']}' alt='Event Image' width='100'></td>
                                <td>
                                    <a href='edit_event_form.php?id={$row['event_id']}' class='edit_btn'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a href='delete_event.php?id={$row['event_id']}' class='delete_btn' onclick='return confirm(\"Are you sure you want to delete this event?\")'><i class='fa-solid fa-trash'></i></a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No events found</td></tr>";
                    }
                ?>
                </tbody>
            </table>        
        </div>
    </main>
</body>
</html>
<?php $conn->close(); ?>