<?php

header('Content-Type: application/json');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'biohub_database';

// Connect to database
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Get product_id from POST or JSON request
$product_id = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['product_id'])) {
        $product_id = htmlspecialchars($_POST['product_id']);
    } else {
        $data = json_decode(file_get_contents("php://input"), true);
        $product_id = $data['product_id'] ?? null;
    }
}

if (!$product_id) {
    die(json_encode(["error" => "Invalid product ID"]));
}

// Check if product exists
$checkSql = "SELECT product_id FROM product_swap WHERE product_id = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("i", $product_id);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows === 0) {
    $checkStmt->close();
    die(json_encode(["error" => "Product not found"]));
}
$checkStmt->close();

// Delete the product from product_swap table
$deleteSql = "DELETE FROM product_swap WHERE product_id = ?";
$deleteStmt = $conn->prepare($deleteSql);
$deleteStmt->bind_param("i", $product_id);

if ($deleteStmt->execute()) {
    header("Location: productswap.php");
    exit();
} else {
    echo json_encode(["error" => "Swap failed: " . $deleteStmt->error]);
}

$deleteStmt->close();
$conn->close();

?>
