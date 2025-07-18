<?php
    include 'conn.php';
    session_start();

    header("Content-Type: application/json");

    // Enable debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Ensure user is logged in
    if (!isset($_SESSION['userid'])) {
        echo json_encode(["success" => false, "message" => "You must be logged in to create an event."]);
        exit();
    }

    // Debugging: Log received POST data and files
    error_log("POST Data: " . print_r($_POST, true));
    error_log("FILES Data: " . print_r($_FILES, true));

    $userid = $_SESSION['userid'];
    $username = $_SESSION['user'];
    $eventname = trim($_POST['eventname'] ?? '');
    $eventdesc = trim($_POST['eventdesc'] ?? '');
    $eventvenue = trim($_POST['eventvenue'] ?? '');
    $eventdate = trim($_POST['eventdate'] ?? '');
    $starttime = trim($_POST['starttime'] ?? '');
    $endtime = trim($_POST['endtime'] ?? '');
    $eventcategory = $_POST['eventcategory'] ?? "General";

    // Validate required fields
    if (empty($eventname) || empty($eventdesc) || empty($eventvenue) || empty($eventdate) || empty($starttime) || empty($endtime)) {
        error_log("Validation Failed: eventname=$eventname, eventdesc=$eventdesc, eventvenue=$eventvenue, eventdate=$eventdate, starttime=$starttime, endtime=$endtime");
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit();
    }
    
    // Handle Image Upload
    $eventImagePath = ""; // Default empty if no image
    if (!empty($_FILES['eventimage']['name'])) {
        $targetDir = __DIR__ . "/../CG_pics/";

        // Ensure uploads directory exists
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $imageName = basename($_FILES["eventimage"]["name"]);
        $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $newFileName = time() . "_" . uniqid() . "." . $imageFileType;
        $targetFile = $targetDir . $newFileName; // Full path

        // Allow only specific image types
        $allowedTypes = ["jpg", "jpeg", "png"];
        if (!in_array($imageFileType, $allowedTypes)) {
            error_log("Invalid file type: $imageFileType");
            echo json_encode(["success" => false, "message" => "Only JPG, JPEG, and PNG files are allowed."]);
            exit();
        }

        // Check file size (max 5MB)
        if ($_FILES["eventimage"]["size"] > 5 * 1024 * 1024) {
            error_log("File too large: " . $_FILES["eventimage"]["size"]);
            echo json_encode(["success" => false, "message" => "Image file size is too large. Max 5MB allowed."]);
            exit();
        }

        // Move the uploaded file
        if (move_uploaded_file($_FILES["eventimage"]["tmp_name"], $targetFile)) {
            $eventImagePath = "CG_pics/" . $newFileName; // Save relative path in DB
        } else {
            error_log("Error moving uploaded file");
            echo json_encode(["success" => false, "message" => "Error uploading image."]);
            exit();
        }
    }

    // Insert data using prepared statement
    $query = "INSERT INTO `community_events` (`eventname`, `eventdesc`, `eventvenue`, `eventdate`, `starttime`, `endtime`, `eventimage`, `userid`, `username`, `eventcategory`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Statement preparation failed: " . mysqli_error($conn)]);
        exit();
    }

    if (!mysqli_stmt_bind_param($stmt, "ssssssssss", $eventname, $eventdesc, $eventvenue, $eventdate, $starttime, $endtime, $eventImagePath, $userid, $username, $eventcategory)) {
        echo json_encode(["success" => false, "message" => "Binding parameters failed: " . mysqli_error($conn)]);
        exit();
    }

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => true, "message" => "Event created successfully."]);
        header("Location: community.php");
        exit();
    } else {
        echo json_encode(["success" => false, "message" => "Database error: " . mysqli_error($conn)]);
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
