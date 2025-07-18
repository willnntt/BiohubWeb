<?php
    session_start();

    include 'conn.php';
    // include 'header.php'; 

    if (isset($_POST['create'])) {
        $event_name        = $_POST['eventname'];
        $location          = $_POST['eventvenue'];
        $event_date        = $_POST['eventdate'];
        $event_start_time  = $_POST['starttime'];
        $event_end_time    = $_POST['endtime'];
        $event_detail      = $_POST['eventdesc'];
        $event_category    = $_POST['eventcategory'];
        $userid = '1';
        $username = 'admin';

        // Handle Image Upload
        if (!empty($_FILES['image']['name'])) {
            $targetDir = __DIR__ . "/../CG_pics/";

            // Ensure uploads directory exists
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true); // Create folder with full permissions
            }

            $imageName = basename($_FILES["image"]["name"]);
            $targetFile = $targetDir . $imageName;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Allow only specific image types
            $allowedTypes = array("jpg", "jpeg", "png", "gif");
            if (!in_array($imageFileType, $allowedTypes)) {
                die("Error: Only JPG, JPEG, PNG, and GIF files are allowed.");
            }


            // Move the uploaded file
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                die("Error uploading image.");
            }
        } else {
            $imageName = ""; // No image uploaded
        }

        // Insert data using prepared statement
        $sql = "INSERT INTO community_events (eventname, eventvenue, eventdate, starttime, endtime, eventdesc, eventcategory, eventimage, userid, username) 
                VALUES ('$event_name', '$location', '$event_date', '$event_start_time', '$event_end_time', '$event_detail', '$event_category','CG_pics/$imageName', '$userid', '$username')";

        if (mysqli_query($conn, $sql)) {
            echo "Event added successfully.";
            header("refresh:1; url=community_events_database.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Event Creation Form</title>
    <link rel="stylesheet" href="../main.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
    <script src="map_script.js" defer></script>
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
</head>
<form-body>
    <main class="form-content">
        <section>
            <div class="registration-form-title">
                <h1>Community Event Creation Form</h1>
            </div>             
        </section>
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
                <a href="admin_home.php" class="nav_link">Recycling Program</a>
                    <a href="admin_event_database.php" class="nav_link">Recycling Program</a>
                    <a href="admin_ect_database.php" class="nav_link">Energy Conservation Tips</a>
                    <a href="CG_file/community_event_database.php" class="nav_link">Our Community</a>
                    <a href="admin_product_database.php" class="nav_link">Swap & Share</a>
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
                    <td><input type="text" name="eventname" required="required" class="registration-input"></td>
                </tr>
                <!-- Location Input -->
                <tr>
                    <th>Location</th>
                    <th>
                        <textarea rows="3" name="eventvenue" class="registration-input"></textarea>
                    </th>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><input type="date" name="eventdate" required="required" class="registration-input"></td>
                </tr> 
                <tr>
                    <th>Event Start Time</th>
                    <td><input type="time" name="starttime" required="required" class="registration-input"></td>
                </tr>
                <tr>
                    <th>Event End Time</th>
                    <td><input type="time" name="endtime" required="required" class="registration-input"></td>
                </tr>
                <tr>
                    <th>Event Detail</th>
                    <th>
                        <textarea rows="3" name="eventdesc" class="registration-input"></textarea>
                    </th>
                </tr>

                <tr>
                    <th>Upload Event Image</th>
                    <th>
                        <input type="file" name="image" id="image" accept="image/*" required>
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

            <div class="registration-button">
                <input type="reset" name="reset" value="Reset" class="reset_button"/>
                <input type="submit" name="create" value="Create" class="create_button"/>
            </div>            
        </form>
    </div>
    </main>
</form-body>
</html>