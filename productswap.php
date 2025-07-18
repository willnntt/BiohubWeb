<?php

// Database Connection
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "biohub_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT product_id, productName, productDescription, productCondition, image, productCategory FROM product_swap";
$result = $conn->query($sql);

$allProducts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $allProducts[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swap & Share</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    
<?php
include 'header.php'; 
?>
    <nav class="PS-breadcrumbs">
        <span class="PS-breadcrumbs-items">
            <a href="home.php" class="PS-breadcrumbs-link">Home</a>
        </span>
        <span class="PS-breadcrumbs-items">
            <a href="productswap.php" class="PS-breadcrumbs-link">Swap & Share</a>
        </span>
    </nav>
    <section>
        <div class="PS-banner">
            <div class="PS-banner-content active">
                <h1>Swap & Share</h1>
                    <p>Exchange what you have, get what you need sustainable, simple, and community-driven</p>
            </div>
    </section>
    <style>
    .PS-banner {
        padding: 2rem;
        width: 100%;
        height: 90vh; /* Default height for larger screens */
        min-height: 400px; /* Prevents content squishing */
        position: relative;
        background: url('banner/PS_bg.jpg') no-repeat center center;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: left; /* Centers content */
        text-align: left;
        color: white; /* Ensures readability */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding-left: 80px;
    }

    .PS-banner-content {
        max-width: 80%;
    }

    .PS-banner-content h1 {
        color: #F8E9D8;
        font-weight: 500;
        font-size: clamp(2rem, 5vw, 3.125rem); /* Responsive font size */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin-bottom: 1rem;
        line-height: 1.2;
        padding-left: 0; 
    }

    .PS-banner-content h4 {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 400;
        font-size: clamp(1.25rem, 3vw, 2rem); /* Increased font size */
        margin-bottom: 1rem;
        padding-left: 0; 
    }

    </style>
    <main class="content" style="padding-top: 0; background-color: #FCF7EC;">
        <section class="swap-content" style="background-color: #FCF7EC;" >
        <div class="category"><h2>Popular Categories</h2></div>

    <div class="category-container">
        <button class="nav-button prev hidden" onclick="scrollCategoriesLeft()" id="prevBtn">&#x276E;</button>
        <div class="category-wrapper" id="categoryWrapper">
            <div class="category-box" data-category="All">
                <img src="PS_pic/swapPlants.png" alt="All">
                <span>All Swappable Product</span>
            </div>
            <div class="category-box" data-category="Plants">
                <img src="PS_pic/swapPlants.png" alt="Plants">
                <span>Plants</span>
            </div>
            <div class="category-box" data-category="Kitchenware">
                <img src="PS_pic/swapKitchenwarepng.png" alt="Kitchenware">
                <span>Kitchenware</span>
            </div>
            <div class="category-box" data-category="Toys & Games">
                <img src="PS_pic/swaptoys.png" alt="Toys & Games">
                <span>Toys and games</span>
            </div>
            <div class="category-box" data-category="Furniture">
                <img src="PS_pic/swapFurniture.png" alt="Furniture">
                <span>Furnitures</span>
            </div>
            <div class="category-box" data-category="Fashion">
                <img src="PS_pic/swapClothes.jpg" alt="Fashion">
                <span>Fashion</span>
            </div>
            <div class="category-box" data-category="Books">
                <img src="PS_pic/swapBooks.jpg" alt="Books">
                <span>Books</span>
            </div>
            <div class="category-box" data-category="Bikes & Gear">
                <img src="PS_pic/swapBike.png" alt="Bikes & Gear">
                <span>Bike & Gear</span>
            </div>
        </div>
        <button class="nav-button next" onclick="scrollRight()" id="nextBtn">&#x276F;</button>
    </div>
    <script src="productcategory.js"></script>

    <div class="search-bar">
        <input type="text" id="search-bar" placeholder="Search products...">
        <button class="search-btn">
            <i class="fas fa-search"></i>
        </button>
    </div> 
    
    <div class="list"><a href="list-product.php" class="list_btn">List Product</a></div>

    <div id="product-container">
        <?php if (empty($allProducts)): ?>
            <section class="no-products">
                <p>No items available for swap.</p>
                <a class="add-product-btn" href="list-product.php">Add a Product</a>
            </section>
        <?php else: ?>
            <?php foreach ($allProducts as $product): ?>
                <div class="product-card">
                    <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" 
                         alt="<?php echo htmlspecialchars($product['productName']); ?>" 
                         class="product-image">
                    <h3><?php echo htmlspecialchars($product['productName']); ?></h3>
                    <p><?php echo htmlspecialchars($product['productDescription']); ?></p>
                    <p>Condition: <?php echo htmlspecialchars($product['productCondition']); ?> Stars</p>
                    <button class="swap-btn" data-product-id="<?php echo htmlspecialchars($product['product_id']); ?>">Swap</button>
                    
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

        <!-- Confirmation Popup Panel -->
        <div id="swapPanel" class="panel">
        <div class="panel-content">
            <h2>Confirm Swap</h2>
            <p>Are you sure you want to swap this product?</p>
            <form action="swapprocess.php" method="post">
                <input type="hidden" name="product_id" id="product_id">
                <div class="panel-buttons">
                <button type="button" class="cancelBtn">Cancel</button>
                <button type="submit" class="confirmBtn">Confirm</button>
                </div>
                </div>
            </form>
        </div>
    </div>
    </main>

    <script>
    // Embedded initial products data
    const allProducts = <?php echo json_encode($allProducts); ?>;

    document.addEventListener("DOMContentLoaded", function () {
        function displayProducts(products) {
            const productContainer = document.getElementById("product-container");
            productContainer.innerHTML = ""; 

            if (products.length === 0) {
                productContainer.innerHTML = `
                    <section class="no-products">
                        <p>No items available for swap.</p>
                        <a class="add-product-btn" href="list-product.php">Add a Product</a>
                    </section>
                `;
            } else {
                products.forEach(product => {
                    const productCard = document.createElement("div");
                    productCard.classList.add("product-card");
                    
                    productCard.innerHTML = `
                        <img src="uploads/${product.image}" alt="${product.productName}" class="product-image">
                        <h3>${product.productName}</h3>
                        <p>${product.productDescription}</p>
                        <p>Condition: ${product.productCondition} Stars</p>
                        <button class="swap-btn" data-product-id="${product.product_id}">Swap</button>


                    `;
                    productContainer.appendChild(productCard);
                });
                attachSwapButtonListeners();
            }
        }

        function attachSwapButtonListeners() {
        const panel = document.getElementById("swapPanel");
        const cancelBtn = document.querySelector(".cancelBtn");
        const productIdInput = document.getElementById("product_id");

        const swapButtons = document.querySelectorAll(".swap-btn");
        swapButtons.forEach(button => {
            button.addEventListener("click", function () {
                const productId = this.getAttribute("data-product-id");
                productIdInput.value = productId;
                panel.style.display = "block";
            });
        });

        cancelBtn.addEventListener("click", function() { 
            panel.style.display = "none";
        });
    }

        // Filter function
        function filterProducts(category) {
            if (category === "All") {
                displayProducts(allProducts);
            } else {
                const filteredProducts = allProducts.filter(product => product.productCategory === category);
                displayProducts(filteredProducts);
            }
        }

        // Add event listener to each category box
        document.querySelectorAll(".category-box").forEach(box => {
            box.addEventListener("click", function () {
                const selectedCategory = this.getAttribute("data-category");
                filterProducts(selectedCategory);
            });
        });

        // Function for Search Bar
        function searchProducts() {
            const searchInput = document.getElementById("search-bar").value.toLowerCase();
            const filteredProducts = allProducts.filter((product) => {
                return (
                    product.productName.toLowerCase().includes(searchInput) ||
                    product.productDescription.toLowerCase().includes(searchInput) ||
                    product.productCategory.toLowerCase().includes(searchInput)
                );
            });
            displayProducts(filteredProducts); 
        }

        document.querySelector(".search-btn").addEventListener("click", searchProducts);
    });

    document.addEventListener("DOMContentLoaded", function() {
    const panel = document.getElementById("swapPanel"); // Get the swap panel
    const cancelBtn = document.querySelector(".cancelBtn"); // Get the cancel button
    const productIdInput = document.getElementById("product_id"); // Get the hidden input

    const swapButtons = document.querySelectorAll(".swap-btn");
    swapButtons.forEach(button => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-product-id");
            productIdInput.value = productId; // Set product ID in the hidden input
            panel.style.display = "block"; // Show the swap panel
        });
    });

    cancelBtn.addEventListener("click", function() { 
        panel.style.display = "none"; // Hide the panel when cancel is clicked
    });
});

    </script>


</section>
</body>
</html>
<?php
include 'footer.php'; 
?>   