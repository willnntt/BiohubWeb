<?php
session_start(); 
?>

<?php
include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="main.css">
</head>
<register-body>
    <main class="content">
        <section>
            <div class="registration-form-title">
                <h1>Event Registration Form</h1>
            </div>             
        </section>
        <center>
        <div class="registration-form">
            <form action="database.php" method="POST" enctype="multipart/form-data">
            <table class="event-registration-container">
                <tr>
                    <td colspan="2">
                        <a href="recycling_program.php" class="cancel_create_event">Cancel<i class="fa-solid fa-xmark"></i></a>
                    </td>
                <tr>
                    <th>First name</th>
                    <td><input type="text" name="first_name" required="required" class="registration-input"></td>
                </tr>
                <tr>
                    <th>Last name</th>
                    <td><input type="text" name="last_name" required="required" class="registration-input"></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" name="email" required="required" class="registration-input"></td>
                </tr>
                <tr>
                    <th>Contact Number</th>
                    <td><input type="integer" name="contact_number" placeholder="60XXXXXXXXX" required="required" class="registration-input"></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <th>
                        <textarea rows="3" name="address" class="registration-input"></textarea>
                    </th>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td class="gender-container">
                        <input type="radio" id="male" name="gender" value="Male">
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="Female">
                        <label for="female">Female</label>
                        </td>
                </tr>

                <tr>
                    <th>Event</th>
                <td>
                    <select name="event_name">
                        <?php
                        // Database credentials
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

                        // Query to fetch future events
                        $today = date("Y-m-d"); // Get current date
                        $sql = "SELECT event_name FROM recycling_event WHERE event_date >= ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $today);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Check if there are any future events
                        if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . htmlspecialchars($row["event_name"]) . '">' . htmlspecialchars($row["event_name"]) . '</option>';
                            }
                        } else {
                            echo '<option value="">No upcoming events</option>';
                        }

                        // Close connections
                        $stmt->close();
                        $conn->close();
                        ?>
                    </select>
                </td>
            </tr>

            </table>
    
            <div id="eventDetails" class="event-details">
                <p id="eventDescription">Join us for Recycling Program! A community-driven initiative for a greener future.</p>   
            </div>

            <div class="registration-button">
                <input type="reset" name="reset" value="Reset" class="registration-button"/>
                <input type="submit" name="submit" value="Submit" class="registration-button"/>
            </div>            
        </form>
    </div>
    </center>
    </main>
</body>
</html>