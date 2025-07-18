<?php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "biohub_database";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM product_swap WHERE product_id='$product_id'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['productName'];
    $description = $_POST['productDescription'];
    $condition = $_POST['product_condition'];
    $category = $_POST['product_category'];

    $update_sql = "UPDATE product_swap SET productName='$name', productDescription='$description', productCondition='$condition', 
                   productCategory='$category' WHERE product_id='$product_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "Product updated successfully!";
        header("Location: admin_product_database.php"); // Redirect back to the main page
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>
<style>
.edit-swap-product-form {
    font-family: 'Arial', sans-serif;
    background-color: #FCF7EC;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    color: #333;
    }
    
    /* Form container */
    form {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 90%;
    max-width: 600px;
    margin: 20px 0;
    }
    
    /* Heading style */
    h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 20px;
    }
    
    /* Form elements styling */
    label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    }
    
    input[type="text"],
    textarea,
    select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
    }
    
    textarea {
    min-height: 100px;
    resize: vertical;
    }
    
    select {
    height: 40px;
    background-color: white;
    }
    
    /* Button styling */
    input[type="submit"],
    input[type="reset"],
    button {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 12px 20px;
    margin-right: 10px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
    }
    
    input[type="submit"] {
    background-color:rgb(137, 190, 159);
    }
    
    input[type="reset"] {
    background-color:rgb(187, 123, 116);
    }
    
    button {
    background-color:rgb(106, 118, 119);
    }
    
    input[type="submit"]:hover,
    input[type="reset"]:hover,
    button:hover {
    opacity: 0.9;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
    form {
        width: 95%;
        padding: 20px;
    }
    
    input[type="submit"],
    input[type="reset"],
    button {
        padding: 10px 15px;
        font-size: 14px;
        margin-bottom: 10px;
    }
    }
</style>
<?php
include 'adminheader.php'; 
?>
<!DOCTYPE html>
<link rel="stylesheet" href="main.css">
<head>
<title>Edit Swap Product</title>
</head>
<form-body class="edit-swap-product-form">
<h2>Edit Swap Product</h2>
<form method="post">
    <!-- Product Name -->
    <label for="productName">Product Name:</label>
    <input type="text" name="productName" id="productName" value="<?php echo htmlspecialchars($product['productName']); ?>" required><br><br>

    <!-- Product Description -->
    <label for="productDescription">Product Description:</label>
    <textarea name="productDescription" id="productDescription" required><?php echo htmlspecialchars($product['productDescription']); ?></textarea><br><br>

    <!-- Product Condition -->
    <label for="product_condition">Product Condition:</label>
    <input type="text" name="product_condition" id="product_condition" value="<?php echo htmlspecialchars($product['productCondition']); ?>" required><br><br>

    <!-- Product Category -->
    <label>Product Category:</label>
    <select name="product_category" required>
        <option value="Plants" <?php if($product['productCategory'] == "Plants") echo "selected"; ?>>Plants</option>
        <option value="Kitchenware" <?php if($product['productCategory'] == "Kitchenware") echo "selected"; ?>>Kitchenware</option>
        <option value="Toys & Games" <?php if($product['productCategory'] == "Toys & Games") echo "selected"; ?>>Toys & Games</option>
        <option value="Furniture" <?php if($product['productCategory'] == "Furniture") echo "selected"; ?>>Furniture</option>
        <option value="Fashion" <?php if($product['productCategory'] == "Fashion") echo "selected"; ?>>Fashion</option>
        <option value="Books" <?php if($product['productCategory'] == "Books") echo "selected"; ?>>Books</option>
        <option value="Bikes & gear" <?php if($product['productCategory'] == "Bikes & gear") echo "selected"; ?>>Bikes & gear</option>
    </select>
    <br><br>

    <input type="submit" value="Update">
    <input type="reset" value="Clear"> 
    <button type="button" onclick="window.location.href='admin_product_database.php'">Back</button> <!-- Goes back -->
</form>

</form-body>
</html>