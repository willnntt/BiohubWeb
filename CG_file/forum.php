<?php
    session_start();
    $current_page = basename($_SERVER['PHP_SELF']); // Gets the current file name
    $userID = $_SESSION['userid'] ?? null; // Allow guest users
    $isLoggedIn = $userID !== null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biohub - Forum</title>
    <link rel="stylesheet" href="../main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
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

    <script src="index.js"></script>
    <script>
    function toggleMobileMenu() {
        document.querySelector(".mobile-menu").classList.toggle("open");
    }
    </script>

    <CG-body>
    <!-- CONTENT -->
    <div class="forum-page">
        <div class="forum-header">
            <h1>COMMUNITY FORUM</h1>
            <div class="back-button-container">
            <a href="community.php">
                <button class="back-button">Back</button>                
            </a>
        </div>
        </div>

        <div class="filter-container">
            <p>Sort by:</p>
            <button class="filter-button active" id="newest-first">Newest</button>
            <button class="filter-button" id="oldest-first">Oldest</button>
            <button class="filter-button" id="top-rated">Top Rated</button>
        </div>

        <div class="comment-overlay-container">
            <?php if (!$isLoggedIn): ?>
                <div class="overlay">
                    <p class="overlay-text">Please login first to comment</p>
                </div>
            <?php endif; ?>

            <div class="input-message-container <?php echo !$isLoggedIn ? 'disabled' : ''; ?>">
                <form action="create_comment.php" method="post" class="input-message">
                    <input type="text" name="comment_title" placeholder="Enter title here..." required="required" class="input-message-box title">
                    <hr>
                    <input type="text" name="comment_message" placeholder="Enter comment here..." required="required" class="input-message-box">
                    
                    <div class="button-holder">
                        <button class="send-button material-icons" type="submit" name="commentBtn">send</button>  
                    </div>                 
                </form>
            </div>
        </div>

        <div id="comments-section"></div>

        <div class="pagination">
            <button class="previous-button material-icons" id="prev-btn">arrow_back_ios</button>
            <p id="page-info"></p>
            <button class="next-button material-icons" id="next-btn">arrow_forward_ios</button>
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
    
    <script src="forum-loadcomment.js"></script>
    <script src="forum-deletecomment.js"></script>
    <script src="rating.js"></script>
</body>
</html>