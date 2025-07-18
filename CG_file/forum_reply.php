<?php
    session_start();
    $current_page = basename($_SERVER['PHP_SELF']); // Gets the current file name

    include 'conn.php';

    $userID = $_SESSION['userid'] ?? null; // Allow guest users
    $isLoggedIn = $userID !== null;

    $questionid = $_GET['commentid'] ?? '';

    if (!$questionid) {
        echo "No comment ID provided!";
    }
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

    <script src="../index.js"></script>
    <script>
    function toggleMobileMenu() {
        document.querySelector(".mobile-menu").classList.toggle("open");
    }
    </script>
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
    <!-- CONTENT -->
    <div class="reply-page">
        <div class="back-button-container">
            <a href="forum.php">
                <button class="back-button">Back</button>                
            </a>
        </div>

        <div id="main-comment-container" questionid="<?php echo $questionid; ?>">
            <div class="header-container">    
                <div class="profile-container">
                    <div class="header-topic">
                        <div id="title-container"></div>
                        <div id="username-container">Username</div>
                        <div id="date-container">2025-02-20</div>
                    </div>
                </div>

                <div class="header-container-right">
                    <div class="rating-container" id="question-rating-container">
                        <button class="like-button material-icons">
                            thumb_up
                        </button>
                        <div id="rating-holder"></div>
                        <button class="dislike-button material-icons">
                            thumb_down
                        </button>
                        <button class="delete-button material-icons" type="submit" name="deleteComment">delete</button>
                    </div>
                </div>
            </div>
            <hr>

            <div class="question-container" id="question-container"></div>
        </div>


        <div class="reply-overlay-container">
            <?php if (!$isLoggedIn): ?>
                <div class="overlay">
                    <p class="overlay-text">Please login first to reply</p>
                </div>
            <?php endif; ?>

            <div class="enter-reply-container <?php echo !$isLoggedIn ? 'disabled' : ''; ?>">
                <form action="create_reply.php" method="post" class="input-reply">
                    <input type="text" name="reply_message" placeholder="Enter comment here..." required="required" class="input-message">
                    <input type="hidden" name="commentid" value="<?php echo $questionid; ?>">

                    <button class="send-button material-icons" type="submit" name="replyBtn">send</button>                    
                </form>
            </div>
        </div>

        <div class="sort-by-container">
            <label for="reply-sort">Sort by:</label>

            <select name="sort-dropdown" id="reply-sort">
                <option value="top-replies" selected>Top Replies</option>
                <option value="newest-replies">Newest</option>
                <option value="oldest-replies">Oldest</option>
            </select>
        </div>

        <div id="reply-section"></div>

        <div class="pagination">
            <button class="previous-button material-icons" id="prev-btn">arrow_back_ios</button>
            <p id="page-info"></p>
            <button class="next-button material-icons" id="next-btn">arrow_forward_ios</button>
        </div>
    </div>

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

    <script src="forumr-deletereply.js"></script>
    <script src="forumr-loadreply.js"></script>
    <script src="rating.js"></script>
</body>
</html>