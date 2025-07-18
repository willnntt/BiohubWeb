<?php
if (isset($_POST['create'])) {
    $productName        = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productCondition   = $_POST['productCondition'];
    $productCategory    = $_POST['productCategory']; 

    $host    = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "biohub_database";

    // Connect to the database
    $conn = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle Image Upload (using the "image" file input)
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";

        // Ensure uploads directory exists
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create folder with full permissions
        }

        $imageName = basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Allow only specific image types
        $allowedTypes = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedTypes)) {
            die("Error: Only JPG, JPEG, PNG, and GIF files are allowed.");
        }

        // Move the uploaded file
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            die("Error uploading image.");
        }
    } else {
        $imageName = ""; // No image uploaded
    }

    // Insert data using prepared statement
    $sql = "INSERT INTO product_swap (productName, productDescription, productCondition, productCategory, image) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if(!$stmt){
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("sssss", $productName, $productDescription, $productCondition, $productCategory, $imageName);

    if ($stmt->execute()) {
        header("Location: productswap.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    

    // Close connections
    $stmt->close();
    $conn->close();
}
?>