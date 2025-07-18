
<?php
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

// Fetch event data
$sql = "SELECT * FROM event_registration";
$result = $conn->query($sql);
?>
<?php
include 'header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Recycling Events</title>
    <link rel="stylesheet" href="admin_database.css">
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
</head>
<body>
    <main class="content">
        <section>
            <div class="database_title">
                <h1>User Registration Database</h1>
            </div>             
        </section>
        <div class="table-container">
        <table class="database">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Register ID</th>
                    <th>User ID</th> 
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>DOB</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Event Name</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$count}</td>
                                    <td>{$row['register_id']}</td>
                                    <td>{$row['user_id']}</td> 
                                    <td>{$row['first_name']}</td>
                                    <td>{$row['last_name']}</td>
                                    <td>{$row['dob']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['contact_number']}</td>
                                    <td>{$row['address']} </td>
                                    <td>{$row['gender']} </td>
                                    <td>{$row['event_name']} </td>
                                  </tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='11'>No data found</td></tr>"; 
                    }
                ?>
            </tbody>
            </div>
        </table>        
    </main>
</body>
</html>

<?php $conn->close(); ?>
<!-- Close connection after use -->