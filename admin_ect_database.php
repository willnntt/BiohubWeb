<?php
session_start();
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

// Initial query to fetch all tips
$sql = "SELECT * FROM ect";

// Check if search is performed
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM ect 
            WHERE title LIKE '%$search%' 
            OR description LIKE '%$search%' 
            OR link LIKE '%$search%'";
}

$result = $conn->query($sql);

include 'adminheader.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Energy Conservation Tips</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
</head>
<body>
    
    <main class="content">
        <section>
            <div class="database_title">
                <h1>Energy Conservation Tips Database</h1>
            </div>             
        </section>
        <section>
            <div class="search-container">
                <form method="GET" action="">
                    <div class="search-box">
                        <input class="search-input" type="search" name="search" placeholder="Search tips data here" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <a href="create_ect_form.php" class="create_event_link">Create<i class="fa-solid fa-square-plus"></i></a>
            </div>
        </section>
        <div class="table-container">
            <table class="database">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>description</th>
                        <th>Link</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['NO']}</td>
                                <td>{$row['title']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['link']}</td>
                                <td>
                                    <a href='edit_ect.php?id={$row['NO']}' class='edit_btn'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a href='delete_ect.php?id={$row['NO']}' class='delete_btn' onclick='return confirm(\"Are you sure you want to delete this event?\")'><i class='fa-solid fa-trash'></i></a>
                                </td>
                            </tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>No energy conservation tips found</td></tr>";
                    }
                ?>
                </tbody>
            </table>        
        </div>
    </main>
</body>
</html>
<?php $conn->close(); ?>