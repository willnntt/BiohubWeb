<?php
session_start(); 
?>

<?php
include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>biohub</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
</head>
<body>
    <main class="content">
    <section>
            <ul class="breadcrumbs">
                <li class="breadcrumbs-items">
                    <a href="home.php" class="breadcrumbs-link">Home</a>
                </li>
                <li class="breadcrumbs-items">
                    <a href="ECT.php" class="breadcrumbs-link">Energy Conservation Tips</a>
                </li>
            </ul>
    </section>

    <section>
            <div class="ECT-banner">
                <div class="ECT-banner-content active">
                    <h1>Save Energy, Secure Tomorrow!</h1>
                    <p>Join our Energy Conservation Program and embrace the power to Track, Reduce, and Transform together for a sustainable future!</p>
                </div>
    </section>
    <style>
    .ECT-banner {
        padding: 2rem;
        width: 100%;
        height: 90vh; /* Default height for larger screens */
        min-height: 400px; /* Prevents content squishing */
        position: relative;
        background: url('banner/ECT_bg.jpg') no-repeat center center;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: left; /* Centers content */
        text-align: left;
        color: white; /* Ensures readability */
    }

    .ECT-banner-content {
        max-width: 80%;
    }
    </style>
    <!-- CONTENT -->
    <div class="trend">
        <p></p>
        <div class="trend-left">
            <img class="trend-left-img" src="ECT_pic/energy-image.jpg" alt="Energy Transformation">
            <h1 class="trend-left-text">Power unleashed transforming energy for a sustainable future</h1>
            <a class="trend-left-button " href="https://texta.ai/blog/academic-and-educational/power-unleashed-harnessing-the-energy-of-flowing-water">Discover more detail ↗</a>
        </div>
        <div class="trend-right">
            <img class="trend-right-img" src="ECT_pic/leaves.png" alt="Green Leaves">
            <div class="green-steps">
                <strong>Simple Green Steps</strong>
                <p>Turn off the tap while brushing your teeth or washing dishes to save water.</p>
            </div>
        </div>
    </div>

    <div class="solution">
        <h2>Empowering Communities with Energy Solutions</h2>
        <div class="steps-section">
            <div class="step">
                <p><strong>1 / Step</strong></p>
                <p>Adopt a Daily Energy-Saving Routine.</p>
            </div>
            <div class="step">
                <p><strong>2 / Step</strong></p>
                <p>Implement Energy-Saving Products.</p>
            </div>
            <div class="step">
                <p><strong>3 / Step</strong></p>
                <p>Embrace Renewable Energy Sources.</p>
            </div>
            <div class="step">
                <p><strong>4 / Step</strong></p>
                <p>Engage in Community Energy Initiatives.</p>
            </div>
        </div>
    </div>

    <div class="TRT">
        <h2>Track, Reduce, Transform</h2>
        <div class="TRT-section">
            <div class="TRT-left">
                <img src="ECT_pic/leaves2.png" alt="Green Leaves">
                <p>Every small step make a different</p>
            </div>
            <div class="TRT-right">
                <div class="box">
                    <p>A Daily Energy Roatline</p>
                    <div>
                        <form class="ECT-search-container" action="ECT_SEARCH.php" method="post">
                        <input type="text" name="search" class="ECT-search-input" placeholder="SEARCH FOR MORE TIPS">
                        <button class="fas fa-search ECT-search-icon"></button>
                        </form>
                    </div>
                </div>
                <div class="box-img">
                    <img class="TRT-img" src="ECT_pic/battery.png" alt="battery">
                </div>
                <div class="box-img">
                    <img class="TRT-img" src="ECT_pic/solar panel.png" alt="solar panel">
                </div>
                <div class="box2">
                    <h3>Unlocking Green Power</h3>
                    <p>Together, we can build a world friven by renewable energy sources</p>
                </div>
            </div>
        </div>
    </div>

    <div class="shop">
        <h2>CHOOSE SUSTAINABLE, SHOP RESPONSIBLE</h2>
        <div class="shop-logo">
            <img class="logo-img" src="ECT_pic/ikealogo.webp" alt="ikea logo">
            <img class="logo-img" src="ECT_pic/ecoworld logo.png" alt="ecoworld logo">
            <img class="logo-img" src="ECT_pic/patagonia logo.png" alt="patagonia logo">
            <img class="logo-img2" src="ECT_pic/tesla logo.png" alt="tesla logo">
            <img class="logo-img" src="ECT_pic/tupperware logo.png" alt="tupperware logo">
            <img class="logo-img" src="ECT_pic/the body shop logo.png" alt="the body shop logo">
            <img class="logo-img" src="ECT_pic/unilever logo.png" alt="unilever logo">
            <img class="logo-img" src="ECT_pic/lush logo.png" alt="lush logo">
            <img class="logo-img" src="ECT_pic/west paw logo.png" alt="west paw logo">
            <img class="logo-img2" src="ECT_pic/apple logo.png" alt="apple logo">
            <img class="logo-img" src="ECT_pic/final logo.avif" alt="final logo">
            <img class="logo-img" src="ECT_pic/sun power.png" alt="sun power logo">
        </div>
    </div>
    </main> 
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
                <p>Jalan Teknologi 5, Taman Teknologi Malaysia, 57000 Kuala Lumpur</p> 
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
</body>
</html>