<?php
    session_start();
    $current_page = basename($_SERVER['PHP_SELF']); // Gets the current file name

    include 'conn.php';
    $userID = $_SESSION['userid'] ?? null; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biohub - Community</title>

    <link rel="stylesheet" href="../main.css">

    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
    
    <!-- Google Fonts Asset -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Swiper Assets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>

<body data-userid="<?php echo $userID; ?>">

<body>
<header class="header">
        <nav class="nav">
            <img src="../logo.png" class="header-logo">
            <ul class="nav_items">
                <li class="nav_item">
                    <a href="../home.php" class="nav_link">Home</a>
                    <a href="../recycling_program.php" class="nav_link">Recycling Program</a>
                    <a href="../ECT.php" class="nav_link">Energy Conservation Tips</a>
                    <a href="community.php" class="nav_link">Our Community</a>
                    <a href="../productswap.php" class="nav_link">Swap & Share</a>

                    <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
                        <button onclick="window.location.href='../log_out.php'" id="header-login-button">Sign Out</button>
                    <?php else: ?>
                        <?php if ($current_page == '../index.php'): ?>
                            <button onclick="window.location.href='../sign_up_form.php'" id="header-login-button">Sign Up</button>
                        <?php else: ?>
                            <button onclick="window.location.href='../index.php'" id="header-login-button">Login</button>
                        <?php endif; ?>
                    <?php endif; ?>
                </li>
            </ul>
            
            <div id="hamburger-icon" onclick="toggleMobileMenu()">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div> 

            <ul class="mobile-menu">
                <li><a href="../index.php" class="nav_link">Home</a></li>
                <li><a href="../recycling_program.php" class="nav_link">Recycling Program</a></li>
                <li><a href="../ECT.php" class="nav_link">Energy Conservation Tips</a></li>
                <li><a href="community.php" class="nav_link">Our Community</a></li>
                <li><a href="../productswap.php" class="nav_link">Swap & Share</a></li>
                <li>
                    <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
                        <button onclick="window.location.href='log_out.php'" id="header-login-button">Sign Out</button>
                    <?php else: ?>
                        <?php if ($current_page == 'index.php'): ?>
                            <button onclick="window.location.href='sign_up_form.php'" id="header-login-button">Sign Up</button>
                        <?php else: ?>
                            <button onclick="window.location.href='index.php'" id="header-login-button">Login</button>
                        <?php endif; ?>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <script src="../index.js"></script>
    <script>
    function toggleMobileMenu() {
        document.querySelector(".mobile-menu").classList.toggle("open");
    }
    </script>
    <CG-body>
    <section>
            <ul class="breadcrumbs">
                <li class="breadcrumbs-items">
                    <a href="../home.php" class="breadcrumbs-link">Home</a>
                </li>
                <li class="breadcrumbs-items">
                    <a href="community.php" class="breadcrumbs-link">Community Gardening</a>
                </li>
            </ul>
    </section>

    <section>
            <div class="CG-banner">
                <div class="CG-banner-content active">
                    <h1>Grow Together, Flourish Together!</h1>
                    <p>Join us to grow fresh food, make friends, and enjoy gardening together no experience needed!</p>
                </div>
    </section>
    <!-- EVENTS -->
    <div class="gardening-projects">
        <h1>GARDENING EVENTS</h1>
        
        <div class="slider swiper">
            <div class="image-slider">
                <ul class="event-list swiper-wrapper"></ul>

                <div class="swiper-pagination"></div>
                <div class="swiper-slide-button swiper-button-prev"></div>
                <div class="swiper-slide-button swiper-button-next"></div>
            </div>
        </div>

        <div class="new-event">
            <button id="create-event-openpopup">CREATE A NEW EVENT</button>
        </div>
    </div>
    
    
    <!-- COMMUNITY TAB -->
    <div class="community-container">
        <div class="option-container" id="newsletter">
            <span class="option-dot">
                <img class="option-logo" src="https://www.iconpacks.net/icons/2/free-leaf-icon-1550-thumb.png" alt="leaf icon">
            </span>

            <div class="option-content">
                <h1>ECO HUB FAMILY</h1>
                <p>Join our newsletter to receive daily gardening tips, expert advice, and seasonal inspiration to help your garden thrive all year round.</p>
            </div>

            <button class="interact-btn" id="newsletter-openpopup">Learn More</button>
        </div>

        <div class="option-container" id="community-forum">
            <span class="option-dot">
                <img class="option-logo" src="https://www.iconpacks.net/icons/2/free-leaf-icon-1550-thumb.png" alt="leaf icon">
            </span>

            <div class="option-content">
                <h1>COMMUNITY FORUMS</h1>
                <p>Post questions and answers on various topics!</p>        
            </div>

            <a href="forum.php">
                <button class="interact-btn" id="see-more">See More</button>                
            </a>
        </div>

        <div class="option-container" id="tips">
            <span class="option-dot">
                <img class="option-logo" src="https://www.iconpacks.net/icons/2/free-leaf-icon-1550-thumb.png" alt="leaf icon">
            </span>

            <div class="option-content" id="tip-content"></div>

            <div class="rating-container">
                <button class="like-button material-icons" id="like-button">
                    thumb_up
                </button>
                <p class="rating-count" id="like-count"></p>
                <button class="dislike-button material-icons" id="dislike-button">
                    thumb_down
                </button>
                <p class="rating-count" id="dislike-count"></p>
            </div>
        </div>
    </div>


    <!-- POPUP BOX -->
    <div class="news-popup" id="newsletter-popup">
        <div class="popup-content">
            <h1>Biohub Newsletter</h1>
            <p>Here's what you're missing out on!</p>
        
            <img src="../CG_pics/newsletter.jpg" alt="Newsletter Image">

            <div class="close-button" id="newsletter-closepopup">✖</div>
            <ul class="newsletter-list">
                <li class="newsletter-points">🌱 Daily gardening tips</li>
                <li class="newsletter-points">📖 Advice from experts</li>
                <li class="newsletter-points">📰 Latest news on upcoming events</li>
                <li class="newsletter-points">🌿 Gardening decorative themes</li>
                <li class="newsletter-points">🌍 Informative news on world issues</li>
            </ul>
            
            
            <button class="join-news">Sign up</button>
        </div>
    </div>

    <div class="event-popup" id="register-event-popup">
        <div class="popup-content">
            <div class="content-container">
                <div class="image-container"></div>

                <div class="event-details">
                    <h1 class="event-name">Event Name</h1>
                    
                    <p class="event-desc"></p>

                    <div class="sub-details">
                        <div class="event-left-container">
                            <p class="event-date"></p>
                            <p class="event-time"></p>
                            <p class="event-venue"></p>
                        </div>

                        <div class="event-right-container">
                            <p class="event-host"></p>
                            <p class="event-category"></p>
                        </div>                        
                    </div>
    
                    <button class="event-button" id="event-confirm-register" eventid="">Register</button>
                </div>
            </div>
            <div class="close-button" id="event-closepopup">✖</div>
        </div>
    </div>

    <div class="create-event-popup" id="create-event-popup">
        <div class="popup-content">
            <div class="content-container">
                <h2>Create a New Event</h2>
                <form action="create_event.php" method="POST" id="create-event-form" enctype="multipart/form-data">
                    <label for="eventname">Event Name:</label>
                    <input type="text" id="eventname" name="eventname" required>

                    <label for="eventdesc">Event Description:</label>
                    <textarea id="eventdesc" name="eventdesc" required></textarea>

                    <label for="eventvenue">Venue:</label>
                    <input type="text" id="eventvenue" name="eventvenue" required>

                    <label for="eventdate">Event Date:</label>
                    <input type="date" id="eventdate" name="eventdate" required>

                    <label for="starttime">Start Time:</label>
                    <input type="time" id="starttime" name="starttime" required>

                    <label for="endtime">End Time:</label>
                    <input type="time" id="endtime" name="endtime" required>

                    <label for="eventimage">Event Image:</label>
                    <input type="file" id="eventimage" name="eventimage" accept="image/*" required>

                    <label for="eventcategory">Category:</label>
                    <select id="eventcategory" name="eventcategory">
                        <option value="General">General</option>
                        <option value="Gardening">Gardening</option>
                        <option value="Cleanup">Cleanup</option>
                        <option value="Bazaar">Bazaar</option>
                        <option value="Charity">Charity</option>
                    </select>

                    <div class="button-container">
                        <button type="submit" id="submit-event">Create Event</button>
                        <div class="close-button" id="create-event-closepopup">Cancel</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </CG-body>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="row"> 
            <div class="col">
                <img src="../CG_pics/logo.png" class="logo">
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
                    <li><a href="../home.php">Home</a></li>
                    <li><a href="../recycling_program.php">Recycling Program</a></li>
                    <li><a href="../ECT.php">Energy Conservation Tips</a></li>
                    <li><a href="community.php">Our Community</a></li>
                    <li><a href="../productswap.php">Swap & Share</a></li>
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
    
    <!-- Javascripts Function -->
    <script src="community-popup.js"></script>
    <script src="community-slider.js"></script>
    <script src="community-loadtip.js"></script>
    <script src="community-rating.js"></script>
    <script src="community-loadevent.js"></script>
    <script src="community-deleteevent.js"></script>
    <script src="community-newsletter.js"></script>

    <!-- Javascript Swiper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.0/swiper-bundle.min.js"></script>
</body>
</html>

