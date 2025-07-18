<?php
// Database connection 
$host    = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "biohub_database";

// Connect to the database
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initial query to fetch all products
$sql = "SELECT * FROM product_swap";

// Check if search is performed
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM product_swap 
            WHERE productName LIKE '%$search%' 
            OR productDescription LIKE '%$search%' 
            OR productCategory LIKE '%$search%'";
}

$result = $conn->query($sql);
?>
<?php
include 'adminheader.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Swap Database</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/87e5c78782.js"></script>
    <style>
    .search-container-swap form {
        width: 100%;
        display: flex;
        justify-content: center;
        background-color: #FCF7EC;
        padding: 20px 0; /* Added padding for spacing */
    }

    /* Search box styling */
    .search-box-swap {
        /* display: flex; */
        justify-content: center;
        padding: 10px;
        width: 80%; 
        border-radius: 40px;
        background: #E5F2E0;
        border: 2px solid #809671;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease-in-out;
    }
    </style>
</head>
<body>
    <main class="content">
        <section>
            <div class="database_title">
                <h1>Product Database</h1>
            </div>             
        </section>
        <section>
            <div class="search-container-swap">
                <form method="GET" action="">
                    <div class="search-box-swap">
                        <input class="search-input" type="search" name="search" placeholder="Search product here" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </section>
        <div class="table-container">
            <table class="database">
                <thead>
                    <tr>
                        <th>ProductID</th>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Product Condition</th>
                        <th>Product Category</th>
                        <th>Image</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['product_id']}</td>
                                <td>{$row['productName']}</td>
                                <td>{$row['productDescription']}</td>
                                <td>{$row['productCondition']}</td>
                                <td>{$row['productCategory']}</td>
                                <td><img src='uploads/{$row['image']}' alt='image' width='100'></td>
                                <td>
                                    <a href='edit_product.php?id={$row['product_id']}' class='edit_btn'><i class='fa-solid fa-pen-to-square'></i></a>
                                    <a href='delete_product.php?id={$row['product_id']}' class='delete_btn' onclick='return confirm(\"Are you sure you want to delete this product?\")'><i class='fa-solid fa-trash'></i></a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No products found</td></tr>";
                    }
                ?>
                </tbody>
            </table>        
        </div>
    </main>
</body>
</html>

<?php $conn->close(); ?>