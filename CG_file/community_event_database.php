<?php
    session_start(); 
    include 'conn.php';
    // include 'adminheader.php'; 

    // Initial query to fetch all events
    $sql = "SELECT * FROM community_events";

    // Check if search is performed
    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $sql = "SELECT * FROM community_events 
                WHERE eventname LIKE '%$search%' 
                OR eventvenue LIKE '%$search%' 
                OR eventdesc LIKE '%$search%'
                OR eventcategory LIKE '%$search%'";
    }

    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Recycling Events</title>
    <link rel="stylesheet" href="../admin_database.css">
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
</head>
<table-body>
<link rel="stylesheet" href="../main.css">    
<header class="header">
        <nav class="nav">
            <img src="../logo.png" class="header-logo">
            <ul class="nav_items">
                <li class="nav_item">
                <!-- <img src="logo.png" class="header-logo"> -->
                <a href="../admin_home.php" class="nav_link">Home</a>
                    <a href="../admin_event_database.php" class="nav_link">Recycling Program</a>
                    <a href="../admin_ect_database.php" class="nav_link">Energy Conservation Tips</a>
                    <a href="community_event_database.php" class="nav_link">Our Community</a>
                    <a href="../admin_product_database.php" class="nav_link">Swap & Share</a>

                    <?php if (isset($_SESSION['user'])): ?>
                        <button onclick="window.location.href='../log_out.php'" id="header-login-button">Sign Out</button>
                    <?php else: ?>
                        <?php if ($current_page == '../index.php'): ?>
                            <button onclick="window.location.href='../sign_up_form.php'" id="header-login-button">Sign Up</button>
                        <?php elseif ($current_page == 'sign_up_form.php'): ?>
                            <button onclick="window.location.href='../index.php'" id="header-login-button">Login</button>
                        <?php else: ?>
                            <button onclick="window.location.href='../index.php'" id="header-login-button">Login</button>
                        <?php endif; ?>
                    <?php endif; ?>
                </li>
            </ul>
            
            <div id="hamburger-icon" onclick="toggleMobileMenu(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
                <ul class="mobile-menu">
                <!-- <img src="logo.png" class="header-logo"> -->
                <a href="../admin_home.php" class="nav_link">Recycling Program</a>
                    <a href="../admin_event_database.php" class="nav_link">Recycling Program</a>
                    <a href="../admin_ect_database.php" class="nav_link">Energy Conservation Tips</a>
                    <a href="community_event_database.php" class="nav_link">Our Community</a>
                    <a href="../admin_product_database.php" class="nav_link">Swap & Share</a>
                    <li>
                        <?php if (isset($_SESSION['user'])): ?>
                            <button onclick="window.location.href='log_out.php'" id="header-login-button">Sign Out</button>
                        <?php else: ?>
                            <?php if ($current_page == 'index.php'): ?>
                                <button onclick="window.location.href='sign_up_form.php'" id="header-login-button">Sign Up</button>
                            <?php elseif ($current_page == 'sign_up_form.php'): ?>
                                <button onclick="window.location.href='index.php'" id="header-login-button">Login</button>
                            <?php else: ?>
                                <button onclick="window.location.href='index.php'" id="header-login-button">Login</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>                
        </nav>
    </header>
    <script src="../index.js"></script>
    <script>
    function toggleMobileMenu(menu) {
        menu.classList.toggle("open");
    }
    </script>
    <main class="content">
        <section>
            <div class="database_title">
                <h1>Community Event Database</h1>
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
                <a href="create_community_event.php" class="create_event_link">Create <i class="fa-solid fa-square-plus"></i></a>
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
                    <th>Category</th>
                    <th>Image</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if (mysqli_num_rows($result) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['eventid']}</td>
                            <td>{$row['eventname']}</td>
                            <td>{$row['eventvenue']}</td>
                            <td>{$row['eventdate']}</td>
                            <td>{$row['starttime']}</td>
                            <td>{$row['endtime']}</td>
                            <td>{$row['eventdesc']}</td>
                            <td>{$row['eventcategory']}</td>
                            <td><img src='../{$row['eventimage']}' alt='Event Image' width='100'></td>
                            <td>
                                <a href='edit_community_event.php?id={$row['eventid']}' class='edit_btn'><i class='fa-solid fa-pen-to-square'></i></a>
                                <a href='delete_community_event.php?id={$row['eventid']}' class='delete_btn' onclick='return confirm(\"Are you sure you want to delete this event?\")'><i class='fa-solid fa-trash'></i></a>
                            </td>
                        </tr>";
                    $count++;
                    }
                } else {
                    echo "<tr><td colspan='10'>No community events found</td></tr>";
                }
            ?>
            </tbody>
            </div>
        </table>        
    </main>
</table-body>
</html>

<?php mysqli_close($conn); ?>