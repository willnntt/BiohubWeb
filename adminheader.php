    <?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>
<html lang="en">
    <link rel="stylesheet" href="main.css">
    <header class="header">
        <nav class="nav">
            <img src="logo.png" class="header-logo">
            <ul class="nav_items">
                <li class="nav_item">
                <!-- <img src="logo.png" class="header-logo"> -->
                <a href="admin_home.php" class="nav_link">Home</a>
                    <a href="admin_event_database.php" class="nav_link">Recycling Program</a>
                    <a href="admin_ect_database.php" class="nav_link">Energy Conservation Tips</a>
                    <a href="CG_file/community_event_database.php" class="nav_link">Our Community</a>
                    <a href="admin_product_database.php" class="nav_link">Swap & Share</a>

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
    <script src="index.js"></script>
    <script>
    function toggleMobileMenu(menu) {
        menu.classList.toggle("open");
    }
    </script>