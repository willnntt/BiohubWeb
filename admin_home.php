<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
</head>
<body>
    <?php
    include 'adminheader.php'; 
    ?>

    <main class="content">
    <!-- CONTENT -->
    <section>
        <div class="admin_welcome">
            <h1>Welcome, Admin</h1>
            <p>Select database to view and create more instresting things here!</p>
            <hr>
        </div>
    </section>

    <section>
        <div class="manageent">
            <h1>Management Center</h1>
        </div>
        <div class="admin_function_container">
            <div class="admin-home-card">
                <i class="fa-solid fa-recycle"></i>
                <h3><a href="admin_event_database.php"> Recycling Event Management</a></h3>
            </div>

            <div class="admin-home-card">
                <i class="fa-solid fa-lightbulb"></i>
                <h3><a href="admin_ect_database.php">Energy Tips Management</a></h3>
            </div>

            <div class="admin-home-card">
                <i class="fa-solid fa-user-group"></i>
                <h3><a href="CG_file/community_event_database.php">Community Event Management</a></h3>
            </div>

            <div class="admin-home-card">
                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                <h3><a href="admin_product_database.php">Product Swap Management</a></h3>
            </div>
    </section>
</body>
</html>