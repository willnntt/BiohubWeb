<?php
    session_start(); 
    include 'conn.php';
    // include 'header.php'; 

    if (isset($_GET['id'])) {
        $event_id = $_GET['id'];
        $sql = "SELECT * FROM community_events WHERE eventid='$event_id'";
        $result = $conn->query($sql);
        $event = $result->fetch_assoc();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['eventname'];
        $location = $_POST['eventvenue'];
        $date = $_POST['eventdate'];
        $start_time = $_POST['starttime'];
        $end_time = $_POST['endtime'];
        $detail = $_POST['eventdesc'];
        $event_category = $_POST['eventcategory'];

        $update_sql = "UPDATE community_events SET eventname='$name', eventvenue='$location', eventdate='$date', 
                    starttime='$start_time', endtime='$end_time', eventdesc='$detail', eventcategory='$event_category' WHERE eventid='$event_id'";

        if (mysqli_query($conn, $update_sql)) {
            echo "Event updated successfully!";
            header("Location: community_events_database.php"); // Redirect back to the main page
            exit();
        } else {
            echo "Error updating event: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event Form</title>
    <link rel="stylesheet" href="../main.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
    <script src="map_script.js" defer></script>
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
</head>
<form-body>
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
                            <button onclick="window.location.href='../log_out.php'" id="header-login-button">Sign Out</button>
                        <?php else: ?>
                            <?php if ($current_page == '../index.php'): ?>
                                <button onclick="window.location.href='../sign_up_form.php'" id="header-login-button">Sign Up</button>
                            <?php elseif ($current_page == '../sign_up_form.php'): ?>
                                <button onclick="window.location.href='../index.php'" id="header-login-button">Login</button>
                            <?php else: ?>
                                <button onclick="window.location.href='../index.php'" id="header-login-button">Login</button>
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
                        <a href="community_event_database.php" class="cancel_create_event">Cancel<i class="fa-solid fa-xmark"></i></a>
                    </td>
                </tr>
                <tr>
                    <th>Event Name</th>
                    <td><input type="text" name="eventname" class="registration-input" value="<?php echo $event['eventname']; ?>"></td>
                </tr>
                <!-- Location Input -->
                <tr>
                    <th>Location</th>
                    <th>
                        <textarea rows="3" name="eventvenue" class="registration-input"><?php echo htmlspecialchars($event['eventvenue']); ?></textarea>
                    </th>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><input type="date" name="eventdate" class="registration-input" value="<?php echo $event['eventdate']; ?>"></td>
                </tr> 
                <tr>
                    <th>Event Start Time</th>
                    <td> <input type="time" name="starttime" class="registration-input" value="<?php echo $event['starttime']; ?>"></td>
                </tr>
                <tr>
                    <th>Event End Time</th>
                    <td><input type="time" name="endtime" class="registration-input" value="<?php echo $event['endtime']; ?>"></td>
                </tr>
                <tr>
                    <th>Event Detail</th>
                    <th>
                        <textarea name="eventdesc" class="registration-input"><?php echo $event['eventdesc']; ?></textarea>
                    </th>
                </tr>
                <tr>
                    <th>Category: </th>
                    <th>
                        <select id="eventcategory" name="eventcategory">
                            <option value="General">General</option>
                            <option value="Gardening">Gardening</option>
                            <option value="Cleanup">Cleanup</option>
                            <option value="Bazaar">Bazaar</option>
                            <option value="Charity">Charity</option>
                        </select>                        
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