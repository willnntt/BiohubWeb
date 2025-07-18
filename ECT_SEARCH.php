<?php
session_start(); 
?>

<?php
include 'header.php'; 
?>

<?php
$conn = new mysqli("localhost","root","","biohub_database");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';

$sql = "SELECT title, description, link FROM ect WHERE title LIKE '%$search%'";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>biohub</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
</head>
<body>

    <!-- CONTENT -->
    <center>
    <div class="ECT-search-box">
        <form class="ECT-search-bar" action="ECT_SEARCH.php" method="post">
        <input type="text" name="search" class="ECT-search-input2" placeholder="SEARCH FOR MORE TIPS  ">
        <button class="fas fa-search ECT-search-icon"></button>
        </form>
    </div>
    
    <div class="search-results">
        <?php if ($result->num_rows > 0) {
            if (str_word_count($_POST['search'], 0, '0123456789')) {
                echo "result for '",$_POST['search'],"'";
            }
            while ($row = $result->fetch_assoc()) {
                echo "<div class='result-box'>";
                echo "<a href='" . htmlspecialchars($row['link']) . "' target='_blank'>" . htmlspecialchars($row['title']) . "</a>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "No results found for ' ",$_POST['search']," '.";
        }
        ?>
    </div>   
    </center>
    
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