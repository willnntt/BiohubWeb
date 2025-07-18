<?php
session_start(); 
?>

<?php
include 'adminheader.php'; 
?>

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

// Fetch user data
$sql = "SELECT * FROM user";
$result = $conn->query($sql);
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
    <!-- HEADER -->
    <header class="header">
        <nav class="nav">
            <ul class="nav_items">
                <li class="nav_item">
                    <img src="logo.png" class="header-logo">
                    <a href="#" class="nav_link">Home</a>
                    <a href="#" class="nav_link">Recycling Program</a>
                    <a href="#" class="nav_link">Energy Conservation Tips</a>
                    <a href="#" class="nav_link">Our Community</a>
                    <a href="#" class="nav_link">Swap & Share</a>
                </li>
            </ul>
        </nav>
    </header>
    
    <main class="content">
        <section>
            <div class="database_title">
                <h1>User Database</h1>
            </div>             
        </section>
        <section>
        <div class="search-container">
                    <form>
                        <div class="search-box">
                            <input class="search-input" type="search" placeholder="Search user data here">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </form>
                </div>
        </section>
        <div class="table-container">
        <table class="database">
            <thead>
                <tr>
                    <th>User ID</th> <!-- Ensure User ID is displayed -->
                    <th>Username</th>
                    <th>DOB</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Register Date</th>
                    <th>Edit</th>
                </tr>
            </thead>

            <tbody>
            <?php
                $count = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['user_id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['dob']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['role']}</td>
                        <td>{$row['register_date']} </td>
                        <td>
                            <a href='edit_user.php?id={$row['user_id']}' class='edit_btn'><i class='fa-solid fa-pen-to-square'></i></a>
                            <a href='delete_user.php?id={$row['user_id']}' class='delete_btn' onclick='return confirm(\"Are you sure you want to delete this user?\")'><i class='fa-solid fa-trash'></i></a>
                        </td>
                    </tr>";
                $count++;
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