<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List product</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <body>

        <?php
include 'header.php';?>

        <body>
            <body>
                <section class="addProduct">
                    <h2>Add your product</h2>
                    <form action="swapping_form.php" method="POST" enctype="multipart/form-data">
                        <label for="productName">Product Name:</label>
                        <input type="text" id="productName" name="productName" required>
                        <br><br>
                        <label for="productDescription">Product Description:</label>
                        <textarea id="productDescription" name="productDescription" required></textarea>
                        <br><br>
                        <label for="productCondition">Product Condition:</label>
                        <!-- The rating mechanism sets the hidden field -->
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5" onclick="updateRating(5)">★</label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" onclick="updateRating(4)">★</label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" onclick="updateRating(3)">★</label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" onclick="updateRating(2)">★</label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" onclick="updateRating(1)">★</label>
                        </div>
                        <p id="selectedRating">Select a rating</p>
                        <input type="hidden" id="productCondition" name="productCondition">
                        <br>
                        <label for="productImage">Image:</label>
                        <!-- Ensure name matches your PHP code; here we use "image" -->
                        <input type="file" id="productImage" name="image" required>
                        <br><br>
                        <label for="productCategory">Product Category:</label>
                        <select id="productCategory" name="productCategory" required>
                            <option value="" disabled selected>Select a category</option>
                            <option value="Plants">Plants</option>
                            <option value="Kitchenware">Kitchenware</option>
                            <option value="Toys & Games">Toys & Games</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Fashion">Fashion</option>
                            <option value="Books">Books</option>
                            <option value="Bikes & Gear">Bikes & Gear</option>
                        </select>
                        <br><br>
                        <button type="submit" name="create">List Product</button>
                        
                    </form>
                </section>
            
                <script>
                    function updateRating(value) {
                        document.getElementById("selectedRating").innerText = value + " Stars";
                        document.getElementById("productCondition").value = value;
                    }
            
                    document.querySelectorAll('input[name="rating"]').forEach((radio) => {
                        radio.addEventListener("change", function() {
                            updateRating(this.value);
                        });
                    });
                </script>
    </body>
</html>
    