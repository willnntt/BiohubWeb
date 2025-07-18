<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure the variable is set
$current_page = basename($_SERVER['PHP_SELF']);
?>

<html lang="en">
    <link rel="stylesheet" href="main.css">
    <header class="header">
        <nav class="nav">
            <img src="logo.png" class="header-logo">
            <ul class="nav_items">
                <li class="nav_item">
                    <a href="home.php" class="nav_link">Home</a>
                    <a href="recycling_program.php" class="nav_link">Recycling Program</a>
                    <a href="ECT.php" class="nav_link">Energy Conservation Tips</a>
                    <a href="CG_file/community.php" class="nav_link">Our Community</a>
                    <a href="productswap.php" class="nav_link">Swap & Share</a>

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
            
            <div id="hamburger-icon" onclick="toggleMobileMenu()">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div> 

            <ul class="mobile-menu">
                <li><a href="index.php" class="nav_link">Home</a></li>
                <li><a href="recycling_program.php" class="nav_link">Recycling Program</a></li>
                <li><a href="energy_tips.php" class="nav_link">Energy Conservation Tips</a></li>
                <li><a href="community.php" class="nav_link">Our Community</a></li>
                <li><a href="swap_share.php" class="nav_link">Swap & Share</a></li>

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

    <script>function toggleMobileMenu() {
    document.querySelector(".mobile-menu").classList.toggle("open");
    document.getElementById("hamburger-icon").classList.toggle("open");
}
    </script>
</html>