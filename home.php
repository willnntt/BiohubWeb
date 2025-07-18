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
    <title>Biohub Home</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
</head>
<body>
    <main class="content">
    <!-- CONTENT -->
    <div class="home-body">
    <section>
        <div class="home-banner">
            <div class="home-banner-content active">
                <h1>ACT GREEN, LIVE CLEAN</h1>
                <p>Discover tools, resources, and community-driven initiatives that make eco-friendly living accessible and impactful for everyone.</p>
                <div class="home-register-button">
                    <a href="index.php">Join Us</a>
                </div>
            </div>
    </section>

    <section>
        <div class="home-about_us">
            <h1>What is Biohub?</h1>
            <p>"Biohub" represents a sustainability-focused platform that fosters eco-friendly practices and community collaboration. "Bio" reflects life and nature, while "Hub" signifies a central space for learning, recycling, product exchange, and environmental conservation.</p>
            <br><br>
            <h1>ABOUT US</h1>
            <p>At Biohub, we are dedicated to a sustainable future through a circular economy. Our recycling programs and eco-friendly product exchanges reduce waste, while our energy conversion tips promote smarter consumption. We empower communities with urban gardening initiatives, fostering greener spaces and a regenerative approach to daily living.</p>
        </div>
    </section>

    <section>
        <div class="home-column">
            <div class="home-page-icons">
                <a href = "recycling_program.php"><i class="fa-solid fa-recycle"></i></a>
                <a href = "ECT.php"><i class="fa-solid fa-lightbulb"></i></a>
                <a href = "CG_file/community.php"><i class="fa-solid fa-user-group"></i></a>
                <a href = "productswap.php"><i class="fa-solid fa-arrow-right-arrow-left"></i></a>
            </div>
        </div>
    </section>

    <section>
        <div class="solution_section">
            <div class="left_content_container">
                <img src="home_pic/home_content_1.jpg" alt="About Us">
            </div>
            <div class="content-section">
                <h2>Together, We Reimagining the World</h2>
                <div class="goals">
                </div>
                <div class="SDG">
                    <h3>Our Path to Achieving the SDGs</h3> 
                    <p>We align with SDGs by promoting clean energy solutions, waste reduction through recycling programs, urban gardening initiatives, and circular economies. Our efforts focus on creating a more sustainable, resilient future where communities thrive while preserving natural resources and reducing environmental impact.</p>
                </div>
    
                <div class="quote">
                    <blockquote>
                        "Our mission is to empower communities, inspire innovation, and create an eco-friendly world."
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="goals_description">
            <h1>Empowering Sustainable Communities: Our Commitment to the SDGs</h1>
            <div class="goals_detail">
                <div class="goals_header">
                    <h2>SDG 7: Affordable and Clean Energy</h2>
                </div>
                <p>Promoting decentralized renewable energy solutions, such as solar or wind</p>
            </div>
            <div class="goals_detail">
                <h2>SDG 11: Sustainable Cities and Communities</h2>
                <p>Encouraging urban gardening, eco-friendly product exchanges, and public sharing infrastructure for sustainable mobility</p>
            </div>
            <div class="goals_detail">
                <h2>SDG 13: Climate Action</h2>
                <p>Educating communities on recycling, energy conservation, supporting regenerative agriculture, and fostering climate resilience through localized sustainability programs</p>
            </div>
        </div>
    </section>

    <section>
    <div class="activities_title">
        <h1>Begin Your Sustainable Journey!</h1>
        <div class="activities_container">
            <div class="activity">
                <a href="recycling_program.php"><img src="home_pic/recycling.jpg" alt="Recycling Program">
                <h2>RECYCLING PROGRAM</h2></a>
                <p>Learn how to reduce waste and recycle effectively to save our planet.</p>
            </div>
            <div class="activity">
                <a href="#"><img src="home_pic/energy.jpg" alt="Energy Conservation">
                <h2>Energy Conservation TIPS</h2></a>
                <p>Discover easy ways to conserve energy and reduce your carbon footprint.</p>
            </div>
            <div class="activity">
                <a href="#"><img src="home_pic/community_gardening.jpg" alt="Community Gardening">
                <h2>COMMUNITY GARDENING</h2></a>
                <p>Join your neighbors in growing sustainable food locally.</p>
            </div>
            <div class="activity">
                <a href="#"><img src="home_pic/productswap.webp" alt="Community Gardening">
                <h2>Swap & Share</h2></a>
                <p>Swap within the community to save resources!</p>
            </div>
        </div>
    </div>  
    </section>

    <section>
        <div class="location_title">
            <h1>Visit Us</h1>
            <div class="loaction">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.1466274461595!2d101.70056140000001!3d3.0554056999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4abb795025d9%3A0x1c37182a714ba968!2sAsia%20Pacific%20University%20of%20Technology%20%26%20Innovation%20(APU)!5e0!3m2!1sen!2smy!4v1739979249063!5m2!1sen!2smy" width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

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
                    <li><a href="home.php">Home</a></li>
                    <li><a href="recycling_program.php">Recycling Program</a></li>
                    <li><a href="ECT.php">Energy Conservation Tips</a></li>
                    <li><a href="CG_file/community.php">Our Community</a></li>
                    <li><a href="productswap.php">Swap & Share</a></li>
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
    </main>
</body>
</html>

