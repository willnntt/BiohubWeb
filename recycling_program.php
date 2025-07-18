<?php
session_start(); 
?>

<?php
include 'header.php'; 
?>

<?php
 $host    = "localhost";
 $db_user = "root";
 $db_pass = "";
 $db_name = "biohub_database";

 
 // Connect to the database
 $conn = new mysqli($host, $db_user, $db_pass, $db_name);
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }

 $sql = "SELECT * FROM recycling_event";
 $result = $conn->query($sql);

$today = date('Y-m-d');

// Fetch upcoming events
$upcoming_query = "SELECT * FROM recycling_event WHERE event_date >= '$today' ORDER BY event_date ASC";
$upcoming_result = $conn->query($upcoming_query);

// Fetch past events
$past_query = "SELECT * FROM recycling_event WHERE event_date < '$today' ORDER BY event_date DESC";
$past_result = $conn->query($past_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycling Program</title>
    <link rel="stylesheet" href="main.css">
    <script src="recycling_program.js" defer></script>
    <script src="timelineAnimation.js" defer></script>
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
    <script src="recycling_point_search_bar.js" defer></script>
    <script src="index.js" defer></script>
    <script src="past_event.js" defer></script>
</head>
<body>
    <!-- CONTENT -->
    <main class="content">
        <section>
            <ul class="breadcrumbs">
                <li class="breadcrumbs-items">
                    <a href="home.php" class="breadcrumbs-link">Home</a>
                </li>
                <li class="breadcrumbs-items">
                    <a href="recycling_program.php" class="breadcrumbs-link">Recycling Program</a>
                </li>
            </ul>
        </section>

        <section>
            <div class="RP-banner">
                <div class="RP-banner-content active">
                    <h1>Reduce, Reuse, Recycle <br> A Greener Future Starts Here!</h1>
                    <p>Join our Recycling Program and support the 3R principles Reduce, Reuse, and Recycle! Be part of the change today! </p>
                    <div class="learn_more_button">
                        <a href="https://www.recyclenow.com/how-to-recycle/how-to-reduce-waste">Learn More</a>
                    </div>
                </div>
        </section>

        <section>
            <div class="upcoming-event-container">
                <h1>Upcoming Event</h1>
            </div>             
        </section>

            <section class="slide">
                    <div class="wrapper">
                    <ul class="carousel">
                    <?php
                        if ($upcoming_result->num_rows > 0) {
                            while ($row = $upcoming_result->fetch_assoc()) {
                    ?>
                        <li class="card">
                            <div class="event-header">
                                <div class="date-container">
                                    <span class="day"><?php echo date("d", strtotime($row['event_date'])); ?></span>
                                    <span class="month"><?php echo date("M", strtotime($row['event_date'])); ?></span>
                                </div>  
                                <div class="event-name">
                                        <?php echo $row['event_name']; ?>
                                </div>
                            </div>
                
                            <div class="img">
                                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Recycling Program 1" draggable="false"> 
                            </div>
                            <h2>
                                <?php echo $row['location']; ?>
                                <br>
                                <?php echo date("H:i", strtotime($row['event_start_time'])); ?> - 
                                <?php echo date("H:i", strtotime($row['event_end_time'])); ?>
                            </h2>
                
                            <p><?php echo $row['event_detail']; ?></p>
                                <a href="registration_form.php" class="slide-button register-btn" data-event-id="<?php echo $row['event_id']; ?>">Register Now</a>
                        </li>
                    <?php
                        }
                        } else {
                            echo "<p>No upcoming events available.</p>";
                        }
                    ?>
                    
                    </ul>
                </div>

            </section>

            <section>
                <div class="collection-point">
                    <h1>Find nearby recycling points and collection schedules to conveniently recycle your items!</h1>
                </div>
            </section>
            
            <section>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/d/embed?mid=1V0965S_L3_xzwY7hdx3jdmE5s__BisM&ehbc=2E312F&noprof=1"></iframe>
                </div>
            </section>    

            <section>
                <div class="collection-schedule-container">
                    <div class="collection-schedule">
                        <h1>Recycle Point Collection Schedule</h1>
                        <p> Find out when your next collection day is! Click below to check your area's schedule and keep your community clean!</p>
                    <div class="timeline">
                        <div class="checkpoint">
                            <h2>Monday</h2>
                                <p><span>Penang - Riiicycle Waste Management Sdn Bhd</span> 
                                    <a href="https://maps.app.goo.gl/7cRUcEKQCRsSAwkXA" class="location_link" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                                </p> 
                                <p><span>Sabah - Kota Kinabalu City Hall</span> 
                                    <a href="https://maps.app.goo.gl/RQ6cFUEsY2dN2N7SA" class="location_link" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                                </p>
                        </div>

                        <div class="checkpoint">
                            <h2>Tuesday</h2>
                                <p><span>Selangor - Alam Flora Buy-Back Centers</span> 
                                    <a href="https://maps.app.goo.gl/mDTv1KPp53wrLKRMA" class="location_link" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                                </p> 
                                <p><span>Labuan - Labuan Corporation Recycling Unit</span> 
                                    <a href="https://maps.app.goo.gl/yLwe53aigvUAABtg8" class="location_link" target="_blank"><i class="fa-solid fa-location-dot" target="_blank"></i></a>
                                </p>
                        </div>

                        <div class="checkpoint">
                            <h2>Wednesday</h2>
                                <p><span>Johor - Tunku Mahkota Ismail Youth Center Johor Bahru</span> 
                                    <a href="https://maps.app.goo.gl/RszMtPnLaREbLgic6" class="location_link" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                                </p> 
                                <p><span>Terengganu - Kuala Terengganu City Council</span> 
                                    <a href="https://maps.app.goo.gl/aEoia811ER2AWtkE8" class="location_link" target="_blank"><i class="fa-solid fa-location-dot" target="_blank"></i></a>
                                </p>
                        </div>

                        <div class="checkpoint">
                            <h2>Thursday</h2>
                                <p><span>Pahang - Drive Thru Recycling Centre Taman Gelora Alam Flora</span> 
                                    <a href="https://maps.app.goo.gl/DYi16NebwsLDAe9i8" class="location_link" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                                </p> 
                                <p><span>Perlis - Drive Thru Recycle Centre (DTRC) Sena</span> 
                                    <a href="https://maps.app.goo.gl/wEJPtuKT57UnL79L9" class="location_link" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                                </p>
                        </div>

                        <div class="checkpoint">
                            <h2>Friday</h2>
                                <p><span>Kuala Lumpur - IPC Recycling Buy-Back Center</span> 
                                    <a href="https://maps.app.goo.gl/xdtfoo6Eag9mWg1f7" class="location_link" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                                </p> 
                                <p><span>Melaka - Tzu Chi Recycling Centers - Bukit Cheng</span> 
                                    <a href="https://maps.app.goo.gl/pCnqyeXnEdL7uEKH9" class="location_link" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                                </p>
                        </div>

                        <div class="checkpoint">
                            <h2>Saturday</h2>
                                <p><span>Sarawak - Rejang Park Recycling Centre</span> 
                                    <a href="https://maps.app.goo.gl/M7AD9sX4cUFrHnpC8" class="location_link" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                                </p> 
                                <p><span>Negeri Sembilan - Drive Thru Recycle Centre(DTRC) Nilai 7</span> 
                                    <a href="https://maps.app.goo.gl/eYMRYuvxCcLrdwcG6" class="location_link" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                                </p>
                        </div>

                        <div class="checkpoint">
                            <h2>Sunday</h2>
                                <p><span>Kedah - Drive Thru Recycling Centre (E-Idaman) Alor Setar</span> 
                                    <a href="https://maps.app.goo.gl/23uJA97rJRZnMWqN7" class="location_link" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                                </p> 
                                <p><span>Perak - Kitaran Berjaya Recycling Centre</span> 
                                    <a href="https://maps.app.goo.gl/b3fY4ohwupwYK6McA" class="location_link" target="_blank"><i class="fa-solid fa-location-dot"></i></a>
                                </p>
                        </div>
                    </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="past-event-container">
                <h1>Past Events</h1>
                <?php
                    if ($past_result->num_rows > 0) {
                        while ($row = $past_result->fetch_assoc()) {
                ?>
                    <div class="past-event-review">
                        <div class="past-event">
                            <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Past Event Image" class="past-event-img">
                            <div class="past-event-description">
                                <h1><?php echo $row['event_name']; ?></h1>
                                <br>
                                <span><?php echo date("d M Y", strtotime($row['event_date'])); ?></span> 
                                <span><?php echo date("H:i", strtotime($row['event_start_time'])); ?> - <?php echo date("H:i", strtotime($row['event_end_time'])); ?></span>
                                <span><?php echo $row['location']; ?></span>
                                <br><br>
                                <p><?php echo $row['event_detail']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    } else {
                        echo "<p style='text-align: center; font-size: 18px; color: #666;'>No past events available.</p>";
                    }
                ?>
                </div>
            </section>
    </main>
    <script>
    const container = document.getElementById("categoryWrapper");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    function scrollCategoriesLeft() {
        container.scrollBy({ left: -200, behavior: "smooth" });
    }

    function scrollRight() {
        container.scrollBy({ left: 200, behavior: "smooth" });
    }
    </script>
    <!-- FOOTER -->
    <footer class="footer">
        <div class="row"> 
            <div class="col">
                <img src="logo.png" class="logo">
                <p>BioHub is a one-stop platform offering eco-friendly products, community discussions, and sustainability-focused activities. Our goal is to provide informative resources, interactive features, and real-time collaboration opportunities for individuals and businesses committed to a greener future.</p>
            </div>
            <div class="col">
                <h3>Contact Us</h3>
                <p><b>BioHub.Sdn.Bhd.</b></p>
                <p>Jalan Teknologi 5, Taman Teknologi Malaysia, 57000 Kuala Lumpur...</p> 
                <p class="email-id">biohub@gmail.com</p>
                <h4>+6012 7894578</h4>
            </div>
            <div class="col">
                <h3>Links</h3>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Recycling Program</a></li>
                    <li><a href="">Energy Conservation Tips</a></li>
                    <li><a href="">Our Community</a></li>
                    <li><a href="">Swap & Share</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-x-twitter"></i>
                    <i class="fa-brands fa-whatsapp"></i>
                    <i class="fa-brands fa-linkedin"></i>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>