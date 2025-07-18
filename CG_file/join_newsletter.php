<?php
    include 'conn.php';
    session_start();

    header("Content-Type: application/json");

    if (!isset($_SESSION['userid'])) {
        echo json_encode(["success" => false, "message" => "You must be logged in."]);
        exit;
    }

    $userid = $_SESSION['userid'];

    // Check join status request
    if (isset($_GET['check_status'])) {
        $result = mysqli_query($conn, "SELECT joinnewsletter FROM community_newsletter WHERE userid = '$userid'");
        if ($row = mysqli_fetch_assoc($result)) {
            echo json_encode(["success" => true, "joinnewsletter" => (int)$row['joinnewsletter']]);
        } else {
            echo json_encode(["success" => true, "joinnewsletter" => 0]); // Default not joined
        }
        exit;
    }

    // Toggle join/leave status
    $result = mysqli_query($conn, "SELECT joinnewsletter FROM community_newsletter WHERE userid = '$userid'");
    if ($row = mysqli_fetch_assoc($result)) {
        $newStatus = $row['joinnewsletter'] == 1 ? 0 : 1;
        mysqli_query($conn, "UPDATE community_newsletter SET joinnewsletter = $newStatus WHERE userid = '$userid'");
    } else {
        $newStatus = 1;
        mysqli_query($conn, "INSERT INTO community_newsletter (userid, joinnewsletter) VALUES ('$userid', $newStatus)");
    }

    echo json_encode(["success" => true, "joinnewsletter" => $newStatus]);
    mysqli_close($conn);
?>
