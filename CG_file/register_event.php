    <?php
    include 'conn.php';
    session_start();

    header("Content-Type: application/json");

    if (!isset($_SESSION['userid'])) {
        echo json_encode(["success" => false, "message" => "You must be logged in."]);
        exit;
    }

    $userid = $_SESSION['userid'];
    $eventid = $_GET['eventid'] ?? $_POST['eventid'] ?? null;

    if (!$eventid) {
        echo json_encode(["success" => false, "message" => "No event ID provided."]);
        exit;
    }

    // Check join status request
    if (isset($_GET['check_status'])) {
        $result = mysqli_query($conn, "SELECT joinstatus FROM event_register WHERE userid = '$userid' AND eventid = '$eventid'");
        if ($row = mysqli_fetch_assoc($result)) {
            echo json_encode(["success" => true, "joinstatus" => (int)$row['joinstatus']]);
        } else {
            echo json_encode(["success" => true, "joinstatus" => 0]);
        }
        exit;
    }

    // Toggle join/leave status
    $result = mysqli_query($conn, "SELECT joinstatus FROM event_register WHERE userid = '$userid' AND eventid = '$eventid'");
    if ($row = mysqli_fetch_assoc($result)) {
        $newStatus = $row['joinstatus'] == 1 ? 0 : 1;
        $query = "UPDATE event_register SET joinstatus = $newStatus WHERE userid = '$userid' AND eventid = '$eventid'";
        mysqli_query($conn, $query);
    } else {
        $newStatus = 1;
        $query = "INSERT INTO event_register (userid, eventid, joinstatus) VALUES ('$userid', '$eventid', $newStatus)";
        mysqli_query($conn, $query);
    }

    echo json_encode(["success" => true, "joinstatus" => $newStatus]);
    mysqli_close($conn);

?>
